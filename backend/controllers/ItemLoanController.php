<?php

namespace backend\controllers;

use common\models\Item;
use common\models\PermissionHelpers;
use common\models\SpotTag;
use common\models\User;
use Yii;
use common\models\Loan;
use backend\models\search\ItemLoanSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

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
            $spotTag = $item->spot_tag_id;

            if (PermissionHelpers::loanPermission($user, $item)) {

                if ($model->save()) {

                    $item->item_status_id = 5;
                    $item->update();

                    $loanDuration = SpotTag::findOne($spotTag)->loan_duration;
                    $date = date('Y-m-d', strtotime('+' . $loanDuration . ' days'));
                    $model->return_date = $date;
                    $model->update();

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                throw new ForbiddenHttpException('Item is not Available and/or this User is not allowed to borrow this item!');
            }
        } elseif (is_null(Yii::$app->request->post('user_id')) && is_null(Yii::$app->request->post('item_id')) == true) {
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
        $this->findModel($id)->delete();

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
