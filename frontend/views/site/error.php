<?php
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="error-top">
        <h1><?= $name; ?></h1>
        <p><?= nl2br(Html::encode($message)); ?></p>
    </div>

    <div class="error-bottom">
        <?= Html::a('<div class="arrow"><i class="fas fa-chevron-left"></i></div> На главную',  
            '/site/index', ['class' => 'error btn']) ?>
    </div>

</div>
