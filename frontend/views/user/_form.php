<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use \kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Tag;


/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file', ['options'=>['class'=>'col-lg-6']])->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [
            'allowedFileExtensions'=> ['jpg','jpeg','png'],
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'dropZoneEnabled' => false,
            'browseClass' => 'image btn btn-primary btn-block',
            'browseIcon' => '<i class="fas fa-camera"></i>',
            'browseLabel' =>  'Выберите фото',
            'previewFileType' => 'image',
            'maxFileSize' => ['1024'],
        ],
    ]) ?>

    <?= $form->field($model, 'tags_array')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Tag::find()->where(['type' => 1])->all(), 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите теги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
        ])->label('Теги');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
