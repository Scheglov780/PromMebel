<?php

namespace app\modules\admin\controllers;

use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\ElFinder;
use alexantr\elfinder\InputFileAction;
use app\models\ar\Category;
use app\models\search\CategorySearch;
use Yii;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController
{
    public function init()
    {
        /**
         * @var $modelClass Category
         */
        $this->modelClass = Category::class;
        $this->modelSearchClass = CategorySearch::class;
        $this->modelName = 'категории';
        $this->staticHash = "l1_Y2F0ZWdvcnk";
        $this->staticName = "category";
        $this->rememberLastDir = false;

        parent::init();
    }

    public function actionDelete($id)
    {
        /* if($id < 4) {
            Yii::$app->session->addFlash('danger', "Данную категорию нельзя удалить");
            return $this->redirect('/admin/category/index');
        } */
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
}
