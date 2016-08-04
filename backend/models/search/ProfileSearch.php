<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `frontend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gender_id', 'postal_code', 'group_id', 'university_id', 'course_id'], 'integer'],
            [['first_name', 'last_name', 'birthdate', 'created_at', 'updated_at', 'ic_passport', 'expiry', 'mobile_num', 'home_num', 'nationality', 'race', 'city', 'address'], 'safe'],
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
        $query = Profile::find();

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
            'user_id' => $this->user_id,
            'birthdate' => $this->birthdate,
            'gender_id' => $this->gender_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'expiry' => $this->expiry,
            'postal_code' => $this->postal_code,
            'group_id' => $this->group_id,
            'university_id' => $this->university_id,
            'course_id' => $this->course_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'ic_passport', $this->ic_passport])
            ->andFilterWhere(['like', 'mobile_num', $this->mobile_num])
            ->andFilterWhere(['like', 'home_num', $this->home_num])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'race', $this->race])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
