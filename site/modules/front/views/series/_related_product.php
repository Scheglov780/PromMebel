<?php

use app\widgets\QuickOrderBlock;
use yii\helpers\Url;
use \app\models\ar\Product;

/** @var $relatedProduct \app\models\ar\Product */

?>
<div class="entity-cont df jc-sa">
  <div class="left-cont">
    <div class="sub-product-img">
      <div class="product-main-img img-contain">
        <img src='/static/product/upl/<?= @$relatedProduct->productImgs[0]->name ?>' alt="">
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
                 value="1"
                 class="product-count"/>
        </div>
        <div class="plus df"><img src="/img/plus.svg" alt=""></div>
      </div>
      <div class="in-cart-btn-cont">
        <div class="in-cart-btn btn btn-red" data-product-id="<?= $relatedProduct->id; ?>">
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
<div class="sub-cont">
</div>
<? // Лишний, ненужный неконвенционный div - см выше ?>
</div>

