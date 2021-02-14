<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
?>
<a class="btn <?= $project->isMember(Yii::$app->user->identity->id) ? 'btn-secondary' : 'btn-success' ?>" 
    href="<?= Url::to(['projects/apply', 'id' => $project->id]) ?>"
    data-method="post" data-pjax="1"><?= $project->isMember(Yii::$app->user->identity->id) ? 'Выйти' : 'Подать заявку' ?>
</a>
<p>Участники:</p>
<?= $project->getMembers()->count() ?>/<?= $project->max_number ?>


