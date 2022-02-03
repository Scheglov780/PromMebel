<?php

use app\models\ar\Order;
use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Order */
/* @var $products app\models\ar\Product[] */

$this->title = "Заказ №" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="box-title">
            Общая информация о заказе
          </div>
        </div>
        <div class="box-body">

            <?= DetailView::widget(
              [
                'model' => $model,
                'attributes' => [
                  'id',
                  [
                    'attribute' => 'sum',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return app\models\Currency::priceWrapper($model->sum);
                    },
                  ],
                  'company_name',
                  'name',
                  'email:email',
                  'phone',
                  'region',
                  [
                    'attribute' => 'delivery_type',
                    'value'     => function ($model) {
                        return @Order::$delivery[$model->delivery_type];
                    },
                  ],
                  'address',
                  'comment:ntext',
                  [
                    'attribute' => 'data',
                    'format'    => 'html',
                    'value'     => function ($model) {
                        $a = '';
                        if (isset($model->data) && $model->data != 'null') {
                            $data = \yii\helpers\Json::decode($model->data);
                            foreach ($data as $k => $row) {
                                $a .= Order::$datas[$k] . '<br>';
                            }
                        }
                        return $a;
                    },
                  ],
                  [
                    'attribute' => 'file_name',
                    'format'    => 'raw',
                    'value'     => function ($model) {
                        return '<a download target="_blank" href="' . Yii::getAlias(
                            '@web/static/orders/' . $model->file_name
                          ) . '" >Реквизиты</a>';
                    },
                  ],
                ],
              ]
            ) ?>

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="box-title">
            Товары заказа
          </div>
        </div>
        <div class="box-body">
          <table class="table table-striped table-bordered">
            <thead>
            <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Цена</th>
              <th>Колличество</th>
              <th>Изображение</th>
              <th>Категория</th>
              <th>Бренд</th>
              <th>Производитель</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) { ?>
              <tr data-key="<?= $product->id ?>">
                <td><?= $product->id ?></td>
                <td><?= Html::a(
                      $product->name,
                      \yii\helpers\Url::to(['product/update', 'id' => $product->id])
                    ) ?></td>
                <td><?= $product->getActualPrice(true) ?></td>
                <td><?= $product->count ?></td>
                <td><?php

                    if (isset($product->productImgs) && !empty($product->productImgs[0]->name)) {
                        /*
                          echo Html::img(
                  Yii::getAlias(
                    '@product/' . $product->slug . '/' . @$product->productImgs[0]->name
                  ),
                  ['class' => 'thmb-img']
                );
                         */
                        echo '<div class="image-box">' . Html::img(
                            Yii::getAlias('@product/upl/' . @$product->productImgs[0]->name),
                            [
                              'class' => 'thmb-img',
                                //'width'=>'50','height'=>'50',
                                //'data-toggle'=>'tooltip',
                            ]
                          ) . '</div>';
                    }
                    ?></td>
                <td><?= Html::a(
                      $product->category->name,
                      \yii\helpers\Url::to(['category/update', 'id' => $product->category_id])
                    ) ?></td>
                <td><?= Html::a(
                      $product->brand->name,
                      \yii\helpers\Url::to(['brand/update', 'id' => $product->brand_id])
                    ) ?></td>
                <td><?= Html::a(
                      $product->manufacturer->name,
                      \yii\helpers\Url::to(
                        ['manufacturer/update', 'id' => $product->manufacturer_id]
                      )
                    ) ?></td>
              </tr>
            <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
