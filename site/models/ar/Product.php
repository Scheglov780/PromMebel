<?php

namespace app\models\ar;

use app\models\Currency;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $type
 * @property int $category_id
 * @property int $brand_id
 * @property int $manufacturer_id
 * @property int $order
 * @property int $count
 * @property int|null $delivery_type
 * @property int|null $execution
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $alt
 * @property string|null $description
 * @property string|null $description_short
 * @property string $video
 * @property string|null $construct_link
 * @property float|string $actualPrice
 * @property float|string $inFavorite
 * @property float|string $inComparison
 * @property float|null $price
 * @property float|null $price_eur
 * @property float|null $price_gbp
 * @property int $status
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string $created_at
 *
 * @property string $link
 * @property string $mainImg

 * @property Brand $brand
 * @property Manufacturer $manufacturer
 * @property Category $category
 * @property ProductImg[] $productImgs
 * @property ProductToPackages[] $productToPackages
 * @property Property[] $properties
 * @property PropertyToProduct[] $propertyValue
 * @property Product[] $relatedProducts
 * @property Product[] $recommendedProducts
 * @property Product[] $tables                  Список товаров для серии бренда @todo Ой ли?!
 * @property FileToBrand[] $files
 * @todo Пофиксить или объединить с брендами @property FileToManufacturer[] $files
 */
class Product extends BaseAR
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISH = 1;
    const TYPE_PRODUCT = 0;
    const TYPE_SERIES = 1;
    const propsToList = [];
    public $count;
    /**
     * @var UploadedFile[]
     */
    public $docFiles;
    public $img;
    public $imges;
    public $propertiesArray;
    public static $_comparisons;
    public static $_favorites;
    public static $deliveryTypes = [
      0 => 'Со склада',
      1 => 'Под заказ',
    ];
    public static $executions = [
      0 => 'Общепромышленное',
      1 => 'Антистатическое',
    ];
    public static $statusNames = [
      self::STATUS_PUBLISH  => 'Опубликован',
      self::STATUS_DISABLED => 'Скрыт',
    ];

    public function afterSave($insert, $changedAttributes)
    {
        //  Обновляем свойства товара
        $this->unlinkAll('properties', true);
        $properties = Property::find()->andWhere(['id' => array_keys($this->propertiesArray)])->all();
        foreach ($properties as $prop) {
            if (isset($this->propertiesArray[$prop->id]) && $this->propertiesArray[$prop->id] != '') {
                $this->link('properties', $prop, ['value' => $this->propertiesArray[$prop->id]]);
            }
        }

        //  Обновляем сопутсвующие и рекомендованные товары
        $this->unlinkAll('relatedProducts', true);
        $products = Product::find()->andWhere(['id' => $this->relatedProducts])->all();
        foreach ($products as $prod) {
            $this->link('relatedProducts', $prod, ['type' => ProductPackages::TYPE_RELATED]);
        }
        $this->unlinkAll('recommendedProducts', true);
        $products = Product::find()->andWhere(['id' => $this->recommendedProducts])->all();
        foreach ($products as $prod) {
            $this->link('recommendedProducts', $prod, ['type' => ProductPackages::TYPE_RECOMEND]);
        }
        $this->unlinkAll('tables', true);
        $products = Product::find()->andWhere(['id' => $this->tables])->all();
        foreach ($products as $prod) {
            $this->link('tables', $prod, ['type' => ProductPackages::TYPE_TABLES]);
        }

        $slug = $this->slug;
        //  Созадем директорию или переносим файлы если смелился слаг(название папки)
        if ($insert) {
            if (!file_exists(Yii::getAlias('@productroot/' . $this->slug))) {
                mkdir(Yii::getAlias('@productroot/' . $this->slug));
            }
        } else {
            if (isset($changedAttributes['slug']) && $this->slug !== $changedAttributes['slug']) {
                $slug = $changedAttributes['slug'];
            }
            if (!file_exists(Yii::getAlias('@productroot/' . $slug))) {
                mkdir(Yii::getAlias('@productroot/' . $slug));
            }
        }

        $oldImages = $this->getProductImgs()->indexBy('id')->all();
        //  Записываем новые файлы
        if (isset($this->imges)) {
            foreach ($this->imges as $order => $tmpImg) {
                if ($tmpImg['isNew']) {
                    $imgPath = Yii::getAlias('@webroot' . $tmpImg['value']);
                    $pathInfo = pathinfo($imgPath);
                    $newName = md5($imgPath . time()) . '.' . $pathInfo['extension'];
                    copy($imgPath, Yii::getAlias('@productroot/upl/' . $newName));

                    $img = new ProductImg();
                    $img->order = $order;
                    $img->name = $newName;
                    $img->product_id = $this->id;
                    $img->save();
                } else {
                    $img = ProductImg::findOne($tmpImg['value']);
                    if (!isset($img)) {
                        continue;
                    }
                    $img->order = $order;
                    $img->save();
                    unset($oldImages[$tmpImg['value']]);
                }
            }
        }

        foreach ($oldImages as $productImg) {
            $productImg->delete();
        }

        if (!$insert && isset($changedAttributes['slug']) && $this->slug !== $changedAttributes['slug']) {
            rename(Yii::getAlias('@productroot/' . $slug), Yii::getAlias('@productroot/' . $this->slug));
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'id'                => 'ID',
          'category_id'       => 'Категория',
          'brand_id'          => 'Бренд',
          'manufacturer_id'   => 'Производитель',
          'name'              => 'Название',
          'slug'              => 'Slug',
          'video'             => 'Шорткод видео с Youtube',
          'description'       => 'Описание',
          'description_short' => 'Короткое описание',
          'price'             => 'Цена',
          'price_eur'         => 'Цена EUR',
          'price_gbp'         => 'Цена GBP',
          'status'            => 'Статус',
          'meta_title'        => 'Meta Title',
          'meta_description'  => 'Meta Description',
          'meta_keywords'     => 'Meta Keywords',
          'created_at'        => 'Добавлен',
          'alt'               => 'Текст главного изображения',
          'type'              => 'Тип',
          'delivery_type'     => 'Срок поставки',
          'execution'         => 'Исполнение',
          'construct_link'    => 'Ссылка на конструктор',
          'order'         => 'Порядок',
        ];
    }

    public function beforeSave($insert)
    {
     /*   if ($this->type == self::TYPE_SERIES) {
            $this->category_id = 1;
        } */
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function beforeValidate()
    {
        $this->price = str_replace(',', '.', $this->price);
        $this->price_eur = str_replace(',', '.', $this->price_eur);
        $this->price_gbp = str_replace(',', '.', $this->price_gbp);

        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function behaviors()
    {
        return [
          [
            'class'         => SluggableBehavior::class,
            'attribute'     => 'name',
            'slugAttribute' => 'slug',
            'immutable'     => true,
            'ensureUnique'  => true,
            'attributes'    => [
              ActiveRecord::EVENT_BEFORE_INSERT => 'slug',
              ActiveRecord::EVENT_AFTER_UPDATE  => 'slug'
            ],
          ],
        ];
    }

    /** Возвращает цену товара в рублях с форматированием (в виде строки) или без (в виде числа)
     * @param bool $asNumber Если true - возвращает результат в виде числа для дальнейших вычислений
     * @return float|int|string|null
     */
    public function getActualPrice($asNumber = false)
    {
        $result = 0;
        if (!empty($this->price)) {
            $result = $this->price;
        } elseif (!empty($this->price_eur)) {
            $result = Currency::convertCurrency($this->price_eur, 'eur');
        } elseif (!empty($this->price_gbp)) {
            $result = Currency::convertCurrency($this->price_gbp, 'gbp');
        }
        if (!$asNumber) {
            $result = Currency::priceWrapper($result);
        }
        return $result;
    }

    /**
     * Связанный бренд
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * Связанная категория
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    public function getFiles()
    {
        return $this->hasMany(FileToBrand::class, ['brand_id' => 'id'])->andWhere(
          ['type' => FileToBrand::TYPE_PRODUCT]
        );
    }

    public function getInComparison()
    {
        if (empty(self::$_comparisons)) {
            self::$_comparisons = \Yii::$app->session['comparisons'];
        }
        return !empty(self::$_comparisons[$this->id]);
    }

    public function getInFavorite()
    {
        if (empty(self::$_favorites)) {
            self::$_favorites = \Yii::$app->session['favorites'];
        }
        return !empty(self::$_favorites[$this->id]);
    }

    public function getLink()
    {
        if ($this->type == self::TYPE_SERIES) {
            return '/series/' . $this->slug;
        }
        return '/catalog/' . @$this->category->slug . '/' . $this->slug;
    }

    public function getMainImg()
    {
        return '/static/product/upl/' . @$this->productImgs[0]->name;
    }

    /**
     * Связанный производитель
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    public function getMass($count = 1)
    {
        $productMass = @$this->propertyValue[3]->value;
        if (empty($productMass)) {
            $productMass = 0;
        }
        return $productMass * $count;
    }

    public function getPriceEurText()
    {
        if (empty($this->price_eur)) {
            return 'По запросу';
        } else {
            return $this->price_eur;
        }
    }

    public function getPriceGbpText()
    {
        if (empty($this->price_gbp)) {
            return 'По запросу';
        } else {
            return $this->price_gbp;
        }
    }

    public function getPriceText()
    {
        if (empty($this->price)) {
            return 'По запросу';
        } else {
            return $this->price;
        }
    }

    /**
     * Связанные изображения
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductImgs()
    {
        return $this->hasMany(ProductImg::className(), ['product_id' => 'id'])->orderBy('order ASC');
    }

    /**
     * Привязанные свойства товаров
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getProperties()
    {
        return $this->hasMany(Property::class, ['id' => 'property_id'])
          ->viaTable('property_to_product', ['product_id' => 'id'])->orderBy('order ASC');
    }

    /**
     * Значения свойств товаров
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getPropertyValue()
    {
        return $this->hasMany(PropertyToProduct::class, ['product_id' => 'id'])->with('property')->indexBy(
          'property_id'
        );
    }

    /** возвращает массив свойств товара, проиндексированный по $keyName
     * @param string $keyName имя поля таблицы property, по значению которого индексируется результирующий массив.
     * @return array массив, проиндексированный по $keyName, заполненный массивами значений атрибутов зкщзукен b property_to_product
     */
    public function getPropsVals(string $keyName = 'name')
    {
        $result = [];
        if ($this->properties) {
            /** @var PropertyToProduct[] $propertyValueArray */
            $propertyValueArray = $this->propertyValue;
            if (!empty($propertyValueArray)) {
                /** @var  Property $property */
                foreach ($this->properties as $i => $property) {
                    if (!empty($property->getAttribute($keyName)) && !empty($propertyValueArray[$property->id])) {
                        $result[$property->getAttribute($keyName)] = array_merge(
                          $property->getAttributes(['id', 'name', 'value_name', 'type', 'order']),
                          $propertyValueArray[$property->id]->getAttributes(['product_id', 'property_id', 'value'])
                        );
                    }
                }
            }
        }
        return $result;
    }

    /**
     * Рекомендованные товары
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getRecommendedProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->via('recommendedProductsTable');
    }

    public function getRecommendedProductsTable()
    {
        return $this->hasMany(ProductToProduct::class, ['main_product_id' => 'id'])->andWhere(
          ['type' => ProductPackages::TYPE_RECOMEND]
        );
    }

    /**
     * Сопутствующие товары
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getRelatedProducts()
    {
        $seriesTypeVal = self::TYPE_SERIES;
        return $this->hasMany(Product::class, ['id' => 'product_id'])
          ->via('relatedProductsTable')->orderBy("(type={$seriesTypeVal}) desc, order asc, name asc");
    }

    /**
     * Вспомогательный связи для via
     */
    public function getRelatedProductsTable()
    {
        return $this->hasMany(ProductToProduct::class, ['main_product_id' => 'id'])->andWhere(
          ['type' => ProductPackages::TYPE_RELATED]
        );
    }

    public function getSumm($count = 1)
    {
        return $this->getActualPrice(true) * $count;
    }

    /**
     * Столы для серии
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getTables()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->via('tablesTable');
    }

    public function getTablesTable()
    {
        return $this->hasMany(ProductToProduct::class, ['main_product_id' => 'id'])->andWhere(
          ['type' => ProductPackages::TYPE_TABLES]
        );
    }

    public function getValue($count = 1)
    {
        $productValue = @$this->propertyValue[2]->value;
        if (empty($productValue)) {
            $productValue = 0;
        }
        return $productValue * $count;
    }

    public function imagesValidate($attribute, $params, $validator)
    {
        if (!isset($this->imges)) {
            $this->addError('img', 'Добавьте хотя бы одно изображение');
        }

        if (!is_array($this->imges)) {
            $this->imges = explode(',', $this->imges);
        }

        //  Повторно проверяем входные данные
        if (!is_array($this->imges)) {
            return $this->addError('img', 'Неверный формат изображений');
        }

        $imges = [];
        foreach ($this->imges as $order => $tmpImg) {
            if (strpos($tmpImg, 'static')) {
                $imges[$order] = [
                  'isNew' => true,
                  'value' => $tmpImg,
                ];
            } else {
                $imges[$order] = [
                  'isNew' => false,
                  'value' => $tmpImg,
                ];
            }
        }

        $this->imges = $imges;
        //  Валидные ли данные и есть ли данные изображения
        foreach ($this->imges as $tmpImg) {
            if (!$tmpImg['isNew']) {
                continue;
            }
            if (!file_exists(Yii::getAlias('@webroot' . $tmpImg['value']))) {
                return $this->addError('img', 'Изображения которыее вы хотите загрузить не существуют на сервере');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['name', 'price'], 'required'], // Эти поля должны быть обязательно не пустыми. 0 - это ноль, это не пусто
            // Этиполя должны быть целыми числами
          [['category_id', 'brand_id', 'manufacturer_id', 'status', 'order', 'delivery_type', 'execution'], 'integer'],
            // Эти поля должны быть числами, причём разделитель целой и дробной части - точка. Не запятая. И без
            // разделения групп разрядов.
          [['price', 'price_eur', 'price_gbp'], 'number'],
            // Эти поля могут быть какими угодно
          [['docFiles'], 'safe'],
          [['video'], 'safe'],
            // Эти поля по умолчанию принимают соотв. значения, если не заданы
          ['status', 'default', 'value' => self::STATUS_PUBLISH],
          ['type', 'default', 'value' => self::TYPE_PRODUCT],
          ['order', 'default', 'value' => 9999],
            // Эти поля - строковые значения
          [['meta_title', 'meta_description', 'meta_keywords', 'img', 'description'], 'string'],
            // Какие угодно, без проверки
          [['created_at', 'imges', 'img', 'properties', 'relatedProducts', 'recommendedProducts', 'tables'], 'safe'],
            // Строковые заданной максимальной длины, не более
          [['name', 'slug', 'alt', 'construct_link'], 'string', 'max' => 255],
          [['description_short'], 'string', 'max' => 120],
            // не вызывать ошибку, если бренд задан но не определён в таблице брендов
          [
            ['brand_id'],
            'exist',
            'skipOnError'     => true,
            'targetClass'     => Brand::className(),
            'targetAttribute' => ['brand_id' => 'id']
          ],
            // не вызывать ошибку, если производитель задан но не определён в таблице производителей
          [
            ['manufacturer_id'],
            'exist',
            'skipOnError'     => true,
            'targetClass'     => Manufacturer::className(),
            'targetAttribute' => ['manufacturer_id' => 'id']
          ],
            // не вызывать ошибку, если категория задана но не определён в таблице категорий
          [
            ['category_id'],
            'exist',
            'skipOnError'     => true,
            'targetClass'     => Category::className(),
            'targetAttribute' => ['category_id' => 'id']
          ],
            // Изображения не должны быть пустыми
          ['imges', 'imagesValidate', 'skipOnEmpty' => false],
            // Товары нельзя добавлять в категории, имеющие дочерние категории. Ну типа чтобы не было дубликатов
            // страниц ))
          [
            'category_id',
            function ($value) {
                $cat = Category::find()->where(['id' => $this->$value])->one();
                if (count($cat->childs)) {
                    $this->addError($value, 'У категории не должно быть подкатегорий');
                    return false;
                }
            },
            'when' => function () {
                return $this->type == 0;
            }
          ]
        ];
    }

    /**
     * Gets query for [[PropertyToProducts]].
     */
    public function setProperties($propertiesArray)
    {
        $this->propertiesArray = $propertiesArray;
    }

    public function setRecommendedProducts($products)
    {
        ArrayHelper::removeValue($products, $this->id);
        $this->recommendedProducts = $products;
    }

    public function setRelatedProducts($products)
    {
        ArrayHelper::removeValue($products, $this->id);
        $this->relatedProducts = $products;
    }

    public function setTables($products)
    {
        ArrayHelper::removeValue($products, $this->id);
        $this->tables = $products;
    }

    public function upload()
    {
        foreach ($this->docFiles as $file) {
            $newName = $file->baseName . '.' . $file->extension;
            $res = $file->saveAs(Yii::getAlias('@productroot/' . $newName));
            if ($res) {
                $file = new FileToBrand();
                $file->brand_id = $this->id;
                $file->name = $newName;
                $file->type = FileToBrand::TYPE_PRODUCT;
                $file->save();
            }
        }
        return true;
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new \app\models\query\ProductQuery(get_called_class()))->orderBy('order');
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function findAdmin()
    {
        return new \app\models\query\ProductQuery(get_called_class());
    }

    /** @param array $where Фильтр, по умолчанию ['type' => self::TYPE_PRODUCT]
     * @param string|array $orderBy Сортирвока, по умолчанию 'name asc'
     */
    public static function getAll($where = ['type' => self::TYPE_PRODUCT], $orderBy = 'name asc')
    {
        return self::find()->andWhere($where)->orderBy($orderBy)->all();
    }

    public static function getCartProducts($sessionProducts)
    {
        if (!isset($sessionProducts)) {
            return [];
        }
        $response = [];
        $ids = array_keys($sessionProducts);
        /** @var $products Product[] */
        $products = Product::find()->andWhere(['id' => $ids])->with(['category', 'productImgs'])->indexBy('id')->all();
        foreach ($sessionProducts as $id => $count) {
            /**
             * @todo Что-то тут странное. По идее, продуктов без id не должно быть. А они встречаются.
             */
            if (empty($id) || empty($products[$id]) || empty($count)) {
                continue;
            }
            $response[] = [
              'count' => $count,
              'id'    => $id,
              'price' => $products[$id]->getActualPrice(true),
              'name'  => $products[$id]->name,
              'href'  => $products[$id]->link,
              'img'   => $products[$id]->mainImg,
            ];
        }

        return $response;
    }

    public static function getComparisonProducts($sessionComparisons)
    {
        if (!isset($sessionComparisons)) {
            return [];
        }
        $response = [];
        $ids = array_keys($sessionComparisons);
        /** @var Product[] $products */
        $products = Product::find()->andWhere(['id' => $ids])->with(['category', 'productImgs'])->indexBy('id')->all();
        foreach ($sessionComparisons as $id => $count) {
            /**
             * @todo Что-то тут странное. По идее, продуктов без id не должно быть. А они встречаются.
             */
            if (empty($id) || empty($products[$id]) || empty($count)) {
                continue;
            }
            $response[] = [
              'count' => $count,
              'id'    => $id,
              'price' => $products[$id]->getActualPrice(true),
              'name'  => $products[$id]->name,
              'href'  => $products[$id]->link,
              'img'   => $products[$id]->mainImg,
            ];
        }
        return $response;
    }

    public static function getFavoriteProducts($sessionFavorites)
    {
        if (!isset($sessionFavorites)) {
            return [];
        }
        $response = [];
        $ids = array_keys($sessionFavorites);
        /** @var Product[] $products */
        $products = Product::find()->andWhere(['id' => $ids])->with(['category', 'productImgs'])->indexBy('id')->all();
        foreach ($sessionFavorites as $id => $count) {
            /**
             * @todo Что-то тут странное. По идее, продуктов без id не должно быть. А они встречаются.
             */
            if (empty($id) || empty($products[$id]) || empty($count)) {
                continue;
            }
            $response[] = [
              'count' => $count,
              'id'    => $id,
              'price' => $products[$id]->getActualPrice(true),
              'name'  => $products[$id]->name,
              'href'  => $products[$id]->link,
              'img'   => $products[$id]->mainImg,
            ];
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }
}
