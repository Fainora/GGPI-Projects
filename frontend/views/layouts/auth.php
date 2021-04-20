<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AuthAsset;
use yii\helpers\Html;
use yii\widgets\Pjax;

AuthAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <div class="login">
        <div class="wrapper">
            <div class="sign">
                <?= Html::a('Авторизация', ['login'], ['class' => 'sign-in']); ?>
                <?= Html::a('Регистрация', ['signup']); ?>
            </div>
            <?php $this->beginBody() ?>
                <?= $content; ?>
            <?php $this->endBody() ?>
        </div>
    </div>
</body>
</html>
<?php $this->endPage() ?>
