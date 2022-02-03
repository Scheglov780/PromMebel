<?php

namespace app\modules\admin;

use app\models\User;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    public $layout = 'main';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function init()
    {
        parent::init();
    }
}
