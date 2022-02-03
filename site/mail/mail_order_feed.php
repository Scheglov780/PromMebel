<?php
use yii\helpers\Url;
use yii\helpers\Html;

/** @var $products \app\models\ar\Product[] */
/** @var $order \app\models\ar\Order */
?>
<table width="100%" border="0">
  <tr>
    <td bgcolor="#ca1e1e"><br>
      &nbsp; <span class="style1"><span
            class="style2">Новый заказ в интернет магазине <?= Html::a(
                  'ПРОМЫШЛЕННАЯ-МЕБЕЛЬ.РУС',
                  Url::to('/'), ['class' => 'style21']
                ) ?></span><br><br>
    </span></td>
  </tr>
  <tr>
    <td><span class="style4"> &nbsp; Уважаемый <?= $order->name ?>, Ваш заказ принят. </span></td>
  </tr>
  <tr>
    <td><span class="style1"><br>&nbsp; Состав заказа: </span></td>
  </tr>
  <tr>
    <td>
      <table cellpadding="4" border="">
        <tr>
          <td width="36">Фото</td>
          <td width="488">Наименование</td>
          <td width="57">Цена</td>
          <td width="88">Количество</td>
          <td width="68">Всего</td>
        </tr>
          <? foreach ($products as $i => $product) { ?>
            <tr>
                <?php
                /** @var  yii\swiftmailer\Message $message */
                ?>
              <td><a href="<?= $product->link ?>"><img width="75px"
                                                       src="<?= \app\models\Utils::getEmbeddedImage(
                                                         $product->mainImg,
                                                         75
                                                       ) ?>" alt=""></a>
              </td>
              <td><a href="<?= $product->link ?>"><?= $product->name ?></a></td>
              <td><?= $product->actualPrice ?></td>
              <td>
                <div align="center"><?= $counts[$product->id] ?></div>
              </td>
              <td><?= \app\models\Currency::priceWrapper($product->getSumm($counts[$product->id])) ?></td>
            </tr>
          <? } ?>
      </table>
      <strong>Итого: <?= \app\models\Currency::priceWrapper($order->sum) ?></strong></td>
  </tr>
  <tr>
    <td><p><strong>Информация о заказе: </strong></p>
      <p><strong>Регион:</strong> Москва <br>
        <strong>Имя:</strong> Мск Белтема <br>
        <strong>Телефон:</strong> +74959793678 <br>
        <strong>Email:</strong> <a href="mailto:buh-m@erpribor.ru">buh-m@erpribor.ru </a><br>
        <strong>Компания:</strong> ООО "Радиомонтаж-Мск" <br>
        <strong>Адрес:</strong> Лианозовский проезд. д.6 <br>
        <strong>Доставка:</strong> <?= $order->delivery_type_text ?> <br>
        <strong>Пожелания к заказу:</strong> <?= $order->dataText ?: 'нет' ?><br>
        <strong>Примечание:</strong><span class="mail-comment"><?= $order->comment ?: 'нет' ?></span></p></td>
  </tr>
  <tr>
    <td bgcolor="#ca1e1e"><br>
      &nbsp; <span class="style1">
            <span class="style2">Спасибо за покупку! С уважением, администрация интернет-магазина <?= Html::a(
                  'ПРОМЫШЛЕННАЯ-МЕБЕЛЬ.РУС',
                  Url::to('/'), ['class' => 'style21']
                ) ?>
    E-mail: <a href="mailto:zakaz@pmzakaz.ru" class="style21">zakaz@pmzakaz.ru</a></span><br><br>
    </span></td>
  </tr>
</table>