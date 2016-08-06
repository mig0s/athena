<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "remarks".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $record
 *
 * @property User $createdBy
 * @property Item $item
 */
class Remarks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'remarks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'created_by', 'record'], 'required'],
            [['item_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['record'], 'string'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'record' => 'Record',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
