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
    ])

    ?>
    <?php Pjax::end(); ?></div>
