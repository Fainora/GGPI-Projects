<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Регистрация';
?>
<div class="form">

    <div class="container">
        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            ],
            ]); ?>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Имя пользователя') ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'surname')->label('Фамилия') ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'name')->label('Имя') ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'patronymic')->label('Отчество') ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'email')->label('Email') ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                </div>
            </div>
  
            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'sign-btn btn  btn-md btn-block', 'name' => 'sign-btn']) ?>
            </div>

            <div class="sign forgot">
                <a href="<?= Url::to(["login"]);?>">Назад</a>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
