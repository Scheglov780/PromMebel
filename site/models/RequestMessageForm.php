<?
namespace app\models;

use Yii;
use yii\base\Model;
use yii\captcha\Captcha;
use yii\helpers\Url;

/*******************************************************************************************************************
 * This file is the part of "DropShop" taobao(c) showcase project http://dropshop.pro
 * Copyright (C) 2013 - 2014 DanVit Labs http://danvit.ru
 * All rights reserved and protected by law. Certificate #40514-UA 21.12.2013
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="UserForm.php">
 * </description>
 **********************************************************************************************************************/ ?>
<?php

class RequestMessageForm extends Model
{
    public $verifyCode;
    public $email = null;
    public $phone = null;
    public $comment = '';
    public $name = '';
    public $subj = '';

    function attributeLabels()
    {
        return array(
          'name'    => Yii::t('app', 'Ваше имя'),
          'email'   => 'Ваш EMail',
          'phone'   => 'Ваш телефон',
          'verifyCode' => Yii::t('app', 'Код проверки'),
          'subj'    => Yii::t('app', 'Тема письма'),
          'comment' => Yii::t('app', 'Ваше сообщение')
        );
    }

    function rules()
    {
        $result = array();
        $result[] = [['name', 'email', 'phone', 'verifyCode', 'subj'], 'required'];
        $result[] = [['verifyCode',], 'required'];
        $result[] = [['comment'], 'safe'];
        /* $result[] = array('name', 'length', 'min' => 1, 'max' => 64);
        $result[] = array('subj', 'length', 'min' => 1, 'max' => 256);
        $result[] = array('comment', 'length', 'min' => 1, 'max' => 2048); */
        $result[] = array(
          'email',
          'email',
          'allowName' => false,
          'pattern'   => '/[a-z0-9\-\.\+%_]+@[a-z0-9\.\-]+\.[a-z]{2,6}/i'
        );
        $result[] = array(
          'phone',
          'match',
          'pattern'   => '/[\+\-\(\)\s0-9]/i',
        );
        $result[] = [
          'verifyCode',
          'captcha',
          //'allowEmpty'    => !Captcha::checkRequirements(),
          'caseSensitive' => false,
          'captchaAction' => '/front/default/captcha',
        ];
        return $result;
    }
}