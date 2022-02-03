<?php

namespace app\modules\admin\controllers;

use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\ElFinder;
use alexantr\elfinder\InputFileAction;
use app\models\ar\Params;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BaseController implements the CRUD actions for all models.
 */
class BaseController extends Controller
{
    /**
     * @var $modelClass ActiveRecord
     */
    public $modelClass;
    /**
     * @var $modelSearchClass ActiveRecord
     */
    public $modelSearchClass;
    /**
     * @var $modelName string
     */
    public $modelName;
    /**
     * @var $staticName string
     */
    public $staticName = 'tmp';
    /**
     * @var $staticName callable
     */
    public $staticHash = "l1_dG1w";
    /**
     * @var $staticName callable
     */
    public $rememberLastDir = true;
    /**
     * @var $staticName callable
     */
    public $uploadCallback;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
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

        $searchModel = null;
        if(isset($this->modelSearchClass)) {
            $searchModel = new $this->modelSearchClass();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->modelClass::find());
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $this->modelClass::find(),
                          'pagination' => [
              'pageSize' => 100,
            ],
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'modelName' => $this->modelName,
            'searchModel' => $searchModel,
            'param' => $param,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var $model \yii\db\ActiveRecord */
        $model = new $this->modelClass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(is_callable($this->uploadCallback)) {
                call_user_func($this->uploadCallback, $model);
                return $this->redirect(['update?id='.$model->id]);
            }
            return $this->redirect(Url::previous()?Url::previous():['index']);
        }
        if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl) {
            Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
        }
        return $this->render('/base/update', [
            'update' => false,
            'model' => $model,
            'modelName' => $this->modelName,
        ]);
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(is_callable($this->uploadCallback)) {
                 call_user_func($this->uploadCallback, $model);
                return $this->redirect(['update?id='.$model->id]);
            }
            return $this->redirect(Url::previous()?Url::previous():['index']);
        }
        if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl) {
            Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
        }
        return $this->render('/base/update', [
            'update' => true,
            'model' => $model,
            'modelName' => $this->modelName,
        ]);
    }

    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer ? Yii::$app->request->referrer :['index']);
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        }
        if (method_exists($this->modelClass, 'findAdmin') && ($model = $this->modelClass::findAdmin()->where(['id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actions()
    {
        return [
            'connector' => [
                'class' => ConnectorAction::class,
                'options' => [
                    'bind' => [
                        'upload.presave' => [[$this, 'preload']]
                    ],
                    'disabledCommands' => ['netmount'],
                    'connectOptions' => [
                        'filter'
                    ],
                    'roots' => [
                        [
                            'driver' => 'LocalFileSystem',
                            'path' => Yii::getAlias('@webroot/static'),
                            'startPath'  => Yii::getAlias("@webroot/static/{$this->staticName}/"),
                            'URL' => '/static',
                            'uploadDeny' => [
                                'text/x-php', 'text/php', 'application/x-php', 'application/php'
                            ],
                        ],
                    ],
                ],
            ],
            'input' => [
                'class' => InputFileAction::class,
                'connectorRoute' => 'connector',
                'settings' => [
                    'lang' => 'ru',
                    'rememberLastDir' => $this->rememberLastDir,
                    'startPathHash' => Yii::$app->request->get('staticHash', null) ?? $this->staticHash,
                ],
                'separator' => ',',
                'textareaSeparator' => '\n', // newline character in javascript
            ],
        ];
    }

    /**
     * @return bool
     * @param $volume elFinder
     *
     */
    public function preload(&$path, &$name, $tmpname, $volume) {
        $name = md5($name.time()).'.png';
        // You can force refresh the elFinder view by returning a value `true`
        return true;
    }

    public function hashGen($string = null)
    {
        if(!isset($string)) {
            $string = $this->staticName;
        }

        $hash = base64_encode($string);
        $hash = preg_replace('/\+/', '-', $hash);
        $hash = preg_replace('/\//', '_', $hash);
        $hash = preg_replace('/=/', '.', $hash);
        $hash = preg_replace('/\.+$/', '', $hash);

        return 'l1_'.$hash;
    }
}
