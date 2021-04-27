<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
</div>
<div class="projects-view">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <?php if ($model->user_id == Yii::$app->user->identity->id): ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], 
                    ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить проект?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Заявки на участие', ['request', 'id' => $model->id], 
                    ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?php Pjax::begin(['timeout' => 5000, 'enablePushState' => false]) ?>
                    <?= $this->render('_member', [
                        'project' => $project,
                        'count' => $count,
                    ]) ?>
                <?php Pjax::end() ?>
            <?php endif ?>
            
            <?php if($model->isMember(Yii::$app->user->identity->id) || 
                ($model->creater->id == Yii::$app->user->identity->id)): ?>
                <div class="btn-group mr-2" role="group" aria-label="Second group">  
                    <?= Html::a('Доска <i class="far fa-edit"></i>', ['/dashboard/index', 
                        'id' => $model->id], ['class' => 'btn btn-info']);?>
                </div>
            <? endif; ?>
        </div>
    </div>

    <?php ($model->image) ? $img = $model->image : $img = 'no_image.png';?>
    <?= Html::img("@web/uploads/projects/80x80/$img", [
        'class'=>'project-img', 'align' => 'left']) ?>

    <div class="card-body d-flex flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <b>Куратор: </b>
        <?=Html::a($model->creater->username, ['user/view', 'id' => $model->creater->id]);?>
    </div>
    <hr>
    <b>Cписок</b> (<?= $count ?>/<?= $project->max_number ?>):

    <?php foreach ($members as $member): ?>
        <?php Pjax::begin(['enablePushState' => false]); ?>
            <?= $this->render('_kick', [
                'project' => $project,
                'member' => $member,
            ]) ?>
        <?php Pjax::end(); ?>
    <?php endforeach;?>

    <div class="block-text ">
        <?= nl2br($model->description) ?>
    </div>
    <br>
    <div class="well">
        <?php foreach($tags as $one): ?>
            <?php if($one->project_id == $model->id):?>
                <span class="badge badge-primary"><?=$one->tag->title?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>