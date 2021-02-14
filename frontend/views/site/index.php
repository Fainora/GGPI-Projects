<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<p>1. Админка
<p>2. Создать проект: Кнопки "Вступить" и "Принять"
<p>4. Добавить чат
<p>5. Назначение ролей (???)
<p>6. Frontend
    
<?php foreach($projects as $project): ?>
<div class="card flex-sm-row box-shadow h-sm-250">
    <?php
        ($project->image) ? $img = $project->image : $img = 'no_image.png';
    ?>
    <?= Html::img("@web/uploads/projects/80x80/$img", [
        'class'=>'rounded-circle card-img-left flex-auto d-none d-md-block', 
        'style'=>'min-width: 80px; height: 80px;'
    ]) ?>
    <div class="card-body d-flex flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        <a href="<?= Url::toRoute(['../projects/view', 'id'=>$project->id]);?>"><h5 class="mb-1"><?= $project->title ?></h5></a>
        <small>
        <?= $project->getMembers()->count() ?>/<?= $project->max_number ?>
        </small>
        </div>
        <p class="card-text mb-auto"><?= $project->description ?></p>
        <div class="well">
        <?php foreach($tags as $one): ?>
        <?php if($one->projects_id == $project->id):?>
            <span class="badge badge-primary"><?=$one->tag->title?></span>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>