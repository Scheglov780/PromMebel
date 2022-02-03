<?php

/** @var $products \app\models\ar\Product[] */
/** @var $recommendedProducts \app\models\ar\Product[] */

/** @var $order \app\models\ar\Order */

use app\models\ar\Product;
use app\models\Utils;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\QuickOrderBlock;
use yii\helpers\Url;

$this->params['breadcrumbs'] = ['Сравнение товаров'];
?>
<div class="comparison-content">
    <?php if (empty($products) || count($products) <= 0) { ?>
        <div class="title">Список сравнения пуст!</div>
        <div class="content comparison-categories"></div>
        <?php
        $this->registerJs("$('.content.comparison-categories').load('/catalog');", \yii\web\View::POS_LOAD);
        ?>
    <?php } else { ?>
        <div class="title">Товары для сравнения</div>

        <div class="entity-cont df jc-sa comparison-entity">
            <div class="table table-comparison calculated-data-products comparison-empty-title">
                <div class="table-row head df ai-c jc-fs">
                    <?php //===============================================================?>
                    <?php foreach ($products as $product) { ?>
                        <div class="table-cell bordered comparison-cell-<?= $product->id ?>">
                            <div class="table">
                                <div class="table-row head calculated-data-product comparison-removable" id="comparison-id-<?= $product->id ?>">
                                    <div class="table-cell">
                                        <div class="table-row head">
                                            <div class="table-cell">
                                                <div class="img-contain comparison-img">
                                                    <img src="<?= $product->mainImg ?>" alt="<?= $product->name ?>">
                                                </div>
                                            </div>
                                            <div class="table-cell verticval-buttons-wrapper">
                                                <div class="delete-from-comparison"
                                                     data-product-id="<?= $product->id ?>">
                                                    <img src="/img/delete-button.svg" alt="">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="table-row head">
                                            <div class="table-cell">
                                                <a href="<?= $product->link ?>"
                                                   class="comparison-name"><?= $product->name ?></a>
                                                <div class="comparison-footer df ai-c jc-fs">
                                                    <div class="product-count-cont df">
                                                        <div class="minus df"><img src="/img/minus.svg" alt=""></div>
                                                        <div class="count">
                                                            <input type="number" min="1" max="65535" step="1"
                                                                   pattern="[0-9]+"
                                                                   value="<?= $product->count ?>"
                                                                   data-product-id="<?= $product->id ?>"
                                                                   data-product-price="<?= $product->getActualPrice
                                                                   (true) ?>"
                                                                   class="product-count"/>
                                                        </div>
                                                        <div class="plus df"><img src="/img/plus.svg" alt=""></div>
                                                    </div>
                                                    <div class="price"><?= app\models\Currency::priceWrapper(
                                                          $product->getActualPrice(true)
                                                        ) ?></div>
                                                </div>
                                                <div class="in-cart-btn-cont compars_tocart">
                                                    <div class="in-cart-btn btn btn-red"
                                                         data-product-id="<?= $product->id ?>"> В корзину
                                                    </div>
                                                    <?php
                                                    $currentUrl = Url::current();
                                                    $completeMessage=<<<COMM
Заказ <a class="product-name" href="{$currentUrl}">{$product->name}</a> успешно оформлен.</br>
Менеджер свяжется с Вами в ближайшее время.
COMM;

                                                    echo QuickOrderBlock::widget(
                                                      [
                                                        'debug'      => false,
                                                        'label'      => Yii::t('app', 'Купить в один клик'),
                                                        'asButton'   => true,
                                                        'products' => Product::find()
                                                            ->andWhere(['id' => $product->id]) //@array_keys($sessionProducts)
                                                            ->indexBy('id')
                                                            ->all(),
                                                        'subj'       => "Быстрый заказ: {$product->name} (ID:{$product->id})",
                                                          'completeMessage' => $completeMessage,
                                                        'comment'    => <<<MES
Здравствуйте. Я хочу приобрести <a href="{$currentUrl}">{$product->name} (ID:{$product->id})</a> и прошу связаться со мной.<br>
MES,
                                                       /* 'attachment' => json_encode(
                                                          $product,
                                                          JSON_INVALID_UTF8_IGNORE | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR |
                                                          JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES
                                                        ) */

                                                      ]
                                                    ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php //===============================================================?>
                <?php
                if (!empty($comparisons)) {
                    // print_r($comparisons); die;
                    foreach ($comparisons as $param => $values) {
                        ?>
                        <div class="table-row comparison-field df ai-c jc-fs">
                            <div class="table-cell comparison-field"><?= $param ?></div>
                        </div>
                        <div class="table-row comparison-val df ai-c jc-fs">
                            <?php
                            //@todo Тут пошел сдвиг параметров, надо разобраться потом - см запрос.
                            foreach ($products as $product) {
                                ?>
                                <div
                                class="table-cell comparison-val comparison-cell-<?= $product->id ?> <?= empty($values[$product->id]) ? 'val-empty' : '' ?>"><?php
                                if (!empty($values[$product->id])) {
                                    $textColor = Utils::genColorCodeFromText($values[$product->id], 0, 2);
                                    echo "<span class=\"dot\" style=\"background-color:{$textColor};\"></span>" . $values[$product->id];
                                } else {
                                    echo 'Нет данных';
                                }
                                ?></div><?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php //===============================================================?>
            </div>
        </div>
    <?php } ?>
</div>
