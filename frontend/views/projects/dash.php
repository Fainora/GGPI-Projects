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
  // List 1
  $('#items-1').sortable({
      group: 'list',
      animation: 200,
      ghostClass: 'ghost',
      onSort: reportActivity,
  });

  // List 2
  $('#items-2').sortable({
      group: 'list',
      animation: 200,
      ghostClass: 'ghost',
      onSort: reportActivity,
  });

  // Arrays of "data-id"
  $('#get-order').click(function() {
      var sort1 = $('#items-1').sortable('toArray');
      console.log(sort1);
      var sort2 = $('#items-2').sortable('toArray');
      console.log(sort2);
  }); 

  // Report when the sort order has changed
  function reportActivity() {
      console.log('The sort order has changed');
  };
  </script>
<div id="demo" class="row">
    <div id="items-1" class="list-group col">
        <div id="item-1.1" data-id="1.1" class="list-group-item nested-1">Item 1.1</div>
        <div id="item-1.2" data-id="1.2" class="list-group-item nested-1">Item 1.2</div>
        <div id="item-1.3" data-id="1.3" class="list-group-item nested-1">Item 1.3</div>
        <div id="item-1.4" data-id="1.4" class="list-group-item nested-1">Item 1.4</div>
        <div id="item-1.5" data-id="1.5" class="list-group-item nested-1">Item 1.5</div>
    </div>
    <div id="items-2" class="list-group col">
        <div id="item-2.1" data-id="2.1" class="list-group-item nested-1">Item 2.1</div>
        <div id="item-2.2" data-id="2.2" class="list-group-item nested-1">Item 2.2</div>
        <div id="item-2.3" data-id="2.3" class="list-group-item nested-1">Item 2.3</div>
        <div id="item-2.4" data-id="2.4" class="list-group-item nested-1">Item 2.4</div>
        <div id="item-2.5" data-id="2.5" class="list-group-item nested-1">Item 2.5</div>
    </div>
  </div>
  <button id="get-order" >Get Order</button>