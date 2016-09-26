<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SpotTagCharges */

$this->title = 'Create Spot Tag Charges';
$this->params['breadcrumbs'][] = ['label' => 'Spot Tag Charges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spot-tag-charges-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
