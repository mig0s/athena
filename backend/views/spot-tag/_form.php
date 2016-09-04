<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\UserType;

/* @var $this yii\web\View */
/* @var $model common\models\SpotTag */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="spot-tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allowance')->radioList(['0' => 'Yes', '1' => 'No']) ?>

    <?= $form->field($model, 'loan_duration')->textInput() ?>

    <?= $form->field($model, 'renewal_duration')->textInput() ?>

    <?= $form->field($model, 'renewal_limit')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'minimum_user_type')->widget(Select2::className(), [
        'data' => ArrayHelper::map(UserType::find()->asArray()->all(), 'user_type_value', 'user_type_name')
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
