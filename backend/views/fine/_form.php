<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\Item;

$userurl = \yii\helpers\Url::to(['/user/userlist']);
$itemurl = \yii\helpers\Url::to(['/item/itemlist']);
/* @var $this yii\web\View */
/* @var $model common\models\Fine */
/* @var $form yii\widgets\ActiveForm */
$itemTitle = empty($model->item) ? '' : Item::findOne($model->item)->title;
$userName = empty($model->user) ? '' : User::findOne($model->user)->username;
?>

<div class="fine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'initValueText' => $userName, // set the initial display text
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

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'waived_by')->textInput() ?>

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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
