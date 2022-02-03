<?php

/** @var $category \app\models\ar\Category */
/** @var $breadcrumbs array */
/** @var $this \yii\web\View */

$this->params['breadcrumbs'] = $breadcrumbs;
?>
<?php
if (is_array($category)) {
    $categories = $category;
} else {
    $categories = [$category];
}
foreach ($categories as $i => $category) {
    ?>
    <div class="category-block">
        <div class="category-header df jc-fs">
            <h1 class="main-category-title"><?= $category->name ?></h1>
            <div class="category-line-menu-select">
                <?= $category->selectInput() ?>
            </div>
        </div>
        <div class="category-description">
            <?= $category->description ?>
        </div>
        <div class="card-cont df jc-fs">
            <?php foreach ($category->childs as $child) { ?>
                <?php if (count($child->childs) == 0) {
                    $href = '/catalog/' . $child->slug;
                } else {
                    $href = '#catanch+' . $child->id;
                } ?>
                <? // echo "<pre>7</pre>"; ?>
                <?= $this->render(
                  '/product/_card',
                  [
                    'href'        => $href,
                    'img'         => $child->getImgUrl(),
                    'name'        => $child->name,
                    'description' => $child->description_short,
                    'price'       => \app\models\Currency::priceWrapper($child->price_from),
                    'alt'         => $child->alt,
                    'type'        => 'child',
                    'product'     => $child,
                  ]
                );
            } ?>
        </div>
    </div>

    <?php foreach ($category->childs as $cat) {
        if (count($cat->childs) == 0) {
            continue;
        }
        ?>
        <div class="category-block">
            <a name="catanch+<?= $cat->id ?>"></a>
            <div class="category-header df jc-fs">
                <div class="main-category-title"><?= $cat->name ?></div>

                <div class="category-line-menu-select">
                    <?= $cat->selectInput() ?>
                </div>
            </div>
            <div class="category-description">
                <?= $cat->description ?>
            </div>
            <div class="card-cont df jc-fs">
                <?php foreach ($cat->childs as $child) { ?>
                    <?= $this->render(
                      '/product/_card',
                      [
                        'href'        => "/catalog/" . $child->slug,
                        'img'         => $child->getImgUrl(),
                        'name'        => $child->name,
                        'description' => $child->description_short,
                        'price'       => \app\models\Currency::priceWrapper($child->price_from),
                        'alt'         => $child->alt,
                        'type'        => 'child',
                        'product'     => $child,
                      ]
                    ) ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>