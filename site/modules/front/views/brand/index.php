<?php

/** @var $category \app\models\ar\Category */
/** @var $brand \app\models\ar\Brand */

/** @var $breadcrumbs array */

use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'] = $breadcrumbs;

?>
<? foreach ($data as [$brand, $categories]) { ?>
    <?php /* Начало блока описания бренда */ ?>
  <div class="brand-title"><a href="<?= Url::to(['/front/brand/view', 'slug' => $brand->slug]) ?>">Торговая марка <?=
          $brand->name ?></a></div>
  <div class="brand-cont df jc-fs">
      <?php if (!empty($brand->video)) { ?>
        <div class="video-cont">
          <iframe src="https://www.youtube.com/embed/<?= $brand->video ?>?autoplay=0&enablejsapi=1" frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
        </div>
      <?php } ?>

    <div class="text-cont">
      <div class="brand-description">
          <?= nl2br($brand->description) ?>
      </div>
      <div class="files-cont df jc-fs">
          <?php foreach ($brand->files as $file) { ?>
            <a class="file-cont df" href="/static/brand/<?= $file->name ?>" target="_blank">
              <img src="/img/pdf.svg" alt="">
              <div class="file-name"><?= $file->name ?></div>
            </a>
          <?php } ?>
      </div>
    </div>
  </div>
    <?php /* Конец блока описания бренда */ ?>

    <?php /* Начало блока категорий серий */ ?>
    <?php if (!empty($categories) && count($categories)) { ?>
    <div class="category-block">
      <div class="category-header df jc-fs">
        <div class="main-category-title">Популярные товары марки <?= $brand->name ?></div>

        <div class="category-line-menu-select">
        </div>
      </div>
        <?php /* <div class="category-description">
      <?= $cat->description ?>
  </div> */ ?>
      <div class="card-cont df jc-fs">
          <?php /* А в цикле выводим автономные категории, содержащие серии заданного бренда */ ?>
          <?php foreach ($categories as $cat) { ?>
              <?= $this->render('/product/_card', [
                'href'        => '#catanch+' . $cat->id,
                'img'         => $cat->getImgUrl(),
                'name'        => $cat->name,
                'description' => $cat->description_short,
                'price'       => \app\models\Currency::priceWrapper($cat->price_from),
                'alt'         => $cat->alt,
                'type'        => 'cat',
                'product'     => $cat,
              ]) ?>
          <?php } ?>
      </div>
    </div>
    <?php } ?>
    <?php /* Конец блока категорий серий */ ?>

    <?php // И далее в цикле выводим найденные ранее категории с сериями заданного бренда ?>
    <?php if (!empty($categories) && count($categories)) { ?>
        <?php foreach ($categories as $cat) { ?>
      <div class="category-block">
        <a name="catanch+<?= $cat->id ?>"></a>
        <div class="category-header df jc-fs">
          <div class="main-category-title">Серии товаров <?= $cat->name ?></div>

        </div>
        <div class="category-description">
            <?= $cat->description ?>
        </div>
        <div class="card-cont df jc-fs">
            <?php // Выводим продукты категории, соответствующие бренду ?>
            <?php foreach ($cat->products as $serie) { ?>
                <?= $this->render('/product/_card', [
                  'href'        => $serie->link,
                  'img'         => $serie->mainImg,
                  'name'        => $serie->name,
                  'description' => $serie->description_short,
                  'price'       => $serie->actualPrice,
                  'alt'         => $serie->alt,
                  'type'        => 'serie',
                  'product'     => $serie,
                    // 'showExtActionsBlock' => true,
                ]) ?>
            <?php } ?>
        </div>
      </div>
        <?php } ?>
    <?php } ?>
<?php } ?>
