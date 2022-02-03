<?php

namespace app\modules\front\controllers;

use app\models\ar\City;
use app\models\ar\News;
use app\models\ar\Slider;

/**
 * Default controller for the `front` module
 */
class NewsController extends BaseController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $news = News::find()->orderBy('created_at DESC')->all();

        return $this->render('index', [
            'news' => $news,
        ]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView($slug)
    {
        $news = News::find()->where(['slug' => $slug])->one();

        return $this->render('view', [
            'news' => $news,
        ]);
    }
}
