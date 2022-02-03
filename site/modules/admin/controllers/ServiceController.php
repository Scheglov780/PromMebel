<?php

namespace app\modules\admin\controllers;

use app\models\ar\News;
use app\models\ar\Service;
use app\models\search\NewsSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        /**
         * @var $modelClass Service
         */
        $this->modelClass = Service::class;
        $this->modelName = 'услуги';
        $this->staticHash = "l1_c2VydmljZQ";
        $this->staticName = "service";
        $this->rememberLastDir = false;

        parent::init();
    }
}
