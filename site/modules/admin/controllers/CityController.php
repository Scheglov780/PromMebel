<?php

namespace app\modules\admin\controllers;

use app\models\search\CitySearch;
use Yii;
use app\models\ar\City;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends BaseController
{
    /**
     * @var $modelClass City
     */
    public $modelClass = City::class;
    public $modelSearchClass = CitySearch::class;
    public $modelName = 'города';
}
