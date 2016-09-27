<?php

namespace backend\controllers;

use common\models\User;
use frontend\models\Profile;
use Yii;
use common\models\Loan;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use common\models\PermissionHelpers;
use yii\helpers\ArrayHelper;

class ReportController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'popular-books', 'popular-books-grid', 'popular-categories', 'popular-subcategories', 'overdue-items', 'send-notifications'],
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
        $query->select('sc.name, COUNT(item_id) AS Count
                        FROM loan AS l
                        INNER JOIN item AS i ON l.item_id = i.id
                        INNER JOIN sub_category AS sc ON i.sub_category_id = sc.id
                        WHERE year(initial_loan) = year(current_timestamp) AND month(initial_loan) = month(current_timestamp)
                        GROUP BY sc.name
                        ORDER BY COUNT(item_id) DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $provider,
            'title' => 'Popular Subcategories'
        ]);
    }

    public function actionPopularBooksGrid()
    {
        $query = new Query();
        $query->select('i.id, i.title, COUNT(item_id) AS Count
                        FROM loan AS l
                        INNER JOIN item AS i ON l.item_id = i.id
                        INNER JOIN category AS c ON i.category_id = c.id
                        WHERE year(initial_loan) = year(current_timestamp) AND month(initial_loan) = month(current_timestamp)
                        GROUP BY i.title
                        ORDER BY COUNT(item_id) DESC'); // removed from GROUP BY: i.id

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'dataProvider' => $provider,
            'title' => 'Popular Books (Grid)'
        ]);
    }

    //TODO: change loan_status_id to 1

    public function actionDueToday()
    {
        //SELECT id, item_id, user_id, initial_loan, return_date FROM athena_structure.loan where loan_status_id = 1 and return_date < current_date();
        $query = new Query();
        $query->select('l.id, i.title, u.username, l.initial_loan, l.return_date
                        FROM loan AS l
                        INNER JOIN item AS i ON l.item_id = i.id
                        INNER JOIN user AS u ON l.user_id = u.id
                        WHERE l.loan_status_id = 2 AND l.return_date = current_date()
                        ORDER BY l.id DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('overdue-items',[
            'dataProvider' => $provider,
            'title' => 'Overdue Items'
        ]);
    }

    public function actionOverdueItems()
    {
        //SELECT id, item_id, user_id, initial_loan, return_date FROM athena_structure.loan where loan_status_id = 1 and return_date < current_date();
        $query = new Query();
        $query->select('l.id, i.title, u.username, l.initial_loan, l.return_date
                        FROM loan AS l
                        INNER JOIN item AS i ON l.item_id = i.id
                        INNER JOIN user AS u ON l.user_id = u.id
                        WHERE l.loan_status_id = 2 AND l.return_date < current_date()
                        ORDER BY l.id DESC');

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('overdue-items',[
            'dataProvider' => $provider,
            'title' => 'Overdue Items'
        ]);
    }

    public function actionSendNotifications()
    {
        $loans = Loan::findBySql('SELECT id, item_id, user_id, COUNT(item_id) AS Count FROM loan WHERE loan_status_id = 2 GROUP BY user_id')->asArray()->all();

        foreach ($loans as $loan) {

            //TODO: add body with list of items & use global From, set up linking and redirects

            $profile[] = User::findOne($loan['user_id'])->email;

            $messages[] = Yii::$app->mailer->compose()
                ->setFrom('from@domain.com')
                ->setTo(User::findOne($loan['user_id'])->email)
                ->setSubject('Message subject')
                ->setHtmlBody('<b>HTML content</b>')
                ->send();
        }

        return $this->render('debug', [
            'loans' => $messages
        ]);

    }

}
