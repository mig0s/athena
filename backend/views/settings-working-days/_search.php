<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\SettingsWorkingDaysSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-working-days-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'venue_id') ?>

    <?= $form->field($model, 'day') ?>

    <?= $form->field($model, 'is_working') ?>

    <?= $form->field($model, 'open_at') ?>

    <?php // echo $form->field($model, 'closed_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
