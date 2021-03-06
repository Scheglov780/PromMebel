<?php

namespace app\models\ar;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property string $img
 * @property int $order
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'url'], 'string'],
            [['order'], 'integer'],
            [['order'], 'default', 'value' => 0],
            [['name', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'description' => 'Описание',
            'img' => 'Слайд',
            'order' => 'Порядок',
            'url' => 'Ссылка',
        ];
    }

    public function beforeSave($insert)
    {
        if(!$this->isAttributeChanged('img')) {
            return parent::beforeSave($insert);
        }

        $tmpImgs = explode(',', $this->img);

        //  Повторно проверяем входные данные
        if(!is_array($tmpImgs)) {
            return $this->addError('img', 'Проблемы с сохранением изображения');
        }

        //  Валидные ли данные и есть ли данные изображения
        foreach ($tmpImgs as $tmpImg) {
            if(!file_exists(Yii::getAlias('@webroot'.$tmpImg))) {
                return $this->addError('img', 'Проблемы с сохранением изображения');
            }
        }

        //  Сносим старые файлы что бы записать новые
/*        $oldImg = $this->getOldAttribute('img');
        if(isset($oldImg)) {
            if(file_exists(Yii::getAlias('@sliderroot/'.$oldImg))) {
                unlink(Yii::getAlias('@sliderroot/'.$oldImg));
            }
        }*/

        //  Записываем новые файлы
        foreach ($tmpImgs as $tmpImg) {
            $imgPath = Yii::getAlias('@webroot'.$tmpImg);
            $pathInfo = pathinfo($imgPath);
            if(strpos($imgPath, 'slider')) {
                $this->img = $pathInfo['basename'];
            } else {
                $newName = md5($imgPath.time()).'.'.$pathInfo['extension'];
                copy($imgPath, Yii::getAlias('@sliderroot/'.$newName));
                $this->img = $newName;
            }
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function getFullUrl()
    {
        return Yii::getAlias('@slider/'.$this->img);
    }

    public function afterDelete()
    {
        if(isset($this->img)) {
            unlink(Yii::getAlias('@sliderroot/'.$this->img));
        }

        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
}
