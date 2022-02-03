<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\ar\Property]].
 *
 * @see \app\models\ar\Property
 */
class PropertyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Property[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\ar\Property|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
