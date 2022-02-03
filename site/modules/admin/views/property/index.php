<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Свойства товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

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
              'format'    => "html",
              'value'     => function ($model) {
                  return Html::a($model->name, \yii\helpers\Url::to(['property/update', 'id' => $model->id]));
              },
            ],
            'value_name',
            'type',
            [
              'attribute'      => 'order',
              //'contentOptions' => ['class' => 'text-right'],
              'format'         => ['integer'],
              'headerOptions'  => ['data-type' => 'number'],
            ],
            [
              'class'    => 'yii\grid\ActionColumn',
              'template' => "{update}\n{delete}",
                /*'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return !in_array($model->id, [1,4]);
                    }
                ]*/
            ],
          ],
        ]); ?>

    </div>
  </div>

</div>
