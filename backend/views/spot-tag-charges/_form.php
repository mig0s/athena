<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\UserType;
use common\models\SpotTag;

/* @var $this yii\web\View */
/* @var $model common\models\SpotTagCharges */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spot-tag-charges-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_type_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(UserType::find()->asArray()->all(),'id','user_type_name'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ]) ?>

    <?= $form->field($model, 'spot_tag_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(SpotTag::find()->groupBy(['colour'])->asArray()->all(),'id','colour', 'description'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
