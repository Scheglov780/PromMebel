<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 * @property string|null $name_pad_1
 * @property string|null $name_pad_2
 * @property string $address
 * @property string|null $phone
 * @property string|null $email
 * @property float|null $lat
 * @property float|null $lng
 * @property string|null $data
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'address'    => 'Адрес',
          'alias'      => 'Доменное имя',
          'data'       => 'Data',
          'email'      => 'E-mail',
          'id'         => 'ID',
          'lat'        => 'Lat',
          'lng'        => 'Lng',
          'name'       => 'Название города',
          'name_pad_1' => 'Название в падеже "Где?"',
          'name_pad_2' => 'Название в падеже "Откуда?"',
          'phone'      => 'Телефон',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['lat', 'lng'], 'number'],
          [['data'], 'string'],
          [['name', 'name_pad_1', 'name_pad_2', 'address', 'phone', 'email', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }
}
