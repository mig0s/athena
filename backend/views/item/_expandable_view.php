<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09-Sep-16
 * Time: 18:12
 */

/* @var $model common\models\Item */

use kartik\detail\DetailView;

echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Book # ' . $model->id,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
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
        'created_by',
        'created_at',
        'edited_by',
        'edited_at',
        'accompanying_materials',
        'subject_id',
        'spot_tag_id',
        'location_id',
        'collection_id',
        'category_id',
        'sub_category_id',
        'item_status_id',
    ]
]);