<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">
    <h1> <?= Html::encode($this->title) ?> </h1>
    <p>
        <?= Html::a( "Popular Books",
        Url::toRoute([
            'popular-books'
        ]), array(
            'class' => 'btn btn-default'
            ));
        ?>
    </p>
</div>

