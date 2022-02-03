<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\grid\CheckboxColumn;
use app\models\ar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $param \app\models\ar\Params */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_list" data-toggle="tab">Список</a></li>
        <li><a href="#tab_settings" data-toggle="tab">Настройки</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_list">
          <div class="product-index">
            <div class="box">
              <div class="box-header">
                  <?= Html::a('Добавление товара', ['create'], ['class' => 'btn btn-success']) ?>
              </div>
              <div class="box-body">

                  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                  <?= GridView::widget([
                    'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
                    'layout'       => "{summary}{pager}\n{items}\n{pager}",
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel,
                    'columns'      => [
                        /*
                          `price_gbp` float DEFAULT NULL,
                          `price_eur` float DEFAULT NULL,

                          `delivery_type` int(11) DEFAULT NULL,
                          `execution` int(11) DEFAULT NULL,
                          `construct_link` varchar(255) DEFAULT NULL,
                          */
                      ['class' => 'yii\grid\SerialColumn'],
                      'id',
                      [
                        'attribute' => 'name',
                        'format'    => 'html',
                        'value'     =>
                        /**
                         * @param \app\models\ar\Product $model
                         * @return string
                         */
                          function ($model) {
                              return Html::a(
                                $model->name,
                                \yii\helpers\Url::to(['product/update', 'id' => $model->id])
                              );
                          },
                      ],
                        //'slug',
                     /* [
                        'attribute' => 'type',
                        'label'     => 'Серия',
                        'format'    => 'raw',
                        'value'     => function ($data) {
                            return Html::checkbox(
                              "type[{$data->id}]",
                              $data->type == 1,
                              [
                                'value'   => $data->type,
                                  //'disabled'=>'disabled',
                                'onclick' => 'return false;',
                              ]
                            );
                        },
                      ], */
                      [
                        'attribute' => 'category_id',
                        'format'    => 'raw',
                        'filter'    => ArrayHelper::map(ar\Category::getCategoriesWithoutChild(),
                        'id', 'name'),

                        'value'     =>
                        /**
                         * @param \app\models\ar\Product $model
                         * @return string
                         */
                          function ($model) {
                              if (!isset($model->category)) {
                                  return 'Нет';
                              }
                              return Html::a(
                                $model->category->name,
                                \yii\helpers\Url::to(['category/update', 'id' => $model->category_id])
                              );
                          },
                      ],
                      [
                        'attribute' => 'brand_id',
                        'format'    => 'raw',
                          'filter'    => ArrayHelper::map(ar\Brand::find()->orderBy('order,name')->all(),'id','name'),
                        'value'     =>
                        /**
                         * @param \app\models\ar\Product $model
                         * @return string
                         */
                          function ($model) {
                              if (!isset($model->brand)) {
                                  return 'Нет';
                              }
                              return Html::a(
                                $model->brand->name,
                                \yii\helpers\Url::to(['brand/update', 'id' => $model->brand_id])
                              );
                          },
                      ],
                      [
                        'attribute' => 'manufacturer_id',
                        'format'    => 'raw',
                        'filter'    => ArrayHelper::map(ar\Manufacturer::find()->orderBy('order,name')->all(),'id','name'),
                        'value'     =>
                        /**
                         * @param \app\models\ar\Product $model
                         * @return string
                         */
                          function ($model) {
                              if (!isset($model->manufacturer)) {
                                  return 'Нет';
                              }
                              return Html::a(
                                $model->manufacturer->name,
                                \yii\helpers\Url::to(['manufacturer/update', 'id' => $model->manufacturer_id])
                              );
                          },
                      ],
                      [
                        'label'  => 'Картинка',
                        'format' => 'raw',
                        'value'  =>
                        /**
                         * @param \app\models\ar\Product $model
                         * @return string
                         */
                          function ($model) {
                              if (isset($model->productImgs) && !empty($model->productImgs[0]->name)) {
                                  //return Yii::getAlias('@product/upl/' . @$model->productImgs[0]->name);
                                  return '<div class="image-box">' . Html::img(
                                      Yii::getAlias('@product/upl/' . @$model->productImgs[0]->name),
                                      [
                                        'class' => 'thmb-img',
                                          //'width'=>'50','height'=>'50',
                                          //'data-toggle'=>'tooltip',
                                      ]
                                    ) . '</div>';
                              } else {
                                  return null;
                              }
                          },
                      ],
                      [
                        'attribute' => 'video',
                        'label'     => 'Видео',
                        'format'    => 'raw',
                        'value'     => function ($data) {
                            return Html::checkbox(
                              "video[{$data->id}]",
                              !empty($data->video),
                              [
                                'value'   => !empty($data->video),
                                  //'disabled'=>'disabled',
                                'onclick' => 'return false;',
                              ]
                            );
                        },
                      ],
                      [
                        'attribute'      => 'price',
                        'contentOptions' => ['class' => 'text-right'],
                        'format'         => ['decimal',0],
                        'headerOptions'  => ['data-type' => 'number'],
                        'value'          =>
                        /**
                         * @param \app\models\ar\Product $model
                         * @return string
                         */
                          function ($model) {
                              return $model->getActualPrice(true);
                          },
                      ],
                      [
                        'label'          => 'meta',
                        'format'         => 'raw',
                        'contentOptions' => ['class' => 'cell-with-tooltip',],
                        'value'          => function ($data) {
                            $result = [];
                            $props = [
                              'meta_title'        => 'title',
                              'meta_description'  => 'descr',
                              'meta_keywords'     => 'keywords',
                              'alt'               => 'alt',
                              'description_short' => 'short',
                              'short_description' => 'short',
                            ];
                            foreach ($props as $prop => $name) {
                                if (!empty($data->$prop)) {
                                    $result[] = Html::a($name, null, [
                                      'data-toggle'    => 'tooltip',
                                      'data-placement' => 'left', // top, bottom, left, right
                                      'data-container' => 'body', // to prevent breaking table on hover
                                      'title'          => $data->$prop,
                                    ]);
                                }
                            }
                            return implode('<br>', $result);
                        },
                      ],
                      [
                        'attribute' => 'status',
                        'label'     => 'Вкл',
                        'format'    => 'raw',
                        'filter'    => ['0' => 'Нет', '1' => 'Да'],
                        'value'     => function ($data) {
                            return Html::checkbox(
                              "status[{$data->id}]",
                              $data->status == 1,
                              [
                                'value'   => $data->status,
                                  //'disabled'=>'disabled',
                                'onclick' => 'return false;',
                              ]
                            );
                        },
                      ],
                      [
                        'attribute' => 'created_at',
                          //'label'=>'Создано',
                        'format'    => ['date', 'YYYY.MM.dd HH:mm'], // Доступные модификаторы - date:datetime:time
                      ],
                      [
                        'class'    => 'yii\grid\ActionColumn',
                        'template' => "{update}\n{delete}",
                      ],
                    ],
                  ]); ?>

              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_settings">
          <div class="product-index">

              <?= $this->render('/params/_meta_form', [
                'model' => $param,
                'type'  => 'product',
                'name'  => $this->context->modelName,
              ]) ?>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<?php
$js = <<<SCRIPT
/* To initialize BS3 tooltips set this below */
$(function () {
$('body').tooltip({
selector: '[data-toggle="tooltip"]',
// html:true
});
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js, \yii\web\View::POS_LOAD);
?>
