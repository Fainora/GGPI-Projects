<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
?>
<nav class="navbar navbar-expand navbar-light navbar-dark sticky-top" style="background-color: #6d7fcc;">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-light">
            <i class="fas fa-align-justify"></i>
        </button>

        <?php
            $menuItems = [ /*
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                */
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
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

