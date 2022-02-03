<?php

use app\widgets\QuickOrderBlock;
use \app\models\ar\Product;
use yii\helpers\Url;

/** @var $category \app\models\ar\Category */
/** @var $product \app\models\ar\Product */
/** @var $breadcrumbs array */

$this->params['breadcrumbs'] = $breadcrumbs;

$properties = $product->propertyValue;
\yii\helpers\ArrayHelper::multisort($properties, 'property.order');

?>

<h1 class="title"><?= $product->name ?></h1>
<div class="entity-cont df jc-sa">
  <div class="left-cont">
    <div class="comparisonblock" style="display: block; z-index: 12;">
      <button class="star <?= $product->inFavorite ? ' icon-empty' : '' ?>" data-product-id="<?= $product->id ?>"
              alt="Добавить в избранное"
              title="<?= $product->inFavorite ? 'Товар уже в избранном' : 'Добавить в избранное' ?>"></button>
      <button class="comparisonbutton <?= $product->inComparison ? ' icon-empty' : '' ?>"
              data-product-id="<?= $product->id ?>" alt="Добавить в сравнение"
              title="<?= $product->inComparison ? 'Товар уже в сравнении' : 'Добавить в сравнение' ?>"></button>
    </div>
    <div class="slider-for">
        <?php foreach ($product->productImgs as $img) { ?>
          <div class="product-main-img img-contain">
            <img data-lazy='/static/product/upl/<?= $img->name ?>' alt="<?= $product->name ?>">
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
                <img src='/static/product/upl/<?= $img->name ?>' title="<?= $product->name ?>"
                     alt="<?= $product->name ?>" style="cursor: pointer;">
              </div>
            <?php } ?>
            <?php if (!empty($product->video)) { ?>
              <div class="product-sub-img img-contain">
                <img src='/web/img/youtube_logo.png' title="Смотрите видео <?= $product->name ?>"
                     alt="Смотрите видео <?= $product->name ?>" style="padding: 0 22%; cursor: pointer;">
              </div>
            <?php } ?>
        </div>
      <? } ?>
  </div>
  <div class="main-cont">
    <div class="entity-description"><?= nl2br($product->description) ?></div>

    <div class="data-cont df ai-fs jc-sa">
      <div class="data-block">

        <div class="price-cont calculated-data-product df jc-fs">
          <div class="price"><?= $product->actualPrice ?></div>
          <div class="in-cart-btn-cont">
            <div class="cart_place_btn">
              <div class="product-count-cont df">
                <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                <div class="count">
                  <input type="number" min="1" max="65535" step="1" pattern="[0-9]+"
                         data-product-id="<?= $product->id ?>"
                         data-product-price="<?= $product->getActualPrice(true) ?>"
                         value="1"
                         class="product-count"/>
                </div>
                <div class="plus df"><img src="/img/plus.svg" alt=""></div>
              </div>
              <div class="in-cart-btn btn btn-red" data-product-id="<?= $product->id ?>">
                В корзину
              </div>
            </div>

              <?php
              $currentUrl = Url::current();
              $completeMessage = <<<COMM
Заказ <a class="product-name" href="{$currentUrl}">{$product->name}</a> успешно оформлен.</br>
Менеджер свяжется с Вами в ближайшее время.
COMM;
              echo QuickOrderBlock::widget(
                [
                  'debug'           => false,
                  'label'           => Yii::t('app', 'Купить в один клик'),
                  'asButton'        => true,
                  'products'        => Product::find()
                    ->andWhere(['id' => $product->id]) //@array_keys($sessionProducts)
                    ->indexBy('id')
                    ->all(),
                  'subj'            => "Быстрый заказ: {$product->name} (ID:{$product->id})",
                  'completeMessage' => $completeMessage,
                  'comment'         => <<<MES
Здравствуйте. Я хочу приобрести <a href="{$currentUrl}">{$product->name} (ID:{$product->id})</a> и прошу связаться со мной.<br>
MES,
                    /* 'attachment' => json_encode(
                      $product,
                      JSON_INVALID_UTF8_IGNORE | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR |
                      JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES
                    ) */

                ]
              ); ?>
          </div>
        </div>
          <?
          if (method_exists(get_class($product), 'getPropsVals')) {
              $propsVals = $product->getPropsVals();
              if (!empty($propsVals)) {
                  ?>
                <div class="data-title">Технические характеристики:</div>
                  <? foreach ($propsVals as $name => $propVal) {
                      if (in_array($propVal['name'], ['Срок поставки', 'Срок поставки заказа', 'Доставка'])) {
                          continue;
                      }
                      if (empty($propVal['value'])) {
                          continue;
                      }
                      ?>
                  <div class="param-block df ai-fs jc-sa">
                    <div class="param-name"><?= $propVal['name'] ?></div>
                    <div class="dots"></div>
                    <div class="value"><?= $propVal['value'] ?><?= ($propVal['value_name'] ?
                          '&nbsp;' . $propVal['value_name'] : '') ?></div>
                  </div>
                  <? } ?>
              <? }
          } ?>
      </div>

      <div class="data-block">
        <div class="deliv_descr">
            <?
            $srok = null;
            if (!empty($propsVals['Срок поставки'])) {
                $srok = $propsVals['Срок поставки']['value'];
            } else {
                if (!empty($propsVals['Срок поставки заказа'])) {
                    $srok = $propsVals['Срок поставки заказа']['value'];
                }
            }
            ?>
          <p class="srok"><span>Срок поставки</span></p>
          <p><?= (!empty($srok)) ? $srok : 'Уточняйте у менеджера' ?></p>
          <p class="dostav"><span>Доставка</span></p>
          <p><?= (!empty($propsVals['Доставка'])) ? $propsVals['Доставка']['value'] : 'Уточняйте у менеджера' ?></p>
        </div>
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
  </div>
  <div class="sub-cont recommend-side">
      <?= $this->render(
        '_recommend_side',
        [
          'products' => $product->recommendedProducts,
        ]
      ) ?>
  </div>
</div>

<div class="related-products-title">
    <?php if (count($product->relatedProducts) != 0) { ?> <span
        class="related-href ractive"> Дополнительное оснащение </span> <?php } ?>

    <?php if (isset($product->construct_link) && $product->construct_link != '') { ?><?php if (count(
        $product->relatedProducts
      ) != 0) { ?><?php } ?> <span class="constructor-href"> Конструктор рабочих мест  </span><?php } ?>
</div>
<?php if (count($product->relatedProducts) != 0) { ?>
  <div class="related-cont">
      <?php foreach ($product->relatedProducts as $relatedProduct) { ?>
        <div class="entity-cont df jc-sa">
          <div class="left-cont">
            <div class="sub-product-img">
              <div class="product-main-img img-contain">
                <img src='/static/product/upl/<?= @$relatedProduct->productImgs[0]->name ?>'
                     alt="<?= $relatedProduct->name ?>">
              </div>
            </div>
          </div>
          <div class="main-cont calculated-data-product">
            <div class="sub-title"><?= $relatedProduct->name ?></div>
            <div class="entity-description"><?= nl2br($relatedProduct->description) ?></div>
            <div class="price-cont df jc-fs">
              <div class="price"><?= $relatedProduct->actualPrice ?></div>
              <div class="product-count-cont df">
                <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                <div class="count">
                  <input type="number" min="1" max="65535" step="1" pattern="[0-9]+"
                         data-product-id="<?= $relatedProduct->id ?>"
                         data-product-price="<?= $relatedProduct->getActualPrice(true) ?>"
                         value="1" class="product-count"/>
                </div>
                <div class="plus df"><img src="/img/plus.svg" alt=""></div>
              </div>
              <div class="in-cart-btn-cont">
                <div class="in-cart-btn btn btn-red" data-product-id="<?= $relatedProduct->id ?>">
                  В корзину
                </div>
                  <?php
                  $currentUrl = Url::current();
                  $completeMessage = <<<COMM
Заказ <a class="product-name" href="{$currentUrl}">{$relatedProduct->name}</a> успешно оформлен.</br>
Менеджер свяжется с Вами в ближайшее время.
COMM;
                  echo QuickOrderBlock::widget(
                    [
                      'debug'           => false,
                      'label'           => Yii::t('app', 'Купить в один клик'),
                      'asButton'        => true,
                      'products'        => Product::find()
                        ->andWhere(['id' => $relatedProduct->id]) //@array_keys($sessionProducts)
                        ->indexBy('id')
                        ->all(),
                      'subj'            => "Быстрый заказ: {$relatedProduct->name} (ID:{$relatedProduct->id})",
                      'completeMessage' => $completeMessage,
                      'comment'         => <<<MES
Здравствуйте. Я хочу приобрести <a href="{$currentUrl}">{$relatedProduct->name} (ID:{$relatedProduct->id})</a> и прошу связаться со мной.<br>
MES,
                        /* 'attachment' => json_encode(
                          $relatedProduct,
                          JSON_INVALID_UTF8_IGNORE | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR |
                          JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES
                        ) */

                    ]
                  ); ?>
              </div>
            </div>
            <div class="data-cont df ai-fs jc-sa">
              <div class="data-block">
                <div class="data-title">Технические характеристики:</div>
                  <?php foreach ($relatedProduct->propertyValue as $property) { ?>
                    <div class="param-block df ai-fs jc-sa">
                      <div class="param-name"><?= $property->property->name ?></div>
                      <div class="dots"></div>
                      <div class="value"><?= $property->value ?> <?= $property->property->value_name ?></div>
                    </div>
                  <?php } ?>
              </div>

              <div class="data-block">
                  <?php if (count($relatedProduct->files) != 0) { ?>
                    <div class="data-title">Техническая документация:</div>
                    <div class="files-cont df jc-fs">
                        <?php foreach ($relatedProduct->files as $file) { ?>
                          <a class="file-cont df" href="/static/product/<?= $file->name ?>"
                             target="_blank">
                            <img src="/img/pdf.svg" alt="">
                            <div class="file-name"><?= $file->name ?></div>
                          </a>
                        <?php } ?>
                    </div>
                  <?php } ?>
              </div>
            </div>
          </div>
          <div class="sub-cont">
          </div>
        </div>
      <?php } ?>
  </div>
<?php } ?>
<?php if (isset($product->construct_link) && $product->construct_link != '') { ?>
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
      '_recommend_bottom',
      [
        'products' => $product->recommendedProducts,
      ]
    ) ?>
</div>
<?php
// функция productSliderInit перемещена в main.js дабы не плодить сущности сверх необходимого.
$this->registerJs(
/** @lang JavaScript */ "productSliderInit('.slider-for','.slider-nav', true);",
  \yii\web\View::POS_LOAD
);
?>



