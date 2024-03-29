<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?//= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'filterOptions' => ['style' => 'width: 60px']],
            ['class' => 'yii\grid\ActionColumn', 'filterOptions' => ['style' => 'width: 90px']],

            //'id',
            'fullName',
            //'username',
            //'surname',
            //'name',
            //'patronymic',
            'role',
            'email:email',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'status',
            [
                'attribute' => 'created_at', 
                'format' => ['date', 'php:d.m.Y H:i']
            ],
            //'updated_at',
            //'verification_token',
            //'image',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
