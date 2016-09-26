<?php

namespace common\models;

use Yii;
use backend\models\UserType;

/**
 * This is the model class for table "spot_tag_charges".
 *
 * @property integer $id
 * @property integer $user_type_id
 * @property integer $spot_tag_id
 * @property integer $amount
 *
 * @property SpotTag $spotTag
 * @property UserType $userType
 */
class SpotTagCharges extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spot_tag_charges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_id', 'spot_tag_id', 'amount'], 'required'],
            [['user_type_id', 'spot_tag_id', 'amount'], 'integer'],
            [['spot_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpotTag::className(), 'targetAttribute' => ['spot_tag_id' => 'id']],
            [['user_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type_id' => 'User Type ID',
            'spot_tag_id' => 'Spot Tag ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpotTag()
    {
        return $this->hasOne(SpotTag::className(), ['id' => 'spot_tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['id' => 'user_type_id']);
    }
}
