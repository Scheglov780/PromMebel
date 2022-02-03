<?php

namespace app\modules\admin\controllers;

use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\ElFinder;
use alexantr\elfinder\InputFileAction;
use app\models\ar\FileToBrand;
use app\models\ar\FileToManufacturer;
use app\models\ar\Params;
use app\models\ar\Product;
use app\models\search\ProductSearch;
use http\Url;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * SeriesController implements the CRUD actions for Product model.
 */
class SeriesController extends BaseController
{
    public function actionDeleteFile($id)
    {
        //@todo Доделать аналогично для производителей
        $f = FileToBrand::findOne(['id' => $id]);
        $f->delete();
        if (file_exists(Yii::getAlias('@productroot/' . $f->name))) {
            unlink(Yii::getAlias('@productroot/' . $f->name));
        }
        return $this->redirect(['update', 'id' => $f->brand_id]);
    }

    /**
     * Lists all models.
     * @return mixed
     */
    public function actionIndex()
    {
        $param = Params::get();
        if ($param->load(Yii::$app->request->post()) && $param->save()) {
            return $this->redirect(\yii\helpers\Url::current());
        }
        if (isset($this->modelSearchClass)) {
            $searchModel = new $this->modelSearchClass();
            $dataProvider =
              $searchModel->search(
                Yii::$app->request->queryParams,
                $this->modelClass::find()->andWhere(['type' => Product::TYPE_SERIES])->with(
                  ['manufacturer', 'brand', 'category', 'productImgs', 'properties', 'propertyValue'] //'manufacturer',
                )
              );
        } else {
            $dataProvider = new ActiveDataProvider([
              'query' => $this->modelClass::find()->andWhere(['type' => Product::TYPE_SERIES])->with(
                ['manufacturer', 'brand', 'category', 'productImgs', 'properties', 'propertyValue'] //'manufacturer',
              ),
              'pagination' => [
                'pageSize' => 100,
              ],
            ]);
        }

        return $this->render('index', [
          'dataProvider' => $dataProvider,
          'modelName'    => $this->modelName,
          'searchModel'  => $searchModel,
          'param'        => $param,
        ]);
    }

    public function init()
    {
        /**
         * @var $modelClass Product
         */
        $this->modelClass = Product::class;
        $this->modelSearchClass = ProductSearch::class;
        $this->modelName = 'серии';
        $this->rememberLastDir = false;
        $this->uploadCallback = [$this, "uploadFiles"];

        parent::init();
    }

    /**
     * Получаем хэш для элфиндера что бы попасть в нужную директорию
     * @param $id
     * @return bool|string
     */
    public function staticHash($id)
    {
        $id = Yii::$app->request->get('id');

        if ($id == 'create') {
            return $this->hashGen();
        }

        $id = explode('_', $id);
        if (count($id) != 2) {
            return $this->hashGen();
        }

        $product = Product::findOne($id);
        if (!$product) {
            return $this->hashGen();
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $dirSep = '\\';
        } else {
            $dirSep = DIRECTORY_SEPARATOR;
        }
        $path = 'product' . $dirSep . $product->slug;

        return $this->hashGen($path);
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
}
