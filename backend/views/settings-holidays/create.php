<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SettingsHolidays */

$this->title = 'Create Settings Holidays';
$this->params['breadcrumbs'][] = ['label' => 'Settings Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->added_by=Yii::$app->user->id;
?>
<div class="settings-holidays-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
