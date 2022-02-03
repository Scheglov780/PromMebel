<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductPackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пакеты товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-packages-index">
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
                    return Html::a($model->name, \yii\helpers\Url::to(['product-packages/update', 'id' => $model->id]));
                }
            ],
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function($model) {
                    return \app\models\ar\ProductPackages::$typeNames[$model->type];
                }
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
