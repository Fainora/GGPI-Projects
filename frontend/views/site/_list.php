<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use common\models\ProjectsUser;
?>

<div class="card flex-sm-row box-shadow h-sm-250">
    <?php
        ($model->image) ? $img = $model->image : $img = 'no_image.png';
        $count = ProjectsUser::find()->where(['status' => 2, 'project_id' => $model->id])->count();
    ?>
    <?= Html::img("@web/uploads/projects/80x80/$img", [
        'class'=>'rounded-circle card-img-left flex-auto d-none d-md-block', 
        'style'=>'min-width: 80px; height: 80px;'
    ]) ?>

    <div class="card-body d-flex flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <a href="<?= Url::toRoute(['../projects/view', 'id'=>$model->id]);?>">
                <h5 class="mb-1"><?= Html::encode($model->title) ?></h5>
            </a>
            <small>
                <?= $count ?>/<?= $model->max_number ?>
            </small>
        </div>
        <div class="block-text line-clamp">
            <?= HtmlPurifier::process($model->description) ?>
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

