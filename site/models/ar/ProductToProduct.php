<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "product_to_product".
 *
 * @property int $main_product_id       ID товара к кооторому сопутсвует\рекомендуется товар
 * @property int $product_id            ID товара который сопутсвует\рекомендуется товар
 * @property int $type
 *
 * @property Product $mainProduct
 * @property Product $product
 */
class ProductToProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_to_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_product_id', 'product_id', 'type'], 'required'],
            [['main_product_id', 'product_id', 'type'], 'integer'],
            [['main_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['main_product_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'main_product_id' => 'Main Product ID',
            'product_id' => 'Product ID',
            'type' => 'Type',
        ];
    }
}
