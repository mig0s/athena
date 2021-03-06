<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'author') ?>

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

    <?php echo $form->field($model, 'subject_id')->dropDownList($model->subjectList, ['prompt' => 'Please Select One']) ?>

    <?php echo $form->field($model, 'spot_tag_id')->dropDownList($model->spotTagList, ['prompt' => 'Please Select One']) ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php echo $form->field($model, 'collection_id')->dropDownList($model->collectionList, ['prompt' => 'Please Select One']) ?>

    <?php echo $form->field($model, 'category_id')->dropDownList($model->categoryList, ['prompt' => 'Please Select One']) ?>

    <?php echo $form->field($model, 'sub_category_id')->dropDownList($model->subCategoryList, ['prompt' => 'Please Select One']) ?>

    <?php echo $form->field($model, 'item_status_id')->dropDownList($model->itemStatusList, ['prompt' => 'Please Select One']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
