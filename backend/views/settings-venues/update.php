<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SettingsVenues */

$this->title = 'Update Settings Venues: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Settings Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="settings-venues-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
