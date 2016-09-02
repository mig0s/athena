<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SettingsWorkingDays */

$this->title = 'Create Settings Working Days';
$this->params['breadcrumbs'][] = ['label' => 'Settings Working Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-working-days-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
