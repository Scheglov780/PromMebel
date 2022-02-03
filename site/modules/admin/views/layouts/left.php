<?php

use app\models\ar\Order;

$newOrder = Order::getUnreadCount() > 0 ? Order::getUnreadCount() : "";

?>
<aside class="main-sidebar">

  <section class="sidebar">

    <!-- Sidebar user panel -->
    <!--        <div class="user-panel">
            <div class="pull-left image">
                <img src="<? /*= $directoryAsset */ ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

    <!-- search form -->
    <!--        <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>-->
    <!-- /.search form -->

      <?= dmstr\widgets\Menu::widget(
        [
          'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
          'items'   => [
              //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
            [
              'label' => 'Заказы <span class="pull-right-container"><small class="label pull-right bg-green">' .
                $newOrder .
                '</small></span>',
              'encode' => false,
              'url' => ['order/index'],
              'icon' => 'dollar',
            ],
            ['label' => 'ВИТРИНА', 'options' => ['class' => 'header']],
            ['label' => 'Категории', 'url' => ['category/index'], 'icon' => 'navicon'],
            ['label' => 'Бренды', 'url' => ['brand/index'], 'icon' => 'apple'],
            ['label' => 'Производители', 'url' => ['manufacturer/index'], 'icon' => 'anchor'],
            ['label' => 'Серии товаров', 'url' => ['series/index'], 'icon' => 'calculator'],
            ['label' => 'Пакеты товаров', 'url' => ['product-packages/index'], 'icon' => 'object-group'],
            ['label' => 'Товары', 'url' => ['product/index'], 'icon' => 'cubes'],
            ['label' => 'Свойства товаров', 'url' => ['property/index'], 'icon' => 'gear'],
            ['label' => 'Загрузка товаров', 'url' => ['dev/upload-excel'], 'icon' => 'upload'],
            ['label' => 'КОНТЕНТ', 'options' => ['class' => 'header']],
            ['label' => 'Слайдер', 'url' => ['slider/index'], 'icon' => 'photo'],
            ['label' => 'Страницы', 'url' => ['page/index'], 'icon' => 'id-card'],
            ['label' => 'Новости', 'url' => ['news/index'], 'icon' => 'newspaper-o'],
            ['label' => 'Услуги', 'url' => ['service/index'], 'icon' => 'server'],
            ['label' => 'НАСТРОЙКИ', 'options' => ['class' => 'header']],
            ['label' => 'Города', 'url' => ['city/index'], 'icon' => 'map-marker'],
              /*                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                                  ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                                  ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],*/
          ],
        ]
      ) ?>

  </section>

</aside>
