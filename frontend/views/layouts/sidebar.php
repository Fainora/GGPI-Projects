<?php
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
?>
<!-- Sidebar  -->
<!-- <nav id="sidebar" class="active"> -->
<nav id="sidebar">
    <div class="sidebar-header">
        <a href="/">
            <strong>GP</strong>
        </a>
    </div>
<!--
    <button type="button" id="sidebarCollapse" class="btn btn-light">
        <i class="fas fa-align-justify"></i>
    </button>
-->
    <ul class="list-unstyled components">
        <li>
            <a href="<?= Url::to(["site/index"]);?>">
                <p><i class="fas fa-home"></i> Главная</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(['user/view', 'id'=>Yii::$app->user->identity->id]);?>">
                <p><i class="fas fa-briefcase"></i> Профиль</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(["projects/create"]);?>">
                <p><i class="fas fa-copy"></i><br/>Создать проект</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(["site/contact"]);?>">
                <p><i class="fas fa-paper-plane"></i> Обратная связь</p>
            </a>
        </li>
        <li class="exit">
            <?= Html::a('<p><i class="fas fa-sign-out-alt"></i> Выход (' . Yii::$app->user->identity->username
                . ')</p>', ['/site/logout']); ?>
        </li>
    </ul>
</nav>
