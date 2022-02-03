<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">
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
        'filterModel' => $searchModel,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function($model) {
                    return Html::a($model->name, \yii\helpers\Url::to(['slider/update', 'id' => $model->id]));
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
                      Html::img(Yii::getAlias('@slider/' . $model->img),
                        [
                          'class' => 'thmb-img large',
                        ]
                      ) . '</div>';
                } else {
                    return null;
                }
            },
          ],
            'url',
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
