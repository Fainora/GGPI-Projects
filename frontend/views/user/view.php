<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
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
    ]) ?>
    
    <?php if($model->id == Yii::$app->user->identity->id): ?>
        <h5>Ваши проекты: </h5>
            <?php foreach($creater as $сurator): ?>
                <?php if($сurator->user_id == Yii::$app->user->identity->id): ?>
                    <li><?= $сurator->title ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <h5>Проекты в которых вы состоите: </h5>
        <?php foreach($projects as $project): ?>
            <?php if(($project->user_id == Yii::$app->user->identity->id) && ($project->status == 2)): ?>
                <li><?= $project->project->title ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if($model->id == Yii::$app->user->identity->id): ?>
    <p>
        <?= Html::a('Редактировать профиль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= Html::a('Изменить пароль', ['site/request-password-reset']) ?>.
    <br />
    <?= Html::a('Удалить профиль', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить ваш аккаунт?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>
</div>
