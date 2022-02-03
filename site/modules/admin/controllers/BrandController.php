<?php

namespace app\modules\admin\controllers;

use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\InputFileAction;
use app\models\ar\Brand;
use app\models\ar\FileToBrand;
use app\models\search\BrandSearch;
use elFinder;
use function foo\func;
use Yii;
use yii\web\JsExpression;
use yii\web\UploadedFile;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        /**
         * @var $modelClass Brand
         */
        $this->modelClass = Brand::class;
        $this->modelSearchClass = BrandSearch::class;
        $this->modelName = 'бренда';
        $this->staticHash = "l1_YnJhbmQ";
        $this->staticName = "brand";
        $this->uploadCallback = [$this, "uploadFiles"];

        parent::init();
    }

    public function uploadFiles($model)
    {
        $model->docFiles = UploadedFile::getInstances($model, 'docFiles');

        if ($model->docFiles) {
            if ($model->upload()) {
                return true;
            }
        }

        return true;
    }

    public function actionDeleteFile($id)
    {
        $f = FileToBrand::findOne(['id' => $id]);
        $f->delete();
        if(file_exists(Yii::getAlias('@brandroot/'.$f->name))) {
            unlink(Yii::getAlias('@brandroot/'.$f->name));
        }
        return $this->redirect(['update', 'id' => $f->brand_id]);
    }
}
