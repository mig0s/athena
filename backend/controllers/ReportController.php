<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use common\models\PermissionHelpers;

class ReportController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'popular-books', 'popularBooks'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireMinimumRole('Admin') && PermissionHelpers::requireStatus('Active');
                        }
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPopularBooks()
    {
        return $this->render('popular-books');
    }

}
