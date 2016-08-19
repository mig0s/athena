<?php

// The controller action that will render the list
$url = \yii\helpers\Url::to(['/item/itemlist']);

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Item;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Loan */
/* @var $form yii\widgets\ActiveForm */

// Get the initial item description
$itemTitle = empty($model->item) ? '' : Item::findOne($model->item)->title;

?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id')->textInput() ?>

    <?php //$form->field($model, 'item_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->widget(Select2::classname(), [
        'initValueText' => $itemTitle, // set the initial display text
        'options' => ['placeholder' => 'Search for an item ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(item) { return item.text; }'),
            'templateSelection' => new JsExpression('function (item) { return item.text; }'),
        ],
    ]);
    ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'initial_loan')->textInput() ?>

    <?= $form->field($model, 'recent_renewal')->textInput() ?>

    <?= $form->field($model, 'renewal_count')->textInput() ?>

    <?= $form->field($model, 'return_date')->widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [ 'yearRange' => '-0:+95', 'changeYear' => true] ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
