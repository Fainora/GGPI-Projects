<?php
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use common\widgets\vue\VueWidget;

/* @var $this yii\web\View */

$this->title = 'GGPI-Projects';
?>
<!--
<div id="app"></div> -->

<?//= VueWidget::widget(['component' => 'hello-world', 'props' => ['msg' => 'PAF']])?>
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
