<?php 

namespace JustStore\components;

use Yii;

class Component extends \yii\base\Component
{

    public $basket = [];

    public function init()
    {
        $this->basket = Yii::createObject(((array) $this->basket) + [
            'class' => Basket::className(),
            'storage' => Yii::$app->session,
            'parentComponent' => $this,
        ]);
    }

}
