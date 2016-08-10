<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ItemPair */

$this->title = 'Create Item Pair';
$this->params['breadcrumbs'][] = ['label' => 'Item Pairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-pair-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
