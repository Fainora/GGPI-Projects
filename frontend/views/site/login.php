<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Авторизация';
?>

<h1>GGPI-Project</h1>

<div class="form col-md-5">
    <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",
            ],
        ]); ?>
    
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Логин'])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"])->label(false) ?>
        <div style="color:#808080;margin:1em 0">
            <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>
        </div>
        <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить?') ?>

        <div class="form-group btm">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-md btn-block', 'name' => 'login-button']) ?>
        </div>

        <a href="<?= Url::to(["signup"]);?>"> Зарегистрироваться </a>

    <?php ActiveForm::end(); ?>
</div>

