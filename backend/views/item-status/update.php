<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ItemStatus */

$this->title = 'Update Item Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Item Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
