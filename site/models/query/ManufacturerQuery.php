<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ar\Manufacturer]].
 *
 * @see \app\models\ar\Manufcturer
 */
class ManufacturerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Manufacturer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Manufacturer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
