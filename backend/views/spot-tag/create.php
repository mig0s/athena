<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SpotTag */

$this->title = 'Create Spot Tag';
$this->params['breadcrumbs'][] = ['label' => 'Spot Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spot-tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
