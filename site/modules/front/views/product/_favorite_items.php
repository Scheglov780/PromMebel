<?php

/** @var array $favorites */

?>
<? if (empty($favorites) || count($favorites) < 1) { ?>
    <div class="title">Список избранных товаров пуст!</div>
<? } else { ?>
    <?php foreach ($favorites as $favorite) { ?>
        <div class="table-row calculated-data-product favorite-removable" id="favorite-popup-id-<?= $favorite['id'] ?>">
            <div class="table-cell">
                <div class="img-contain favorite-img">
                     <a href="<?= $favorite['href'] ?>" ><img src="<?= $favorite['img'] ?>" alt="<?= $favorite['name'] ?>"></a>
                </div>
            </div>
            <div class="table-cell" style="flex-grow: 1;">
                <a href="<?= $favorite['href'] ?>" class="favorite-name"><?= $favorite['name'] ?></a>
                <div class="favorite-footer df ai-c jc-fs">
                    <div class="product-count-cont df">
                        <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                        <div class="count">
                            <input type="number" min="1" max="65535" step="1" pattern="[0-9]+"
                                   value="<?= $favorite['count'] ?>"
                                   data-product-id="<?= $favorite['id'] ?>"
                                   data-product-price="<?= $favorite['price'] ?>"
                                   class="product-count"/>
                        </div>
                        <div class="plus df"><img src="/img/plus.svg" alt=""></div>
                    </div>
                    <div class="price"><?= app\models\Currency::priceWrapper($favorite['price']) ?></div>
                </div>
            </div>
            <div class="verticval-buttons-wrapper">
            <div class="delete-from-favorite" data-product-id="<?= $favorite['id'] ?>">
                <img src="/img/delete-button.svg" alt="">
            </div>
            <div class="to-cart-from-favorite" data-product-id="<?= $favorite['id'] ?>">
                <img src="/img/cart.svg" alt="">
            </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
