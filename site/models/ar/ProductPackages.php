<?php

namespace app\models\ar;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "product_packages".
 *
 * @property int $id
 * @property int|null $type
 * @property string|null $name
 *
 * @property Product[] $products
 */
class ProductPackages extends \yii\db\ActiveRecord
{
    const TYPE_RECOMEND = 0;
    const TYPE_RELATED = 1;
    const TYPE_TABLES = 2;

    public static $typeNames = [
        self::TYPE_RECOMEND => 'Рекомендованые',
        self::TYPE_RELATED => 'Сопутствующие',
        self::TYPE_TABLES => 'Серии',
    ];

    public static function tableName()
    {
        return 'product_packages';
    }
    /** @param string|array $orderBy Сортирвока, по умолчанию 'name asc'
     */
    public static function getRecommendedPackages($orderBy = 'name ASC')
    {
        return self::find()->andWhere(['type' => self::TYPE_RECOMEND])
          ->with('productsToPackages')->indexBy('id')
          ->orderBy($orderBy)
          ->asArray()->all();
    }
    /** @param string|array $orderBy Сортирвока, по умолчанию 'name asc'
     */
    public static function getRelatedPackages($orderBy = 'name ASC')
    {
        return self::find()->andWhere(['type' => self::TYPE_RELATED])
          ->with('productsToPackages')->indexBy('id')
          ->orderBy('name ASC')->asArray()->all();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['products'], 'safe'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255, 'min' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип пакета',
            'name' => 'Название пакета',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->viaTable('product_to_packages', ['packages_id' => 'id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getProductsToPackages()
    {
        return $this->hasMany(ProductToPackages::class, ['packages_id' => 'id'])->indexBy('product_id');
    }

    /**
     * Gets query for [[Product]].
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->unlinkAll('products', true);
        $products = Product::find()->andWhere(['id' => $this->products])->all();
        foreach ($products as $product) {
            $this->link('products', $product);
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ProductQuery the active query used by this AR class.
     */
    public static function findAdmin()
    {
        return new \app\models\query\ProductPackagesQuery(get_called_class());
    }
}