<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SpotTag */

$this->title = 'Update Spot Tag: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Spot Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spot-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
