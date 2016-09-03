<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SpotTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Spot Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spot-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Spot Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'colour',
            'name:ntext',
            'allowance',
            'loan_duration',
            // 'renewal_duration',
            // 'renewal_limit',
            // 'description:ntext',
            // 'minimum_user_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
