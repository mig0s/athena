<?php

// The controller action that will render the list
$itemurl = \yii\helpers\Url::to(['/item/itemlist']);
$userurl = \yii\helpers\Url::to(['/user/userlist']);

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Item;
use common\models\User;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Loan */
/* @var $form yii\widgets\ActiveForm */

// Get the initial item description
$item = Item::findOne($model->item);
$itemTitle = empty($model->item) ? '' : $item->title;
$userName = empty($model->user) ? '' : User::findOne($model->user)->username;

?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>

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
    ]);
    ?>

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
    ]);
    ?>

    <?=''// $form->field($model, 'initial_loan')->textInput() ?>

    <?=''// $form->field($model, 'recent_renewal')->textInput() ?>

    <?=''// $form->field($model, 'renewal_count')->textInput() ?>

    <?=''// $form->field($model, 'return_date')->textInput() ?>

    <?= $form->field($model, 'loan_status_id')->textInput()->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
