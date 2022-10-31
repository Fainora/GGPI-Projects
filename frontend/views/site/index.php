<?php

/** @var yii\web\View $this */

use yii\widgets\LinkPager;
use yii\widgets\ListView;

$this->title = 'GGPI-Projects';

// $this->render('_search', ['model' => $searchModel]);
?>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '/site/_list',
        'layout' => "{items}\n{pager}",
        'pager' => [
            'class' => LinkPager::class,
        ],
        'viewParams' => [
            'tags' => $tags, 
            //'count' => $count
        ],
    ]);
 ?> 

