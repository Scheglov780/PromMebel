<?php

/** @var $products \app\models\ar\Product[] */

?>

<?php foreach ($products as $product) { ?>
    <a href="<?= $product->getLink() ?>" class="table-row">
        <div>
            <div class="img-contain serach-img">
                <img src="<?= $product->mainImg ?>" alt="">
            </div>
        </div>
        <div style="flex-grow: 1;">
            <div class="cart-name"><?= $product->name ?></div>
            <div class="price">
                <?=$product->actualPrice ?>
            </div>
        </div>
    </a>
<?php } ?>
