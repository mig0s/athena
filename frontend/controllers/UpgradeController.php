<?php

namespace frontend\controllers;

use common\models\PermissionHelpers;
use common\models\RecordHelpers;
use common\models\User;
use common\models\ValueHelpers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class UpgradeController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return PermissionHelpers::requireStatus('Active');
                        }
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if ($already_exists = RecordHelpers::userHas('profile')) {
            $name = ValueHelpers::getFisrtName($already_exists);
        } else {
            $name = \Yii::$app->user->identity->id;
        }
        return $this->render('index', ['name' => $name]);
    }
}
