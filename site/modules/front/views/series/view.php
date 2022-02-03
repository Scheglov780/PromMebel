<?php

/** @var $category \app\models\ar\Category */
/** @var $product \app\models\ar\Product */
/** @var $breadcrumbs array */

use app\models\Currency;$this->params['breadcrumbs'] = $breadcrumbs;
$this->params['breadcrumbs'][] = $product->name;

?>
<style>
  .grey-sep {
    width: 100%;
    margin-top: 40px;
    margin-bottom: 40px;
    height: 1px;
    background: #E1E1E1;
  }
</style>
<div class="title"><?= $product->name ?></div>
<div class="entity-cont df jc-sa">
    <div class="left-cont">
        <div class="slider-for">
            <?php foreach ($product->productImgs as $img) { ?>
                <div class="product-main-img img-contain">
                    <img data-lazy='/static/product/upl/<?= $img->name ?>' alt="">
                </div>
            <?php } ?>
            <?php if (!empty($product->video)) { ?>
                <div class="product-main-img img-contain">
                    <iframe class="productVideoEmbeded"
                            src="https://www.youtube.com/embed/<?= $product->video ?>?autoplay=0&enablejsapi=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            <?php } ?>
        </div>
        <? if (count($product->productImgs) + (int) (!empty($product->video)) > 1) { ?>
            <div class="slider-nav">
                <?php foreach ($product->productImgs as $img) { ?>
                    <div class="product-sub-img img-contain">
                        <img src='/static/product/upl/<?= $img->name ?>' alt="">
                    </div>
                <?php } ?>
                <?php if (!empty($product->video)) { ?>
                    <div class="product-sub-img img-contain">
                        <svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%">
                            <path class="ytp-large-play-button-bg"
                                  d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                  fill="#f00"></path>
                            <path d="M 45,24 27,14 27,34" fill="#fff"></path>
                        </svg>
                    </div>
                <?php } ?>
            </div>
        <? } ?>
    </div>
    <div class="main-cont">
        <div class="entity-description"><?= nl2br($product->description) ?></div>
        <!--        <div class="grey-sep"></div>-->
        <br>
        <div class="data-cont df ai-fs jc-sa">
            <div class="data-block">
                <div class="data-title">Технические характеристики:</div>
                <?php foreach ($product->propertyValue as $property) { ?>
                    <div class="param-block df ai-fs jc-sa">
                        <div class="param-name"><?= $property->property->name ?></div>
                        <div class="dots"></div>
                        <div class="value"><?= $property->value ?> <?= $property->property->value_name ?></div>
                    </div>
                <?php } ?>
            </div>

            <div class="data-block">
                <?php if (count($product->files) != 0) { ?>
                    <div class="data-title">Техническая документация:</div>
                    <div class="files-cont df jc-fs">
                        <?php foreach ($product->files as $file) { ?>
                            <a class="file-cont df" href="/static/product/<?= $file->name ?>" target="_blank">
                                <img src="/img/pdf.svg" alt="">
                                <div class="file-name"><?= $file->name ?></div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="data-cont table-cart calculated-data-products">
            <table class="series calculated-data-products">
                <thead>
                <tr>
                    <td>Наименование товара</td>
                    <td>Габаритные размеры, мм</td>
                    <td>Цена</td>
                    <td>Количество, шт</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($product->tables as $p) { ?>
                    <tr class="calculated-data-product">
                        <td><a  class="prod_table_link" href="<?= @$p->link ?>"><?= @$p->propertyValue[1]->value ?></a></td> 
                        <td><?= @$p->propertyValue[4]->value ?></td>
                        <td class="price"><?= $p->actualPrice ?></td>
                        <td>
                            <div class="product-count-cont df jc-fs" style="margin-left: 0;">
                                <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                                <div class="count">
                                    <input type="number" min="0" max="65535" step="1" pattern="[0-9]+"
                                           value="0" class="product-count main can-zero"
                                                          data-product-id="<?= $p->id ?>"
                                                          data-product-price="<?= $p->getActualPrice(true) ?>"
                                    />
                                </div>
                                <div class="plus df"><img src="/img/plus.svg" alt=""></div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" align="right">
                        <div class="series-foot-text">
                            Итого: <span class="sum-text total-sum-price calculated-data-products-total"><?=app\models\Currency::priceWrapper(0)
                                ?></span> <? //id="total-sum-price"?>
                        </div>
                        <div class="btn btn-red series-add-to-cart-btn"> <? //id="series-add-to-cart-btn"?>
                            В корзину
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="sub-cont recommend-side">
        <?= $this->render(
          '/product/_recommend_side',
          [
            'products' => $product->recommendedProducts
          ]
        ) ?>
    </div>
</div>

<div class="related-products-title">
    <?php if (count($product->relatedProducts) != 0) { ?> <span
            class="related-href ractive"> Дополнительное оснащение </span> <?php } ?>

    <?php if (isset($product->construct_link) && $product->construct_link != "") { ?>
        <?php if (count($product->relatedProducts) != 0) { ?>
        <?php } ?>
        <span class="constructor-href"> Конструктор рабочих мест  </span>
    <?php } ?>
</div>
<?php if (count($product->relatedProducts) != 0) { ?>
    <div class="related-cont">
        <?php foreach ($product->relatedProducts as $relatedProduct) {
            if ($relatedProduct->type === \app\models\ar\Product::TYPE_SERIES) {
                echo Yii::$app->controller->renderPartial(
                  '_related_serie',
                  [
                    'relatedSerie' => $relatedProduct
                  ]
                );
            } else {
                echo Yii::$app->controller->renderPartial(
                  '_related_product',
                  [
                    'relatedProduct' => $relatedProduct
                  ]
                );
            }
        } ?>
    </div>
<?php } ?>

<?php if (isset($product->construct_link) && $product->construct_link != "") { ?>
    <div class="constructor-cont <?= count($product->relatedProducts) == 0 ? ' active' : '' ?>">
        <p>Составьте Ваше рабочее место из готовых модулей различных серий мебели. Результат сохраните и отправьте Нашим
            специалистам для получения полной информации&nbsp;о ценах и сроках поставки на e-mail: <a
                    href="mailto:zakaz@pmzakaz.ru? subject=Прошу уточнить стоимость заказа?"
                    style="color: #CA1E1E; text-decoration: underline">zakaz@pmzakaz.ru</a>.</p>
        <iframe src="<?= $product->construct_link ?>" width="100%" height="700px" frameborder="0"></iframe>
    </div>
<?php } ?>

<div class="recommend-bottom">
    <?= $this->render(
      '/product/_recommend_bottom',
      [
        'products' => $product->recommendedProducts
      ]
    ) ?>
</div>

<?php
// функция productSliderInit перемещена в main.js дабы не плодить сущности сверх необходимого.
$this->registerJs(/** @lang JavaScript */ "productSliderInit('.slider-for','.slider-nav', true);", \yii\web\View::POS_LOAD) ?>


