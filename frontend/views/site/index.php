<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\vue\VueWidget;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\helpers\HtmlPurifier;
use yii\bootstrap4\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'GGPI-Projects';
?>

<p>1. Админка (добавить плюшки)
<p>3. При удалении проекта/пользователя, удалить картинку
<p>4. Добавить чат
<p>5. Больше тегов!!!
<p>6. (!) Frontend
<p>7. Если ты участик, то кнопка Выйти остается
<!-- <div id="app"></div> -->

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
