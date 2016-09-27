<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use common\models\Collection;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model frontend\models\search\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <div class="col-sm-12">

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'author') ?>

    </div>

    <div class="col-md-6 col-lg-6 col-sm-12">

    <?= $form->field($model, 'editor') ?>

    <?= $form->field($model, 'publisher') ?>

    <?php echo $form->field($model, 'pub_place') ?>

    <?php echo $form->field($model, 'pub_year') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'price_currency') ?>

    <?php // echo $form->field($model, 'price_sgd') ?>

    <?php echo $form->field($model, 'isbn') ?>

    <?php echo $form->field($model, 'edition') ?>

    <?php // echo $form->field($model, 'num_of_copies') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'edited_by') ?>

    <?php // echo $form->field($model, 'edited_at') ?>

    <?php echo $form->field($model, 'accompanying_materials') ?>

    </div> <div class="col-md-6 col-lg-6 col-sm-12">

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
            'data' => $model->collectionList,
            'options' => ['placeholder' => 'Select ...'],
            'pluginOptions'=>['allowClear'=>true],
        ]) ?>

        <?= $form->field($model, 'category_id')->widget(DepDrop::className(), [
            'type' => DepDrop::TYPE_SELECT2,
            //'data' => $model->categoryList,
            'options' => ['placeholder' => 'Select ...'],
            'select2Options'=>['pluginOptions'=>['allowClear'=>true], 'options' => ['placeholder' => 'Select ...']],
            'pluginOptions'=>[
                'depends'=>['itemsearch-collection_id'],
                'url'=> Url::to(['item/child-category']),
                'loadingText' => 'Loading categories',
            ]
        ]) ?>

        <?= $form->field($model, 'sub_category_id')->widget(DepDrop::className(), [
            'type' => DepDrop::TYPE_SELECT2,
            //'data' => $model->subCategoryList,
            'options' => ['placeholder' => 'Select ...'],
            'select2Options'=>['pluginOptions'=>['allowClear'=>true], 'options' => ['placeholder' => 'Select ...']],
            'pluginOptions'=>[
                'depends'=>['itemsearch-category_id'],
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

    <div class="col-sm-12">

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
