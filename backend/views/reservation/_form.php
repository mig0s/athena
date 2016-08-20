<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Item;
use dosamigos\datepicker\DatePicker;
use yii\web\JsExpression;
use kartik\select2\Select2;

$itemurl = \yii\helpers\Url::to(['/item/itemlist']);
$userurl = \yii\helpers\Url::to(['/user/userlist']);

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */
/* @var $form yii\widgets\ActiveForm */

$itemTitle = empty($model->item) ? '' : Item::findOne($model->item)->title;
$userName = empty($model->user) ? '' : User::findOne($model->user)->username;

?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-12">
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
    </div>
    <div class="col-sm-6">
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
    ]); ?>
    </div>
    <?=''// $form->field($model, 'reservation_date')->textInput() ?>
    <div class="col-sm-6">
    <?= $form->field($model, 'purge_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
