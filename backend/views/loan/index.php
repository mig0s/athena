<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
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
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'id' => 'loanTable',
        'dataProvider' => $dataProvider,
        'toolbar' => [
            [
                'content'=>
                    Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                        'type'=>'button',
                        'title'=>'Add Book',
                        'class'=>'btn btn-success'
                    ]) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                        'class' => 'btn btn-default',
                        'title' => 'Reset Grid'
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Loans</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Loan Item', ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        'columns' => [
            //'id',
            'item.title',
            'user.username',
            'initial_loan',
            // 'recent_renewal',
            // 'renewal_count',
            'return_date',
            'loanStatus.name',
            [
                'class'=>'kartik\grid\ActionColumn',
                'template' => '{view} {update} {return}',
                'buttons' => [
                    'return' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-arrow-down"></span>',
                            ['loan/return', 'id' => $model->id],
                            [
                                'title' => 'Return',
                                'data-pjax' => '0',
                            ]
                        );

                    },
                ],
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'resizableColumns'=>true,
        'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
    ]); ?>
<?php Pjax::end(); ?></div>
