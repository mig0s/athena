<?php

namespace frontend\controllers;

use common\models\Item;
use Yii;
use common\models\Loan;
use backend\models\search\LoanSearch;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\PermissionHelpers;
use common\models\ValueHelpers;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\SqlDataProvider;

/**
 * LoanController implements the index and view actions for Loan model.
 */
class LoanController extends Controller
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
                        'actions' => ['index', 'overdue-items'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireMinimumRole('User') && PermissionHelpers::requireStatus('Active');
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
     * Lists all Loan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoanSearch();
        $query = Loan::find()->where(['user_id' => Yii::$app->user->id ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Loan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $user = $this->findModel($id)->user_id;
        if (PermissionHelpers::requireMinimumRole('Admin')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } elseif (PermissionHelpers::userMustBeOwner('loan', $this->findModel($id)->id)) { //($user == Yii::$app->user->id)
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new NotFoundHttpException('You are trying to access unknown record!');
        }
    }

    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
