<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Item;

/**
 * ItemSearch represents the model behind the search form about `common\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */

    public $global_search;

    public function rules()
    {
        return [
            [['id', 'num_of_copies', 'created_by', 'edited_by', 'subject_id', 'spot_tag_id', 'location_id', 'collection_id', 'category_id', 'sub_category_id', 'item_status_id'], 'integer'],
            [['title', 'author', 'editor', 'publisher', 'pub_place', 'pub_year', 'price_currency', 'isbn', 'edition', 'created_at', 'edited_at', 'accompanying_materials', 'global_search'], 'safe'],
            [['price', 'price_sgd'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params)
    {
        $query = Item::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'id', $this->global_search])
            ->orFilterWhere(['like', 'title', $this->global_search])
            ->orFilterWhere(['like', 'author', $this->global_search])
            ->orFilterWhere(['like', 'editor', $this->global_search])
            ->orFilterWhere(['like', 'publisher', $this->global_search])
            ->orFilterWhere(['like', 'pub_place', $this->global_search])
            ->orFilterWhere(['like', 'price_currency', $this->global_search])
            ->orFilterWhere(['like', 'isbn', $this->global_search])
            ->orFilterWhere(['like', 'edition', $this->global_search])
            ->orFilterWhere(['like', 'accompanying_materials', $this->global_search]);

        return $dataProvider;
    }

    public function searchByParams($params)
    {
        $query = Item::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'pub_year' => $this->pub_year,
            'price' => $this->price,
            'price_sgd' => $this->price_sgd,
            'num_of_copies' => $this->num_of_copies,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'edited_by' => $this->edited_by,
            'edited_at' => $this->edited_at,
            'subject_id' => $this->subject_id,
            'spot_tag_id' => $this->spot_tag_id,
            'location_id' => $this->location_id,
            'collection_id' => $this->collection_id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'item_status_id' => $this->item_status_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'editor', $this->editor])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'pub_place', $this->pub_place])
            ->andFilterWhere(['like', 'price_currency', $this->price_currency])
            ->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'edition', $this->edition])
            ->andFilterWhere(['like', 'accompanying_materials', $this->accompanying_materials]);

        return $dataProvider;
    }
}
