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

<p>
    <?= Html::a('+', ['create', 'id' => $project->id], ['class' => 'btn btn-primary']); ?>
</p>

<div class="row">
    <div class="dashboard card col-lg">
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
                                'class' => 'to_do btn btn-danger',
                            ],
                            'footer' => 'Переместить в колонку: ' .
                            '<li class="none">' . Html::a('В процессе', ['doing','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                            '<li class="none">' . Html::a('Готово', ['done','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                            '<li class="none">' . Html::a('Backlog', ['backlog','card_id' => $card->id], ['class' => 'unline']) . '</li>'
                        ]);
                        echo $card->text;
                        Modal::end();
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="dashboard card col-lg">
        <div class="title">В процессе</div>
        <?php foreach($dashboard as $card): ?>
            <?php if($id == $card->project_id): ?>
                <?php if($card->position == 'doing'):?>
                    <?php
                        Modal::begin([
                            'title' =>  
                                Html::a('Редактировать', ['update', 'id' => $card->id], ['class' => 'dash']) . ' / ' .
                                Html::a('Удалить', ['delete', 'id' => $card->id],[
                                    'class' => 'dash',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]),
                            'toggleButton' => [
                                'label' => $card->text,
                                'tag' => 'button',
                                'class' => 'doing btn btn-warning',
                            ],
                            'footer' => 'Переместить в колонку: ' .
                                '<li class="none">' . Html::a('Сделать', ['todo', 'card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                '<li class="none">' . Html::a('Готово', ['done','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                '<li class="none">' . Html::a('Backlog', ['backlog','card_id' => $card->id], ['class' => 'unline']) . '</li>'
                        ]);
                        echo $card->text;
                        Modal::end();
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="dashboard card col-lg">
        <div class="title">Готово</div>
        <?php foreach($dashboard as $card): ?>
            <?php if($id == $card->project_id): ?>
                <?php if($card->position == 'done'):?>
                    <?php
                        Modal::begin([
                            'title' =>  
                                Html::a('Редактировать', ['update', 'id' => $card->id], ['class' => 'dash']) . ' / ' .
                                Html::a('Удалить', ['delete', 'id' => $card->id],[
                                    'class' => 'dash',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]),
                            'toggleButton' => [
                                'label' => $card->text,
                                'tag' => 'button',
                                'class' => 'done btn btn-success',
                            ],
                            'footer' => 'Переместить в колонку: ' .
                                '<li class="none">' . Html::a('Сделать', ['todo', 'card_id' => $card->id], ['class' => 'unline']) . '</li>' .    
                                '<li class="none">' . Html::a('В процессе', ['doing','card_id' => $card->id], ['class' => 'unline']) . '</li>' .
                                '<li class="none">' . Html::a('Backlog', ['backlog','card_id' => $card->id], ['class' => 'unline']) . '</li>'
                        ]);
                        echo $card->text;
                        Modal::end();
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="dashboard card col-lg">
        <div class="title">Backlog</div>
        <?php foreach($dashboard as $card): ?>
            <?php if($id == $card->project_id): ?>
                <?php if($card->position == 'backlog'):?>
                    <?php
                        Modal::begin([
                            'title' =>  
                                Html::a('Редактировать', ['update', 'id' => $card->id], ['class' => 'dash']) . ' / ' .
                                Html::a('Удалить', ['delete', 'id' => $card->id],[
                                    'class' => 'dash',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]),
                            'toggleButton' => [
                                'label' => $card->text,
                                'tag' => 'button',
                                'class' => 'backlog btn btn-info',
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