<?php

namespace app\modules\front\controllers;

use app\models\ar\Category;
use app\models\ar\City;
use app\models\ar\Params;
use app\models\ar\Product;
use app\models\ar\Service;
use app\models\ar\Page;
use idna_convert;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;

class BaseController extends Controller
{
    public $cartProducts;
    public $cartProductsCount = 0;
    public $cartText;
    /** переменные с html деревом для постройки меню */
    public $categories;
    public $categoriesMobile;
    public $cats;
    /**
     * @var City[]
     */
    public $cities;
    /**
     * @var City
     */
    public $city;
    public $comparisonProducts;
    public $comparisonProductsCount = 0;
    public $comparisonText;
    public $domain;
    public $email;
    public $favoriteProducts;
    public $favoriteProductsCount = 0;
    public $favoriteText;
    public $pagesonmain;
    /* Переменная с родительскими категориями */
    /**
     * @var Params
     */
    public $params;
    public $phone;
    /**
     * @var Service[]
     */
    public $services;

    private function purifyMetaText($text)
    {
        return trim(preg_replace('/[\r\n\s]+/ism', ' ', htmlspecialchars(strip_tags(html_entity_decode($text)))));
    }

    protected function setMeta(
      $title = null,
      $desc = null,
      $keywords = null,
      $placeholdersCustom = [],
      $varsCustom = []
    ) {
        $placeholders = [
          '{city_name}',
          '{city_name_pad_1}',
          '{city_name_pad_2}',
        ];
        $placeholders = array_merge($placeholders, $placeholdersCustom);
        $vars = [
          $this->city->name,
          $this->city->name_pad_1,
          $this->city->name_pad_2,
        ];
        $vars = array_merge($vars, $varsCustom);
        $title = str_replace($placeholders, $vars, $title);
        $desc = str_replace($placeholders, $vars, $desc);
        $keywords = str_replace($placeholders, $vars, $keywords);
        \Yii::$app->view->title = $this->purifyMetaText($title);
        \Yii::$app->view->registerMetaTag(
          [
            'name'    => 'description',
            'content' => $this->purifyMetaText($desc)
          ]
        );
        \Yii::$app->view->registerMetaTag(
          [
            'name'    => 'keywords',
            'content' => $this->purifyMetaText($keywords)
          ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
          'error'   => [
            'class' => 'yii\web\ErrorAction',
          ],
          'captcha' => [
            'class'           => 'yii\captcha\CaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST || defined('YII_TEST_CAPTCHA') ? 'testme' : null,
              //Background color
            'backColor'       => 0x000000,
              //Maximum number of displays
            'maxLength'       => 4,
              //Minimum number of displays
            'minLength'       => 4,
              //Spacing
            'padding'         => 2,
              //Height
            'height'          => 30,
              //Width
            'width'           => 85,
              //Font color
            'foreColor'       => 0xffffff,
              //Set character offset
            'offset'          => 4,
          ],
        ];
    }

    function coderurl($url)
    {
        include_once(\Yii::getAlias('@app/idna_convert.class.php'));
        $idn = new idna_convert();
        $url = (stripos($url, 'xn--') !== false) ? $idn->decode($url) : $url;

        return $url;
    }

    public function init()
    {
        parent::init();

        $city = null;
        $dommainArray = explode('.', $_SERVER['HTTP_HOST']);
        if (count($dommainArray) > 2) {
            $this->domain = substr(strstr($_SERVER['HTTP_HOST'], '.'), 1);
            $city = $this->coderurl($dommainArray[0]);
        } else {
            $this->domain = $_SERVER['HTTP_HOST'];
        }

        $this->cities = [];
        $this->params = Params::get();
        $cities = City::find()->indexBy('alias')->orderBy('name')->all();
        if (isset($cities[$city])) {
            $this->city = $cities[$city];
        } else {
            $this->city = City::find()->where(['id' => $this->params->main_domain])->one();
        }

        $this->email = empty($this->city->email) || !isset($city) ? $this->params->email : $this->city->email;
        $this->phone = empty($this->city->phone) || !isset($city) ? $this->params->phone : $this->city->phone;
        foreach ($cities as $c) {
            $fl = mb_substr($c->name, 0, 1);
            $this->cities[$fl][] = $c;
        }

        $text = 'В корзине пусто';
        $products = \Yii::$app->session->get('products');
        $this->cartProducts = Product::getCartProducts($products);
        if ($this->cartProducts) {
            ArrayHelper::getColumn($this->cartProducts, 'count');
            $this->cartProductsCount = array_sum(ArrayHelper::getColumn($this->cartProducts, 'count'));
            $text = \Yii::t(
              'app',
              'В корзине {n, plural, =0{нет товаров} =1{1 товар} one{# товар} few{# товара} many{# товаров} other{# товара}}',
              ['n' => $this->cartProductsCount]
            );
        }
        $this->cartText = $text;

        $text = 'В избранном пусто';
        $products = \Yii::$app->session->get('favorites');
        $this->favoriteProducts = Product::getFavoriteProducts($products);

        if ($this->favoriteProducts) {
            ArrayHelper::getColumn($this->favoriteProducts, 'count');
            $this->favoriteProductsCount = array_sum(ArrayHelper::getColumn($this->favoriteProducts, 'count'));

            $text = \Yii::t(
              'app',
              'В избранном {n, plural, =0{нет товаров} =1{1 товар} one{# товар} few{# товара} many{# товаров} other{# товара}}',
              ['n' => $this->favoriteProductsCount]
            );
        }
        $this->favoriteText = $text;

        $text = 'В сравнении пусто';
        $products = \Yii::$app->session->get('comparisons');
        $this->comparisonProducts = Product::getComparisonProducts($products);

        if ($this->comparisonProducts) {
            ArrayHelper::getColumn($this->comparisonProducts, 'count');
            $this->comparisonProductsCount = array_sum(ArrayHelper::getColumn($this->comparisonProducts, 'count'));
            $text = \Yii::t(
              'app',
              'В сравнении {n, plural, =0{нет товаров} =1{1 товар} one{# товар} few{# товара} many{# товаров} other{# товара}}',
              ['n' => $this->comparisonProductsCount]
            );
        }
        $this->comparisonText = $text;

        $this->categories[2] = Category::getCategoriesTree(2);

        $this->categoriesMobile[2] = Category::getCategoriesTree(2, true);

        $this->categories[3] = Category::getCategoriesTree(3);

        $this->categoriesMobile[3] = Category::getCategoriesTree(3, true);

        $this->categories[232] = Category::getCategoriesTree(232);

        $this->categoriesMobile[232] = Category::getCategoriesTree(232, true);

        $this->categories[234] = Category::getCategoriesTree(234);

        $this->categoriesMobile[234] = Category::getCategoriesTree(234, true);

        $this->cats = Category::find()->andWhere(['id' => [2, 3, 232, 234]])->indexBy('id')->all();

        $this->services = Service::find()->orderBy('order')->all();

        $this->pagesonmain = Page::find()->andWhere(['footercolumn' => [1]])->indexBy('id')->all();
    }
}