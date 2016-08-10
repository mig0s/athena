<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemPair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-pair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item1')->textInput() ?>

    <?= $form->field($model, 'item2')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
