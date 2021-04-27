<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="top">
        <div class="top-inner">
            <h1>404</h1>
        </div>
        <p><?= nl2br(Html::encode($message)); ?></p>
    </div>

    <?= Html::a("На главную",  '/site/index', ['class' => 'error btn']) ?>

</div>
