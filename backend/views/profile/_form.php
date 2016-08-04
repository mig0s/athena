<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=''// $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'birthdate')-> widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [ 'yearRange' => '-115:+0', 'changeYear' => true] ]) ?>
    * Please Use YYYY-MM-DD format<br />
    <br />
    <?= $form->field($model, 'gender_id')->dropDownList($model->genderList, ['prompt' => 'Please Select One']) ?>

    <?=''// $form->field($model, 'created_at')->textInput() ?>

    <?=''// $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ic_passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'expiry')-> widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [ 'yearRange' => '-115:+95', 'changeYear' => true] ]) ?>

    <?=''// $form->field($model, 'expiry')->textInput() ?>

    <?= $form->field($model, 'mobile_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput() ?>

    <?= $form->field($model, 'race')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?= $form->field($model, 'postal_code')->textInput() ?>

    <?= $form->field($model, 'university_id')->dropDownList($model->universityList, ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'course_id')->dropDownList($model->courseList, ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'group_id')->dropDownList($model->groupList, ['prompt' => 'Please Select One']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
