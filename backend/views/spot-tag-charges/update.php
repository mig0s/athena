<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SpotTagCharges */

$this->title = 'Update Spot Tag Charges: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Spot Tag Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="spot-tag-charges-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
