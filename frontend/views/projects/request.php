<?php
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;
?>

<?php 
$this->title = 'Заявки: ' . $project->title;
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = 'Заявки';
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
</div>
<?php foreach ($members as $member): ?>
    <?php Pjax::begin(); ?>
        <?= $this->render('_waitmember', [
            'project' => $project,
            'member' => $member,
            'tags' => $tags,
            'count' => $count,
        ]) ?>
    <?php Pjax::end(); ?>
<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>