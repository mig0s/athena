<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <h1><?= $model->title ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'author',
            'editor',
            'publisher',
            'pub_place',
            'pub_year',
            'price',
            'price_currency',
            'price_sgd',
            'isbn',
            'edition',
            'num_of_copies',
            'createdByName',
            'created_at',
            'editedByName',
            'edited_at',
            'accompanying_materials',
            'subjectName',
            'spotTagDesc',
            'locationName',
            'collectionName',
            'categoryName',
            'subCategoryName',
            'itemStatusName',
        ],
    ]) ?>

</div>
