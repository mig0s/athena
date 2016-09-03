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

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pub_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pub_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_sgd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_of_copies')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'edited_by')->textInput() ?>

    <?= $form->field($model, 'edited_at')->textInput() ?>

    <?= $form->field($model, 'accompanying_materials')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'spot_tag_id')->textInput() ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'collection_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Collection::find()->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select collection'],
        'pluginOptions'=>['allowClear'=>true],
    ]) ?>

    <?= $form->field($model, 'category_id')->widget(DepDrop::className(), [
        'data' => [0=>'Select category'],
        'options' => ['placeholder' => 'Select category'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['item-collection_id'],
            'url'=> Url::to(['item/child-category']),
            'loadingText' => 'Loading categories',
        ]
    ]) ?>

    <?= $form->field($model, 'sub_category_id')->widget(DepDrop::className(), [
        'data' => [0=>'Select subcategory'],
        'options' => ['placeholder' => 'Select category'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['item-category_id'],
            'url'=> Url::to(['item/child-sub-category']),
            'loadingText' => 'Loading categories',
        ]
    ]) ?>

    <?= $form->field($model, 'item_status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
