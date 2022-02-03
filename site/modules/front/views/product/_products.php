<?php

/** @var \app\models\ar\Product[] $products */
?>
<? if (!empty($products && count($products))) { ?>
    <?php foreach ($products as $i => $product) {
        /** @var \app\models\ar\Product $product */
        ?>
        <? // echo "<pre>14</pre>"; ?>
        <?= $this->render('/product/_card', [
          'href'        => $product->link,
          'img'         => $product->mainImg,
          'name'        => $product->name,
          'description' => $product->description_short,
          'price'       => $product->actualPrice,
          'alt'         => $product->alt,
          'type'        => 'product',
          'product'     => $product,
          'context'     => (!empty($context) ? $context : null),
        ]); ?>
    <?php }; ?>
<?php } else { ?>
    <h2>Ничего не найдено, уточните условия поиска</h2>
<?php } ?>
