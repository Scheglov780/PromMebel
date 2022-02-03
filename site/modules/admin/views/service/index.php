<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->controller->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

  <div class="box">
    <div class="box-header">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
              'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
              'layout'       => "{summary}{pager}\n{items}\n{pager}",
                'dataProvider' => $dataProvider,
                'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a($model->name, Url::to(['service/update', 'id' => $model->id]));
                        }
                    ],
                  [
                    'attribute' => 'description',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        if (!empty($model->description)) {
                            //return $model->description;
                            return \app\models\Utils::textSnippet($model->description,512);
                        } else {
                            return null;
                        }
                    },
                  ],
                  [
                    'label'     => 'Картинка',
                    'attribute' => 'img',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        if (!empty($model->img)) {
                            return '<div class="image-box large">' .
                              Html::img(Yii::getAlias('@service/' . $model->img),
                                [
                                  'class' => 'thmb-img large',
                                ]
                              ) . '</div>';
                        } else {
                            return null;
                        }
                    },
                  ],
                    'href',
                  [
                    'attribute'      => 'order',
                      //'contentOptions' => ['class' => 'text-right'],
                    'format'         => ['integer'],
                    'headerOptions'  => ['data-type' => 'number'],
                  ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => "{update}\n{delete}",
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
