<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id' => 'form-search'
        ],
    ]); ?>

    <?= $form->field($model, 'keywords', ['template' => '{input}' .
            Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn search']),
        ])->textInput(['placeholder' => 'Поиск']);
    ?>

    <?php ActiveForm::end(); ?>

</div>
