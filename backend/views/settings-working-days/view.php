<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SettingsWorkingDays */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Settings Working Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-working-days-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'venue_id',
            'day',
            'is_working',
            'open_at',
            'closed_at',
        ],
    ]) ?>

</div>