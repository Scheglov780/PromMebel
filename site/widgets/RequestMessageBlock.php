<?php

namespace app\widgets;

use yii\base\Widget;
use app\models\RequestMessageForm;
use Yii;

/*******************************************************************************************************************
 * This file is the part of VPlatform project https://info92.ru
 * Copyright (C) 2013-2020, info92 team
 * All rights reserved and protected by law.
 * You can't use this file without of the author's permission.
 * ====================================================================================================================
 * <description file="customBlogAttachedBlock.php">
 * </description>
 **********************************************************************************************************************/
class RequestMessageBlock extends Widget
{

    public $alertTypes = [
      'quick-order-error'   => 'sm-alert-error',
      'quick-order-danger'  => 'sm-alert-danger',
      'quick-order-success' => 'sm-alert-success',
      'quick-order-info'    => 'sm-alert-info',
      'quick-order-warning' => 'sm-alert-warning',
      'quick-order-custom' => 'sm-alert-custom',
    ];
    /**
     * @var bool widget as button?
     */
    public $asButton = false;
    public $debug = false;
    public $email = '';
    public $id = null;
    /**
     * @var string
     */
    public $comment = '';
    public $name = '';
    public $phone = '';
    public $subj = '';
    public $completeMessage = '';
    /**
     * @var bool
     */
    public $useCaptcha = true;
    /**
     * @var string|null use sender email as from email?
     */
    public $useEmailAsSender = true;

    private function processAlerts()
    {
        $result = [];
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        foreach ($flashes as $type => $flash) {
            if (isset($this->alertTypes[$type])) {
                foreach ((array) $flash as $i => $message) {
                    $result[$this->alertTypes[$type]] = $message;
                }
                $session->removeFlash($type);
            }
        }
        return $result;
    }

    public function init() {
        if ($this->debug) {
            $this->email = 'test@mailwerwer.ru';
            $this->name = 'Василий';
            $this->phone = '2128506';
            defined('YII_TEST_CAPTCHA') or define('YII_TEST_CAPTCHA',true);
        }
        parent::init();
    }

    public function run()
    {
        parent::run();
        if (!$this->id) {
            $this->id = uniqid('requestMessage-');
        }
        $model = new RequestMessageForm();
        if ($this->email) {
            $model->email = $this->email;
        }
        if ($this->phone) {
            $model->phone = $this->phone;
        }
        if ($this->name) {
            $model->name = $this->name;
        }
        if ($this->subj) {
            $model->subj = $this->subj;
        }
        if ($this->comment) {
            $model->comment = $this->comment;
        }
        if (defined('YII_TEST_CAPTCHA')) {
            $model->verifyCode = 'test';
        }
        $alerts = $this->processAlerts();
        return $this->render(
          'RequestMessageBlock',
          [
            'model'  => $model,
            'alerts' => $alerts
          ],

        );
    }

}
