<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "product_img".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property int $order
 *
 * @property Product $product
 */
class ProductImg extends \yii\db\ActiveRecord
{
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'order'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Продукт',
            'name' => 'Имя',
            'order' => 'Порядок',
        ];
    }

    public function getImgUrl()
    {

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

    public function afterDelete()
    {
        if(file_exists(Yii::getAlias('@productroot/upl/'.$this->name))) {
            unlink(Yii::getAlias('@productroot/upl/'.$this->name));
        }

        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
}