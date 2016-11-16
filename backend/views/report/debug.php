<?php

/* @var $this yii\web\View */
/* @var $loans array */

$this->title = 'REPORT DEBUG';
$this->params['breadcrumbs'][] = ['label' => 'Settings Working Days', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo '<code>';
print_r($loans);
echo '</code>';
?>

