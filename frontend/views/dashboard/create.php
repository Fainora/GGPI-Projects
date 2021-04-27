<?php

use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model common\models\Dashboard */

$this->title = "Добавить запись";
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['/projects/view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = ['label' => 'Доска', 'url' => ['/dashboard/index', 'id' => $project->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<div class="dashboard-create">
    <?= $this->render('_form', [
        'model' => $model,
        'project' => $project,
    ]) ?>

</div>
