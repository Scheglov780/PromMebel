<?php

namespace app\modules\front\controllers;

use app\models\ar\Category;
use app\models\ar\Order;
use app\models\ar\Product;
use app\models\Currency;
use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Default controller for the `front` module
 */
class ProductController extends BaseController
{
    private function cartContent($print = false)
    {
        $order = new Order();
        if ($order->load(\Yii::$app->request->post()) && $order->save()) {

            \Yii::$app->session->remove('products');

            return $this->redirect(Url::current());
        }

        $sessionProducts = \Yii::$app->session->get('products');
        /** @var $products Product[] */
        $products = Product::find()->andWhere(['id' => @array_keys($sessionProducts)])->indexBy('id')->all();

        $sum = 0;
        $mass = 0;
        $value = 0;
        foreach ($products as $id => $product) {
            $products[$id]->count = $sessionProducts[$id];
            $sum += $product->getActualPrice(true) * $sessionProducts[$id];
            $mass += @$product->propertyValue[3]->value * $sessionProducts[$id];
            $value += @$product->propertyValue[2]->value * $sessionProducts[$id];
        }
        $checks = \Yii::$app->request->getQueryParam('checks');
        $checks = $checks ?? [];
        $checks = array_keys($checks);

        $fields = \Yii::$app->request->getQueryParam('fields', []);

        $content = $this->renderPartial(
          'cartPdf',
          [
            'products' => $products,
            'sum'      => $sum,
            'mass'     => $mass,
            'value'    => $value,
            'order'    => $order,
            'checks'   => $checks,
            'fields'   => $fields,
            'print'    => $print,
          ]
        );

        return $content;
    }

    protected function processNewOrder($order = null)
    {
        if (YII::$app->request->isPost && isset($_POST['QuickOrderForm'])) {
            $orderPost = ['Order' => $_POST['QuickOrderForm']];
            $quick = true;
        } elseif (YII::$app->request->isPost && isset($_POST['Order'])) {
            $orderPost = $_POST;
            $quick = false;
        } else {
            $orderPost = [];
            $quick = false; //@todo Обработать потом, если параметры не заданы
        }
        /** @var Order $order */
        if (empty($order)) {
            $order = new Order(['scenario' => 'fromcart']); //
        }
        if ($order->load($orderPost)) {
            $order->region = $this->city->name;
            if ($order->save()) {
                if (!is_array($order->products)) {
                    $orderProducts = json_decode($order->products, true);
                } else {
                    $orderProducts = $order->products;
                }
                /** @var $products Product[] */
                $products = Product::find()
                  ->andWhere(['id' => @array_keys($orderProducts)])
                  ->indexBy('id')
                  ->all();
                $recommendedProducts = [];
                $print = false;
                /* Письмо менеджерам */
                $mail = \Yii::$app->mailer->compose(
                  'mail_order',
                  ['order' => $order, 'products' => $products, 'counts' => $orderProducts]
                )
                  ->setFrom(['send@pmzakaz.ru' => 'Новый заказ'])
                  ->setTo(empty($this->city->email) ? $this->params->email : $this->city->email)
                  // ->setCc('00.00@mail.ru')
                  ->setSubject('Новый заказ №' . $order->id); // тема письма
                if (!empty($order->file_name)) {
                    $mail->attach('/home/p/pmhosting3/public_html/web/static/orders/' . $order->file_name);
                }
                $mail->getSwiftMessage()->setEncoder(
                  new \Swift_Mime_ContentEncoder_Base64ContentEncoder()
                );
                $result = $mail->send(); //->toString();//->send();
                /* Письмо клиенту */
                $mail = \Yii::$app->mailer->compose(
                  'mail_order_feed',
                  ['order' => $order, 'products' => $products, 'counts' => $orderProducts]
                )
                  ->setFrom(['send@pmzakaz.ru' => 'Ваш новый заказ'])
                  ->setTo($order->email)
                  //  ->setCc('00.00@mail.ru')
                  ->setSubject('Ваш новый заказ №' . $order->id); // тема письма
                if (!empty($order->file_name)) {
                    $mail->attach('/home/p/pmhosting3/public_html/web/static/orders/' . $order->file_name);
                }
                $mail->getSwiftMessage()->setEncoder(
                  new \Swift_Mime_ContentEncoder_Base64ContentEncoder()
                );
                $result = $result && $mail->send(); //->toString();//->send();
                if ($result) {
                    if (!$quick) {
                        \Yii::$app->session->remove('products');
                    }
                    if ($quick) {
                        \Yii::$app->session->addFlash(
                          'quick-order-custom',
                          (!empty($_POST['QuickOrderForm']['completeMessage']) ?
                            $_POST['QuickOrderForm']['completeMessage'] : \Yii::t('app', 'Сообщения отправлены'))
                        );
                    }
                } else {
                    \Yii::$app->session->addFlash(
                      'quick-order-error',
                      \Yii::t('app', 'Внутренняя ошибка отправки сообщений')
                    );
                }
                if ($quick) {
                    return $this->redirect($_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/');
                } else {
                    return $this->redirect('/vash-zakaz-prinyat');
                }
            }
        }
        \Yii::$app->session->addFlash(
          'quick-order-error',
          \Yii::t('app', 'Ошибка обработки заказа')
        );
        return $this->redirect($_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '/');
    }

    public function actionAddToCart()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;
        $products = [];
        $totalCount = 0;
        if ($request->isAjax) {
            $array = $request->post('data');
            if (empty($array)) {
                $array = [];
            }
            $sessionProducts = $session['products'] ?? [];
            if (empty($sessionProducts)) {
                $sessionProducts = [];
            }
            $count = 0;
            foreach ($array as $row) {
                $id = $row['id'];
                $count = $row['count'];
                if ($count == 0) {
                    continue;
                }
                $product = Product::find()->andWhere(['id' => $id])->one();
                if (isset($sessionProducts[$id])) {
                    $sessionProducts[$id] = $sessionProducts[$id] + $count;
                } else {
                    $sessionProducts[$id] = $count;
                }
                $products[] = $product;
            }
            $session->set('products', $sessionProducts);
            $totalCount = array_sum($sessionProducts);
            $response['cartCount'] = $totalCount;
            $this->layout = false;

            $response['html'] = $this->render(
              '/product/_cart_items',
              [
                'products' => Product::getCartProducts($sessionProducts),
                'isPopup'  => true,
              ]
            );

            $popupText = \Yii::t(
              'app',
              '{n, plural, =0{Нет товаров} =1{Товар} one{Товар} few{Товары} many{Товары} other{Товары}} ',
              ['n' => count($products)]
            );
            foreach ($products as $prod) {
                $popupText .= Html::a($prod->name, $prod->link, ['class' => 'product-name']) . ' ';
            }
            $popupText .= \Yii::t(
              'app',
              ' успешно {n, plural, =0{добавлено} =1{добавлен} one{добавлен} few{добавлены} many{добавлены} other{добавлены}} в корзину.',
              ['n' => count($products)]
            );
            $response['popup'] = $popupText;
            $response['messageText'] = '';

            return $response;
        }
    }

    public function actionAddToComparison()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;
        $comparisons = [];
        $totalCount = 0;
        if ($request->isAjax) {
            $array = $request->post('data');
            $sessionComparisons = $session['comparisons'] ?? [];
            unset($sessionComparisons['NaN']);
            foreach ($array as $row) {
                $id = $row['id'];
                $comparison = Product::find()->andWhere(['id' => $id])->one();
                if (!empty($comparison) && !empty($id)) {
                    if (empty($sessionComparisons[$id])) {
                        $sessionComparisons[$id] = 1;
                    }
                    if (empty($comparisons[$id])) {
                        $comparisons[$id] = $comparison;
                    }
                }
            }
            $session->set('comparisons', $sessionComparisons);
            if (!empty($sessionComparisons)) {
                $totalCount = count($sessionComparisons);
            }

            $response['comparisonCount'] = $totalCount;

            $this->layout = false;

            $response['html'] = $this->render(
              '/product/_comparison_items',
              [
                'comparisons' => Product::getComparisonProducts($sessionComparisons),
              ]
            );

            $popupText = \Yii::t(
              'app',
              '{n, plural, =0{Нет товаров} =1{Товар} one{Товар} few{Товары} many{Товары} other{Товары}} ',
              ['n' => count($comparisons)]
            );
            foreach ($comparisons as $comparison) {
                $popupText .= Html::a($comparison->name, $comparison->link, ['class' => 'product-name']) . ' ';
            }
            $popupText .= \Yii::t(
              'app',
              ' успешно {n, plural, =0{добавлено} =1{добавлен} one{добавлен} few{добавлены} many{добавлены} other{добавлены}} в сравнение.',
              ['n' => count($comparisons)]
            );
            $response['popup'] = $popupText;
            $response['messageText'] = '';
            return $response;
        }
    }

    public function actionAddToFavorite()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;
        $favorites = [];
        $totalCount = 0;
        if ($request->isAjax) {
            $array = $request->post('data');
            $sessionFavorites = $session['favorites'] ?? [];
            unset($sessionFavorites['NaN']);
            foreach ($array as $row) {
                $id = $row['id'];
                $favorite = Product::find()->andWhere(['id' => $id])->one();
                if (!empty($favorite) && !empty($id)) {
                    if (empty($sessionFavorites[$id])) {
                        $sessionFavorites[$id] = 1;
                    }
                    if (empty($favorites[$id])) {
                        $favorites[$id] = $favorite;
                    }
                }
            }
            $session->set('favorites', $sessionFavorites);
            if (!empty($sessionFavorites)) {
                $totalCount = count($sessionFavorites);
            }

            $response['favoriteCount'] = $totalCount;

            $this->layout = false;

            $response['html'] = $this->render(
              '/product/_favorite_items',
              [
                'favorites' => Product::getFavoriteProducts($sessionFavorites),
              ]
            );

            $popupText = \Yii::t(
              'app',
              '{n, plural, =0{Нет товаров} =1{Товар} one{Товар} few{Товары} many{Товары} other{Товары}} ',
              ['n' => count($favorites)]
            );

            foreach ($favorites as $favorite) {
                $popupText .= Html::a($favorite->name, $favorite->link, ['class' => 'product-name']) . ' ';
            }
            $popupText .= \Yii::t(
              'app',
              ' успешно {n, plural, =0{добавлено} =1{добавлен} one{добавлен} few{добавлены} many{добавлены} other{добавлены}} в избранное.',
              ['n' => count($favorites)]
            );
            $response['popup'] = $popupText;
            $response['messageText'] = '';

            return $response;
        }
    }

    public function actionCart()
    {
        \Yii::$app->view->title = 'Корзина';
        $order = new Order(['scenario' => 'fromcart']);
        if (YII::$app->request->isPost) {
            $this->processNewOrder($order);
        }
        $sessionProducts = \Yii::$app->session->get('products');
        /** @var $products Product[] */
        $products = Product::find()
          ->andWhere(['id' => @array_keys($sessionProducts)])
          ->indexBy('id')
          ->all();

        $ps = [];
        if (!empty($sessionProducts)) {
            foreach ($sessionProducts as $id => $sessionProduct) {
                $ps[$id] = $products[$id];
            }
        }
        $products = $ps;

        $sum = 0;
        $mass = 0;
        $value = 0;
        $recommendedProducts = [];
        foreach ($products as $id => $product) {
            $products[$id]->count = $sessionProducts[$id];
            $sum += $product->getActualPrice(true) * $sessionProducts[$id];
            $mass += @$product->propertyValue[3]->value * $sessionProducts[$id];
            $value += @$product->propertyValue[2]->value * $sessionProducts[$id];
            if (!empty($product->recommendedProducts)) {
                $recommendedProducts[] = @$product->recommendedProducts[0];
            }
        }

        return $this->render(
          'cart',
          [
            'products'            => $products,
            'sum'                 => $sum,
            'mass'                => $mass,
            'value'               => $value,
            'order'               => $order,
            'recommendedProducts' => $recommendedProducts,
          ]
        );
    }

    public function actionCartPdf()
    {
        $content = $this->cartContent();

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf(
          [
              // set to use core fonts only
            'mode'        => Pdf::MODE_UTF8,
              // A4 paper format
            'format'      => Pdf::FORMAT_A4,
              // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
              // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
              // your html content input
            'content'     => $content,
              // format content from your own css file if needed or use the
              // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile'     => '@webroot/css/print-pdf.css',
              // any css to be embedded if required
              //'cssInline'   => '',
            'filename'    => 'Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H-i') . '.pdf',
              // set mPDF properties on the fly
            'options'     => ['title' => 'Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H:i')],
              // call mPDF methods on the fly
            'methods'     => [
              'SetHeader' => ['Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H:i')],
              'SetFooter' => ['{PAGENO}'],
            ]
          ]
        );

        // return the pdf output as per the destination setting
        // $printResult =
        return $pdf->render();
        /*        \Yii::$app->response->sendContentAsFile(
                  $printResult,
                  'Заказ на '. 'промышленная-мебель.рус от '.date('Y-m-d H:i') . '.pdf',
        ['mimeType' => 'application/pdf',
          'inline' => false]
                ); */
    }

    public function actionCartPrint()
    {
        $content = $this->cartContent(true);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf(
          [
              // set to use core fonts only
            'mode'        => Pdf::MODE_UTF8,
              // A4 paper format
            'format'      => Pdf::FORMAT_A4,
              // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
              // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
              // your html content input
            'content'     => $content,
              // format content from your own css file if needed or use the
              // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile'     => '@webroot/css/print-pdf.css',
              // any css to be embedded if required
              //'cssInline'   => '',
              //'filename' => 'Заказ на сайте промышленная-мебель.рус от '.date('Y-m-d H-i').'.pdf',
              // set mPDF properties on the fly
            'options'     => ['title' => 'Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H:i')],
              // call mPDF methods on the fly
            'methods'     => [
              'SetHeader' => ['Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H:i')],
              'SetFooter' => ['{PAGENO}'],
            ]
          ]
        );
        // return the pdf output as per the destination setting
        $pdf->getApi()->title = 'Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H:i');
        $pdf->getApi()->SetJS('this.print();');
        \Yii::$app->view->title = 'Заказ на сайте промышленная-мебель.рус от ' . date('Y-m-d H:i');
        return $pdf->render();
    }

    public function actionChangeCart()
    {
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;

        if ($request->isAjax) {
            $id = $request->post('id');
            $count = $request->post('count');
            $sessionProducts = $session['products'] ?? [];

            if (isset($sessionProducts[$id])) {
                if ($count == 0) {
                    unset($sessionProducts[$id]);
                } else {
                    $sessionProducts[$id] = $count;
                }
            }
            $session->set('products', $sessionProducts);
        }
    }

    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionComparison()
    {
        \Yii::$app->view->title = 'Сравнение товаров';
        $sessionProducts = \Yii::$app->session->get('comparisons');
        /** @var $products Product[] */
        $products = Product::find()
          ->andWhere(['id' => @array_keys($sessionProducts)])
          ->indexBy('id')
          ->all();

        $ps = [];
        if (!empty($sessionProducts)) {
            foreach ($sessionProducts as $id => $sessionProduct) {
                $ps[$id] = $products[$id];
            }
        }
        $products = $ps;
        $sqlPartArr = [];
        $i = 0;
        foreach ($products as $id => $product) {
            $i = $i + 1;
            $sqlPartArr[$id] = "SELECT {$i} AS ordr, {$id} AS id";
            $products[$id]->count = $sessionProducts[$id];
        }
        if (is_array($sqlPartArr) && count($sqlPartArr)) {
            $sqlPart = implode("\r\nUNION ALL\r\n", $sqlPartArr);
            $sql = /** @lang MySQL */
              <<<TAG
SELECT
	trim(
		BOTH ',' 
	FROM
		concat(
			'"',
			trim(
				BOTH ', ' 
			FROM
				concat( replace(pv.`name`,'"','\\\'), ', ', pv.value_name )),
			'":{',
			group_concat( concat( '"',replace(pr.product_id,'"','\\\'), '":"', replace(pr.`value`,'"','\\\'), '"' ) 
			    ORDER BY ll.ordr ASC SEPARATOR ',' ),
			'},' 
		)) AS props_vals 
FROM
	( {$sqlPart} ) ll
	LEFT JOIN product pp ON ll.id = pp.id
	LEFT JOIN property_to_product pr ON pp.id = pr.product_id
	LEFT JOIN property pv ON pv.id = pr.property_id 
GROUP BY
	pv.type,
	pv.`name` 
	having props_vals is not null
ORDER BY
	count(pr.product_id) DESC, pv.`order` ASC
TAG;
            // echo $sql; die;
            $comparisons = Product::findBySql(
              $sql,
              []
            )->column();
            $comparisonsStr = '{' . implode(',', $comparisons) . '}';
            $comparisons = json_decode($comparisonsStr, true);
        } else {
            $comparisons = [];
        }
        //VarDumper::dump($comparisons, 10, true); die;
        return $this->render(
          'comparison',
          [
            'products'    => $products,
            'comparisons' => $comparisons,
          ]
        );
    }

    public function actionDeleteFromCart()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;

        if ($request->isAjax) {
            $id = $request->post('id');
            if ($id === '0') {
                $session->remove('products');
            }
            $count = $request->post('count');
            $sessionProducts = $session['products'] ?? [];

            if (isset($sessionProducts[$id])) {
                if ($count == 0) {
                    unset($sessionProducts[$id]);
                } else {
                    $sessionProducts[$id] -= $count;
                }
            }

            $session['products'] = $sessionProducts;
            /** @var $products Product[] */
            $products = Product::find()->andWhere(['id' => @array_keys($sessionProducts)])->indexBy('id')->all();

            $sum = 0;
            $mass = 0;
            $value = 0;
            foreach ($products as $id => $product) {
                $products[$id]->count = $sessionProducts[$id];
                $sum += $product->getActualPrice(true) * $sessionProducts[$id];
                $mass += @$product->propertyValue[3]->value * $sessionProducts[$id];
                $value += @$product->propertyValue[2]->value * $sessionProducts[$id];
            }

            return [
              'count'       => array_sum($sessionProducts),
              'sum'         => Currency::priceWrapper($sum),
              'sum_value'   => round($value, 2),
              'sum_mass'    => round($mass, 2),
              'messageText' => ''
            ];
        }
    }

    public function actionDeleteFromComparison()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;

        if ($request->isAjax) {
            $id = $request->post('id');
            if ($id === '0') {
                $session->remove('comparisons');
            }
            $sessionComparisons = $session['comparisons'] ?? [];

            if (isset($sessionComparisons[$id])) {
                unset($sessionComparisons[$id]);
            }

            /** @var $products Product[] */
            $products = Product::find()->andWhere(['id' => @array_keys($sessionComparisons)])->indexBy('id')->all();

            foreach ($sessionComparisons as $id => $comparison) {
                if (!isset($products[$id])) {
                    unset($sessionComparisons[$id]);
                }
            }
            $session['comparisons'] = $sessionComparisons;
            return [
              'count'       => count($sessionComparisons),
              'messageText' => ''
            ];
        }
    }

    public function actionDeleteFromFavorite()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;

        if ($request->isAjax) {
            $id = $request->post('id');
            if ($id === '0') {
                $session->remove('favorites');
            }
            $sessionFavorites = $session['favorites'] ?? [];

            if (isset($sessionFavorites[$id])) {
                unset($sessionFavorites[$id]);
            }

            /** @var $products Product[] */
            $products = Product::find()->andWhere(['id' => @array_keys($sessionFavorites)])->indexBy('id')->all();

            foreach ($sessionFavorites as $id => $favorite) {
                if (!isset($products[$id])) {
                    unset($sessionFavorites[$id]);
                }
            }
            $session['favorites'] = $sessionFavorites;
            return [
              'count'       => count($sessionFavorites),
              'messageText' => ''
            ];
        }
    }

    public function actionFavorite()
    {
        \Yii::$app->view->title = 'Избранные товары';
        $sessionProducts = \Yii::$app->session->get('favorites');
        /** @var $products Product[] */
        $products = Product::find()
          ->andWhere(['id' => @array_keys($sessionProducts)])
          ->indexBy('id')
          ->all();
        return $this->render(
          'favorite',
          [
            'products' => $products,
          ]
        );
    }

    public function actionQuickOrder()
    {
        return $this->processNewOrder();
    }

    public function actionSearch()
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;
        $this->layout = false;
        $request = \Yii::$app->request;

        if ($request->isAjax) {
            $text = $request->post('text');
            if (empty($text)) {
                return false;
            }
            $fullTextQuery = /** @lang MySQL */
              "select ss.*,
			greatest(coalesce(ss2.score,0),
							case 
							when isnull(pp3.id) then 0
							else 100 end,
							case 
							when isnull(pp4.id) then 0
							else 90 end) as score
								from product ss use index (idx_id_name,`FTS_name_description`) use key (PRIMARY)
LEFT JOIN (select pp2.id, MATCH(pp2.`name`,pp2.`description`)
              AGAINST (:search_text IN NATURAL LANGUAGE MODE) as score from product pp2
							use index (idx_id_name,`FTS_name_description`)
							where MATCH(pp2.`name`,pp2.`description`)
              AGAINST (:search_text IN NATURAL LANGUAGE MODE) > 0 AND LENGTH(:search_text) > 3
							order by score desc) ss2 on ss2.id = ss.id
LEFT JOIN product pp3 use index (idx_id_name) 
on (pp3.id = ss.id and pp3.`name` like binary concat(:search_text_like,'%'))
LEFT JOIN product pp4 use index (idx_id_name) 
on (pp4.id = ss.id and pp4.`name` like binary concat('% ',:search_text_like,'%'))
 having score > 0
 order by score desc, ss.name ASC
limit 100";

            //$searchText = preg_replace('/\b([A-ZА-Я0-9\-\+\/]+)\b\s*/u', ' +"$1" ', $text);
            //$searchText = preg_replace('/\b([a-zа-я]{4,})\b/iu', '+$1', $searchText);
            $searchText = trim(preg_replace('/\s+/iu', ' ', $text));
            $searchTextLike = trim($text);
            $products = Product::findBySql(
              $fullTextQuery,
              [
                ':search_text'      => $searchText,
                ':search_text_like' => $searchTextLike
              ]
            )->with(['productImgs'])->all();
            /** @todo Может быть, здесь следовало бы санитизировать запрос: $quoteValue = \Yii::$app->db->quoteValue($value); */
            return $this->render(
              '_search_popup',
              [
                'products' => $products
              ]
            );
        }
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView($slug, $productSlug)
    {
        /** @var $category Category */
        $category = Category::find()->andWhere(['slug' => $slug])->with(['parent.parent'])->one();
        if (empty($category)) {
            $category = Category::find()->andWhere(['slug' => $slug])->with(['parent'])->one();
        }
        /** @var $product Product */
        $product = Product::find()
          ->andWhere(['type' => Product::TYPE_PRODUCT])
          ->andWhere(['slug' => $productSlug])
          ->andWhere(['category_id' => $category->id??0])
          ->with(
            [
              'productImgs',
              'recommendedProducts.category',
              'relatedProducts.category',
              'relatedProducts.propertyValue.property',
              'relatedProducts.productImgs',
              'propertyValue.property'
            ]
          )
          ->one();
        if (empty($product)) {
            throw new NotFoundHttpException('Этот товар не найден');
        }
        $breadcrumbs = array_reverse(Category::getBreadcrumbs($category));
        array_push($breadcrumbs, $product->name);

        $title = $product->meta_title ?? $this->params->meta_title_product;
        $desc = $product->meta_description ?? $this->params->meta_desc_product;
        $keywords = $product->meta_keywords ?? $this->params->meta_keywords_product;

        $this->setMeta(
          $title,
          $desc,
          $keywords,
          ['{category_name}', '{product_name}', '{product_price}', '{product_description}'],
          [$category->name, $product->name, $product->actualPrice, str_replace("\n", "", $product->description)]
        );
        return $this->render(
          'view',
          [
            'category'    => $category,
            'product'     => $product,
            'breadcrumbs' => $breadcrumbs,
          ]
        );
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
