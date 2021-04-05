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

<style>
    .to_do, .doing, .done {
        border: 1px solid black;
        padding: 5px;
        border-radius: 5px;
        margin: 3px;
        background-color: #aaafff;
        cursor:pointer;
    }
    .droptrue {
        min-height: 200px;
        padding: 10px;
    }
    .btn.dash{
        float: right;
        padding: 0 5px;

    }
</style>

<script>
    $(function () {
     $("#sortable1, #sortable2, #sortable3").sortable({
         connectWith: ".connectedSortable",
         update: function () {
             var order1 = $('#sortable1').sortable('toArray').toString();
             var order2 = $('#sortable2').sortable('toArray').toString();
             var order3 = $('#sortable3').sortable('toArray').toString();

             console.log("Order 1:" + order1 + "\nOrder 2:" + order2 + "\nOrder 3:" + order3); 
             $.ajax({
                 type: "POST",
                 //url: "/echo/json/",
                 data: "order1=" + order1 + "&order2=" + order2 + "&order3=" + order3,
                 dataType: "json",
                 success: function (data) {
                 }
             });
         }
     }).disableSelection();
 });
</script>

<div class="row">
    <div id="sortable1" class="connectedSortable card col-sm-3">
    To Do
        <?php foreach($dashboard as $board): ?>
            <?php if($id == $board->project_id): ?>
                <?php if($board->position == 'todo'):?>
                    <div class="to_do" id=<?=$board->id;?>><?= $board->text;?>
                    <?= Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $board->id], [
                    'class' => 'btn dash',
                    'data' => ['method' => 'post'],
                ]) ?></div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div id="sortable2" class="connectedSortable card col-sm-3">
    Do
    <?php foreach($dashboard as $board): ?>
        <?php if($id == $board->project_id): ?>
            <?php if($board->position == 'doing'):?>
                <div class="doing" id=<?=$board->id;?>><?= $board->text;?>
                <?= Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $board->id], [
                    'class' => 'btn dash',
                    'data' => ['method' => 'post'],
                ]) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <div id="sortable3" class="connectedSortable card col-sm-3">
    Done
    <?php foreach($dashboard as $board): ?>
        <?php if($id == $board->project_id): ?>
            <?php if($board->position == 'done'):?>
                <div class="done" id=<?=$board->id;?>><?= $board->text;?>
                <?= Html::a('<i class="fas fa-times"></i>', ['delete', 'id' => $board->id], [
                    'class' => 'btn dash',
                    'data' => ['method' => 'post'],
                ]) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
</div>