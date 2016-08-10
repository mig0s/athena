<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            'author',
            // 'editor',
            // 'publisher',
            // 'pub_place',
            // 'pub_year',
            // 'price',
            // 'price_currency',
            // 'price_sgd',
            // 'isbn',
            // 'edition',
            // 'num_of_copies',
            // 'created_by',
            // 'created_at',
            // 'edited_by',
            // 'edited_at',
            // 'accompanying_materials',
            // 'subject_id',
            // 'spot_tag_id',
            // 'location_id',
            // 'collection_id',
            // 'category_id',
            // 'sub_category_id',
            'itemStatusName',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>