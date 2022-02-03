<?php

namespace app\models\search;

use yii\base\Model;
use yii\behaviors\SluggableBehavior;
use yii\data\ActiveDataProvider;
use app\models\ar\Category;
use yii\helpers\VarDumper;

/**
 * CategorySearch represents the model behind the search form of `app\models\ar\Category`.
 */
class CategorySearch extends Category
{
    public function behaviors()
    {
        return [
            /*[
              'class' => SluggableBehavior::class,
              'attribute' => 'name',
              'slugAttribute' => 'slug',
              'ensureUnique' => true,
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['name', 'slug', 'description', 'parent_id', 'price_from', 'status','parent_exists','children_count'], 'safe'],
          [['price_from'], 'number'],
          [['status'], 'integer'],
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find()->addSelect(['*','(select count(0) from category cc2 where cc2.id = qq.parent_id
        limit 1) as parent_exists',
'(select count(0) from category cc3 where cc3.parent_id = qq.id) as children_count'])->alias('qq')
        ->orderBy('(parent_id = -1) desc, (parent_id = 0) desc, parent_exists desc');
//        $count = $query->count();

        // add conditions that should always apply here
        /*
         *             'params'         => array(':device_id' => $id),
            'id'             => 'device-data-' . $source . '-' . $id,
            'keyField'       => 'pk',
            'totalItemCount' => $totalItemCount,
         * */

        $dataProvider = new ActiveDataProvider([
          'query'      => $query,
          'pagination' => [
            'pageSize' => 100,

          ],
/*         'sort'       => [
            'defaultOrder' => '',
          ],
*/
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        //VarDumper::dump($this->getAttributes(null, ['name', 'description', 'parent_id']),10,true); die;
        $query->filterWhere($this->getAttributes(null, ['name', 'description', 'parent_id']));
        //VarDumper::dump($this->getAttributes(),10,true); die;
        if ((!is_null($this->parent_id)) && strlen($this->parent_id)) {
            if (is_numeric($this->parent_id)) {
                $parent_id = (integer) $this->parent_id;
                if ($parent_id > 0) {
                    $q = ['id' => $parent_id];
                    $catIds = self::find()->where($q)->select('id')->column();
                } else {
                    $catIds = [$parent_id];
                }
            } else {
                $q = ['like', 'name', $this->parent_id];
                $catIds = self::find()->where($q)->select('id')->column();
            }

            if (!empty($catIds)) {
                $query->andFilterWhere(['parent_id' => $catIds]);
            }
        }
        $query->andFilterWhere(['like', 'name', $this->name])
          ->andFilterWhere(['like', 'description', $this->description]);
//        $baseOrderBy = ['(parent_id = -1)' => SORT_DESC, '(parent_id = 0)' => SORT_DESC,
//                        'parent_exists'=>SORT_DESC];
//        $query->addOrderBy($baseOrderBy);
        return $dataProvider;
    }
}
