<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LoanStatus */

$this->title = 'Create Loan Status';
$this->params['breadcrumbs'][] = ['label' => 'Loan Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
