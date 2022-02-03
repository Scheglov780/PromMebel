<?php

use app\models\ar\Category;
use yii\web\View;
use yii\widgets\Menu;
use yii\helpers\Url;

/** @var $cities array[] */
/** @var $this View */

$cities = $this->context->cities;
$cartProducts = $this->context->cartProducts;
$cartProductsCount = $this->context->cartProductsCount;
$cartText = $this->context->cartText;
$favoriteProducts = $this->context->favoriteProducts;
$favoriteProductsCount = $this->context->favoriteProductsCount;
$favoriteText = $this->context->favoriteText;
$comparisonProducts = $this->context->comparisonProducts;
$comparisonProductsCount = $this->context->comparisonProductsCount;
$comparisonText = $this->context->comparisonText;
/** @var $services \app\models\ar\Service[] */
$services = $this->context->services;

$citiesCount = 0;
foreach ($cities as $c) {
    $citiesCount += count($c);
}
$domain = $this->context->domain;

$parentCategories = $this->context->cats;
$catMenu_2 = $this->context->categories[2];
$catMenu_3 = $this->context->categories[3];
$catMenu_232 = $this->context->categories[232];
$catMenu_234 = $this->context->categories[234];
$brands = \app\models\ar\Brand::getAll();
$manufacturers = \app\models\ar\Manufacturer::getAll();
$pagesonmain = $this->context->pagesonmain;
?>

<header>
    <div class="header-top df jc-sa">
        <div class="mobile btn-menu">
            <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.871 0H2.12903C0.958064 0 0 0.964286 0 2.14286C0 3.32143 0.958064 4.28571 2.12903 4.28571H19.871C21.0419 4.28571 22 3.32143 22 2.14286C22 0.964286 21.0419 0 19.871 0Z"/>
                <path d="M19.871 7.85718H2.12903C0.958064 7.85718 0 8.82146 0 10C0 11.1786 0.958064 12.1429 2.12903 12.1429H19.871C21.0419 12.1429 22 11.1786 22 10C22 8.82146 21.0419 7.85718 19.871 7.85718Z"/>
                <path d="M19.871 15.7142H2.12903C0.958064 15.7142 0 16.6785 0 17.8571C0 19.0357 0.958064 19.9999 2.12903 19.9999H19.871C21.0419 19.9999 22 19.0357 22 17.8571C22 16.6785 21.0419 15.7142 19.871 15.7142Z"/>
            </svg>
        </div>
        <div class="logo-cont df">
            <a href="/" class="df">
                <img src="/img/logo.svg" alt="" class="logo">
                <img src="/img/logo_text.svg" alt="" class="logo-text">
            </a>
        </div>
        <div class="city-select-cont df">
            <img src="/img/city.svg" alt="">
            <div class="city-select-text"><?= isset($this->context->city) ? $this->context->city->name : 'Не выбран' ?></div>
            <svg width="11" class="arrow-black" height="6" viewBox="0 0 11 6" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
            </svg>
            <div class="popup popup-cities">
                <div class="cities-header df jc-sa">
                    <div class="input-text">Выбранный регион:</div>
                    <div class="city-search-cont df">
                        <input type="text" id="search-city" placeholder="Поиск"
                               value="<?= isset($this->context->city) ? $this->context->city->name : '' ?>">
                        <img src="/img/search.svg" alt="" class="serch-icon">
                    </div>
                    <div class="input-text-right">
                        Не нашли свой город? <br class="city-br"> У нас есть <a href="/dostavka-po-rossii">доставка по
                            России.</a>
                    </div>
                </div>
                <div class="cities-cont" style="height: <?= 50 + ($citiesCount / 4 * 40) ?>px">
                    <?php foreach ($cities as $char => $cityChank): ?>
                        <?php foreach ($cityChank as $k => $city): ?>
                            <div class="city-item <?= array_key_last($cityChank) == $k ? 'last' : '' ?>">
                                <div class="city-char"><?= array_key_first($cityChank) == $k ? $char : '' ?></div>
                                <a href="https://<?= $city->alias . '.' . $domain ?>/"
                                   class="city-name"><?= $city->name ?></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="search-cont df">
            <div class="search-input-cont df">
                <input type="text" id="search" placeholder="Поиск" autocomplete="off">
                <img src="/img/search.svg" alt="" class="serch-icon">

                <div class="popup popup-search">
                    <div class="header">
                        <div class="title"><span class="popup-search-header">Ничего не найдено...</span><span
                                    class="popup-search-close">×</span></div>
                    </div>
                    <div class="popup-body">

                    </div>
                </div>
            </div>
        </div>
        <div class="phone-cont df">
            <a class="phone-number" href="tel:<?= $this->context->phone ?>"><?= $this->context->phone ?></a>
            <a class="email" href="mailto:<?= $this->context->email ?>"><?= $this->context->email ?></a>
        </div>
        <section>
            <div class="favorite-cont rcount">
                <a href="/product/favorite" class="df" style="position: relative;"> <?//javascript:void(0) ?>
                    <img src="/img/star.png" alt=""
                         class="favorite-icon <?= $favoriteProductsCount <= 0 ? 'header-icon-empty' : '' ?>">
                    <span id="mobile-favorite-count" <?= $favoriteProductsCount <= 0 ? 'style="display:none"' : '' ?>><?= $favoriteProductsCount ?></span>
                    <div class="favorite-text" id="favorite-text" style="display: none;">
                        <?= $favoriteText ?>
                    </div>

                </a>

                <div class="popup popup-favorite">
                    <div class="header">
                        <div class="title">Избранные товары
                            <div class="clear-favorite">
                                <img src="/img/delete-button.svg" alt="" title="Очистить список избранного">
                            </div>
                        </div>
                    </div>
                    <div class="popup-body">
                        <div class="favorite-ajax calculated-data-products favorite-empty-title">
                            <?= $this->render(
                              '/product/_favorite_items',
                              [
                                'favorites' => $favoriteProducts
                              ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="comparison-cont rcount"><a href="/product/comparison" class="df" style="position: relative;">
                    <div><img src="/img/compare.png" alt=""
                    class="comparison-icon <?= $comparisonProductsCount <= 0 ? 'header-icon-empty' : '' ?>">
                    <span id="mobile-comparison-count"<?= $comparisonProductsCount <= 0 ? 'style="display:none"' : '' ?>><?= $comparisonProductsCount ?></span>
                    <div class="comparison-text" id="comparison-text" style="display: none;">
                        <?= $comparisonText ?>
                    </div>
                </a>
                <div class="popup popup-comparison">
                    <div class="header">
                        <div class="title">Сравнение товаров
                            <div class="clear-comparison">
                                <img src="/img/delete-button.svg" alt="" title="Очистить список сравнения">
                            </div>
                        </div>
                    </div>
                    <div class="popup-body">
                        <div class="comparison-ajax calculated-data-products comparison-empty-title">
                            <?= $this->render(
                              '/product/_comparison_items',
                              [
                                'comparisons' => $comparisonProducts
                              ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="cart-cont rcount">
                <a href="/cart" class="df" style="position: relative;">
                    <img src="/img/cart.svg" alt=""
                         class="cart-icon <?= $cartProductsCount <= 0 ? 'header-icon-empty' : '' ?>">
                    <span id="mobile-cart-count" <?= $cartProductsCount <= 0 ? 'style="display:none"' : '' ?>><?= $cartProductsCount ?></span>
                    <div class="cart-text" id="cart-text" style="display: none;">
                        <?= $cartText ?>
                    </div>
                </a>
                <? if ($this->context->action->id !== 'cart') { ?>
                    <div class="popup popup-cart">
                        <div class="header">
                            <div class="title">Товары для заказа
                            <div class="clear-cart">
                                <img src="/img/delete-button.svg" alt="" title="Очистить корзину">
                            </div>
                            </div>
                        </div>
                        <div class="popup-body">
                            <div class="cart-ajax calculated-data-products cart-empty-title">
                                <? /* <div class="table-row head df jc-fs ai-c">
                                <div class="table-cell">Фото</div>
                                <div class="table-cell">Наименование товара</div>
                            </div> */ ?>
                                <?= $this->render(
                                  '/product/_cart_items',
                                  [
                                    'products' => $cartProducts,
                                    'isPopup'  => true,
                                  ]
                                ) ?>
                            </div>
                        </div>
                        <div class="footer">
                            <a href="/cart" class="btn-red to-cart">Перейти в корзину</a>
                        </div>
                    </div>
                <? } ?>
            </div>
        </section>
    </div>
    <div class="header-menu df jc-fs">
        <div class="header-menu-catalog-cont menu-item">
            <div class="catalog-text">Каталог</div>
            <div class="catalog-menu">
                <div class="catalog-menu-btn">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.871 0H2.12903C0.958064 0 0 0.964286 0 2.14286C0 3.32143 0.958064 4.28571 2.12903 4.28571H19.871C21.0419 4.28571 22 3.32143 22 2.14286C22 0.964286 21.0419 0 19.871 0Z"/>
                        <path d="M19.871 7.85718H2.12903C0.958064 7.85718 0 8.82146 0 10C0 11.1786 0.958064 12.1429 2.12903 12.1429H19.871C21.0419 12.1429 22 11.1786 22 10C22 8.82146 21.0419 7.85718 19.871 7.85718Z"/>
                        <path d="M19.871 15.7142H2.12903C0.958064 15.7142 0 16.6785 0 17.8571C0 19.0357 0.958064 19.9999 2.12903 19.9999H19.871C21.0419 19.9999 22 19.0357 22 17.8571C22 16.6785 21.0419 15.7142 19.871 15.7142Z"/>
                    </svg>
                </div>
                Каталог продукции
            </div>
        </div>
        <div class="menu-item parent catalog-item" id="prom-mebel-menu">
            <a href="<?= Url::toRoute(['/front/category/view', 'slug' => $parentCategories[2]->slug]) ?>">
                Промышленная мебель
                <svg width="11" class="arrow-white" height="6" viewBox="0 0 11 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
                </svg>
            </a>
            <div class="popup popup-menu">
                <?= Menu::widget(
                  [
                    'options'           => ['class' => 'main-menu-tree', 'data-widget' => 'tree'],
                    'items'             => $catMenu_2,
                    'firstItemCssClass' => "label-title",
                    'submenuTemplate'   => "\n<ul class=\"main-menu-sub-tree\">\n{items}\n</ul>\n",
                  ]
                )
                ?>
                <div class="brand-count">
                    <div class="brand-title">Популярные бренды</div>
                    <div class="brands">
                        <?php foreach ($brands as $brand) { ?>
                            <div class="brand">
                                <a href="<?= Url::to(['/front/brand/view', 'slug' => $brand->slug]) ?>"><img
                                            src="/static/brand/<?= $brand->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
               <?/* <div class="manufacturer-count">
                    <div class="manufacturer-title">Популярные производители</div>
                    <div class="manufacturers">
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                            <div class="manufacturer">
                                <a href="<?= Url::to(
                                  ['/front/manufacturer/view', 'slug' => $manufacturer->slug]
                                ) ?>"><img src="/static/manufacturer/<?= $manufacturer->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div> */?>
                <div class="sale-count">
                    <div class="brand-title">Акции</div>
                    <div class="sale-img-count">
                        <a href="/<?= $this->context->params->popup_banner_link ?>"><img
                                    src="<?= $this->context->params->popup_banner ?>" alt=""
                                    class="sale-img"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item parent catalog-item" id="prom-mebel-menu-2">
            <a href="<?= Url::toRoute(['/front/category/view', 'slug' => $parentCategories[3]->slug]) ?>">
                Антистатическая мебель и оснащение
                <svg width="11" class="arrow-white" height="6" viewBox="0 0 11 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
                </svg>
            </a>
            <div class="popup popup-menu">
                <?= Menu::widget(
                  [
                    'options'           => ['class' => 'main-menu-tree', 'data-widget' => 'tree'],
                    'items'             => $catMenu_3,
                    'firstItemCssClass' => "label-title",
                    'submenuTemplate'   => "\n<ul class=\"main-menu-sub-tree\">\n{items}\n</ul>\n",
                  ]
                )
                ?>
                <div class="brand-count">
                    <div class="brand-title">Популярные бренды</div>
                    <div class="brands">
                        <?php foreach ($brands as $brand) { ?>
                            <div class="brand">
                                <a href="<?= Url::to(['/front/brand/view', 'slug' => $brand->slug]) ?>"><img
                                            src="/static/brand/<?= $brand->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
				<?/*
                <div class="manufacturer-count">
                    <div class="manufacturer-title">Популярные производители</div>
                    <div class="manufacturers">
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                            <div class="manufacturer">
                                <a href="<?= Url::to(
                                  ['/front/manufacturer/view', 'slug' => $manufacturer->slug]
                                ) ?>"><img src="/static/manufacturer/<?= $manufacturer->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div> */?>
                <div class="sale-count">
                    <div class="brand-title">Акции</div>
                    <div class="sale-img-count">
                        <a href="/<?= $this->context->params->popup_banner_link_2 ?>"><img
                                    src="<?= $this->context->params->popup_banner_2 ?>" alt=""
                                    class="sale-img"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item parent catalog-item" id="prom-mebel-menu-232">
            <a href="/catalog/paalnoe-oborudovanie">
                Паяльное оборудование
                <svg width="11" class="arrow-white" height="6" viewBox="0 0 11 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
                </svg>
            </a>
            <div class="popup popup-menu" style="">
                <?= Menu::widget(
                  [
                    'options'           => ['class' => 'main-menu-tree', 'data-widget' => 'tree'],
                    'items'             => $catMenu_232,
                    'firstItemCssClass' => "label-title",
                    'submenuTemplate'   => "\n<ul class=\"main-menu-sub-tree\">\n{items}\n</ul>\n",
                  ]
                ) ?>
                <div class="brand-count">
                    <div class="brand-title">Популярные бренды</div>
                    <div class="brands">
                        <?php foreach ($brands as $brand) { ?>
                            <div class="brand">
                                <a href="<?= Url::to(['/front/brand/view', 'slug' => $brand->slug]) ?>"><img
                                            src="/static/brand/<?= $brand->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
				<?/*
                <div class="manufacturer-count">
                    <div class="manufacturer-title">Популярные производители</div>
                    <div class="manufacturers">
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                            <div class="manufacturer">
                                <a href="<?= Url::to(
                                  ['/front/manufacturer/view', 'slug' => $manufacturer->slug]
                                ) ?>"><img src="/static/manufacturer/<?= $manufacturer->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div> */?>
                <div class="sale-count">
                    <div class="brand-title">Акции</div>
                    <div class="sale-img-count">
                        <a href="/<?= $this->context->params->popup_banner_link ?>"><img
                                    src="<?= $this->context->params->popup_banner ?>" alt=""
                                    class="sale-img"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item parent catalog-item" id="prom-mebel-menu-232">
            <a href="/catalog/izmeritelnye-pribory">
                Измерительные приборы
                <svg width="11" class="arrow-white" height="6" viewBox="0 0 11 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
                </svg>
            </a>
            <div class="popup popup-menu" style="">
                <?= Menu::widget(
                  [
                    'options'           => ['class' => 'main-menu-tree', 'data-widget' => 'tree'],
                    'items'             => $catMenu_234,
                    'firstItemCssClass' => "label-title",
                    'submenuTemplate'   => "\n<ul class=\"main-menu-sub-tree\">\n{items}\n</ul>\n",
                  ]
                ) ?>
                <div class="brand-count">
                    <div class="brand-title">Популярные бренды</div>
                    <div class="brands">
                        <?php foreach ($brands as $brand) { ?>
                            <div class="brand">
                                <a href="<?= Url::to(['/front/brand/view', 'slug' => $brand->slug]) ?>"><img
                                            src="/static/brand/<?= $brand->img ?>" alt=""></a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
				<?/*
                <div class="manufacturer-count">
                    <div class="manufacturer-title">Популярные производители</div>
                    <div class="manufacturers">
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                            <div class="manufacturer">
                                <a href="<?= Url::to(
                                  ['/front/manufacturer/view', 'slug' => $manufacturer->slug]
                                ) ?>"><img
                                            src="/static/manufacturer/<?= $manufacturer->img ?>" alt=""></a>
                            </div>
                        <?php } ?>
                    </div>
                </div> */?>

                <div class="sale-count">
                    <div class="brand-title">Акции</div>
                    <div class="sale-img-count">
                        <a href="/<?= $this->context->params->popup_banner_link ?>"><img
                                    src="<?= $this->context->params->popup_banner ?>" alt=""
                                    class="sale-img"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item parent menurelativep">
            <a href="/">
                Услуги
                <svg width="11" class="arrow-white" height="6" viewBox="0 0 11 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
                </svg>
            </a>
            <div class="popup popup-menu-def">
                <ul class="main-menu-tree" data-widget="tree">
                    <?php foreach ($services as $service) { ?>
                        <li class=""><a href="<?= $service->href ?>"><?= $service->name ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="menu-item parent menurelativep"><a href="/o-kompanii"> Компания
                <svg width="11" class="arrow-white" height="6" viewBox="0 0 11 6" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.14284 6C4.9585 6 4.77418 5.92797 4.63364 5.78422L0.211003 1.25832C-0.0703343 0.970413 -0.0703343 0.503627 0.211003 0.21584C0.492226 -0.0719468 0.948276 -0.0719468 1.22964 0.21584L5.14284 4.22061L9.05607 0.21598C9.3374 -0.0718069 9.79341 -0.0718069 10.0746 0.21598C10.3561 0.503767 10.3561 0.970553 10.0746 1.25846L5.65204 5.78436C5.51143 5.92814 5.32711 6 5.14284 6Z"/>
                </svg>
            </a>
            <div class="popup popup-menu-def">
                <ul class="main-menu-tree" data-widget="tree">
                    <li class=""><a href="/news">Новости</a></li> <?php foreach ($pagesonmain as $pom) { ?>
                        <li class=""><a href="/<?= $pom->slug ?>"><?= $pom->name ?></a>
                        </li>                            <?php } ?>                        </ul>
            </div>
        </div>
    </div>
</header>