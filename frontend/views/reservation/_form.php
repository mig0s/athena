<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_id')->textInput()->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'user_id')->textInput()->hiddenInput()->label(false) ?>

    <?php //= $form->field($model, 'reservation_date', ['readonly' => true])->textInput()->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'purge_date')->textInput()->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
