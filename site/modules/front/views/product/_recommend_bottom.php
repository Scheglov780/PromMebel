<?php

/** @var $products \app\models\ar\Product[] */

?>

<?php if(count($products) != 0) { ?>
    <div class="sub-cont-header">
        <div class="sub-cont-title">Так же рекомендуем</div>
        <div class="sub-cont-nav-arrows-cont"></div>
    </div>
    <div class="sub-cont-body">
        <?php foreach ($products as $recomendedProduct) { ?>
            <a href="/catalog/<?= $recomendedProduct->category->slug ?>/<?= $recomendedProduct->slug ?>" class="card card-recommend-bottom">
                <div class="card-img-cont" style="background-image: url('/static/product/upl/<?= @$recomendedProduct->productImgs[0]->name ?>')"></div>
                <div class="card-text-cont">
                    <div class="card-title"><?= $recomendedProduct->name ?></div>
					<div class="card-price"><?= $recomendedProduct->actualPrice ?></div>
                </div>
            </a>
        <?php } ?>
    </div>
<?php } ?>
