<?php

namespace app\models\ar;

use yii\BaseYii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $short_description
 * @property int|null $publish
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 */
class Page extends BaseAR
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISH = 1;
    public static $statusMenu = [
      self::STATUS_PUBLISH  => 'Опубликован',
      self::STATUS_DISABLED => 'Скрыт',
    ];
    public static $statusNames = [
      self::STATUS_PUBLISH  => 'Опубликован',
      self::STATUS_DISABLED => 'Скрыт',
    ];

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'description'       => 'Контент',
          'footercolumn'      => 'Вывод в меню Компании',
          'id'                => 'ID',
          'name'              => 'Заголовок',
          'publish'           => 'Статус страницы',
          'short_description' => 'Краткое описание',
        ];
    }

    public function behaviors()
    {
        return [
          [
            'class'         => SluggableBehavior::class,
            'attribute'     => 'name',
            'slugAttribute' => 'slug',
            'ensureUnique'  => true,
          ],
        ];
    }

    public function checkPhpSyntax($file)
    {
        return true;
        if (!file_exists($file)) {
            return false;
        }
        $checkResult = @exec("php -l $file");
        if ($checkResult && (substr($checkResult, 0, 28) != 'No syntax errors detected in')) {
            return false;
        }
        return true;
    }

    public function render($text)
    {
        if (preg_match('/<!--\?(.+?)\?-->/s', $text)) {
            $text = preg_replace('/<!--\?(.+?)\?-->/s', '<?\1?>', $text);
        }
        if (!preg_match('/<\?/i', $text)) {
            return $text;
        }
        $open_basedir = ini_get('open_basedir');
        try {
            if ($open_basedir) {
                $tFileName = tempnam(
                  BaseYii::getPathOfAlias('@webroot') . '/upload/',
                  'php'
                ) or die('could not create file');
                $tempFile = fopen($tFileName, 'w+');
            } else {
                $tempFile = tmpfile();
            }
            if (!$tempFile) {
                return ('error to open temp file');
            }
            $metaDatas = stream_get_meta_data($tempFile);
            $tmpFilename = $metaDatas['uri'];
            fwrite($tempFile, $text);
//      fseek($tempFile, 0);
            $phpRes = @$this->checkPhpSyntax($tmpFilename);
            if (!isset($phpRes) || !$phpRes) {
                @fclose($tempFile); // this removes the file
                if (isset($tFileName)) {
                    @unlink($tFileName);
                }
                return 'Syntax error in content!';
            }
            ob_start();
            ob_implicit_flush(false);
            try {
                $phpRes = @include($tmpFilename);
            } catch (Exception $e) {
                VarDumper::dump($e);
                ob_get_clean();
            }
            if (!isset($phpRes) || !$phpRes) {
                ob_get_clean();
                fclose($tempFile); // this removes the file
                if (isset($tFileName)) {
                    unlink($tFileName);
                }
                return 'Error in content!';
            }
            $content = ob_get_clean();
            fclose($tempFile); // this removes the file
            if (isset($tFileName)) {
                unlink($tFileName);
            }
            return $content;
        } catch (Exception $e) {
            return VarDumper::dumpAsString($e, 3, true);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['description', 'short_description', 'meta_title', 'meta_description', 'meta_keywords'], 'string'],
          [['publish'], 'integer'],
          [['footercolumn'], 'boolean'],
          [['name'], 'required'],
          [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }
}
