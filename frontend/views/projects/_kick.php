<?php
use yii\helpers\Html;
?>

<?php if($project->id == $member->project->id): ?>
    <div class="wait">
        <li><?=Html::a($member->user->username, ['user/view', 'id' => $member->user->id]);?>
            <?=Html::a('<i class="fas fa-times"></i>', [
                'projects/kick', 'id' => $member->user->id, 'project_id' => $project->id
            ],
            [
                'data' => [
                    'confirm' => 'Удалить ' . $member->user->username . ' из проекта?',
                    'method' => 'post',
                    'pjax' => 1
                ],
            ]);
            ?>
        </li>
    </div>
<?php endif; ?>