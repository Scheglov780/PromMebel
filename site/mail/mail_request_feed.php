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
    <td><span class="style4"> &nbsp; Уважаемый <?= $model->name ?>, Ваше обращение принято. </span></td>
  </tr>
  <tr>
    <td>
      <p><?= $model->subj ?></p>
      <p><strong>Примечание:</strong><span class="mail-comment"><?= $model->comment ?: 'нет' ?></span></p>
    </td>
  </tr>
  <tr>
    <td><p><strong>Информация: </strong></p>
      <p><strong>Регион:</strong> Москва <br>
        <strong>Имя:</strong> Мск Белтема <br>
        <strong>Телефон:</strong> +74959793678 <br>
        <strong>Email:</strong> <a href="mailto:buh-m@erpribor.ru">buh-m@erpribor.ru </a><br>
        <strong>Компания:</strong> ООО "Радиомонтаж-Мск" <br>
        <strong>Адрес:</strong> Лианозовский проезд. д.6 <br>
  </tr>
  <tr>
    <td bgcolor="#ca1e1e"><br>
      &nbsp; <span class="style1"><span
            class="style2">Спасибо за покупку! С уважением, администрация интернет-магазина <?= Html::a(
                  'ПРОМЫШЛЕННАЯ-МЕБЕЛЬ.РУС',
                  Url::to('/'), ['class' => 'style21']
                ) ?>
    E-mail: <a href="mailto:zakaz@pmzakaz.ru" class="style21">zakaz@pmzakaz.ru</a></span><br><br>
    </span></td>
  </tr>
</table>