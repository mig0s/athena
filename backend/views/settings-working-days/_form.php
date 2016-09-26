<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SettingsWorkingDays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-working-days-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'venue_id')->textInput() ?>

    <?= $form->field($model, 'day')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_working')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_at')->textInput() ?>

    <?= $form->field($model, 'closed_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
