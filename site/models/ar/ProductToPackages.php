<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "product_to_packages".
 *
 * @property int $id
 * @property int $product_id
 * @property int $packages_id
 *
 * @property Product $product
 * @property ProductPackages $packages
 */
class ProductToPackages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_to_packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'packages_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductPackages::className(), 'targetAttribute' => ['packages_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID продукта',
            'packages_id' => 'ID пакета',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Packages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackages()
    {
        return $this->hasOne(ProductPackages::className(), ['id' => 'packages_id']);
    }
}
