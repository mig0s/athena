<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SpotTagCharges;

/**
 * SpotTagChargesSearch represents the model behind the search form about `common\models\SpotTagCharges`.
 */
class SpotTagChargesSearch extends SpotTagCharges
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_type_id', 'spot_tag_id', 'amount'], 'integer'],
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
        $query = SpotTagCharges::find();

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
            'user_type_id' => $this->user_type_id,
            'spot_tag_id' => $this->spot_tag_id,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
