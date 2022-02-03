<?php

use dosamigos\ckeditor\CKEditor;
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $form yii\widgets\ActiveForm */
/** @var $products app\models\ar\Product[] */
/** @var $model app\models\QuickOrderForm */

?>
<? if ($this->context->asButton) { ?>
    <div class="btn btn-red btn-quick-order"
         onclick="$('#btnRefreshCaptcha-<?= $this->context->id ?>').click(); showPopup('', 'quickOrderDialog-<?= $this->context->id ?>');">
        <?= $this->context->label ?>
    </div>
    <div class="poup" id="quickOrderDialog-<?= $this->context->id ?>">
        <div class="poup-body">
            <?php $form = ActiveForm::begin(
              [
                'id'                     => 'quickOrderForm-' . $this->context->id,
                  //'layout'=>'horizontal',
                  /*                    'options'                => [
                                          //'class'   => 'quick-order-form', // col-lg-11
                                          //'enctype' => 'multipart/form-data'
                                      ],
                  */
                'fieldConfig'            => [
                  'template' => "{label}\n{input}\n{hint}\n{error}",
                ],
                'enableAjaxValidation'   => false,
                'enableClientValidation' => true,
                'action'                 => Url::toRoute('/quickOrder'),
                'method'                 => 'POST',
                  //'htmlOptions' => array('class' => 'well'), // for inset effect
              ]
            ) ?>
            <div class="poup-body-header">
                <a class="popupclose clpop">&times;</a>
                <h2 class="formzag"><?= $this->context->label ?></h2>
            </div>
            <div class="poup-body-text quick-order-form">
              <input type="hidden" name="QuickOrderForm[completeMessage]" value="<?= htmlentities
              (
                $this->context->completeMessage
              ) ?>">
              <? if (!empty($products)) {
                foreach ($products as $i => $product ) {?>
                <div class="quick-order-form-subheader"><?= $product->name ?></div>
                <? }
                } ?>
                <?php
                if (!empty($products)) {
                    foreach ($products as $i => $product) { ?>
                      <input type="hidden"
                               id="qiuckorderformproducts-<?= $product->id ?>"
                               name="QuickOrderForm[products][<?= $product->id ?>]"
                               value="<?= $product->count? $product->count : 1 ?>"
                               data-product-id="<?= $product->id ?>"
                               data-product-price="<?= $product->getActualPrice(true) ?>"
                               data-product-mass="<?= @$product->propertyValue[3]->value ?>"
                               data-product-value="<?= @$product->propertyValue[2]->value ?>"/>
                    <?php }
                } ?>
                <?= $form->field($model, 'subj')->input('hidden', ['value' => $model->subj])->label(false); ?>
                <?= $form->field(
                  $model,
                  'name',
                  [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options'  => ['class' => 'form-group inline-form-group']
                  ]
                )->textInput(); ?>
                <?= $form->field(
                  $model,
                  'email',
                  [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options'  => ['class' => 'form-group inline-form-group']
                  ]
                )->input('email'); ?>
                <?= $form->field(
                  $model,
                  'phone',
                  [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options'  => ['class' => 'form-group inline-form-group']
                  ]
                )->input('tel'); ?>
                <?= $form->field(
                  $model,
                  'comment'
                //  ,['options'=>['style'=>'height:120px;']]
                )->widget(
                  CKEditor::className(),
                  [
                    'options'       => ['rows' => 3],
                    'preset'        => 'basic',
                    'clientOptions' => ['height' => 120]
                  ]
                )->label('Сообщение'); ?>
                <? /* =  $form->field($model, 'attachment')->input('hidden', ['[value' => $model->attachment])->label(
                  false
                ); */ ?>
                <? if (true || $this->context->useCaptcha) { ?>
                    <?= $form->field(
                      $model,
                      'verifyCode',
                      [
                        'template' => "{label}\n{input}\n{hint}\n{error}",
                        'options'  => ['class' => 'form-group inline-form-group-captcha']

                      ]
                    )->widget(
                      Captcha::className(),
                      [
                        'imageOptions'  => [
                          'class' => 'quick-order-form-captcha',
                          'id'    => 'btnRefreshCaptcha-' . $this->context->id
                        ],
                        'captchaAction' => '/front/product/captcha', // was good Url::toRoute('/site/captcha'),
                      ]
                    ) ?>
                <? } ?>
                <div class="form-group">
                    <p class="requestlabe">
                        Нажимая на кнопку &quot;отправить&quot; вы подтверждаете согласие на обработку персональных
                        данных в соответствии с <a href="#">политикой конфиденциальности</a>
                    </p>
                </div>
            </div>
            <div class="poup-body-footer">
                <div class="form-group">
                    <button type="submit" class="popuplink">Отправить</button>
                    <a class="popuplink clpop">Продолжить покупки</a>
                </div>
            </div>
            <? ActiveForm::end() ?>
        </div>
    </div>
<? } else {


} ?>
<?php if (!empty($alerts)) {
    $popupBodyText = '';
    foreach ($alerts as $class => $alert) {
        $popupBodyText = $popupBodyText . "<span class=\"$class\">
                  $alert
              </span>";
    }
    $popupBodyText = trim(json_encode($popupBodyText), '"');
    $this->registerJs(
      "showPopup('$popupBodyText', 'quick-order-popup-alert',true);",
      \yii\web\View::POS_READY,
      'quick-order-block-js-' . $this->context->id
    );
} ?>
<? /*
<div class="poup" id="popup-oneclick">
    <div class="poup-body">
        <span class="popupclose clpop">&times;</span>
        <div class="poup-body-text oneclick-form">
            <form>
                <p class="formzag">Купить в один клик</p>
                <input placeholder="Ваше имя">
                <input placeholder="Телефон*">
                <input placeholder="Email*">
                <textarea placeholder="Комментарий"></textarea>
                <p class="requestlabe">* обязательные для заполнения поля</p>
                <p class="requestlabe">Нажимая на кнопку отправить вы подтверждаете согласие на обработку персональных
                    данных в соответствии с <a href="#">политикой конфиденциальности</a></p>
                <button type="submit" class="popuplink">Отправить</button>
                <a class="popuplink clpop">Продолжить покупки</a>

            </form>
        </div>
    </div>
</div>
<?/*
<form>
	<span class="formclose">X</span>
	<p class="formzag">Выезд эксперта</p>
	<input placeholder="Ваше имя">
	<input placeholder="Телефон*">
	<input placeholder="Email*">
	<textarea placeholder="Комментарий"></textarea>
	<p class="requestlabe">* обязательные для заполнения поля</p>
	<p class="requestlabe">Нажимая на кнопку отправить вы подтверждаете согласие на обработку персональных данных в соответствии с <a href="#">политикой конфиденциальности</a></p>
	<button type="submit">Отправить</button>
</form>
*/ ?>
