<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SpotTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spot-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'allowance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loan_duration')->textInput() ?>

    <?= $form->field($model, 'renewal_duration')->textInput() ?>

    <?= $form->field($model, 'renewal_limit')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
