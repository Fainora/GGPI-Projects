<?php
use kartik\sortinput\SortableInput;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;
use common\widgets\vue\VueWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
    <?= Alert::widget() ?>
</div>

<p>
    <?= Html::a('Create Dashboard', ['create', 'id' => $project->id], ['class' => 'btn btn-success']); ?>
</p>
<div class="row">
<?php
    echo '<div class="col-sm-6">';
    echo SortableInput::widget([
        'name'=>'to-do',
        'items' => [
            1 => ['content' => 'Item # 1'],
            2 => ['content' => 'Item # 2'],
            3 => ['content' => 'Item # 3'],
        ],
        'hideInput' => false,
        'sortableOptions' => [
            'connected'=>true,
            'options' => ['style' => 'min-height: 50px']
        ],
        'options' => ['class'=>'form-control', 'readonly'=>true],
        'pluginEvents' => [
            'sortupdate' => "function(event, value) {
                $.ajax({
                    url: '/dashboard',
                    method: 'post',
                    data: {
                        id: 1,
                    },
                    dataType: 'json',
                    success: function(data) {
                        location.reload();
                    }
                });
            }",
        ],
    ]);
    echo '</div>';
    
    echo '<div class="col-sm-6">';
    echo SortableInput::widget([
        'name'=>'doing',
        'items' => [
            10 => ['content' => 'Item # 10'],
            20 => ['content' => 'Item # 20'],
        ],
        'hideInput' => false,
        'sortableOptions' => [
        'itemOptions'=>['class'=>'alert alert-warning'],
            'connected'=>true,
        ],
        'options' => ['class'=>'form-control', 'readonly'=>true]
    ]);
    echo '</div>';
?>
</div>
