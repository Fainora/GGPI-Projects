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

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'plugins' => [
                    'fullscreen',
                ],
                'clips' => [
                    ['Lorem ipsum...', 'Lorem...'],
                    ['red', '<span class="label-red">red</span>'],
                    ['green', '<span class="label-green">green</span>'],
                    ['blue', '<span class="label-blue">blue</span>'],
                ],
            ],
        ]);
    ?>

    <?= $form->field($model, 'file', ['options'=>['class'=>'col-sm']])->widget(\kartik\file\FileInput::classname(), [
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'showCancel' => false,
            'dropZoneEnabled' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="fas fa-camera"></i>',
            'browseLabel' =>  'Выберите фото'
        ],
    ]) ?>

    <?= $form->field($model, 'tags_array')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Tag::find()->where(['type' => 0])->all(), 'id', 'title', 'type'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выберите теги ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'tokenSeparators' => [',', ' '],
        ],
        ])->label('Теги');
    ?>


    <?= $form->field($model, 'max_number')->textInput() ?>

    <?//= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
