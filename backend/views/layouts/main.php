<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('{A.A}: '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    if (!Yii::$app->user->isGuest) {
        $is_admin = \common\models\PermissionHelpers::requireMinimumRole('Admin');
    }
    NavBar::begin([
        'brandLabel' => '{A.Admin}',
        'brandUrl' => '/library/admin/gii', //Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest && $is_admin) {

        $menuItems[] = ['label' => 'Items', 'items' => [
            ['label' => 'Items', 'url' => ['item/index']],
            ['label' => 'Loans', 'url' => ['loan/index']],
            ['label' => 'Reservations', 'url' => ['reservation/index']],
        ]];

        $menuItems[] = ['label' => 'Users', 'items' => [
            ['label' => 'Users', 'url' => ['user/index']],
            ['label' => 'Profiles', 'url' => ['profile/index']],
            ['label' => 'Roles', 'url' => ['role/index']],
            ['label' => 'User Types', 'url' => ['user-type/index']],
            ['label' => 'Statuses', 'url' => ['status/index']],
        ]];

        $menuItems[] = ['label' => 'Reports', 'items' => [
            ['label' => 'Report 1', 'url' => ['report/popular-books']],
        ]];

        $menuItems[] = ['label' => 'Settings', 'items' => [
            ['label' => 'Collections', 'url' => ['collection/index']],
            ['label' => 'Categories', 'url' => ['category/index']],
            ['label' => 'Subcategories', 'url' => ['sub-category/index']],
            ['label' => 'Subjects', 'url' => ['subject/index']],
            ['label' => 'Universities', 'url' => ['university/index']],
            ['label' => 'Courses', 'url' => ['course/index']],
            ['label' => 'Groups', 'url' => ['group/index']],
            ['label' => 'Related items', 'url' => ['item-pair/index']],
            ['label' => 'Item Statuses', 'url' => ['item-status/index']],
            ['label' => 'Spot Tags', 'url' => ['spot-tag/index']],
            ['label' => 'Fines' ,'url' => ['fine/index']],
            ['label' => 'Loan Statuses' ,'url' => ['loan-status/index']],
        ]];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; mig0s <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
