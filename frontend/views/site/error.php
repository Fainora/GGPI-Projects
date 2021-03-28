<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="top">
        <div class="top-inner">
            <h1>404</h1>
            <p>This page is missing</p>
        </div>
    </div>

    <?= Html::a("На главную",  '/site/index', ['class' => 'error btn']) ?>
    
    <?//= Html::img('@web/images/404.png', ['alt' => '404', 'class' => 'error-img']); ?>
</div>
