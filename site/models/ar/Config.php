<? /*******************************************************************************************************************
 * This file is the part of "DropShop" taobao(c) showcase project http://dropshop.pro
 * Copyright (C) 2013 - 2014 DanVit Labs http://danvit.ru
 * All rights reserved and protected by law. Certificate #40514-UA 21.12.2013
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="DSConfig.php">
 * </description>
 **********************************************************************************************************************/
?>
<?php

/**
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property string $id
 * @property string $label
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{
    protected static $_cache = array();

    /*
    public function afterDelete()
    {
        if (isset($this->img)) {
            if (file_exists(Yii::getAlias('@static/' . $this->popup_banner))) {
                unlink(Yii::getAlias('@static/' . $this->popup_banner));
            }
            if (file_exists(Yii::getAlias('@static/' . $this->popup_banner_2))) {
                unlink(Yii::getAlias('@static/' . $this->popup_banner_2));
            }
        }

        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
    */
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
          'id'    => Yii::t('app', 'Параметр'),
          'value' => Yii::t('app', 'Значение'),
          'label' => Yii::t('app', 'Описание'),
        );
    }

    /*
    public function beforeSave($insert)
    {
        if (!$this->isAttributeChanged('popup_banner')) {
            return parent::beforeSave($insert);
        }
        if (!$this->isAttributeChanged('popup_banner_2')) {
            return parent::beforeSave($insert);
        }

        $tmpImgs = explode(',', $this->popup_banner);
        $tmpImgs2 = explode(',', $this->popup_banner_2);

        //  Повторно проверяем входные данные
        if (!is_array($tmpImgs)) {
            return $this->addError('popup_banner', 'Проблемы с сохранением изображения');
        }
        if (!is_array($tmpImgs2)) {
            return $this->addError('popup_banner_2', 'Проблемы с сохранением изображения');
        }

        //  Валидные ли данные и есть ли данные изображения
        foreach ($tmpImgs as $tmpImg) {
            if (!file_exists(Yii::getAlias('@webroot' . $tmpImg))) {
                return $this->addError('popup_banner', 'Проблемы с сохранением изображения');
            }
        }
        foreach ($tmpImgs2 as $tmpImg) {
            if (!file_exists(Yii::getAlias('@webroot' . $tmpImg))) {
                return $this->addError('popup_banner_2', 'Проблемы с сохранением изображения');
            }
        }

        //  Записываем новые файлы
        foreach ($tmpImgs as $tmpImg) {
            $imgPath = Yii::getAlias('@webroot' . $tmpImg);
            $pathInfo = pathinfo($imgPath);
            $this->popup_banner = $pathInfo['basename'];
        }
        foreach ($tmpImgs2 as $tmpImg) {
            $imgPath = Yii::getAlias('@webroot' . $tmpImg);
            $pathInfo = pathinfo($imgPath);
            $this->popup_banner_2 = $pathInfo['basename'];
        }

        return parent::beforeSave($insert);
    }
    */

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
          array('id', 'required'),
          array('id,label', 'length', 'max' => 256),
          array('value', 'safe'),
            //array('value','numerical'),
          array('value', 'length', 'max' => 32767),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
          array('id, label, value', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->condition = "id LIKE '" . $this->id . "%'";
        $criteria->compare('value', $this->value, true);
        $criteria->compare('label', $this->label, true);
        return new CActiveDataProvider(
          $this, array(
            'criteria'   => $criteria,
            'sort'       => array(
              'defaultOrder' => 't.id ASC',
            ),
            'pagination' => array(
              'pageSize' => 200,
            ),
          )
        );
    }

    /**
     * @return self
     */
    /*
      public static function get()
      {
          if ($param = self::find()->one()) {
              return $param;
          } else {
              return new self();
          }
      }
      */

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'config';
    }

    private static function getValOverload($Pk, $val)
    {
        switch ($Pk) {
            case $Pk == 'seo_img_cache_enabled':
                {
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) {
                        return 0;
                    }
                }
                return $val;
                break;
            default:
                return $val;
        }
    }

    public static function getDays()
    {
        $days = array();
        for ($i = 1; $i <= 31; $i++) {
            if ($i < 10) {
                $days['0' . $i] = $i;
            } else {
                $days[$i] = $i;
            }
        }
        return $days;
    }

    public static function getMounthes()
    {
        return array(
          '01' => Yii::t('app', 'Январь'),
          '02' => Yii::t('app', 'Февраль'),
          '03' => Yii::t('app', 'Март'),
          '04' => Yii::t('app', 'Апрель'),
          '05' => Yii::t('app', 'Май'),
          '06' => Yii::t('app', 'Июнь'),
          '07' => Yii::t('app', 'Июль'),
          '08' => Yii::t('app', 'Август'),
          '09' => Yii::t('app', 'Сентябрь'),
          '10' => Yii::t('app', 'Октябрь'),
          '11' => Yii::t('app', 'Ноябрь'),
          '12' => Yii::t('app', 'Декабрь'),
        );
    }

    public static function getVal($Pk, $throwError = true)
    {
        if (is_array(self::$_cache)) {
            if (isset(self::$_cache[$Pk])) {
                return self::getValOverload($Pk, self::$_cache[$Pk]);
            }
        }
        $res_object = self::model()->findByPk($Pk);
        if (!$res_object) {
            if ($throwError) {
                throw new CHttpException(
                  500,
                  Yii::t(
                    'app',
                    'Фатальная ошибка: нарушена целостность конфигурации системы. Обратитесь к разработчикам'
                  ) . ' (' . $Pk . ')'
                );
            } else {
                $res = null;
            }
        }
        if (!is_object($res_object)) {
            if ($throwError) {
                throw new CHttpException(
                  500,
                  Yii::t(
                    'app',
                    'Фатальная ошибка: нарушена целостность конфигурации системы. Обратитесь к разработчикам'
                  ) . ' (' . $Pk . ')'
                );
            } else {
                $res = null;
            }
        } else {
            $res = $res_object->value;
        }
        if (!isset($res)) {
            if ($throwError) {
                throw new CHttpException(
                  500,
                  Yii::t(
                    'app',
                    'Фатальная ошибка: нарушена целостность конфигурации системы. Обратитесь к разработчикам'
                  ) . ' (' . $Pk . ')'
                );
            } else {
                $res = null;
            }
        }
        if (strlen($res) <= 1024 * 16) {
            if (!is_array(self::$_cache)) {
                self::$_cache = array();
            }
            self::$_cache[$Pk] = $res;
        }
        return self::getValOverload($Pk, $res);
    }

    public static function getValDef($Pk, $defaulValue)
    {
        $res = self::getVal($Pk, false);
        if (is_null($res)) {
            return $defaulValue;
        } else {
            return $res;
        }
    }

    public static function getYears()
    {
        $start_year = intval(date('Y') - 70);
        $end_year = intval(date('Y'));
        $years = array();
        for ($i = $start_year; $i <= $end_year; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }
}