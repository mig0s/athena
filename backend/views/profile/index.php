<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'user_id',
            'first_name:ntext',
            'last_name:ntext',
            'birthdate',
            // 'gender_id',
            // 'created_at',
            // 'updated_at',
            // 'ic_passport',
            // 'expiry',
            // 'mobile_num',
            // 'home_num',
            // 'nationality:ntext',
            // 'race:ntext',
            // 'city:ntext',
            // 'address:ntext',
            // 'postal_code',
            // 'group_id',
            // 'university_id',
            // 'course_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
