<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <?php if (Yii::$app->user->getIdentity()->isAdmin()): ?>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Начальная страница',
                        'icon' => 'tachometer-alt',
                        'url' => ['site/index']
                    ],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Таблицы БД', 'header' => true],
                    ['label' => 'Пользователи', 'url' => ['user/index']],
                    ['label' => 'Проекты', 'url' => ['projects/index']],
                    ['label' => 'Теги', 'url' => ['tag/index']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <?php endif; ?>
    <!-- /.sidebar -->
</aside>