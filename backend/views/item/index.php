<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\ItemStatus;
use yii\bootstrap\Collapse;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

$pdfHeader = array(
    'L' => [
        'content' => '{Athena Reports} - '.$this->title,
        'font-size' => 8,
        'color' => '#333'
    ],
    'C' => [
        'content' => '',
    ],
    'R' => [
        'content' => 'Generated: '.date('l, d-M-Y g:i a T').' by '.Yii::$app->user->identity->username,
        'font-size' => 8,
        'color' => '#333'
    ]);

$pdfFooter = array(
    'L' => [
        'content'=> '',
    ],
    'R' => [
        'content' => 'page: {PAGENO} of {nb}',
        'font-size' => 8,
        //'font-style' => 'B',
        //'font-family' => 'serif',
        'color' => '#333'
    ],
    'line' => true
);

?>
<div class="item-index">


    <?php
    echo Collapse::widget([
        'items' => [
            [
                'label' => 'Global search',
                'content' => $this->render('_global_search', ['model' => $searchModel]),
            ],
        ]
    ]); ?>

    <?php
    echo Collapse::widget([
        'items' => [
            [
                'label' => 'Search by parameters',
                'content' => $this->render('_search', ['model' => $searchModel]),
            ],
        ]
    ]); ?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
        'responsiveWrap' => false,
        'hover' => true,
        'resizableColumns'=>true,
        'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
        'toolbar' => [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                        //'type'=>'button',
                        'title'=>'Add Book',
                        'class'=>'btn btn-success'
                    ]) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default',
                        'title' => 'Reset Grid'
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'exportConfig' => [
            'html' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $this->title).'_'.date('Y-m-d')
            ],
            'txt' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $this->title).'_'.date('Y-m-d')
            ],
            'xls' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $this->title).'_'.date('Y-m-d')
            ],
            'pdf' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $this->title).'_'.date('Y-m-d'),
                'config' => [
                    'contentBefore' => '<h1>'.$this->title.'</h1>',
                    'methods' => [
                        'SetHeader' => [[
                            'odd' => $pdfHeader,
                            'even' => $pdfHeader
                        ]],
                        'SetFooter' => [[
                            'odd' => $pdfFooter,
                            'even' => $pdfFooter
                        ]],
                    ],
                ]
            ],
        ]
    ])

    ?>
<?php Pjax::end(); ?></div>
