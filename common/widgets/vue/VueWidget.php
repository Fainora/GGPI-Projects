<?php
namespace common\widgets\vue;

use yii\base\Widget;
use yii\helpers\Html;
use common\widgets\vue\VueAssets;

class VueWidget extends Widget
{
    public string $component;
    public array $props = [];

    public function init()
    {
        parent::init();
        VueAssets::register($this->view);
    }

    public function run()
    {
        echo Html::tag('div', Html::tag($this->component, '', $this->props), ['id' => $this->getVueID()]);
        $this->view->registerJs("
            new window.Vue({
                el: '#" . $this->getVueID() . "'
            });
        ");
    }
    
    public function getVueID() 
    {
        return 'vue' . $this->getId();
    }
}