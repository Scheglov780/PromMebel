<?php

namespace app\modules\admin\controllers;

use app\models\ar\Params;
use app\models\ar\Property;
use app\models\search\PropertySearch;
use app\models\query\PropertyQuery;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends BaseController
{
    /**
    * @var $modelClass Property
    */
    public $modelClass = Property::class;
    public $modelName = 'свойства товара';


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
              'query' => $this->modelClass::findAdmin(),
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
         * @var $modelClass Property
         */
        $this->modelClass = Property::class;
        $this->modelSearchClass = PropertySearch::class;
        $this->modelName = 'свойства товара';
        parent::init();
    }

    public function actionDelete($id)
    {
        if(in_array($id, [1, 4])) {
            \Yii::$app->session->addFlash('danger', 'Нельзя удаляить данное свойство');
            return $this->redirect(['index']);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
