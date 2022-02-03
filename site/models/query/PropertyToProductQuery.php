<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ar\Property]].
 *
 * @see \app\models\ar\PropertyToProduct
 */
class PropertyToProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\ar\PropertyToProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\ar\PropertyToProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
