<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html5>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BWH4F0H8B6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-BWH4F0H8B6');
    </script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(76759648, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/76759648" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body>

<div class="poup" id="popup-cart">
    <div class="poup-body">
                <span class="popupclose">
        <a class="clpop">&times;</a>
        </span>
        <div class="poup-body-text">

        </div>
        <div class="poup-body-footer">
        <a href="/cart" class="popuplink">Оформить заказ</a>
        <a class="popuplink clpop">Продолжить покупки</a>
        </div>
    </div>
</div>
<div class="poup" id="popup-favorite">
    <div class="poup-body">
                <span class="popupclose">
        <a class="clpop">&times;</a>
        </span>
        <div class="poup-body-text">

        </div>
        <div class="poup-body-footer">
        <a class="popuplink clpop">Продолжить покупки</a>
        </div>
    </div>
</div>
<div class="poup" id="popup-comparison">
    <div class="poup-body">
        <span class="popupclose">
        <a class="clpop">&times;</a>
        </span>
        <div class="poup-body-text">

        </div>
        <div class="poup-body-footer">
        <a class="popuplink clpop">Продолжить покупки</a>
        </div>
    </div>
</div>
<?php $this->beginBody() ?>

<?= $this->render('popup') ?>
<?= $this->render(
  'mobile-menu',
  [

  ]
) ?>

<?= $this->render('header') ?>

<div class="content-wrapper">
    <?//= Alert::widget() ?>
    <?php
    if (Yii::$app->request->pathInfo != '') {
        echo Breadcrumbs::widget(
          [
            'itemTemplate' => "<li>{link}</li><img src='/img/bread_sep.svg' alt=''>\n",
            'links'        => $this->params['breadcrumbs'],
            'options'      => ['class' => 'breadcrumb-count'],
            'homeLink'     => ['label' => 'Главная', 'url' => ['/']]
          ]
        );
        echo '<div class="content">';
        echo $content;
        echo '</div>';
    } else {
        echo $content;
    } ?>
</div>

<?= $this->render('footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
