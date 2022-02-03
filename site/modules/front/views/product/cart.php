<?php

/** @var $products \app\models\ar\Product[] */
/** @var $recommendedProducts \app\models\ar\Product[] */

/** @var $order \app\models\ar\Order */

use app\models\ar\Order;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/** @var $sum string */
/** @var $mass string */
/** @var $value string */

$this->params['breadcrumbs'] = ['Корзина'];
?>
<div class="cart-content">
    <? if (empty($products) || count($products) <= 0) { ?>
        <div class="title">Ваша корзина пуста!</div>
        <div class="content cart-categories"></div>
        <?php
        $this->registerJs("$('.content.cart-categories').load('/catalog');", \yii\web\View::POS_LOAD);
        ?>
    <? } else { ?>
        <div class="title">Оформление заказа</div>

        <div class="entity-cont df jc-sa cart-entity">

            <?php
            /** @var app\models\ar\Order $order */
            $form = ActiveForm::begin(
              [
                'id'                     => 'print-content',
                'fieldConfig'            => [
                  'template' => "{label}\n{input}\n{hint}\n{error}",
                ],
                'enableAjaxValidation'   => false,
                'enableClientValidation' => true,
                  //'action'                 => Url::toRoute('/cart'),
                  //'method'                 => 'POST',
                  /* 'options' => [
                                'id' => 'print-content'
                        ] */
              ]
            ); ?>
            <div class="cart-header df ai-c jc-fs">
                <div class="sub-title">Товары для заказа</div>
                <a class="item df cart-link" href="/cart/pdf" target="_blank" id="save-order-btn"><img
                            src="/img/save.svg"
                            alt="">Сохранить PDF</a>
                <!--<div class="item df" onClick="javascript:CallPrint('print-content');" ><img src="/img/print.svg" alt="">Распечатать</div>-->
                <a class="item df cart-link" href="/cart/print" target="_blank" id="print-order-btn"><img
                            src="/img/print.svg"
                            alt="">Распечатать</a>
            </div>

            <div class="table-cart calculated-data-products cart-empty-title">

                <div class="table-row head df ai-c jc-fs">
                    <div class="table-cell">Фото</div>
                    <div class="table-cell name">Наименование товара</div>
                    <div class="table-cell count">Кол-во, шт.</div>
                    <div class="table-cell main-price">Цена, с НДС</div>
                    <div class="table-cell value">Объем упаковки, м3</div>
                    <div class="table-cell value">Масса, кг</div>
                    <div class="table-cell sum-price">Общая стоимость</div>
                    <div class="table-cell action"></div>
                </div>
                <?php foreach ($products as $product) { ?>
                    <div class="cart-row df ai-c jc-fs calculated-data-product cart-removable" id="cart-id-<?= $product->id ?>">
                        <div class="table-cell photo">
                            <div class="img-contain">
                                <img src="<?= $product->mainImg ?>" alt="">
                            </div>
                        </div>
                        <div class="table-cell name">
                            <a class="cart-name" href="<?= $product->link ?>"><?= $product->name ?></a>
                        </div>
                        <div class="table-cell count">
                            <div class="product-count-cont df" style="margin-left: 0;">
                                <div class="minus df is_cart" data-price="<?= $product->getActualPrice(true) ?>"><img
                                            src="/img/minus.svg"
                                            alt=""></div>
                                <div class="count">
                                    <input type="number" min="1" max="65535" step="1" pattern="[0-9]+"
                                           name="Order[products][<?= $product->id ?>]"
                                           value="<?= $product->count ?>" class="product-count main"
                                           data-product-id="<?= $product->id ?>"
                                           data-product-price="<?= $product->getActualPrice(true) ?>"
                                           data-product-mass="<?= @$product->propertyValue[3]->value ?>"
                                           data-product-value="<?= @$product->propertyValue[2]->value ?>"/>
                                </div>
                                <div class="plus df is_cart" data-price="<?= $product->getActualPrice(true) ?>"><img
                                            src="/img/plus.svg"
                                            alt=""></div>
                            </div>
                        </div>
                        <div class="table-cell main-price"><?= $product->actualPrice ?></div>
                        <div class="table-cell value"><?= @$product->propertyValue[3]->value ?></div>
                        <div class="table-cell value"><?= @$product->propertyValue[2]->value ?></div>
                        <div class="table-cell sum-price price">
                            <?= app\models\Currency::priceWrapper($product->getActualPrice(true) * $product->count) ?>
                        </div>
                        <div class="table-cell action">
                            <div class="delete-from-cart" data-product-id="<?= $product->id ?>"><img
                                        src="/img/delete-button.svg" alt=""></div>
                        </div>
                    </div>
                <?php } ?>

                <div class="cart-row df ai-c jc-fs sum-row last-row" style="border: none;">
                    <div class="table-cell" style="width: 140px;"></div>
                    <div class="table-cell name"></div>
                    <div class="table-cell count"></div>
                    <div class="table-cell main-price">Итого:</div>
                    <div class="table-cell value sum-mass" style="font-weight: bold;"><?= round($mass, 2) ?></div>
                    <div class="table-cell value sum-value" style="font-weight: bold;"><?= round($value, 2) ?></div>
                    <? /* Было id="total-sum-price" */ ?>
                    <div class="table-cell sum-price total-sum-price calculated-data-products-total" data-sum-price="<?= $sum
                    ?>">
                        <?= app\models\Currency::priceWrapper($sum) ?>
                    </div>
                    <div class="table-cell action"></div>
                </div>
            </div>
            <div class="cart-form-block">
                <div class="cart-header df ai-c jc-fs">
                    <div class="sub-title">Оформление заказа</div>
                </div>
                <div class="df ai-c jc-sb cart-from-input" style="margin-bottom: 16px;">
                    <?= $form->field(
                      $order,
                      'company_name',
                      ['options' => ['class' => 'form-group inline-form-group cart-field']]
                    )->textInput(
                      [
                        'maxlength'   => true,
                        'placeholder' => 'Наименование компании'
                      ]
                    )->label(false) ?>
                    <?= $form->field(
                      $order,
                      'name',
                      ['options' => ['class' => 'form-group inline-form-group cart-field']]
                    )->textInput(
                      [
                        'maxlength'   => true,
                        'placeholder' => 'Контактное лицо'
                      ]
                    )->label(false) ?>
                    <?= $form->field(
                      $order,
                      'email',
                      ['options' => ['class' => 'form-group inline-form-group cart-field']]
                    )->textInput(
                      [
                        'maxlength'   => true,
                        'placeholder' => 'Ваш e-mail'
                      ]
                    )->label(false) ?>
                    <?= $form->field(
                      $order,
                      'phone',
                      ['options' => ['class' => 'form-group inline-form-group cart-field']]
                    )
                      ->textInput(
                        [
                          'maxlength'   => true,
                          'placeholder' => 'Телефон'
                        ]
                      )
                      ->label(false) ?>
                    <!-- --><? /*= $form->field($order, 'region')->textInput(['maxlength' => true, 'class' => '', 'placeholder' => 'Регион заказа'])->label(false) */ ?>
                </div>
                <?= $form->field($order, 'file_name')->fileInput()->label(
                  "<img src='/img/attach_file.svg'/>Прикрепить реквизиты",
                  ['class' => 'mb-24']
                ) ?>
                <div class="mini-title">Ваши пожелания к заказу:</div>
                <div class="cart-checkbox-cont df ai-c jc-fs">
                    <?php foreach (Order::$datas as $key => $d) { ?>
                        <div class="check-cont"><input type="checkbox" name=Order[data][<?= $key ?>]"
                                                       id="check-<?= $key ?>"><label
                                    for="check-<?= $key ?>" class="df"><span class="custom-checkbox"></span><?= $d ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>

                <div class="cart-header df ai-c jc-fs">
                    <div class="sub-title">Способ доставки</div>
                </div>
                <div class="df ai-c jc-sb cart-from-input">
                    <select name="Order[delivery_type]">
                        <?php foreach (Order::$delivery as $k => $n) { ?>
                            <option value="<?= $k ?>" <?= $k == 1 ? ' selected="selected"' : ''; ?>><?= $n ?></option>
                        <?php } ?>
                    </select>
                    <?= $form->field(
                      $order,
                      'address',
                      ['options' => ['class' => 'form-group inline-form-group cart-field']]
                    )->textInput(
                      [
                        'maxlength'   => true,
                        'placeholder' => 'Адрес доставки'
                      ]
                    )->label(false) ?>
                    <?= $form->field(
                      $order,
                      'comment',
                      ['options' => ['class' => 'form-group inline-form-group cart-field']]
                    )->textInput(
                      [
                        'maxlength'   => true,
                        'placeholder' => 'Примечания'
                      ]
                    )->label(false) ?>
                </div>

                <!--    --><? /*= Html :: hiddenInput(\Yii::$app->getRequest()->csrfParam, \Yii::$app->getRequest()->getCsrfToken(), []) */ ?>
                <div class="df ai-c jc-sb cart-from-input">
                    <?= $form->field(
                      $order,
                      'verifyCode',
                      [
                        'template' => "{label}\n{input}\n{hint}\n{error}",
                        'options'  => ['class' => 'form-group inline-form-group-captcha cart-field-captcha']
                      ]
                    )->widget(
                      Captcha::className(),
                      [
                              'options' => [
                                  'maxlength'   => true,
                                  'placeholder' => 'Код проверки'
                              ],
                        'imageOptions'  => [
                          'class' => 'cart-field-captcha-image',
                        ],
                        'captchaAction' => '/front/product/captcha', // was good Url::toRoute('/site/captcha'),
                      ]
                    )->label(false); ?>
                    <div class="form-group inline-form-group">
                        <?= Html::submitButton('Оформить заказ', ['class' => 'btn-red inline-form-submit-btn']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?php if (count($recommendedProducts)) { ?>
                <div class="sub-cont recommend-side cart">
                    <?= $this->render(
                      '_recommend_side',
                      [
                        'products' => $recommendedProducts
                      ]
                    ) ?>
                </div>
            <?php } ?>

        </div
    <?php } ?>
</div>
