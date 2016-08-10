<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SettingsVenues */

$this->title = 'Create Settings Venues';
$this->params['breadcrumbs'][] = ['label' => 'Settings Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-venues-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
