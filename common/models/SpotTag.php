<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "spot_tag".
 *
 * @property integer $id
 * @property string $colour
 * @property string $name
 * @property string $allowance
 * @property integer $loan_duration
 * @property integer $renewal_duration
 * @property integer $renewal_limit
 * @property string $description
 *
 * @property Item[] $items
 * @property SpotTagCharges[] $spotTagCharges
 */
class SpotTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spot_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['colour', 'name', 'allowance'], 'required'],
            [['name', 'description'], 'string'],
            [['loan_duration', 'renewal_duration', 'renewal_limit'], 'integer'],
            [['colour'], 'string', 'max' => 20],
            [['allowance'], 'string', 'max' => 1],
            [['colour'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'colour' => 'Colour',
            'name' => 'Name',
            'allowance' => 'Allowance',
            'loan_duration' => 'Loan Duration',
            'renewal_duration' => 'Renewal Duration',
            'renewal_limit' => 'Renewal Limit',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['spot_tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpotTagCharges()
    {
        return $this->hasMany(SpotTagCharges::className(), ['spot_tag_id' => 'id']);
    }
}
