<?php
use yii\helpers\Html;
$this->title = 'Начальная страница';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3><?= $user; ?></h3>
                    <p>Пользователей</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <?= Html::a('Больше информации <i class="fas fa-arrow-circle-right"></i>', ['user/index'], 
                    ['class' => 'small-box-footer']); ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $projects; ?></h3>
                    <p>Проектов создано</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <?= Html::a('Больше информации <i class="fas fa-arrow-circle-right"></i>', ['projects/index'], 
                    ['class' => 'small-box-footer']); ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3><?= $tags; ?></h3>
                    <p>Тегов создано</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <?= Html::a('Больше информации <i class="fas fa-arrow-circle-right"></i>', ['tag/index'], 
                    ['class' => 'small-box-footer']); ?>
            </div>
        </div>
    </div>
</div>