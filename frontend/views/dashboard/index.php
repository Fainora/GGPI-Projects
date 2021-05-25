<?php
use kartik\sortinput\SortableInput;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\vue\VueWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
Url::remember();
?>
<?php 
$this->title = 'Доска: ' . $project->title;
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['/projects/view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = 'Доска';
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<div class="dashboard">
    <p><?= Html::a('+', ['create', 'id' => $project->id], ['class' => 'btn btn-primary']); ?></p>

    <div class="row">
        <div class="dashboard-todo card col-lg">
            <div class="title">Сделать</div>
            <?php foreach($dashboard as $card): ?>
                <?php if($id == $card->project_id): ?>
                    <?php if($card->position == 'todo'):?>
                        <?php
                            Modal::begin([
                                'title' =>  
                                    Html::a('Редактировать', ['update', 'id' => $card->id, 'project_id' => $card->project_id], ['class' => 'dash']) . ' / ' .
                                    Html::a('Удалить', ['delete', 'id' => $card->id],[
                                        'class' => 'dash',
                                        'data' => [
                                            'method' => 'post',
                                        ],
                                    ]),
                                'toggleButton' => [
                                    'label' => $card->text,
                                    'tag' => 'button',
                                    'class' => 'btn to_do ',
                                ],
                                'footer' => 'Переместить в колонку: ' .
                                '<li class="none">' . Html::a('В процессе', ['doing','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                '<li class="none">' . Html::a('Готово', ['done','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                '<li class="none">' . Html::a('Ресурсы', ['backlog','card_id' => $card->id], ['class' => 'unline']) . '</li>'
                            ]);
                            echo $card->text;
                            Modal::end();
                        ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="dashboard-doing card col-lg">
            <div class="title">В процессе</div>
            <?php foreach($dashboard as $card): ?>
                <?php if($id == $card->project_id): ?>
                    <?php if($card->position == 'doing'):?>
                        <?php
                            Modal::begin([
                                'title' =>  
                                Html::a('Редактировать', ['update', 'id' => $card->id, 'project_id' => $card->project_id], ['class' => 'dash']) . ' / ' .
                                    Html::a('Удалить', ['delete', 'id' => $card->id],[
                                        'class' => 'dash',
                                        'data' => [
                                            'method' => 'post',
                                        ],
                                    ]),
                                'toggleButton' => [
                                    'label' => $card->text,
                                    'tag' => 'button',
                                    'class' => 'btn doing',
                                ],
                                'footer' => 'Переместить в колонку: ' .
                                    '<li class="none">' . Html::a('Сделать', ['todo', 'card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                    '<li class="none">' . Html::a('Готово', ['done','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                    '<li class="none">' . Html::a('Ресурсы', ['backlog','card_id' => $card->id], ['class' => 'unline']) . '</li>'
                            ]);
                            echo $card->text;
                            Modal::end();
                        ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="dashboard-done card col-lg">
            <div class="title">Готово</div>
            <?php foreach($dashboard as $card): ?>
                <?php if($id == $card->project_id): ?>
                    <?php if($card->position == 'done'):?>
                        <?php
                            Modal::begin([
                                'title' =>  
                                Html::a('Редактировать', ['update', 'id' => $card->id, 'project_id' => $card->project_id], ['class' => 'dash']) . ' / ' .
                                    Html::a('Удалить', ['delete', 'id' => $card->id],[
                                        'class' => 'dash',
                                        'data' => [
                                            'method' => 'post',
                                        ],
                                    ]),
                                'toggleButton' => [
                                    'label' => $card->text,
                                    'tag' => 'button',
                                    'class' => 'btn done',
                                ],
                                'footer' => 'Переместить в колонку: ' .
                                    '<li class="none">' . Html::a('Сделать', ['todo', 'card_id' => $card->id], ['class' => 'unline']) . '</li>' .    
                                    '<li class="none">' . Html::a('В процессе', ['doing','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                    '<li class="none">' . Html::a('Ресурсы', ['backlog','card_id' => $card->id], ['class' => 'unline']) . '</li>'
                            ]);
                            echo $card->text;
                            Modal::end();
                        ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="dashboard-backlog card col-lg">
            <div class="title">Ресурсы</div>
            <?php foreach($dashboard as $card): ?>
                <?php if($id == $card->project_id): ?>
                    <?php if($card->position == 'backlog'):?>
                        <?php
                            Modal::begin([
                                'title' =>  
                                Html::a('Редактировать', ['update', 'id' => $card->id, 'project_id' => $card->project_id], ['class' => 'dash']) . ' / ' .
                                    Html::a('Удалить', ['delete', 'id' => $card->id],[
                                        'class' => 'dash',
                                        'data' => [
                                            'method' => 'post',
                                        ],
                                    ]),
                                'toggleButton' => [
                                    'label' => $card->text,
                                    'tag' => 'button',
                                    'class' => 'btn backlog',
                                ],
                                'footer' => 'Переместить в колонку: ' .
                                    '<ul class="none">' .
                                        '<li class="none">' . Html::a('Сделать', ['todo', 'card_id' => $card->id], ['class' => 'unline']) . '</li>' .    
                                        '<li class="none">' . Html::a('В процессе', ['doing','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                        '<li class="none">' . Html::a('Готово', ['done','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                    '</ul>'
                            ]);
                            echo $card->text;
                            Modal::end();
                        ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>