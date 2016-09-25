<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Popular books';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">
    <p>
        <?php
        $reportico = Yii::$app->getModule('reportico');
        $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
        $engine->access_mode = "REPORTOUTPUT";             // Allows access to report output only
        $engine->initial_execute_mode = "EXECUTE";         // Just executes specified report
        $engine->initial_project = "Athena";            // Name of report project folder
        $engine->initial_project_password = "comp1108";
        $engine->initial_report = "popular";           // Name of report to run
        $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
        $engine->force_reportico_mini_maintains = true;    // Often required
        $engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
        $engine->clear_reportico_session = true;           // Normally required
        $engine->execute();
        ?>
    </p>
    <p>
        <?= Html::a( "Generate PDF",
            Url::toRoute([
                'reportico/mode/execute',
                'target_format' => 'PDF',
                'project' => 'Athena',
                'project_password' => 'comp1108',
                'report' => 'popular.xml',
            ]), array(
                'class' => 'btn btn-success',
                'target' => '_blank'
            ));
        ?>
    </p>
</div>