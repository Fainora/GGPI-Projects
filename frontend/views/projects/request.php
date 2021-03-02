<?php
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap4\LinkPager;
?>

<?php 
$this->title = 'Заявки: ' . $project->title;
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = 'Заявки';
?>

<?php foreach ($members as $member): ?>
    <?php Pjax::begin(); ?>
        <?= $this->render('_waitmember', [
            'project' => $project,
            'member' => $member,
            'tags' => $tags,
        ]) ?>
    <?php Pjax::end(); ?>
<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>