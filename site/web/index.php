<?php
//phpinfo();die;
set_time_limit ( 10 );
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true); //false
defined('YII_ENV') or define('YII_ENV', 'dev'); //prod dev
defined('YII_ENV_DEV') or define('YII_ENV_DEV', true);


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
