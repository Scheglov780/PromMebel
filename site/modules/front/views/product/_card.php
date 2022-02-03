<?php
/**
 * @var string                                         $href
 * @var string                                         $img
 * @var string                                         $name
 * @var string                                         $description
 * @var string                                         $price
 * @var string                                         $alt
 * @var \app\models\ar\Product|\app\models\ar\Category $product
 */
if (is_a($product, 'app\models\ar\Category')) {
    if ($product->price_from > 0) {
        $suffix = 'от ';
    } else {
        $suffix = '';
    }

} else {
    $suffix = '';
}

/*  if (method_exists($product,'getActualPrice') && $product->getActualPrice(true)>0) {
    $suffix = '3 от ';
} else {
    $suffix = '4 ';
} */

/* echo '<pre>';
\yii\helpers\VarDumper::dump($this,10,true);
echo '</pre>'; die; */
?>
<a href="<?= $href ?>"
   class="card card-main<?
   if (empty($context) || ($context != 'favorite')) {
       echo '"';
   } else {
       echo ' favorite-removable" id="favorite-id-' . $product->id . '"';
   }
   ?>>
    <div class=" card_item_wrap calculated-data-product">
<div class="card-img-cont">
    <? //if (isset($showExtActionsBlock) && $showExtActionsBlock) {
    if (isset($type) && in_array($type, ['product'])) {
        ?>
      <div class="comparisonblock">
          <? if (empty($context) || ($context != 'favorite')) { ?>
            <button class="star <?= $product->inFavorite ? ' icon-empty' : '' ?>"
                    data-product-id="<?= $product->id ?>" <?php
            /* alt="Добавить в избранное" - Пионеры, alt бывает только у img, area и input, чё его лупить куда
            не попадя в параксизмах SEO-иступления? */ ?>
                    title="<?= $product->inFavorite ? 'Товар уже в избранном' : 'Добавить в избранное' ?>"></button>
          <? } else { ?>
            <button class="delete-from-favorite" data-product-id="<?= $product->id ?>"
              <?php // alt="Удалить из избранного" ?>
                    title="Удалить из избранного"></button>
          <? } ?>
        <button class="comparisonbutton <?= $product->inComparison ? ' icon-empty' : '' ?>"
                data-product-id="<?= $product->id ?>" <?php // alt="Добавить в сравнение" ?>
                title="<?= $product->inComparison ? 'Товар уже в сравнении' : 'Добавить в сравнение' ?>"></button>
      </div>
    <? } ?>
  <img class="of-contain" src="<?= $img ?>" alt="<?= $alt ?>">
</div>
<div class="card-text-cont">
  <div class="card-title"><?= $name ?></div>
  <div class="card-text"><?= $description ?></div>
  <div class="card-price price"><?= $suffix ?><?= $price ?></div>
</div>
<? //if (isset($showExtActionsBlock) && $showExtActionsBlock) {
if (isset($type) && in_array($type, ['product'])) {
    ?>
  <div class="card_to_cart_block">
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
    <div class="in-cart-btn-cont">
      <div class="in-cart-btn btn btn-red" data-product-id="<?= $product->id ?>">
        В корзину
      </div>
        <?php
        /*  $currentUrl = Url::current();
          echo QuickOrderBlock::widget(
            [
              'debug'      => false,
              'label'      => Yii::t('app', 'Купить в один клик'),
              'asButton'   => true,
               'products' => Product::find()
                ->andWhere(['id' => $product->id]) //@array_keys($sessionProducts)
                ->indexBy('id')
                ->all(),
              'subj'       => "Быстрый заказ: {$product->name} (ID:{$product->id})",
              'comment'    => <<<MES
Здравствуйте. Я хочу приобрести <a href="{$currentUrl}">{$product->name} (ID:{$product->id})</a> и прошу связаться со мной.<br>
MES,
              'attachment' => json_encode(
                $product,
                JSON_INVALID_UTF8_IGNORE | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR |
                JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES
              )

            ]
          ); */ ?>
    </div>
  </div>
<? } ?>
<?
if (method_exists(get_class($product), 'getPropsVals')) {
    $propsVals = $product->getPropsVals();
    if (!empty($propsVals)) {
        ?>
      <div class="card_item_desc">
        <div class="data-block">
            <?/* foreach ($propsVals as $name => $propVal) {
                    if (!in_array($propVal['name'], ['Срок поставки', 'Срок поставки заказа', 'Доставка'])) {
                        continue;
                    }
                    if (empty($propVal['value_name'])) {
                        continue;
                    }
                    ?>
                  <div class="param-block df ai-fs jc-sb">
                    <div class="param-name"><?= $propVal['name'] ?></div>
                    <div class="dots"></div>
                    <div class="value"><?= $propVal['value'] ?><?= ($propVal['value_name'] ? '&nbsp;' . $propVal['value_name'] : '') ?></div>
                  </div>
                <? } */ ?>
            <? foreach ($propsVals as $name => $propVal) {
                if (in_array($propVal['name'], ['Срок поставки', 'Срок поставки заказа', 'Доставка'])) {
                    continue;
                }
                if (empty($propVal['value_name'])) {
                    continue;
                }
                ?>
              <div class="param-block df ai-fs jc-sb">
                <div class="param-name"><?= $propVal['name'] ?></div>
                <div class="dots"></div>
                <div class="value"><?= $propVal['value'] ?><?= ($propVal['value_name'] ?
                      '&nbsp;' . $propVal['value_name'] : '') ?></div>
              </div>
            <? } ?>
        </div>
      </div>
    <? }
} ?>
</div> <?php // Блин, потерянный кем-то див, но без него рвёт!  ?>
</a>
