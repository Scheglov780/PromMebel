<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->controller->modelName;
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
          <div class="manufacturer-index">
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
                    'filterModel'  => $searchModel,
                    'columns'      => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'id',
                      [
                        'attribute' => 'name',
                        'format'    => 'html',
                        'value'     => function ($model) {
                            return Html::a(
                              $model->name,
                              \yii\helpers\Url::to(['manufacturer/update', 'id' => $model->id])
                            );
                        },
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
                                return '<div class="image-box">' .
                                  Html::img(Yii::getAlias('@manufacturer/' . $model->img),
                                    [
                                      'class' => 'thmb-img',
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
                        // 'type',
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
                        'class' => 'yii\grid\ActionColumn',
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
          <div class="manufacturer-index">
              <?= $this->render('/params/_meta_form', [
                'model' => $param,
                'type'  => $this->context->staticName,
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
