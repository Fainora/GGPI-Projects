<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
?>
<nav class="navbar">
    <div class="container-fluid">
<!--
        <button type="button" id="sidebarCollapse" class="btn btn-light">
            <i class="fas fa-align-justify"></i>
        </button>
-->
        <!-- Navbar -->
        <?php
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Выход ('.Yii::$app->user->identity->username.')',
                    'url' => ['/site/logout'],
                    'linkOptions' => [
                        'data-method' => 'post'
                    ]
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav ml-auto'],
                'items' => $menuItems,
            ]);
        ?>
    </div>
</nav>

