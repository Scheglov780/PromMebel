<?php
/** @var $products \app\models\ar\Product[] */

$f = [

  'order-company_name' => 'Наименование компании',

  'order-name' => 'Контактное лицо',

  'order-email' => 'Email',

  'order-phone' => 'Телефон',

  'order-address' => 'Адресс',

  'order-comment' => 'Комментарий',

];
?>
<div class="print-body">
    <div class="logo-block">
        <div class="logo-cont">
            <img src="/img/logo.svg" alt="" class="logo">
            <img src="/img/logo_text.svg" alt="" class="logo-text">
        </div>
        <div class="logo-contacts">
            тел. 8 800 000 00 00<br>
            email: zakaz@pmzakaz.ru<br>

        </div>
    </div>
    <hr/>
    <div class="cart-body">
        <div class="print-left">
            <?= date('Y-m-d H:i') ?>
        </div>
        <div class="print-center">
            <h1>Коммерческое предложение</h1>
        </div>
        <form id="print-content" action="/cart" method="post">
            <table class="table-cart-print" border="1">
                <thead>
                <tr>
                    <? /* <td class="cart-print-photo">Фото</td> */ ?>
                    <td class="cart-print-n">№</td>
                    <td class="cart-print-name">Наименование товара</td>
                    <td class="cart-print-count">Кол-во</td>
                    <td class="cart-print-main-price">Цена</td>
                    <td class="cart-print-volume">Объем</sup></td>
                    <td class="cart-print-weight">Масса</td>
                    <td class="cart-print-sum-price">Стоимость</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($products as $product) {
                    $i = $i + 1;
                    ?>
                    <tr>
                        <? /* <td class="cart-print-photo">
                            <img width="200px" src="<?= $product->mainImg ?>" alt="">
                        </td> */ ?>
                        <td class="cart-print-n"><?= $i ?>.</td>
                        <td class="cart-print-name">
                            <a href="<?= $product->link ?>"><?= $product->name ?></a>
                        </td>
                        <td class="cart-print-count">
                            <?= $product->count ?> шт.
                        </td>
                        <td class="cart-print-main-price"><?= $product->getActualPrice(true) ?>руб
                        </td>
                        <td class="cart-print-volume"><?= @$product->propertyValue[3]->value ?>
                            м<sup>3</td>
                        <td class="cart-print-weight"><?= @$product->propertyValue[2]->value ?>кг
                        </td>
                        <td class="cart-print-sum-price">
                            <?= $product->getActualPrice(true) * $product->count ?> руб
                        </td>
                    </tr>
                <?php } ?>

                <tr>
                    <td class="cart-print-total" colspan="6">Итого:</td>
                    <td class="cart-print-sum-price">
                        <?= $sum ?> руб
                    </td>
                </tr>

                </tbody>
            </table>

            <p>* Наличие товара на складе или срок его изготовления необходимо уточнить у Нашего
                менеджера.</p>
            <p>** Бесплатная доставка до терминала транспортной компании и отправка в Ваш адрес.
                Стоимость дальнейшей
                доставки рассчитывается отдельно и может быть включена в сумму заказа.</p>
            <p>*** Оплата может осуществляется путём перечисления денежных средств на Наш расчётный
                счёт. Для оплаты
                необходимо запросить счёт по телефону или электронной почте.</p>
            <? if (preg_match('/(?:^|,)order-.+(?:,|$)/ism', implode(',', array_keys($f)))) { ?>
                <h2>Данные покупателя:</h2>
                <table class="table-cart-print2" border="1">
                    <tbody>
                    <?php foreach ($fields as $name => $value) {
                        if (!array_key_exists($name, $f)) {
                            continue;
                        }
                        ?>
                        <tr>
                            <td class="print-left" width="auto"><?= $f[$name] ?></td>
                            <td class="print-left"><?= trim($value) ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
                <div class="cart-checkbox-cont"> <?= in_array(
                      'check-view',
                      $checks
                    ) ? '<div class="check-cont"><input type="checkbox" name="Order[data][view]" id="check-view" checked="checked">				
<label for="check-view" class="df"><span class="custom-checkbox"></span>Вид рабочего места</label></div>' :
                      '' ?>
                    <?= in_array(
                      'check-3d',
                      $checks
                    ) ? '<div class="check-cont"><input type="checkbox" name="Order[data][3d]" id="check-view" checked="checked">				
<label for="check-3d" class="df"><span class="custom-checkbox"></span>3D проект помещения</label></div>' :
                      '' ?>
                    <?= in_array(
                      'check-catalog',
                      $checks
                    ) ? '<div class="check-cont"><input type="checkbox" name="Order[data][catalog]" id="check-catalog" checked="checked">		
		<label for="check-catalog" class="df"><span class="custom-checkbox"></span>Выслать каталог</label></div>' :
                      '' ?>                                <?= in_array(
                      'check-autsor',
                      $checks
                    ) ? '<div class="check-cont"><input type="checkbox" name="Order[data][autsor]" id="check-autsor" checked="checked">	
			<label for="check-autsor" class="df"><span class="custom-checkbox"></span>Выезд специалиста</label></div>' :
                      '' ?>                                <?= in_array(
                      'check-esd',
                      $checks
                    ) ? '<div class="check-cont"><input type="checkbox" name="Order[data][esd]" id="check-esd" checked="checked">	
			<label for="check-esd" class="df"><span class="custom-checkbox"></span>ESD аудит предприятия</label></div>' :
                      '' ?>                                <?= in_array(
                      'check-pricelist',
                      $checks
                    ) ?
                      '<div class="check-cont"><input type="checkbox" name="Order[data][pricelist]" id="check-pricelist" checked="checked">				<label for="check-pricelist" class="df"><span class="custom-checkbox"></span>Выслать прайс лист</label></div>' :
                      '' ?>                                        <?= in_array(
                      'check-montaj',
                      $checks
                    ) ?
                      '<div class="check-cont"><input type="checkbox" name="Order[data][montaj]" id="check-montaj" checked="checked">				<label for="check-montaj" class="df"><span class="custom-checkbox"></span>Сборка и монтаж</label></div>' :
                      '' ?>

                </div>
            <? } ?>
        </form>
    </div>
</div>
