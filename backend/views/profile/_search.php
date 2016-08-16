<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\search\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'birthdate')-> widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [ 'yearRange' => '-115:+0', 'changeYear' => true] ]) ?>
    * Please Use YYYY-MM-DD format<br />
    <br />

    <?php echo $form->field($model, 'gender_id')->dropDownList($model->genderList, ['prompt' => 'Please Select One']) ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php echo $form->field($model, 'ic_passport') ?>

    <?php echo $form->field($model, 'expiry')-> widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [ 'yearRange' => '-115:+0', 'changeYear' => true] ]) ?>
    * Please Use YYYY-MM-DD format<br />
    <br />

    <?php echo $form->field($model, 'mobile_num') ?>

    <?php echo $form->field($model, 'home_num') ?>

    <?php echo $form->field($model, 'nationality') ?>

    <?php echo $form->field($model, 'race') ?>

    <?php echo $form->field($model, 'city') ?>

    <?php echo $form->field($model, 'address') ?>

    <?php echo $form->field($model, 'postal_code') ?>

    <?php echo $form->field($model, 'group_id')->dropDownList($model->groupList, ['prompt' => 'Please Select One']) ?>

    <?php echo $form->field($model, 'university_id')->dropDownList($model->universityList, ['prompt' => 'Please Select One']) ?>

    <?php echo $form->field($model, 'course_id')->dropDownList($model->courseList, ['prompt' => 'Please Select One']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
