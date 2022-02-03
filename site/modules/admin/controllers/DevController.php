<?php

namespace app\modules\admin\controllers;

use app\models\ar\Brand;
use app\models\ar\Manufacturer;
use app\models\ar\Category;
use app\models\ar\Product;
use app\models\ar\Property;
use app\models\ar\PropertyToProduct;
use SimpleXLSX;
use SpreadsheetReader;
use Yii;
use app\models\ar\Order;
use app\models\search\OrderSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class DevController extends Controller
{

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionUploadExcel()
    {
        $model = new \yii\base\DynamicModel(['excel']);
        $model->addRule(['excel'], 'required')->addRule(['email'], 'file');

        if ($model->load(Yii::$app->request->post())) {
            $totalProduct = 0;
            ini_set('max_execution_time', 0);
            $file = UploadedFile::getInstance($model, 'excel');

            require_once \Yii::getAlias('@app/models/simplexlsx.class.php');
            $xlsx = new SimpleXLSX($file->tempName);
            $sheet = $xlsx->rows(1);


            if (!$sheet) {
                Yii::$app->session->addFlash('danger', 'Неверный формат файла');
                return $this->render('index', ['model' => $model]);
            }
            $prop = [];
            foreach ($sheet[0] as $id => $p) {
                if (in_array($id, [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 16])) {
                    continue;
                }
                $ar = explode(',', $p);
                $pr = Property::find()->where(['name' => trim($ar[0])])->one();
                if (!isset($pr)) {
                    $pr = new Property();
                    $pr->name = trim($ar[0]);
                    $pr->value_name = (!empty($ar[1])?trim($ar[1]) : ' ');
                    $pr->type = null;
                    $pr->save();
                }

                $prop[$id] = $pr->id;
            }

            unset($sheet[0]);

            /**
             * + 0 - Заголовок 45 символов
             * + 1 - Категория (slug)
             * + 2 - Описание
             * + 3 - Цена, руб.
             * + 4 - Бренд (slug)
             * + 5 - Краткое описание 55 символов
             * + 6 - Order (порядок товаров в виде)
             * + 7 - Исполнение (0 - Общепромышленное \ 1 - Антистатическое)
             * + 8 - Срок поставки (0 - со склада \ 1 - под заказ)
             * + 9 - Статус (вывод на страницу Бренда: 0 - скрыт \ 1 - опубликован)
             * + 10 - Конструктор (ссылка)
             * + 11 - Цена EUR
             * + 12 - Изображение
             * + 13 - Файлы
             * 14 - Антистатическая ESD защита
             * 15 - Габаритные размеры, мм
            * + 16 - Цена GRB
            * + 17 - Срок поставки
            * + 18 - Доставка
            * 19 - "Электропитание"
            * 20 - Мощность, Вт
            * 21 - Уровень шума, дБ
            * 22 - Производительность, м3 в час
            * 23 - Гарантия, год
            * 24 - Срок службы, лет
            * 25 - Масса, кг
            * 26 - Объем упаковки, м3
            * 27 - Артикул
             */


            foreach ($sheet as $row) {
                if (empty($row[0])) {
                    continue;
                }
                $p = Product::find()->where(['name' => $row[0]])->one();
                if (isset($p)) {
                    Yii::$app->session->addFlash('danger', 'Товар с таким именем уже существует: ' . $row[0]);
                    continue;
                }

                $product = new Product();
                $product->name = trim($row[0]);
                $category = Category::find()->where(['slug' => $row[1]])->one();
                if (!isset($category)) {
                    Yii::$app->session->addFlash('danger', 'Неверная категория для товара: ' . $row[0]);
                    continue;
                }
                $product->category_id = $category->id;
                if (!empty($row[4])) {
                    $brand = Brand::find()->where(['slug' => $row[4]])->one();
                    if (!isset($brand)) {
                        Yii::$app->session->addFlash('danger', 'Неверный бренд для товара: ' . $row[0]);
                        continue;
                    }
                    $product->brand_id = $brand->id;
                }
                //@todo Раскомментить для обработки производителей, прописать правильный индекс в $row
                /* if(!empty($row[4])) {
                    $manufacturer = Manufacturer::find()->where(['slug' => $row[4]])->one();
                    if(!isset($manufacturer)) {
                        Yii::$app->session->addFlash('danger', 'Неверный производитель для товара: '.$row[0]);
                        continue;
                    }
                    $product->manufacturer_id = $manufacturer->id;
                } */
                $product->description = $row[2];
                $product->description_short = $row[5];
                $product->price = $row[3];
                $product->order = empty($row[6]) ? 9999 : (int) $row[6];
                $product->execution = empty($row[7]) ? 0 : (int) $row[7];
                $product->delivery_type = empty($row[8]) ? 0 : (int) $row[8];
                $product->status = empty($row[9]) ? 0 : (int) $row[9];
                $product->construct_link = empty($row[10]) ? null : $row[10];
                $product->price_eur = empty($row[11]) ? null : $row[11];
                $product->price_gbp = empty($row[16]) ? null : $row[16];

                $propArray = [];
                foreach ($row as $id => $prope) {
                    if (isset($prop[$id])) {
                        $propArray[$prop[$id]] = $prope;

                    }
                }

                $product->propertiesArray = $propArray;
                //@todo Добавить 'manufacturer_id' если будет использоваться импорт производителей
                if (!$product->save(
                  true,
                  [
                    'price',
                    'name',
                    'category_id',
                    'construct_link',
                    'description_short',
                    'description',
                    'brand_id',
                    'slug',
                    'price_eur',
                    'price_gbp',
                    'status',
                    'order',
                    'execution',
                    'delivery_type'
                  ]
                )) {
                    Yii::$app->session->addFlash('danger', 'Ошибка сохранения товара: ' . $row[0] ."<br>".current($product->firstErrors));
                    continue;
                }
                //Yii::$app->db->getLastInsertID();
                if (empty($product->id)) {
                    Yii::$app->session->addFlash('danger', 'Ошибка сохранения товара: ' . $row[0] ."<br>Пустой ID товара");
                    continue;
                }
                $lastid = $product->id;
                $imgarr = $row[12];
                $filegarr = $row[13];
                if (isset($imgarr)) {
                    $imgarr = explode(',', $imgarr);
                    foreach ($imgarr as $imgarrelem) {

                        Yii::$app->db->createCommand(
                          "INSERT INTO 
    product_img (product_id,[[name]],[[order]]) values (:product_id,:name,:order)",
                          [
                            ':product_id' => $lastid,
                            ':name'       => $imgarrelem,
                            ':order'      => '99999'
                          ]
                        )->execute();
                    }
                }
                //@todo Добавить аналогичный блок для производителей
                if (isset($filegarr)) {
                    $filegarr = explode(',', $filegarr);
                    foreach ($filegarr as $filegarrelem) {
                        Yii::$app->db->createCommand(
                          "insert into file_to_brand (brand_id, [[name]], [[type]])
values (:brand_id, :name, :type)",
                          ['brand_id' => $lastid, 'name' => $filegarrelem, 'type' => '2']
                        )->execute();
                    }
                }

                if ($product->hasErrors()) {
                    Yii::$app->session->addFlash(
                      'danger',
                      'Ошибка сохранения товара: ' .
                      $row[0] . ' - "' . current($product->firstErrors) . '"'
                    );
                } else {
                    $totalProduct++;
                }
            }

            Yii::$app->session->addFlash('success', 'Успешно добавлено товаров: ' . $totalProduct);
        }

        return $this->render('index', ['model' => $model]);
    }
}
