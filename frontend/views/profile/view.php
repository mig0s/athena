<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */

$this->title = 'Athena: My Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= 'My Profile' ?></h1>

    <p>
        <?Php

        //this is not necessary but in here as example

        if (PermissionHelpers::userMustBeOwner('profile', $model->id)) {

            echo Html::a('Update', ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']);
        }

        ?>

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'user.username',
            'first_name:ntext',
            'last_name:ntext',
            'birthdate',
            'gender.gender_name',
            'created_at',
            //'updated_at',
            'ic_passport',
            'expiry',
            'mobile_num',
            'home_num',
            'nationality:ntext',
            'race:ntext',
            'city:ntext',
            'address:ntext',
            'postal_code',
            //'group_id',
            //'university_id',
            //'course_id',
        ],
    ]) ?>

</div>
