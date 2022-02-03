<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "file_to_manufacturer".
 *
 * @property int $id
 * @property int $manufacturer_id
 * @property int $type
 * @property string $name
 */
class FileToManufacturer extends \yii\db\ActiveRecord
{
    const TYPE_MANUFACTURER = 1;
    const TYPE_PRODUCT = 2;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'id'              => 'ID',
          'manufacturer_id' => 'Manufacturer ID',
          'name'            => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['manufacturer_id', 'type'], 'integer'],
          [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_to_manufacturer';
    }
}
