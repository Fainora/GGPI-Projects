<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
?>

<?php if($project->isMember(Yii::$app->user->identity->id)): ?>
    <a class="btn btn-danger" href="<?= Url::to(['projects/exit', 'id' => $project->id]) ?>"
        data-method="post" data-pjax="1" data-confirm="Вы уверены, что хотите выйти из проекта?"> Выйти <i class="fas fa-times"></i>
    </a>
<?php elseif($project->isWaitingMember(Yii::$app->user->identity->id)): ?>
    <a class="btn btn-secondary" href="<?= Url::to(['projects/apply', 'id' => $project->id]) ?>"
        data-method="post" data-pjax="1"> Отменить <i class="fas fa-times"></i>
    </a>
<?php elseif($count < $project->max_number): ?>
    <a class="btn btn-success" href="<?= Url::to(['projects/apply', 'id' => $project->id]) ?>"
        data-method="post" data-pjax="1"> Подать заявку <i class="fas fa-times"></i>
    </a>
<?php endif; ?>