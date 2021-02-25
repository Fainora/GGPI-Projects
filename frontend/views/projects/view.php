<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projects-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($model->user_id == Yii::$app->user->identity->id): ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить проект?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Заявки на участие', ['request', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?php else: ?>
        <?php Pjax::begin() ?>
            <?= $this->render('_member', [
                'project' => $project,
                'count' => $count,
            ]) ?>
        <?php Pjax::end() ?>
        <?/*= Html::a('Подать заявку', ['apply', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Заявка отправлена',
                'method' => 'post',
            ]]) 
        */ ?>
    <?php endif ?>
    <p>Участники:</p>
    <?= $count ?>/<?= $project->max_number ?>
    <p>Cписок:</p>
    <?php 
        foreach($members as $member) {
            if($project->id == $member->project->id) {
                echo "<li>" . Html::a($member->user->username, ['user/view', 
                    'id' => Yii::$app->user->identity->id]) . "</li>";
            }
        }
    ?>

    <span class="badge"><?//= $model->creater->username?></span>
    <?php
        ($model->image) ? $img = $model->image : $img = 'no_image.png';
    ?>
    <?= Html::img("@web/uploads/projects/80x80/$img", [
        'class'=>'rounded-circle card-img-left flex-auto d-none d-md-block', 
        'style'=>'min-width: 80px; height: 80px;'
    ]) ?>
     <?= HtmlPurifier::process($model->description) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'description:ntext',
            'smallImage:image',
            'max_number',
            'creater.username',
            'tagsAsString',
        ],
    ]) ?>

</div>
