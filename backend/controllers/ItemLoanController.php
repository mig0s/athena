<?php

namespace backend\controllers;

use common\models\Item;
use common\models\PermissionHelpers;
use common\models\SettingsHolidays;
use common\models\SettingsWorkingDays;
use common\models\SpotTag;
use common\models\User;
use common\models\ValueHelpers;
use Yii;
use common\models\Loan;
use backend\models\search\ItemLoanSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use common\models\ReturnDate;
use DateTime;
use DatePeriod;
use DateInterval;

/**
 * ItemLoanController implements the CRUD actions for Loan model.
 */
class ItemLoanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Loan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemLoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Loan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Loan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Loan();
        if ($model->load(Yii::$app->request->post())) {
            $loan = Yii::$app->request->post('Loan');
            $item = Item::findOne($loan['item_id']);
            $user = User::findOne($loan['user_id']);
            if ((PermissionHelpers::loanPermission($user, $item)) && ($model->save())) {

                $holidays = SettingsHolidays::find()->asArray()->where('start_date > NOW()')->all();
                $holidays = ArrayHelper::map($holidays, 'start_date', 'duration');

                $skipDays = array();

                foreach ($holidays as $holiday => $holidayDuration) {
                    $holidayStart = new DateTime($holiday);
                    $holidayEnd = new DateTime($holiday);
                    while ($holidayDuration > 0) {
                        $holidayEnd = $holidayEnd->modify('+1 day');
                        $holidayDuration--;
                    }

                    $days = new DatePeriod(
                        $holidayStart,
                        new DateInterval('P1D'),
                        $holidayEnd
                    );

                    foreach ($days as $day) {
                        $skipDays[] = $day;
                    }
                }

                $calculator = new ReturnDate(
                    new DateTime(), // Today
                    [$skipDays], //new DateTime("2014-06-01"), new DateTime("2014-06-02")
                    [ReturnDate::SATURDAY]
                );

                $loanDuration = SpotTag::findOne($item->spot_tag_id)->loan_duration;

                $calculator->addBusinessDays($loanDuration);

                $model->return_date = $calculator->getDate()->modify('+ 1 day')->format('Y-m-d');
                $model->update();

                $item->item_status_id = 5;
                $item->update();

                return $this->redirect(['view', 'id' => $model->id]);

            } elseif (!(PermissionHelpers::loanPermission($user, $item))) {

                throw new ForbiddenHttpException('Item is not Available and/or this User is not allowed to borrow this item!');

            }

        } elseif (is_null(Yii::$app->request->post('user_id')) && is_null(Yii::$app->request->post('item_id'))) {
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            $item_id = Yii::$app->request->post('item_id');
            $user_id = Yii::$app->request->post('user_id');
            return $this->render('create', [
                $model->user_id = $user_id,
                $model->item_id = $item_id,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Loan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Loan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $item = Item::findOne($this->findModel($id)->item_id);
        $this->findModel($id)->delete();
        $item->item_status_id = 1;
        $item->update();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Loan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
