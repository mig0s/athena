<?php

use yii\helpers\Html;
use common\models\ValueHelpers;
use common\models\RecordHelpers;

/* @var $this yii\web\View */
/* @var $model common\models\Reservation */

$this->title = 'Create Reservation';
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->request->get('item_id')) {
    $item_id = Yii::$app->request->get('item_id');

$model->item_id = $item_id;
$model->user_id = Yii::$app->user->id;
$model->purge_date = (new DateTime())->add(new DateInterval("P2D"))->format('Y-m-d H:i:s');
?>
<div class="reservation-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Book:  <?= \common\models\Item::findOne($item_id)->title ?></h3>
    <h3>User: <?= ValueHelpers::getFisrtName(RecordHelpers::userHas('profile'))?></h3>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php } else {

} ?>