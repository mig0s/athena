<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings_holidays".
 *
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property integer $duration
 * @property integer $added_by
 *
 * @property User $addedBy
 */
class SettingsHolidays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings_holidays';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_date'], 'required'],
            [['name'], 'string'],
            [['start_date'], 'safe'],
            [['duration', 'added_by'], 'integer'],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start_date' => 'Start Date',
            'duration' => 'Duration',
            'added_by' => 'Added By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }
}
