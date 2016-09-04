<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Item;
use yii\web\JsExpression;

$itemurl = \yii\helpers\Url::to(['/item/itemlist']);

/* @var $this yii\web\View */
/* @var $model common\models\ItemPair */
/* @var $form yii\widgets\ActiveForm */

$itemTitle = empty($model->item) ? '' : Item::findOne($model->item)->title;
?>

<div class="item-pair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item1')->widget(Select2::classname(), [
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
    ]) ?>

    <?= $form->field($model, 'item2')->widget(Select2::classname(), [
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
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
