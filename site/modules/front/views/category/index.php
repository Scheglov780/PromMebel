<?php

/** @var $category \app\models\ar\Category */

use app\models\ar\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var $breadcrumbs array */
/** @var $products \app\models\ar\Product[] */
/** @var $brands \app\models\ar\Brand[] */
/** @var $sizes array */

$this->params['breadcrumbs'] = $breadcrumbs;

?>

<div class="category-block">
    <div class="category-header df jc-fs">
        <h1 class="main-category-title"><?= $category->name ?></h1>
    </div>
    <? if (!empty($products && count($products))) { ?>
        <div class="f-pagec">
            <div class="mobile-filter-toggle">
                Фильтры
            </div>
            <div class="filter-block df ai-c jc-fs">
                <div class="filter-cont">
                    <select name="filter-size" data-param="size" id="filter-size" class="filter-input">
                        <option value="" selected>Размер</option>
                        <?php foreach ($sizes as $k => $size) { ?>
                            <option value="<?= $size ?>"><?= $size ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="filter-cont">
                    <select name="filter-price" data-param="sort" id="filter-price" class="filter-input">
                        <option value="" disabled selected>Цена</option>
                        <option value="-price">Убыванию</option>
                        <option value="price">Возрастанию</option>
                    </select>
                </div>
                <div class="filter-cont">
                    <select name="filter-delivery_type" data-param="delivery_type"
                                                 id="filter-delivery_type" class="filter-input">
                        <option value="" selected>Срок поставки
                        </option> <?php foreach (Product::$deliveryTypes as $k => $type) { ?>
                            <option value="<?= $k ?>"><?= $type ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="filter-cont">
                    <select name="filter-brand" data-param="brand" id="filter-brand" class="filter-input">
                        <option value="" selected>Бренд</option>
                        <?php foreach ($brands as $brand) { ?>
                            <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                        <?php } ?>
                    </select>
                </div>
				<!-- 	был фильтр по Производитель, аналогичный Бренд. Отличия - $manufacturers -->
                <?/* <div class="filter-cont">
                    <select name="filter-manufacturer" data-param="manufacturer" id="filter-manufacturer"
                            class="filter-input">
                        <option value="" selected>Производитель</option>
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                            <option value="<?= $manufacturer->id ?>"><?= $manufacturer->name ?></option>
                        <?php } ?>
                    </select>
                </div> */?>
                <!-- 	был фильтр по исполнению, аналогичный поставкам. Отличия - 		foreach (Product::$executions as $k => $type) 		И		<select name="filter-execution" data-param="execution" id="filter-execution" class="filter-input"> 	-->
            </div>
            <div class="pagec">
                Товаров на страницу:
                <?php foreach (array(30, 60, 90) as $i => $count) {
                    ?>
                    <span<?= (($count == $pages->pageSize || (empty($pages->pageSize) && $i === 0)) ? ' class="pagec_active"' : '') ?>><?= Html::a(
                          $count,
                          Url::current(['per-page' => $count])
                        ) ?></span>
                    <?
                } ?>
            </div>
        </div>
    <? } ?>
    <div class="category-description">
        <?= $category->description ?>
    </div>
    <div class="card-cont df jc-fs" id="products-cont">
        <?= $this->render(
          '/product/_products',
          [
            'products' => $products,
          ]
        ) ?>
        <? if (!empty($products && count($products))) { ?>
            <div class="bottom_pcount">
                <div class="pagec">
                    Товаров на страницу:
                    <?php foreach (array(30, 60, 90) as $i => $count) {
                        ?>
                        <span<?= (($count == $pages->pageSize || (empty($pages->pageSize) && $i === 0)) ? ' class="pagec_active"' : '') ?>><?= Html::a(
                              $count,
                              Url::current(['per-page' => $count])
                            ) ?></span>
                        <?
                    } ?>
                </div>
            </div>
        <? } ?>
        <div class="prod_pagination">
            <?= LinkPager::widget(
              [
                'pagination' => $pages,
                'options' => ['class' => 'pagination'],
                'registerLinkTags' => true,
              ]
            ); ?>
        </div>
    </div>

</div>
