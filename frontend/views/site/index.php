<?php
use yii\widgets\ListView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = 'GGPI-Projects';
?>
<!-- 
<p>1. Админка (добавить плюшки)
<p>3. При удалении проекта/пользователя, удалить картинку
<p>6. (!) Frontend
<p>7. Если ты участик, то кнопка Выйти остается
<div id="app"></div> -->

<?//= VueWidget::widget(['component' => 'test-component', 'props' => ['msg' => 'PAF']])?>
<!-- Search -->
<?= $this->render('_search', ['model' => $searchModel]); ?>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '/site/_list',
        'layout' => "{items}\n{pager}",
        'pager' => [
            'class' => LinkPager::class,
        ],
        'viewParams' => [
            'tags' => $tags, 
            'count' => $count
        ],
    ]);
 ?> 
