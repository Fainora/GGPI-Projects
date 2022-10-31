<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <?php if($model->id == Yii::$app->user->identity->id): ?>
        <div class="group btn-group" role="group">
            <?= Html::a('<i class="fas fa-edit"></i> Редактировать профиль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-lock"></i> Изменить пароль', ['site/request-password-reset'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> Удалить профиль', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить ваш аккаунт?',
                        'method' => 'post',
                    ],
                ]) ?>
        </div>
    <?php endif; ?>
    <div class="user-top">
        <?php ($model->image) ? $img = $model->image : $img = 'avatar.png';?>
        <?= Html::img("@web/uploads/user/160x160/$img", [
            'class'=>'user-img', 'align' => 'left']) ?>
        <h1><?= Html::encode($this->title); ?></h1>
        <div class="well">
            <?php foreach($tags as $one): ?>
                <?php if($one->user_id == $model->id):?>
                    <span class="badge badge-info"><?=$one->tag->title?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="note">
            <?php if(!$model->note): ?>
                Здесь еще ничего не написано :(
            <?php endif; ?>
            <?= nl2br($model->note); ?>
        </div>
    </div>

    <div class="user-projects">
        <?= ($model->id == Yii::$app->user->identity->id) ? '<h5>Ваши проекты:</h5>' : '<h5>Проекты ' . $this->title . ':</h5>'; ?>
            <?php if($count < 1): ?>
                <?= ($model->id == Yii::$app->user->identity->id) ? 
                    'Вы еще не создали проект' : 'Этот пользователь еще не создал проект'; ?>
					<br/>
			<?php endif; ?>
            <?php foreach($creater as $project): ?>
                <?php if($project->user_id == $model->id): ?>
                    <li><?= Html::a($project->title, ['projects/view', 'id' => $project->id]); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <br/>
        <?= ($model->id == Yii::$app->user->identity->id) ? 
        '<h5>Проекты в которых вы состоите:</h5>' : '<h5>Проекты в которых ' . $this->title . ' состоит:</h5>'; ?>
        <?php if($user_projects < 1): ?>
              <?= ($model->id == Yii::$app->user->identity->id) ? 
                  'Вы еще не состоите ни в одном проекте' : 'Этот пользователь еще не состоит ни в одном проекте'; ?>
              <br/>
        <?php endif; ?>
        <?php foreach($projects as $project): ?>
            <?php if(($project->user_id == $model->id) && ($project->status == 2)): ?>
                <li><?= Html::a($project->project->title, ['projects/view', 'id' => $project->project->id]); ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
