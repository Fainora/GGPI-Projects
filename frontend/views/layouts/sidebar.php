<?php
use yii\helpers\Url;
?>
<!-- Sidebar  -->
<!-- <nav id="sidebar" class="active"> -->
<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <a href="/">
            <h3>GGPI-Project</h3>
            <strong>GP</strong>
        </a>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="<?= Url::to(["site/index"]);?>">
                <p>
                    <i class="fas fa-home"></i>
                    Главная
                </p>
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(['user/view', 'id'=>Yii::$app->user->identity->id]);?>">
                <p>
                    <i class="fas fa-briefcase"></i>
                    Профиль
                </p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(["projects/create"]);?>">
                <p>
                    <i class="fas fa-copy"></i>
                    Создать проект
                </p>
            </a>
        </li>
        <!--<li>
            <a href="<?//= Url::to(["user/update"]);?>">
                <p>
                    <i class="fas fa-image"></i>
                    Настройки
                </p>
            </a>
        </li>-->
        <li>
            <a href="<?= Url::to(["site/contact"]);?>">
                <p>
                    <i class="fas fa-paper-plane"></i>
                    Обратная связь
                </p>
            </a>
        </li>
    </ul>
</nav>
