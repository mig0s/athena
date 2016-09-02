<?php

$itemurl = \yii\helpers\Url::to(['/item/itemlist']);
$userurl = \yii\helpers\Url::to(['/user/userlist']);

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use dosamigos\datepicker\DatePicker;
use yii\web\User;
use common\models\Item;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ReservationSearch */
/* @var $form yii\widgets\ActiveForm */

$itemTitle = empty($model->item) ? '' : Item::findOne($model->item)->title;
$userName = empty($model->user) ? '' : User::findOne($model->user)->username;
?>

<div class="reservation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?=''// $form->field($model, 'id') ?>

    <?= $form->field($model, 'item_id')->widget(Select2::classname(), [
        'initValueText' => $itemTitle, // set the initial display text
        'options' => ['placeholder' => 'Search for an item...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $itemurl,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(item) { return item.text; }'),
            'templateSelection' => new JsExpression('function (item) { return item.text; }'),
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'initValueText' => $itemTitle, // set the initial display text
        'options' => ['placeholder' => 'Search for a user...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $userurl,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(item) { return item.text; }'),
            'templateSelection' => new JsExpression('function (item) { return item.text; }'),
        ],
    ]);
    ?>

    <?= $form->field($model, 'reservation_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'purge_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
