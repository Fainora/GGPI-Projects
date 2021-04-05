<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'surname',
            'name',
            'patronymic',
            //'role',
            'email:email',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            'smallImage:image',
            'tagsAsString',
        ],
    ]) */?>
    <?php if($model->id == Yii::$app->user->identity->id): ?>
        <div class="btn-group" role="group" aria-label="Basic example">
            <?= Html::a('Редактировать профиль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Изменить пароль', ['site/request-password-reset'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::a('Удалить профиль', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить ваш аккаунт?',
                        'method' => 'post',
                    ],
                ]) ?>
        </div>
    <?php endif; ?>
    <br><br>
    
    <?php ($model->image) ? $img = $model->image : $img = 'no_image.png';?>
    <?= Html::img("@web/uploads/user/80x80/$img", [
        'class'=>'user-img', 'align' => 'left']) ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">
        <?php foreach($tags as $one): ?>
            <?php if($one->user_id == Yii::$app->user->identity->id):?>
                <span class="badge badge-info"><?=$one->tag->title?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <hr>
    <?php if($model->id == Yii::$app->user->identity->id): ?>
        <h5>Ваши проекты: </h5>
            <?php foreach($creater as $сurator): ?>
                <?php if($сurator->user_id == Yii::$app->user->identity->id): ?>
                    <li><?= Html::a($сurator->title, ['projects/view', 'id' => $сurator->id]); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <h5>Проекты в которых вы состоите: </h5>
        <?php foreach($projects as $project): ?>
            <?php if(($project->user_id == Yii::$app->user->identity->id) && ($project->status == 2)): ?>
                <li><?= Html::a($project->project->title, ['projects/view', 'id' => $project->project->id]); ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
