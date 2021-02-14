<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projects-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
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
        <?php elseif ($model->getMembers()->count() < $model->max_number): ?>
            <?php Pjax::begin() ?>
                <?= $this->render('_member', [
                    'project' => $project,
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
        <p>Cписок:</p>
        <?php 
            foreach($members as $member) {
                if($project->id == $member->project->id)
                    echo "<li>".$member->user->username."</li>";
            }
        ?>
    </p>
    <span class="badge"><?//= $model->creater->username?></span>
    <?php
        ($model->image) ? $img = $model->image : $img = 'no_image.png';
    ?>
    <?= Html::img("@web/uploads/projects/80x80/$img", [
        'class'=>'rounded-circle card-img-left flex-auto d-none d-md-block', 
        'style'=>'min-width: 80px; height: 80px;'
    ]) ?>
    
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
