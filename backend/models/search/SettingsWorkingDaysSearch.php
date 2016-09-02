<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SettingsWorkingDays;

/**
 * SettingsWorkingDaysSearch represents the model behind the search form about `common\models\SettingsWorkingDays`.
 */
class SettingsWorkingDaysSearch extends SettingsWorkingDays
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'venue_id', 'day'], 'integer'],
            [['is_working', 'open_at', 'closed_at'], 'safe'],
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
        $query = SettingsWorkingDays::find();

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
            'venue_id' => $this->venue_id,
            'day' => $this->day,
            'open_at' => $this->open_at,
            'closed_at' => $this->closed_at,
        ]);

        $query->andFilterWhere(['like', 'is_working', $this->is_working]);

        return $dataProvider;
    }
}
