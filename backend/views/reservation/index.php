<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ReservationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="reservation-index">

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
        <?= Html::a('Create Reservation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //'id',
            'item.title',
            'user.username',
            'reservation_date',
            'purge_date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {loan}',
                'buttons' => [
                    'loan' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-arrow-up"></span>',
                            ['item-loan/create'],
                            ['data' => [
                                'method'=>'post',
                                'params'=>[
                                    'user_id' => $model->user_id,
                                    'item_id' => $model->item_id,
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
