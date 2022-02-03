<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "file_to_brand".
 *
 * @property int $id
 * @property int $brand_id
 * @property int $type
 * @property string $name
 */
class FileToBrand extends \yii\db\ActiveRecord
{
    const TYPE_BRAND = 1;
    const TYPE_PRODUCT = 2;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'id'       => 'ID',
          'brand_id' => 'Brand ID',
          'name'     => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['brand_id', 'type'], 'integer'],
          [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_to_brand';
    }
}
