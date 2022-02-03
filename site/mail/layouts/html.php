<?php

use yii\helpers\Html;
use yii\BaseYii;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
$charset = Yii::$app->charset;
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?= strtoupper($charset) ?>"/>
  <title><?= \app\models\Utils::purifyMetaText($this->title) ?></title>
  <style type="text/css">
    .style1 {
      font-family: Arial, Helvetica, sans-serif
    }

    .style2 {
      color: #FFFFFF;
      font-weight: bold;
    }

    .style21 {
      color: #FFFFFF;
      font-weight: bold;
      text-decoration: underline;
    }

    .style4 {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      font-weight: bold;
    }

    .mail-comment p {
      background-color: rgba(0, 0, 0, 0.075);
      padding: 15px;
    }
  </style>
  <script type="text/javascript"
          src="https://gc.kis.scr.kaspersky-labs.com/0EA2ED02-47A9-0D4A-A204-195B8E497F11/main.js"
          charset="UTF-8"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
