<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$dommainArray = explode('.', $_SERVER['HTTP_HOST']);
if (count($dommainArray) > 2) {
    $domain = substr(strstr($_SERVER['HTTP_HOST'], '.'), 1);
} else {
    $domain = $_SERVER['HTTP_HOST'];
}

$config = [
  'id'         => 'basic',
  'basePath'   => dirname(__DIR__),
  'language'   => 'ru-RU',
  'bootstrap'  => ['log'],
  'aliases'    => [
    '@bower'            => '@vendor/bower-asset',
    '@npm'              => '@vendor/npm-asset',
    '@brandroot'        => '@app/web/static/brand/',
    '@brand'            => '/static/brand/',
    '@manufacturerroot' => '@app/web/static/manufacturer/',
    '@manufacturer'     => '/static/manufacturer/',
    '@catroot'          => '@app/web/static/category/',
    '@cat'              => '/static/category/',
    '@sliderroot'       => '@app/web/static/slider/',
    '@slider'           => '/static/slider/',
    '@newsroot'         => '@app/web/static/news/',
    '@news'             => '/static/news/',
    '@serviceroot'      => '@app/web/static/service/',
    '@service'          => '/static/service/',
    '@productroot'      => '@app/web/static/product',
    '@product'          => '/static/product',
  ],
  'components' => [
    'request'      => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => '0AJqgLb0bdnIpc0rIYJDsPm8zSitu0R2',
      'baseUrl'             => ''
    ],
    'cache'        => [
      'class' => 'yii\caching\FileCache',
    ],
    'user'         => [
      'identityClass'   => 'app\models\User',
      'enableAutoLogin' => true,
      'loginUrl'        => '/admin/login',
      'identityCookie'  => [
        'name'   => '_identity',
        'domain' => '.' . $domain,
      ],
    ],
    'errorHandler' => [
      'errorAction' => 'front/default/error',
    ],
    'formatter'    => [
      'class'       => 'yii\i18n\Formatter',
      'nullDisplay' => '-',
    ],
    'session'      => [
      'class'        => 'yii\web\DbSession',
      'timeout'      => 3600 * 24 * 7,
      'cookieParams' => [
        'domain' => '.' . $domain,
      ],
    ],
    'mailer'       => [
      'class'            => 'yii\swiftmailer\Mailer',
      'viewPath'         => '@app/mail',
      'htmlLayout'       => '@app/mail/layouts/html',
      'transport'        => [
        'class'      => 'Swift_SmtpTransport',
        'host'       => 'smtp.yandex.ru',
        'username'   => 'send@pmzakaz.ru',
        'password'   => '612Pm785',
        'port'       => 465,
        'encryption' => 'ssl',
      ],
      'messageConfig'    => [
        'charset' => 'UTF-8',
      ],
      'useFileTransport' => false,
    ],
    'log'          => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets'    => [
        [
          'class'   => 'yii\log\FileTarget',
          'levels'  => ['error', 'warning'],
          'logVars' => ['_GET', '_POST'],
          'except'  => ['yii\web\HttpException:404','yii\debug\Module::checkAccess'],
        ],
      ],
    ],
    'db'           => $db,

    'urlManager'   => [
      'enablePrettyUrl' => true,
      'showScriptName'  => false,
      'rules'           => [
        '/site/captcha'          => '/front/default/captcha',
        '/product/captcha'       => '/front/product/captcha',
        '/default/captcha'       => '/front/default/captcha',
        '/quickOrder'            => 'front/product/quick-order',
        '/requestMessage'            => 'front/default/request-message',
        '/'                      => 'front/default/index',
        '/scheduler'             => 'front/default/scheduler',
        '/message'               => 'front/default/ajax-message',
        '/admin'                 => 'admin/default/index',
        '/cart'                  => 'front/product/cart',
        '/cart/pdf'              => 'front/product/cart-pdf',
        '/cart/print'            => 'front/product/cart-print',
        '/product/comparison'    => 'front/product/comparison',
        '/product/favorite'    => 'front/product/favorite',
        '/admin/login'           => 'admin/default/login',
        '/admin/logout'          => 'admin/default/logout',
        [
          'pattern' => 'catalog',
          'route'   => 'front/category/index',
        ],
        [
          'pattern' => 'catalog/<slug:>',
          'route'   => 'front/category/view',
        ],
        [
          'pattern' => 'brands',
          'route'   => 'front/brand/index',
        ],
        [
          'pattern' => 'brand/<slug:>',
          'route'   => 'front/brand/view',
        ],
        [
          'pattern' => 'manufacturers',
          'route'   => 'front/manufacturer/index',
        ],

        [
          'pattern' => 'manufacturer/<slug:>',
          'route'   => 'front/manufacturer/view',
        ],
        [
          'pattern' => 'catalog/<slug:>/<productSlug:>',
          'route'   => 'front/product/view',
        ],
        [
          'pattern' => 'series',
          'route'   => 'front/series/index',
        ],
        [
          'pattern' => 'series/<slug:>',
          'route'   => 'front/series/view',
        ],
        [
          'pattern' => '<controller>/<slug:>',
          'route'   => 'front/<controller>/view',
        ],
        [
          'pattern' => 'news',
          'route'   => 'front/news/index',
        ],
        [
          'pattern' => '<slug:>',
          'route'   => 'front/page/index',
        ],
        '/<controller>/<action>' => 'front/<controller>/<action>',
      ],
    ],
    'defaultRoute' => 'front/default'
  ],
  'modules'    => [
    'admin' => [
      'class' => 'app\modules\admin\Module',
    ],
    'front' => [
      'class' => 'app\modules\front\Module',
    ],
  ],
  'params'     => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
      'class'      => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
      'allowedIPs' => ['31.28.227.21'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
      'class'      => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
      'allowedIPs' => ['31.28.227.21'],
      'generators' => [ //here
        'crud' => [ // generator name
          'class'     => 'yii\gii\generators\crud\Generator', // generator class
          'templates' => [ //setting for out templates
            'customCrud' => '@app/modules/admin/views/_gii/crud',
          ]
        ]
      ],
    ];
}

return $config;
