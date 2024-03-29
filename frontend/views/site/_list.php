<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use common\models\ProjectsUser;
?>

<div class="project-card card flex-sm-row box-shadow h-sm-250">
    <?php
        ($model->image) ? $img = $model->image : $img = 'no_image.png';
        $count = ProjectsUser::find()->where(['status' => 2, 'project_id' => $model->id])->count();
    ?>
    <?= Html::img("@web/uploads/projects/160x160/$img", [
        'class'=>'project-img',
    ]) ?>

    <div class="card-body">
        <div class="d-flex w-100 justify-content-between">
            <?= Html::a('<p>'.Html::encode($model->title).'</p>', 
                ['projects/view', 'id' => $model->id],
                ['class' => 'project-title mb-1']); 
            ?>
            <small>
                <?= $count ?>/<?= $model->max_number ?> <i class="fas fa-user"></i>
            </small>
        </div>
        <div class="description block-text line-clamp">
            <?= nl2br($model->description) ?>
        </div>
        <div class="well">
            <?php foreach($tags as $one): ?>
                <?php if($one->project_id == $model->id):?>
                    <span class="badge badge-primary"><?=$one->tag->title?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

