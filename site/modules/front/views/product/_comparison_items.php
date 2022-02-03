<?php

/** @var array $comparisons */

?>
<? if (empty($comparisons) || count($comparisons) < 1) { ?>
    <div class="title">Список сравнения пуст!</div>
<? } else { ?>
    <?php foreach ($comparisons as $comparison) { ?>
        <div class="table-row calculated-data-product comparison-removable" id="comparison-popup-id-<?= $comparison['id'] ?>">
            <div class="table-cell">
                <div class="img-contain comparison-img">
                     <a href="<?= $comparison['href'] ?>" ><img src="<?= $comparison['img'] ?>" alt="<?= $comparison['name'] ?>"></a>
                </div>
            </div>
            <div class="table-cell" style="flex-grow: 1;">
                <a href="<?= $comparison['href'] ?>" class="comparison-name"><?= $comparison['name'] ?></a>
                <div class="comparison-footer df ai-c jc-fs">
                    <div class="product-count-cont df">
                        <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                        <div class="count">
                            <input type="number" min="1" max="65535" step="1" pattern="[0-9]+"
                                   data-product-id="<?= $comparison['id'] ?>"
                                   data-product-price="<?= $comparison['price'] ?>"
                                   value="<?= $comparison['count'] ?>"
                                   class="product-count"/>
                        </div>
                        <div class="plus df"><img src="/img/plus.svg" alt=""></div>
                    </div>
                    <div class="price"><?= app\models\Currency::priceWrapper($comparison['price']) ?></div>
                </div>
            </div>
            <div class="verticval-buttons-wrapper">
            <div class="delete-from-comparison" data-product-id="<?= $comparison['id'] ?>">
                <img src="/img/delete-button.svg" alt="">
            </div>
            <div class="to-cart-from-comparison" data-product-id="<?= $comparison['id'] ?>">
                <img src="/img/cart.svg" alt="">
            </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
