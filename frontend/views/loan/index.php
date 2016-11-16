<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ReservationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            'item.title',
            //'user.username',
            'initial_loan',
            // 'recent_renewal',
            // 'renewal_count',
            'return_date',
            'loanStatus.name'
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
