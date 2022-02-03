<?php

namespace app\modules\admin\controllers;

use app\models\ar\Slider;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends BaseController
{
    public function init()
    {
        /**
         * @var $modelClass Slider
         */
        $this->modelClass = Slider::class;
        $this->modelName = 'слайда';
        $this->staticName = "slider";
        $this->staticHash = $this->hashGen($this->staticName);
        $this->rememberLastDir = false;

        parent::init();
    }
}
