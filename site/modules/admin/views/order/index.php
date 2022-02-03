<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
  <div class="box">
    <?/* <div class="box-header">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </div> */?>
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
                    'company_name',
                    'name',
                    'email',
                    'phone',
                    [
                        'attribute' => 'sum',
                        'format' => 'raw',
                        'value' => function($model) {
                            return app\models\Currency::priceWrapper($model->sum);
                        },
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}'
                    ],
                ],
            ]); ?>
        </div>
    </div>



</div>
