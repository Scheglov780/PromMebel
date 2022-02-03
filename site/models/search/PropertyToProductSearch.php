<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\Property;
use yii\db\ActiveQuery;

/**
 * PropertySearch represents the model behind the search form of `app\models\ar\Property`.
 */
class PropertyToProductSearch extends PropertyToProduct
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
          [['product_id', 'property_id'], 'integer'],
          [['value'], 'string', 'max' => 255],
          [['product', 'property'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params, ActiveQuery $query)
    {
        //$query = Property::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
              'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'product.name', $this->product->name])
            ->andFilterWhere(['like', 'property.name', $this->property->name]);

        return $dataProvider;
    }
}
