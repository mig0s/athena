<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Reservation */

$this->title = 'Create Reservation';
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->item_id = $item_id;
$model->user_id = Yii::$app->user->id;
$model->purge_date = (new DateTime())->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
?>
<div class="reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Book:  <?= \common\models\Item::findOne($item_id)->title ?></h3>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
