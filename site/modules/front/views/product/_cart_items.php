<?php

/** @var $products array */

?>
<? if (empty($products) || count($products) < 1) { ?>
    <div class="title">Ваша корзина пуста!</div>
<? } else { ?>
    <?php foreach ($products as $product) { ?>
        <div class="table-row calculated-data-product cart-removable" id="cart-popup-id-<?= $product['id'] ?>">
            <div class="table-cell">
                <div class="img-contain cart-img">
                    <img src="<?= $product['img'] ?>" alt="<?=$product['name']?>">
                </div>
            </div>
            <div class="table-cell" style="flex-grow: 1;">
                <a href="<?= $product['href'] ?>" class="cart-name"><?= $product['name'] ?></a>
                <div class="cart-footer df ai-c jc-fs">
                    <div class="product-count-cont df">
                        <div class="minus df is_cart<?=$isPopup?' is-popup':''?>"><img src="/img/minus.svg" alt=""></div>
                        <div class="count">
                            <input type="number" min="1" max="65535" step="1" pattern="[0-9]+"
                                   value="<?= $product['count'] ?>"
                                   data-product-id="<?= $product['id'] ?>"
                                   data-product-price="<?= $product['price'] ?>"
                                   class="product-count"/>
                        </div>
                        <div class="plus df is_cart <?=$isPopup?' is-popup':''?>"><img src="/img/plus.svg" alt=""></div>
                    </div>
                    <div class="price"><?= app\models\Currency::priceWrapper
                        ($product['price']) ?></div>
                </div>
            </div>
            <div class="delete-from-cart" data-product-id="<?= $product['id'] ?>">
                <img src="/img/delete-button.svg" alt="">
            </div>
        </div>
    <?php } ?>
<?php } ?>