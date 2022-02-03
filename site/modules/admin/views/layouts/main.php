<?php

use app\assets\AdminAsset;
use app\assets\AdminLteAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AdminLteAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
AdminAsset::register($this);


$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('Админ | '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <?= $this->render(
        'left.php',
        ['directoryAsset' => $directoryAsset]
    )
    ?>

    <?= $this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    ) ?>

</div>

<?php $this->endBody() ?>
<style>
    .showit {
      background: rgba(34, 45, 50, 0.5);
      bottom: 58px;
      color: #ffffff;
      font-size: 20px;
      height: 40px;
      line-height: 0.8;
      padding: 10px 12px;
      position: fixed;
      right: 5px;
      text-align: center;
      width: 40px;
      z-index: 99;
    }

    .showit i {
      color: #ffffff;
    }

    .showit:hover {
      background: #222d32;
    }
</style>
<script>
    $(function () {
        if (jQuery.support.leadingWhitespace == false) {
            alert("Ваш браузер не поддерживает ряд необходимых \r\n для нормальной работы функций. \r\n Обновите его " +
                "до последней версии.");
        }
    });
    //setTimeout(updateAdminNews, 60000);
    //========================
    // Back To Top
    //========================
    $(function () {
        if ($('#backToTop').length) {
            var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#backToTop').addClass('showit');
                        $('#backToTop').show();
                    } else {
                        $('#backToTop').hide();
                        $('#backToTop').removeClass('showit');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#backToTop').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }
    });
</script>
</body>
</html>
<?php $this->endPage() ?>