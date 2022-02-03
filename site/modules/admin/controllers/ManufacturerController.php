<?php

namespace app\modules\admin\controllers;

use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\InputFileAction;
use app\models\ar\Manufacturer;
use app\models\ar\FileToManufacturer;
use app\models\search\ManufacturerSearch;
use elFinder;
use function foo\func;
use Yii;
use yii\web\JsExpression;
use yii\web\UploadedFile;

/**
 * ManufacturerController implements the CRUD actions for Manufacturer model.
 */
class ManufacturerController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        /**
         * @var $modelClass Manufacturer
         */
        $this->modelClass = Manufacturer::class;
        $this->modelSearchClass = ManufacturerSearch::class;
        $this->modelName = 'Производители';
        $this->staticHash = "l1_YnJhbmR";
        $this->staticName = "manufacturer";
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
        $f = FileToManufacturer::findOne(['id' => $id]);
        $f->delete();
        if(file_exists(Yii::getAlias('@manufacturerroot/'.$f->name))) {
            unlink(Yii::getAlias('@manufacturerroot/'.$f->name));
        }
        return $this->redirect(['update', 'id' => $f->manufacturer_id]);
    }
}
