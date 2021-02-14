<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = 'Создать проект';
?>
<div class="projects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
