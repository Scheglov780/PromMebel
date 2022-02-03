<?php

namespace app\models\ar;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "property_to_product".
 *
 * @property int $id
 * @property int $product_id
 * @property int $property_id
 * @property string $value
 *
 * @property Product $product
 * @property Property $property
 */
class PropertyToProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_to_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'property_id', 'value'], 'required'],
            [['product_id', 'property_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'id']],
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
            'property_id' => 'ID свойства',
            'value' => 'Значение',
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
     * Gets query for [[Property]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }

    public static function findAdmin()
    {
        return new \app\models\query\PropertyToProductQuery(get_called_class());
    }
}
