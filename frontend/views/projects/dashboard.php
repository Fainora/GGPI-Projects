<?php
use kartik\sortinput\SortableInput;
use yii\bootstrap4\Breadcrumbs;
use common\widgets\Alert;
use common\widgets\vue\VueWidget;
use yii\helpers\ArrayHelper;
?>
<?php 
$this->title = 'Доска: ' . $project->title;
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = 'Доска';
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
</div>
<?// var_dump($projects['title']);?>
<?php
$value = ArrayHelper::getColumn($projects, 'title');
//var_dump($value);
?>

<div class="app"></div>
<?//= VueWidget::widget(['component' => 'hello-world', 'props' => ['msg' => 'PAF']])?>
<style>
.to_do, .do, .done {
    border: 1px solid black;
    padding: 5px;
    border-radius: 5px;
    margin: 3px;
    background-color: #aaafff;
}
.droptrue {
    min-height: 200px;
    padding: 10px;
}
</style>

<script>
  $(function() {
    $("div.droptrue").sortable({
        connectWith: "div"
    });
 
    $("#sortable1, #sortable2, #sortable3").disableSelection();
  });
  </script>
<div class="row">
    <div id="sortable1" class="droptrue card col-sm-3">
    To Do
        <?php foreach($dashboard as $board): ?>
            <?php if($id == $board->project_id): ?>
                <?php if(isset($board->to_do)):?>
                    <div class="to_do"><?= $board->to_do;?></div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div id="sortable2" class="droptrue card col-sm-3">
    Do
    <?php foreach($dashboard as $board): ?>
        <?php if($id == $board->project_id): ?>
            <?php if(isset($board->do)):?>
                <div class="do"><?= $board->do;?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <div id="sortable3" class="droptrue card col-sm-3">
    Done
    <?php foreach($dashboard as $board): ?>
        <?php if($id == $board->project_id): ?>
            <?php if(isset($board->done)):?>
                <div class="done"><?= $board->done;?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
</div>