<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use \common\models\Tag;
use \vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => '5'])  ?>
    <div class="row">
    <?//= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'file', ['options'=>['class'=>'col-sm']])->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'dropZoneEnabled' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="fas fa-camera"></i>',
            'browseLabel' =>  'Выберите фото'
        ],
    ]) ?>

    <?= $form->field($model, 'max_number', ['options' => ['class'=>'col-sm']])->textInput() ?>
    </div>

    <?= $form->field($model, 'tags_array')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Tag::find()->where(['type' => 0])->orderBy(['title' => SORT_ASC])
            ->all(), 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите теги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ])->label('Теги');?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>