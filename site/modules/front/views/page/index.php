<?php

use app\models\ar\Page;
use app\widgets;

/** @var $page Page */

$this->params['breadcrumbs'][] = $page->name;

?>

<div class="news-block">
    <?php /*
    echo app\widgets\RequestMessageBlock::widget(
      [
        'debug'      => false,
        'asButton'   => false,
        'subj'       => 'Выезд эксперта',
        'comment'    => <<<MES
Здравствуйте. Я хочу пригласить эксперта и прошу связаться со мной.<br>
MES,
      ]
    ); */?>
    <?= $page->render($page->description) ?>
</div>

<?php
echo newerton\fancybox\FancyBox::widget([
  'target' => 'a:has(img.fancybox)', //'a[rel=fancybox]'
  //'helpers' => true,
  'mouse' => true,
  'config' => [
//    'maxWidth' => '90%',
//    'maxHeight' => '90%',
//    'playSpeed' => 7000,
//    'padding' => 0,
    'fitToView' => true,
//    'width' => '70%',
//    'height' => '70%',
    'autoSize' => true,
    'closeClick' => true,
//    'openEffect' => 'elastic',
//    'closeEffect' => 'elastic',
//    'prevEffect' => 'elastic',
//    'nextEffect' => 'elastic',
    'closeBtn' => true,
//    'openOpacity' => true,
//    'helpers' => [
//      'title' => ['type' => 'float'],
//      'buttons' => [],
//      'thumbs' => ['width' => 68, 'height' => 50],
//      'overlay' => [
//        'css' => [
//          'background' => 'rgba(0, 0, 0, 0.8)'
//        ]
//      ]
//    ],
  ]
]);
