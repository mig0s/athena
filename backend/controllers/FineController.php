<?php

namespace backend\controllers;

use common\models\Loan;
use Yii;
use common\models\Fine;
use backend\models\search\FineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DatePeriod;
use DateInterval;
use DateTime;
use yii\filters\AccessControl;
use common\models\PermissionHelpers;

/**
 * FineController implements the CRUD actions for Fine model.
 */
class FineController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update','delete', 'view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireMinimumRole('Admin') && PermissionHelpers::requireStatus('Active');
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Fine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fine model.
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
     * Creates a new Fine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new Fine();
        if ($id !== null) {
            $loan = Loan::findOne($id);

            $days = new DatePeriod(
                DateTime::createFromFormat('Y-m-d', $loan->return_date),
                new DateInterval('P1D'),
                new DateTime()
            );

            $overdue = 0;

            foreach ($days as $day) {
                $overdue++;
            }

            $amount = $overdue * 0.5; // TODO: add dynamic fine rate

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->waived_by = Yii::$app->user->id;
                $model->update();
                $loan->delete();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->user_id = $loan->user_id;
                $model->item_id = $loan->item_id;
                $model->amount = $amount;
                $model->waived_by = Yii::$app->user->id;
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Fine model.
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
     * Deletes an existing Fine model.
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
     * Finds the Fine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fine::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
