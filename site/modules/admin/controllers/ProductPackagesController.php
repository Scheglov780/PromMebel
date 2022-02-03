<?php

namespace app\modules\admin\controllers;

use app\models\ar\Params;
use app\models\ar\ProductPackages;
use app\models\search\ProductPackagesSearch;
use app\models\query\ProductPackagesQuery;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * ProductPackagesController implements the CRUD actions for ProductPackages model.
 */
class ProductPackagesController extends BaseController
{
    public $modelClass = ProductPackages::class;
    public $modelName = 'пакета товаров';
    public $modelSearchClass = ProductPackagesSearch::class;

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
                $this->modelClass::findAdmin()
              );
        } else {
            $dataProvider = new ActiveDataProvider([
              'query'      => $this->modelClass::findAdmin(),
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
         * @var $modelClass ProductPackages
         */
        $this->modelClass = ProductPackages::class;
        $this->modelSearchClass = ProductPackagesSearch::class;
        $this->modelName = 'пакета товаров';

        parent::init();
    }
}
