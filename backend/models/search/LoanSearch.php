<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Loan;

/**
 * LoanSearch represents the model behind the search form about `common\models\Loan`.
 */
class LoanSearch extends Loan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'user_id', 'renewal_count', 'loan_status_id'], 'integer'],
            [['initial_loan', 'recent_renewal', 'return_date'], 'safe'],
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
        $query = Loan::find();

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
            'item_id' => $this->item_id,
            'user_id' => $this->user_id,
            'initial_loan' => $this->initial_loan,
            'recent_renewal' => $this->recent_renewal,
            'renewal_count' => $this->renewal_count,
            'return_date' => $this->return_date,
            'loan_status_id' => $this->loan_status_id,
        ]);

        return $dataProvider;
    }
}
