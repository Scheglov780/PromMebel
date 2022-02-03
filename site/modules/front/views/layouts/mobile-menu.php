<?php

use app\models\ar\Category;
use yii\widgets\Menu;

$cities = $this->context->cities;
$domain = $this->context->domain;
$catMenu_2 = $this->context->categoriesMobile[2];

$catMenu_3 = $this->context->categoriesMobile[3];

$catMenu_232 = $this->context->categoriesMobile[232];

$catMenu_234 = $this->context->categoriesMobile[234];
/** @var $services \app\models\ar\Service[] */
$services = $this->context->services;

$pagesonmain = $this->context->pagesonmain;

?>
<div class="background">
    <img class="close-img" src="/img/close.svg" alt="">
</div>
<div class="mobile-menu">
    <div class="mobile-menu-item">
        <a class="city-menu">
            <img src="/img/city.svg" alt="" class="city-icon">
            <?= $this->context->city->name ?>
            <img src="/img/arrow_right_2.svg" alt="">
        </a>
        <div class="cities-mobile-cont">
            <?php foreach ($cities as $char => $cityChank): ?>
                <?php foreach ($cityChank as $k => $city): ?>
                    <div class="city-item <?= array_key_last($cityChank) == $k ? 'last' : '' ?>">
                        <div class="city-char"><?= array_key_first($cityChank) == $k ? $char: '' ?></div>
                        <a href="https://<?= $city->alias.'.'.$domain ?>/" class="city-name"><?= $city->name ?></a>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="mobile-menu-item parent-item">
        <a href="/catalog/promyslennaa-mebel">Промышленная мебель <img src="/img/arrow_right_2.svg"></a>
        <?= Menu::widget(
            [
                'options' => ['class' => 'mobile-menu-tree'],
                'items' => $catMenu_2,
            ]
        )
        ?>

    </div>
    <div class="mobile-menu-item parent-item">
        <a href="/catalog/antistaticeskaa-mebel-i-osnasenie">Антистатическая мебель и оснащение <img src="/img/arrow_right_2.svg"></a>
        <?= Menu::widget(
            [
                'options' => ['class' => 'mobile-menu-tree'],
                'items' => $catMenu_3,
            ]
        )
        ?>
    </div>
    <div class="mobile-menu-item parent-item">		<a href="/catalog/paalnoe-oborudovanie">Паяльное оборудование <img src="/img/arrow_right_2.svg"></a>	<?= Menu::widget(            [                'options' => ['class' => 'mobile-menu-tree'],                'items' => $catMenu_232,            ]        )        ?>		</div>
    <div class="mobile-menu-item parent-item">		<a href="/catalog/izmeritelnye-pribory">Измерительные приборы <img src="/img/arrow_right_2.svg"></a>	<?= Menu::widget(            [                'options' => ['class' => 'mobile-menu-tree'],                'items' => $catMenu_234,            ]        )        ?>		</div>
    <div class="mobile-menu-item parent-item">
        <a>Услуги <img src="/img/arrow_right_2.svg"></a>
        <ul class="main-menu-tree" data-widget="tree">
            <?php foreach ($services as $service) { ?>
                <li class=""><a href="<?= $service->href ?>"><?= $service->name ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="mobile-menu-item parent-item">
	<a>Компания  <img src="/img/arrow_right_2.svg"></a>
				<ul class="main-menu-tree" data-widget="tree">
            <?php foreach ($pagesonmain as $pom) { ?>
		<li class=""><a href="/<?= $pom->slug ?>"><?= $pom->name ?></a></li>                    
            <?php } ?>
        </ul>
	</div>

    <div class="phone-cont">
        <a class="phone-number" href="tel:<?= $this->context->phone ?>"><?= $this->context->phone ?></a>
        <a class="email" href="mailto:<?= $this->context->email ?>  "><?= $this->context->email ?></a>
    </div>
</div>