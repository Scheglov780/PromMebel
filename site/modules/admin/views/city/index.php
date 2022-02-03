<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->controller->modelName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">
  <div class="box">
    <div class="box-header">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
          'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
          'layout'       => "{summary}{pager}\n{items}\n{pager}",
          'dataProvider' => $dataProvider,
          'filterModel'  => $searchModel,
          'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
              'attribute' => 'alias',
              'format'    => 'html',
              'value'     => function ($model) {
                  return Html::a($model->alias, Url::to(['city/update', 'id' => $model->id]));
              },
            ],
            'name',
            'name_pad_1',
            'name_pad_2',

            [
              'class'    => 'yii\grid\ActionColumn',
              'template' => "{update}\n{delete}",
            ],
          ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
  </div>
</div>
