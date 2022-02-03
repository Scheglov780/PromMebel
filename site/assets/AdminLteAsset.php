<?php
namespace app\assets;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;
use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';

    public $css = [
        'bower_components/select2/dist/css/select2.min.css',
         '/css/admin.css',
    ];

    public $js = [
        'bower_components/select2/dist/js/select2.full.min.js',
    ];
}
