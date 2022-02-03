<?php

/** @var $products \app\models\ar\Product[] */
/** @var $recommendedProducts \app\models\ar\Product[] */

/** @var $order \app\models\ar\Order */

$this->params['breadcrumbs'] = ['Избранные товары'];
?>
<div class="favorite-content favorite-empty-title">
    <?php if (empty($products) || count($products) <= 0) { ?>
        <div class="title">Список избранных товаров пуст!</div>
        <div class="content favorite-categories"></div>
        <?php
        $this->registerJs("$('.content.favorite-categories').load('/catalog');", \yii\web\View::POS_LOAD);
        ?>
    <?php } else { ?>
        <div class="title">Список избранных товаров</div>
        <div class="category-block">
            <div class="card-cont df jc-fs" id="products-cont">
                <? // echo "<pre>6</pre>"; ?>
                <?= $this->render(
                  '/product/_products',
                  [
                    'products' => $products,
                    'context'  => 'favorite'
                  ]
                ) ?>
            </div>
            <div>
                <button class="btn-red clear-favorite">Очистить избранное</button>
            </div>
        </div>
    <?php } ?>
</div>
