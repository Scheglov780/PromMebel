<?php

/** @var $products \app\models\ar\Product[] */

?>


<?php if(count($products) != 0) { ?>
    <div class="sub-cont-header">
        <div class="sub-cont-title">Так же рекомендуем</div>
        <div class="sub-cont-nav-arrows-cont"></div>
    </div>
    <div class="sub-cont-body" <?= count($products) > 2 ? 'id="recommend-slider"' : '' ?>>
        <?php foreach ($products as $k => $recomendedProduct) { ?>
            <div>
                <a href="/catalog/<?= $recomendedProduct->category->slug ?>/<?= $recomendedProduct->slug ?>" class="card card-recommend-side">
                    <div class="card-img-cont" style="background-image: url('/static/product/upl/<?= @$recomendedProduct->productImgs[0]->name ?>')"></div>
                    <div class="card-text-cont">
                        <div class="card-title"><?= $recomendedProduct->name ?></div>
					<div class="card-price"><?= $recomendedProduct->actualPrice ?></div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
<?php } ?>