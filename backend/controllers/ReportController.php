<?php

namespace backend\controllers;

use yii\data\ActiveDataProvider;
use yii\db\Query;
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
                        'actions' => ['index', 'popular-books', 'popular-categories', 'popular-subcategories'],
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

    public function actionPopularCategories()
    {
        $query = new Query();
        $query->select('c.name, COUNT(item_id) AS Count
                        FROM loan AS l
                        INNER JOIN item AS i ON l.item_id = i.id
                        INNER JOIN category AS c ON i.category_id = c.id
                        WHERE year(initial_loan) = year(current_timestamp) AND month(initial_loan) = month(current_timestamp)
                        GROUP BY c.name
                        ORDER BY COUNT(item_id) DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $provider,
            'title' => 'Popular Categories'
        ]);
    }

    public function actionPopularSubcategories()
    {
        $query = new Query();
        $query->select('c.name, COUNT(item_id) AS Count
                        FROM loan AS l
                        INNER JOIN item AS i ON l.item_id = i.id
                        INNER JOIN sub_category AS c ON i.sub_category_id = c.id
                        WHERE year(initial_loan) = year(current_timestamp) AND month(initial_loan) = month(current_timestamp)
                        GROUP BY c.name
                        ORDER BY COUNT(item_id) DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $provider,
            'title' => 'Popular Categories'
        ]);
    }

}
