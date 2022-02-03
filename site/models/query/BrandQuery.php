<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ar\Brand]].
 *
 * @see \app\models\ar\Brand
 */
class BrandQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Brand[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Brand|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
