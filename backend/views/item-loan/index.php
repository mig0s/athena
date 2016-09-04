<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ItemLoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo Collapse::widget([
        'items' => [
            [
                'label' => 'Search',
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ]
    ]); ?>
    <p>
        <?= Html::a('Create Loan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'item.title',
            'user.username',
            // 'initial_loan',
            // 'recent_renewal',
            'return_date',
            //'renewal_count',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {renew}',
                'buttons' => [
                    'renew' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-arrow-up"></span>',
                            ['item-loan/renew'],
                            ['data' => [
                                'method'=>'post',
                                'params'=>[
                                    'id' => $model->id
                                ]
                            ],
                            ],
                            [
                                'title' => 'Reserve',
                                'data-pjax' => '0',
                            ]
                        );

                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
