<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use \yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'filterOptions' => ['style' => 'width: 60px']],
            ['class' => 'yii\grid\ActionColumn', 'filterOptions' => ['style' => 'width: 90px']],

            //'id',
            'title',
            //'description:ntext',
            [
                'attribute' => 'description',
                'value' => function ($model) {
                    return StringHelper::truncate($model->description, 250);
                }
            ],
            'smallImage:image',
            'max_number',
            //'user_id',
            [
                'attribute' => 'user_id', 
                'value' => function($data) {
                    return $data->creater->username;
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
