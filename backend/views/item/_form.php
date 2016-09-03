<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Collection;
use common\models\Category;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    </div>

    <div class="col-md-6">

    <?php // $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pub_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pub_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_sgd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edition')->textInput(['maxlength' => true]) ?>

    </div><div class="col-md-6">

    <?= $form->field($model, 'num_of_copies')->textInput() ?>

    <?php // $form->field($model, 'created_by')->textInput() ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'edited_by')->textInput() ?>

    <?php // $form->field($model, 'edited_at')->textInput() ?>

    <?= $form->field($model, 'accompanying_materials')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->widget(Select2::className(), [
        'data' => $model->getSubjectList(),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ])  ?>

    <?= $form->field($model, 'spot_tag_id')->widget(Select2::className(), [
        'data' => $model->getSpotTagList(),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ])  ?>

    <?= $form->field($model, 'location_id')->widget(Select2::className(), [
        'data' => $model->getLocationList(),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ]) ?>

    <?= $form->field($model, 'collection_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Collection::find()->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ]) ?>

    <?= $form->field($model, 'category_id')->widget(DepDrop::className(), [
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['item-collection_id'],
            'url'=> Url::to(['item/child-category']),
            'loadingText' => 'Loading categories',
        ]
    ]) ?>

    <?= $form->field($model, 'sub_category_id')->widget(DepDrop::className(), [
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['item-category_id'],
            'url'=> Url::to(['item/child-sub-category']),
            'loadingText' => 'Loading categories',
        ]
    ]) ?>

    <?= $form->field($model, 'item_status_id')->widget(Select2::className(), [
        'data' => $model->getItemStatusList(),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions'=>['allowClear'=>true],
    ]) ?>

    </div>

    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
