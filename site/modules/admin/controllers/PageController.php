<?php

namespace app\modules\admin\controllers;

use app\models\ar\Page;
use app\models\search\PageSearch;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * PageController implements the CRUD actions for News model.
 */
class PageController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        /**
         * @var $modelClass Page
         */
        $this->modelClass = Page::class;
        $this->modelSearchClass = PageSearch::class;
        $this->modelName = 'внутренние страницы';

        parent::init();
    }

    //  Экшен для загрузки картинок в редактор
    public function actionUploadImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $file = UploadedFile::getInstanceByName('upload');

        if ($file) {
            $url = '/static/page/'.md5(time().'dqwhtrt65yshzx3332e12'). '.' . $file->extension;
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
