<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'filterOptions' => ['style' => 'width: 60px']],
            ['class' => 'yii\grid\ActionColumn', 'filterOptions' => ['style' => 'width: 90px']],

            //'id',
            'title',
            //'type',
            [
                'attribute' => 'type',
                //'filter' => array('0' => 'Project', '1' => 'User'),
                'filter' => ['0' => 'Проект', '1' => 'Пользователь'],
                'value' => function ($model){
                    if($model->type == 0){
                        return 'для проекта';
                    }
                    else if($model->type == 1) {
                        return 'для пользователя';
                    }
                },
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
