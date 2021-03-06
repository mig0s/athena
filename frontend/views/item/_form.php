<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

    <?=''// $form->field($model, 'created_by')->textInput() ?>

    <?=''// $form->field($model, 'created_at')->textInput() ?>

    <?=''// $form->field($model, 'edited_by')->textInput() ?>

    <?=''// $form->field($model, 'edited_at')->textInput() ?>

    <?= $form->field($model, 'accompanying_materials')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->dropDownList($model->getSubjectList(), ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'spot_tag_id')->dropDownList($model->getSpotTagList(), ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'location_id')->dropDownList($model->getLocationList(), ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'collection_id')->dropDownList($model->getCollectionList(), ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList(), ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'sub_category_id')->dropDownList($model->getSubCategoryList(), ['prompt' => 'Please Select One']) ?>

    <?= $form->field($model, 'item_status_id')->dropDownList($model->getItemStatusList(), ['prompt' => 'Please Select One']) ?>
    <?php //dropDownList($model->genderList, ['prompt' => 'Please Choose One']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
