<?php

namespace app\modules\front\controllers;

use app\models\ar\City;
use app\models\ar\News;
use app\models\ar\Service;
use app\models\ar\Slider;
use app\models\RequestMessageForm;
use app\models\ScheduledJobs;
use Yii;
use yii\base\DynamicModel;
use yii\web\Response;

/**
 * Default controller for the `front` module
 */
class DefaultController extends BaseController
{

    public function actionAjaxMessage()
    {
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new DynamicModel(['name', 'phone']);
            $model
              ->addRule(['name', 'phone'], 'required', ['message' => "Заполниите поле"])
              ->addRule(['name', 'phone'], 'string', ['tooLong' => 'Не более 128 символов', 'max' => 128]);
            $model->setAttributes(\Yii::$app->request->post());
            if ($model->validate()) {
                $result = \Yii::$app->mailer->compose()
                  ->setFrom(['send@pmzakaz.ru' => 'Заявка на обратный звонок'])
                  ->setTo(empty($this->city->email) ? $this->params->email : $this->city->email)
                  ->setSubject('Заявка на обратный звонок') // тема письма
                  ->setTextBody("Имя: $model->name \n Телефон: $model->phone")
                  ->setHtmlBody("<p><b>Имя:</b> $model->name <br> <b>Телефон:</b> $model->phone</p>")
                  ->send();
                return ['result' => $result, 'message' => "Спасибо за ваше обращение! Мы с вами обязательно свяжемся."];
            } else {
                return [
                  'result' => false,
                  'errors' => $model->firstErrors,
                ];
            }
        }
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $sliders = Slider::find()->orderBy('order')->all();
        $news = News::find()->orderBy('created_at DESC')->limit(3)->all();
        $cities = City::find()->all();
        $services = Service::find()->orderBy('order')->limit(5)->all();

        $this->setMeta(
          $this->params->meta_title_main,
          $this->params->meta_desc_main,
          $this->params->meta_keywords_main
        );

        return $this->render(
          'index',
          [
            'sliders'  => $sliders,
            'news'     => $news,
            'cities'   => $cities,
            'services' => $services,
          ]
        );
    }

    public function actionRequestMessage()
    {
        if (YII::$app->request->isPost && isset($_POST['RequestMessageForm'])) {
            $message = new RequestMessageForm(); //
            $message->setAttributes($_POST['RequestMessageForm']);
            if ($message->validate()) {
                $mail = \Yii::$app->mailer->compose('mail_request', ['model' => $message])
                  ->setFrom(['send@pmzakaz.ru' => 'Новый запрос'])
                  ->setTo(empty($this->city->email) ? $this->params->email : $this->city->email)
                  //  ->setCc('00.00@mail.ru')
                  ->setSubject($message->subj); // тема письма
                $mail->getSwiftMessage()->setEncoder(
                  new \Swift_Mime_ContentEncoder_Base64ContentEncoder()
                );
                $result = $mail->send(); //->toString();//->send();
                /* Письмо клиенту */
                $mail = \Yii::$app->mailer->compose('mail_request_feed', ['model' => $message])
                  ->setFrom(['send@pmzakaz.ru' => 'Новый запрос'])
                  ->setTo($message->email)
                  //   ->setCc('00.00@mail.ru')
                  ->setSubject($message->subj); // тема письма
                $mail->getSwiftMessage()->setEncoder(
                  new \Swift_Mime_ContentEncoder_Base64ContentEncoder()
                );
                $result = $result && $mail->send(); //->toString();//->send();
                if ($result) {
                    \Yii::$app->session->addFlash(
                      'quick-order-custom',
                      (!empty($_POST['RequestMessageForm']['completeMessage']) ?
                        $_POST['RequestMessageForm']['completeMessage'] : \Yii::t('app', 'Запрос отправлен'))
                    );
                } else {
                    \Yii::$app->session->addFlash(
                      'quick-order-error',
                      \Yii::t('app', 'Внутренняя ошибка отправки запроса')
                    );
                }
                return $this->redirect(!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/');
            } else {
                \Yii::$app->session->addFlash(
                  'quick-order-error',
                  \Yii::t('app', 'Ошибка обработки запроса')
                );
            }
        }
        return $this->redirect($_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/');
    }

    public function actionScheduler()
    {
        header(
          'Access-Control-Allow-Origin: ' .
          (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] :
            (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '*'))
        );//http://777.danvit.ru
        header('Access-Control-Allow-Credentials: true');
        if (Yii::$app->request->isAjax) {
            return ScheduledJobs::schedulerEvent();
        }
    }

    public function actions()
    {
        $result = parent::actions();
        $result['captcha'] = array_replace_recursive($result['captcha'], [
            //Maximum number of displays
          'maxLength'   => 4,
            //Minimum number of displays
          'minLength'   => 4,
          'backColor'   => 0xffffff,
            //Spacing
          'padding'     => 1,
            //Height
          'height'      => 45,
            //Width
          'width'       => 95,
            //Font color
          'foreColor'   => 0x000000,
            //Set character offset
          'offset'      => 2,
          'transparent' => true,
        ]);
        return $result;
    }
}
