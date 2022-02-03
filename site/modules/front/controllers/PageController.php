<?php

namespace app\modules\front\controllers;

use app\models\ar\Page;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `front` module
 */
class PageController extends BaseController
{
    /**
     * Renders the index view for the module
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($slug)
    {
        /** @var $page Page */
        $page = Page::find()->where(['slug' => $slug])->one();

        if(!isset($page)) {
            throw new NotFoundHttpException();
        }

        $title = $page->meta_title ?? $this->params->meta_title_page;
        $desc = $page->meta_description ?? $this->params->meta_desc_page;
        $keywords = $page->meta_keywords ?? $this->params->meta_keywords_page;

        $this->setMeta(
            $title,
            $desc,
            $keywords
        );

        return $this->render('index', [
            'page' => $page,
        ]);
    }
}
