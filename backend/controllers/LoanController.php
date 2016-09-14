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
use backend\models\search\LoanSearch;
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
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends Controller
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
        $searchModel = new LoanSearch();
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

            $calcReturn = new ReturnDate(
                new DateTime()
            );

            $loanDuration = SpotTag::findOne($item->spot_tag_id)->loan_duration;

            $calcReturn->addBusinessDays($loanDuration);

            $model->return_date = $calcReturn->getDate()->modify('+ 1 day')->format('Y-m-d');

            if ((PermissionHelpers::loanPermission($user, $item)) && ($model->save())) {

                $item->item_status_id = 5;
                $item->update();

                return $this->redirect(['view', 'id' => $model->id]);

            } elseif (!(PermissionHelpers::loanPermission($user, $item))) {

                throw new ForbiddenHttpException('Item is not Available and/or this User is not allowed to borrow this item!');
            }

        } elseif (is_null(Yii::$app->request->post('user_id')) && is_null(Yii::$app->request->post('item_id'))) {
            return $this->render('create', [
                $model->loan_status_id = 1,
                'model' => $model,
            ]);
        } else {
            $item_id = Yii::$app->request->post('item_id');
            $user_id = Yii::$app->request->post('user_id');
            return $this->render('create', [
                $model->user_id = $user_id,
                $model->item_id = $item_id,
                $model->loan_status_id = 1,
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
     * Renews an existing Loan model.
     * If renew is successful, the browser will be redirected to the 'view' page. Otherwise there will be an Forbidden exception thrown.
     * @return mixed
     * @throws mixed
     */

    public function actionRenew()
    {
        $id = Yii::$app->request->post('id');

        $model = $this->findModel($id);

        if (!(is_null($model->renewal_count)) && ($model->renewal_count >= SpotTag::findOne(Item::findOne($model->item_id))->renewal_limit)) {
            throw new ForbiddenHttpException('Renewal limit of this item has been reached by the user!');
        } else {

            $today = new DateTime();

            $loanDuration = SpotTag::findOne(Item::findOne($model->item_id)->spot_tag_id)->loan_duration;

            if (is_null($model->renewal_count)) {
                $model->renewal_count = 0;
            }

            $calcReturn = new ReturnDate(
                date_create_from_format('Y-m-d', $model->return_date) // Today
            // [$skipDays], //new DateTime("2014-06-01"), new DateTime("2014-06-02")
            // [ReturnDate::SATURDAY]
            );

            $calcReturn->addBusinessDays($loanDuration);

            $model->return_date = $calcReturn->getDate()->modify('+ 1 day')->format('Y-m-d');
            $model->recent_renewal = $today->format('Y-m-d');
            $model->renewal_count++;
            $model->update();

            return $this->redirect(['view', 'id' => $model->id]);
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
        $model = $this->findModel($id);

        if (date_create_from_format('Y-m-d', $model->return_date) < new DateTime()) {
            $this->redirect(['/fine/create', 'id' => $model->id])->send();
            // throw new ForbiddenHttpException('You need to collect a fine for this item!');
        } else {
            $item = Item::findOne($this->findModel($id)->item_id);
            $model->delete();
            $item->item_status_id = 1;
            $item->update();
            return $this->redirect(['index']);
        }
    }
    /**
     * Returns an item recorded in an existing Loan model.
     * If return is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReturn($id)
    {
        $model = $this->findModel($id);

        if (date_create_from_format('Y-m-d', $model->return_date) < new DateTime()) {
            $this->redirect(['/fine/create', 'id' => $model->id])->send();
            // throw new ForbiddenHttpException('You need to collect a fine for this item!');
        } else {
            $item = Item::findOne($this->findModel($id)->item_id);
            $model->loan_status_id = 2;
            $model->return_date = date('Y-m-d');
            $model->update();
            $item->item_status_id = 1;
            $item->update();
            return $this->redirect(['index']);
        }
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
