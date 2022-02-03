<?php
use yii\helpers\Url;
use yii\helpers\Html;
/** @var  yii\swiftmailer\Message $message */
/** @var  \app\models\RequestMessageForm $model */
?>
<table width="100%" border="0">
  <tr>
    <td bgcolor="#ca1e1e"><br>
      &nbsp; <span class="style1"><span
            class="style2">Новое обращение в интернет магазин <?= Html::a(
                  'ПРОМЫШЛЕННАЯ-МЕБЕЛЬ.РУС',
                  Url::to('/'), ['class' => 'style21']
                ) ?></span><br><br>
    </span></td>
  </tr>
  <tr>
    <td><span class="style1"><br><strong>Цель обращения:</strong> <?= $model->subj ?></span></td>
  </tr>
  <tr>
    <td><p><strong>Информация о клиенте: </strong></p>
      <strong>Имя:</strong> <?= $model->name ?> <br>
      <strong>Телефон:</strong> <?= $model->phone ?> <br>
      <strong>Email:</strong> <a href="mailto:<?= $model->email ?>"> <?= $model->email ?> </a><br>
      <strong>Примечание:</strong><span class="mail-comment"><?= $model->comment ?: 'нет' ?></span></p></td>
  </tr>
  <tr>
    <td bgcolor="#ca1e1e"><br>
      &nbsp; <span class="style1"><span class="style2">Администрация интернет-магазина <?= Html::a(
                  'ПРОМЫШЛЕННАЯ-МЕБЕЛЬ.РУС',
                  Url::to('/'), ['class' => 'style21']
                ) ?>
    E-mail: <a href="mailto:zakaz@pmzakaz.ru" class="style21">zakaz@pmzakaz.ru</a></span><br><br>
    </span></td>
  </tr>
</table>
