<?php

/** @var $relatedSerie \app\models\ar\Product */

?>
<div class="entity-cont df jc-sa">
    <div class="left-cont">
        <div class="slider-for">
            <?php foreach ($relatedSerie->productImgs as $img) { ?>
                <div class="product-main-img img-contain">
                    <img src='/static/product/upl/<?= $img->name ?>' alt="">
                </div>
            <?php } ?>
        </div>
        <? if (count($relatedSerie->productImgs) + (int) (!empty($relatedSerie->video)) > 1) { ?>
        <div class="slider-nav">
            <?php foreach ($relatedSerie->productImgs as $img) { ?>
                <div class="product-sub-img img-contain">
                    <img src='/static/product/upl/<?= $img->name ?>' alt="">
                </div>
            <?php } ?>
        </div>
        <? } ?>
    </div>
    <div class="main-cont">
        <div class="sub-title"><?= $relatedSerie->name ?></div>
        <div class="entity-description"><?= nl2br($relatedSerie->description) ?></div>
        <!--        <div class="grey-sep"></div>-->
        <br>
        <div class="data-cont df ai-fs jc-sa">
            <div class="data-block">
                <div class="data-title">Технические характеристики:</div>
                <?php foreach ($relatedSerie->propertyValue as $property) { ?>
                    <div class="param-block df ai-fs jc-sa">
                        <div class="param-name"><?= $property->property->name ?></div>
                        <div class="dots"></div>
                        <div class="value"><?= $property->value ?> <?= $property->property->value_name ?></div>
                    </div>
                <?php } ?>
            </div>

            <div class="data-block">
                <?php if (count($relatedSerie->files) != 0) { ?>
                    <div class="data-title">Техническая документация:</div>
                    <div class="files-cont df jc-fs">
                        <?php foreach ($relatedSerie->files as $file) { ?>
                            <a class="file-cont df" href="/static/product/<?= $file->name ?>" target="_blank">
                                <img src="/img/pdf.svg" alt="">
                                <div class="file-name"><?= $file->name ?></div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="data-cont table-cart calculated-data-products">
            <table class="series calculated-data-products">
                <thead>
                <tr>
                    <td>Наименование товара</td>
                    <td>Габаритные размеры, мм</td>
                    <td>Цена</td>
                    <td>Количество, шт</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($relatedSerie->tables as $p) { ?>
                    <tr class="calculated-data-product">
                        <td><a class="prod_table_link" href="<?= @$p->link ?>"><?= @$p->propertyValue[1]->value ?></a></td>
						
                        <td><?= @$p->propertyValue[4]->value ?></td>
                        <td class="price"><?= $p->actualPrice ?></td>
                        <td>
                            <div class="product-count-cont df jc-fs" style="margin-left: 0;">
                                <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                                <div class="count">
                                    <input type="number" min="0" max="65535" step="1" pattern="[0-9]+"
                                           value="0" class="product-count main can-zero"
                                                          data-product-id="<?= $p->id ?>"
                                                          data-product-price="<?= $p->getActualPrice(true) ?>"
                                    />
                                </div>
                                <div class="plus df"><img src="/img/plus.svg" alt=""></div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" align="right">
                        <div class="series-foot-text">
                            Итого: <span class="sum-text total-sum-price
                            calculated-data-products-total"><?=app\models\Currency::priceWrapper(0)?></span>
                            <?//id="total-sum-price"?>
                        </div>
                        <div class="btn btn-red series-add-to-cart-btn"> <?//id="series-add-to-cart-btn"?>
                            В корзину
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

