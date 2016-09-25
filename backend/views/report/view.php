<?php

use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title string */

$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $title;
$this->title = $title;

$pdfHeader = array(
    'L' => [
        'content' => '{Athena Reports} - '.$title,
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

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> '.$title.'</h3>',
            'type'=>'warning',
            'before'=>Html::a('<i class="glyphicon glyphicon-arrow-left"></i> Back', ['index'], ['class' => 'btn btn-success']),
            //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        'responsive' => true,
        'hover' => true,
        'resizableColumns'=>true,
        'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
        'toolbar' => [
            '{export}',
            '{toggleData}'
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'exportConfig' => [
            'html' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $title).'_'.date('Y-m-d')
            ],
            'txt' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $title).'_'.date('Y-m-d')
            ],
            'xls' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $title).'_'.date('Y-m-d')
            ],
            'pdf' => [
                'filename' => 'Athena_Library:'.str_replace(' ', '_', $title).'_'.date('Y-m-d'),
                'config' => [
                    'contentBefore' => '<h1>'.$title.'</h1>',
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
