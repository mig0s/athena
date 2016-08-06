<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_pair".
 *
 * @property integer $id
 * @property integer $item1
 * @property integer $item2
 *
 * @property Item $item10
 * @property Item $item20
 */
class ItemPair extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_pair';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item1', 'item2'], 'required'],
            [['item1', 'item2'], 'integer'],
            [['item1'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item1' => 'id']],
            [['item2'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item2' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item1' => 'Item1',
            'item2' => 'Item2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem10()
    {
        return $this->hasOne(Item::className(), ['id' => 'item1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem20()
    {
        return $this->hasOne(Item::className(), ['id' => 'item2']);
    }
}
