<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Dashboard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dashboard-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->textInput(['readonly' => true, 'value' => $project->id]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'position')->dropDownList([ 'todo' => 'Сделать', 'doing' => 'В процессе', 
       // 'done' => 'Выполнено', 'backlog' => 'Отложено']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
