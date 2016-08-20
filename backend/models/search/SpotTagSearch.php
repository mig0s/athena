<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SpotTag;

/**
 * SpotTagSearch represents the model behind the search form about `common\models\SpotTag`.
 */
class SpotTagSearch extends SpotTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loan_duration', 'renewal_duration', 'renewal_limit', 'minimum_user_type'], 'integer'],
            [['colour', 'name', 'allowance', 'description'], 'safe'],
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
        $query = SpotTag::find();

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
            'loan_duration' => $this->loan_duration,
            'renewal_duration' => $this->renewal_duration,
            'renewal_limit' => $this->renewal_limit,
            'minimum_user_type' => $this->minimum_user_type,
        ]);

        $query->andFilterWhere(['like', 'colour', $this->colour])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'allowance', $this->allowance])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
