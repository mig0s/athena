<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loan".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $user_id
 * @property string $initial_loan
 * @property string $recent_renewal
 * @property integer $renewal_count
 * @property string $return_date
 * @property integer $loan_status_id
 *
 * @property Item $item
 * @property LoanStatus $loanStatus
 * @property User $user
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'user_id', 'return_date', 'loan_status_id'], 'required'],
            [['item_id', 'user_id', 'renewal_count', 'loan_status_id'], 'integer'],
            [['initial_loan', 'recent_renewal', 'return_date'], 'safe'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['loan_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoanStatus::className(), 'targetAttribute' => ['loan_status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'user_id' => 'User ID',
            'initial_loan' => 'Initial Loan',
            'recent_renewal' => 'Recent Renewal',
            'renewal_count' => 'Renewal Count',
            'return_date' => 'Return Date',
            'loan_status_id' => 'Loan Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoanStatus()
    {
        return $this->hasOne(LoanStatus::className(), ['id' => 'loan_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
