<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ar\Product]].
 *
 * @see \app\models\ar\Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
