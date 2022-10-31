<?php
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
?>
<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <a href="/">
            <strong>GP</strong>
        </a>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="<?= Url::to(["site/index"]);?>">
                <p><i class="fas fa-home"></i> <h5>Главная</h5></p>
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(['user/view', 'id'=>Yii::$app->user->identity->id]);?>">
                <p><i class="fas fa-briefcase"></i> <h5>Профиль</h5></p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(["projects/create"]);?>">
                <p><i class="fas fa-copy"></i><br/> <h5>Создать проект</h5></p>
            </a>
        </li>
        <li class="exit">
            <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a('<p><h5>Войти</h5></p>', 
                ['/site/login']); ?>
            <?php else: ?>
            <?= Html::a('<p><i class="fas fa-sign-out-alt"></i> <h5>Выход (' . 
                Yii::$app->user->identity->username . ')</h5></p>', ['/site/logout'],
                ['data' => ['method' => 'post']]); ?>
            <?php endif; ?>
        </li>
    </ul>
</nav>
