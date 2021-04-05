<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
?>

<?php if(($project->id == $member->project_id) && $member->status == 1): ?>
    <div class="wait">
        <li><?= Html::encode($member->user->username); ?></li>
        <div class="well">
            Ключевые навыки:
            <?=$member->user->tagsAsString?>
        </div>
        <?php if($count < $project->max_number): ?>
        <a class="btn btn-success"
            href="<?= Url::to(['projects/accept', 'id' => $member->user->id, 'project_id' => $project->id]) ?>"
            data-method="post" data-pjax="1" id="hideMe-<?=$member->user->id?>">Принять
        </a>
        <?php endif; ?>
        <a class="btn btn-danger"
            href="<?= Url::to(['projects/reject', 'id' => $member->user->id, 'project_id' => $project->id]) ?>"
            data-method="post" data-pjax="1" id="hideMe-<?=$member->user->id?>">Отклонить
        </a>
    </div>
<?php endif; ?>