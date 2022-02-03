<?php

namespace app\modules\admin\controllers;

use app\models\ar\News;
use app\models\search\NewsSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        /**
         * @var $modelClass News
         */
        $this->modelClass = News::class;
        $this->modelSearchClass = NewsSearch::class;
        $this->modelName = 'новости';
        $this->staticHash = "l1_bmV3cw";
        $this->staticName = "news";
        $this->rememberLastDir = false;

        parent::init();
    }

    //  Экшен для загрузки картинок в редактор
    public function actionUploadImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $file = UploadedFile::getInstanceByName('upload');

        if ($file) {
            $url = '/static/news/'.md5(time().'dqwhtrt65656576uyikjghgffe12'). '.' . $file->extension;
            $path = Yii::getAlias("@webroot") .$url;
            if ($file->saveAs($path)) {
                return [
                    'fileName' => $file->name,
                    'uploaded' => 1,
                    'url' => $url
                ];
            } else {
                return "Возникла ошибка при загрузке файла\n";
            }
        } else {
            return "Файл не загружен\n";
        }
    }


}
