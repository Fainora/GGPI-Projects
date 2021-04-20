<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Авторизация';
?>

<div class="form">
    <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",
            ],
        ]); ?>
    
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Имя пользователя'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить?') ?>

        <div class="form-group btm">
            <?= Html::submitButton('Войти', ['class' => 'sign-btn btn btn-md btn-block', 'name' => 'login-btn']) ?>
        </div>

        <div class="sign forgot">
            <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>

