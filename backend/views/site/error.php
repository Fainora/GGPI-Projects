<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="error-page">
    <div class="error-content" style="margin-left: auto;">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> <?= Html::encode($name) ?></h3>
        <p>
            <?= nl2br(Html::encode($message)) ?>
        </p>
        <p>
            Вышеупомянутая ошибка произошла во время обработки вашего запроса веб-сервером.
            Свяжитесь с нами, если вы считаете, что это ошибка сервера. Спасибо.
            Между тем, вы можете <?= Html::a('вернуться на главную страницу', ['../site/index']); ?>.
        </p>
    </div>
</div>

