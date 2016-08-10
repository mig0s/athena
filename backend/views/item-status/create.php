<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ItemStatus */

$this->title = 'Create Item Status';
$this->params['breadcrumbs'][] = ['label' => 'Item Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
