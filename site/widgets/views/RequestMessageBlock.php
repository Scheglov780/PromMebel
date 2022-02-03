<?php

use dosamigos\ckeditor\CKEditor;
use yii\captcha\Captcha;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $form yii\widgets\ActiveForm */
/** @var $model app\models\RequestMessageForm */

?>
<? if ($this->context->asButton) { ?>
    <div class="btn btn-red btn-request-message"
         onclick="$('#btnRefreshCaptcha-<?= $this->context->id ?>').click(); showPopup('', 'requestMessageDialog-<?= $this->context->id ?>');">
        <?= $this->context->label ?>
    </div>
    <div class="poup" id="requestMessageDialog-<?= $this->context->id ?>">
        <div class="poup-body">
            <?php $form = ActiveForm::begin(
              [
                'id'                     => 'requestMessageForm-' . $this->context->id,
                  //'layout'=>'horizontal',
                  /*                    'options'                => [
                                          //'class'   => 'request-message-form', // col-lg-11
                                          //'enctype' => 'multipart/form-data'
                                      ],
                  */
                'fieldConfig'            => [
                  'template' => "{label}\n{input}\n{hint}\n{error}",
                ],
                'enableAjaxValidation'   => false,
                'enableClientValidation' => true,
                'action'                 => Url::toRoute('/requestMessage'),
                'method'                 => 'POST',
                  //'htmlOptions' => array('class' => 'well'), // for inset effect
              ]
            ) ?>
            <div class="poup-body-header">
                <a class="popupclose clpop">&times;</a>
                <h2 class="formzag"><?= $this->context->subj ?></h2>
            </div>
            <div class="poup-body-text request-message-form">
                <?= $form->field($model, 'subj')->input('hidden', ['value' => $model->subj])->label(false); ?>
                <?= $form->field(
                  $model,
                  'name',
                  [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options'  => ['class' => 'form-group inline-form-group'],
                  ]
                )->textInput(); ?>
                <?= $form->field(
                  $model,
                  'email',
                  [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options'  => ['class' => 'form-group inline-form-group'],
                  ]
                )->input('email'); ?>
                <?= $form->field(
                  $model,
                  'phone',
                  [
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'options'  => ['class' => 'form-group inline-form-group'],
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
                    'clientOptions' => ['height' => 120],
                  ]
                )->label('Сообщение'); ?>
                <? if (true || $this->context->useCaptcha) { ?>
                    <?= $form->field(
                      $model,
                      'verifyCode',
                      [
                        'template' => "{label}\n{input}\n{hint}\n{error}",
                        'options'  => ['class' => 'form-group inline-form-group-captcha'],

                      ]
                    )->widget(
                      Captcha::className(),
                      [
                        'imageOptions'  => [
                          'class' => 'request-message-form-captcha',
                          'id'    => 'btnRefreshCaptcha-' . $this->context->id,
                        ],
                        'captchaAction' => '/front/page/captcha', // was good Url::toRoute('/site/captcha'),
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
    ?>
    <div class="vform request-message-form">
        <?php $form = ActiveForm::begin(
          [
            'id'                     => 'requestMessageForm-' . $this->context->id,
              //'layout'=>'horizontal',
              /*                    'options'                => [
                                      //'class'   => 'request-message-form', // col-lg-11
                                      //'enctype' => 'multipart/form-data'
                                  ],
              */
            'fieldConfig'            => [
              'template' => "{label}\n{input}\n{hint}\n{error}",
            ],
            'enableAjaxValidation'   => false,
            'enableClientValidation' => true,
            'action'                 => Url::toRoute('/requestMessage'),
            'method'                 => 'POST',
              //'htmlOptions' => array('class' => 'well'), // for inset effect
          ]
        ) ?>
        <span class="formclose">&times;</span>
        <p class="formzag"><?= $this->context->subj ?></p>
        <input type="hidden" name="RequestMessageForm[completeMessage]" value="<?= htmlentities
        (
          $this->context->completeMessage
        ) ?>">
        <?= $form->field($model, 'subj')->input('hidden', ['value' => $model->subj])->label(false); ?>
        <?= $form->field(
          $model,
          'name',
          [
            'template' => "{label}\n{input}\n{hint}\n{error}",
              //'options'  => ['class' => 'form-group inline-form-group']
          ]
        )->textInput(['placeholder' => 'Ваше имя'])->label(false); ?>
        <?= $form->field(
          $model,
          'phone',
          [
            'template' => "{label}\n{input}\n{hint}\n{error}",
              //'options'  => ['class' => 'form-group inline-form-group']
          ]
        )->textInput(['placeholder' => 'Телефон'])->label(false); ?>
        <?= $form->field(
          $model,
          'email',
          [
            'template' => "{label}\n{input}\n{hint}\n{error}",
              //'options'  => ['class' => 'form-group inline-form-group']
          ]
        )->textInput(['placeholder' => 'Email'])->label(false); ?>
        <?= $form->field(
          $model,
          'comment',
          [
            'template' => "{label}\n{input}\n{hint}\n{error}",
              //'options'  => ['class' => 'form-group inline-form-group']
          ]
        )->textarea(['placeholder' => 'Комментарий'])->label(false); ?>
        <? if (true || $this->context->useCaptcha) { ?>
            <?= $form->field(
              $model,
              'verifyCode',
              [
                'template' => "{label}\n{input}\n{hint}\n{error}",
                'options'  => ['class' => 'form-group inline-form-group-captcha'],

              ]
            )->widget(
              Captcha::className(),
              [
                'imageOptions'  => [
                  'class' => 'request-message-form-captcha',
                  'id'    => 'btnRefreshCaptcha-' . $this->context->id,
                ],
                'captchaAction' => '/front/default/captcha', // was good Url::toRoute('/site/captcha'),
              ]
            ) ?>
        <? } ?>
        <div class="form-group">
            <p class="requestlabe">
                Нажимая на кнопку &quot;отправить&quot; вы подтверждаете согласие на обработку персональных
                данных в соответствии с <a href="#">политикой конфиденциальности</a>
            </p>
        </div>
        <div class="form-group">
            <button type="submit">Отправить</button>
        </div>
        <? ActiveForm::end() ?>
    </div>
    <?php
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
      "showPopup('$popupBodyText', 'request-message-popup-alert',true);",
      \yii\web\View::POS_READY,
      'request-message-block-js-' . $this->context->id
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
