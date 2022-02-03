<?php

namespace app\models\search;

use app\models\ar\Brand;
use app\models\ar\Manufacturer;
use app\models\ar\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\Product;
use yii\db\ActiveQuery;

/**
 * ProductSearch represents the model behind the search form of `app\models\ar\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'meta_title', 'meta_description', 'category_id', 'brand_id','manufacturer_id', 'type'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @param ActiveQuery $query
     * @return ActiveDataProvider
     */
    public function search($params, ActiveQuery $query)
    {
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
              'pageSize' => 100,
            ],
           'sort'       => [
            'defaultOrder' => 'category_id, order, name',
          ],
        ]);

        $this->load($params);
        //$query->filterWhere($this->getAttributes(null, ['name', 'description', 'parent_id']));
        $query->filterWhere($this->getAttributes(null, ['name']));
        $query->andFilterWhere(['like', 'name', $this->name]);
        //$baseOrderBy = ['(parent_id = -1)' => SORT_DESC, '(parent_id = 0)' => SORT_DESC];
        //$query->addOrderBy($baseOrderBy);
        return $dataProvider;
    }
}
