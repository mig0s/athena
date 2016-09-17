<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\ItemStatus;
use yii\bootstrap\Collapse;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
?>
<div class="item-index">

    <?php echo Collapse::widget([
        'items' => [
            [
                'label' => 'Search',
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ]
    ]); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
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
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Items</h3>',
            'type'=>'info',
            //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Item', ['create'], ['class' => 'btn btn-success']),
            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            //'footer'=>true
        ],
        'columns' => [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expandable_view', ['model'=>$model]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'],
                'enableRowClick'=>true,
                'expandOneOnly'=>true
            ],
            //['class' => 'yii\grid\SerialColumn'],
            'title',
            'author',
            [
                'attribute'=>'item_status_id',
                'vAlign'=>'middle',
                'width'=>'180px',
                'value'=>'itemStatusName',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(ItemStatus::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'format'=>'raw'
            ],
        ],
        'responsive' => true,
        'hover' => true,
        'resizableColumns'=>true,
        'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
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
        ]
    ])

    ?>
<?php Pjax::end(); ?></div>
