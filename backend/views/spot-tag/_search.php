<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\SpotTagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spot-tag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'colour') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'allowance') ?>

    <?= $form->field($model, 'loan_duration') ?>

    <?php // echo $form->field($model, 'renewal_duration') ?>

    <?php // echo $form->field($model, 'renewal_limit') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
