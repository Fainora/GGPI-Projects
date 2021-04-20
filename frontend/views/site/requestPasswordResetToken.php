<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Восстановление пароля';
?>
<div class="form">
    <h4>Для сброса пароя, введите ваш Email.</h4>
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'sign-btn btn btn-md btn-block']) ?>
        </div>

        <div class="sign forgot">
            <a href="<?= Url::to(["login"]);?>">Назад</a>
        </div>

        <?php ActiveForm::end(); ?>
</div>
