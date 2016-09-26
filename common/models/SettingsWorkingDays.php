<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings_working_days".
 *
 * @property integer $id
 * @property integer $venue_id
 * @property string $day
 * @property string $is_working
 * @property string $open_at
 * @property string $closed_at
 *
 * @property SettingsVenues $venue
 */
class SettingsWorkingDays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings_working_days';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venue_id', 'day', 'is_working'], 'required'],
            [['venue_id'], 'integer'],
            [['day'], 'string'],
            [['open_at', 'closed_at'], 'safe'],
            [['is_working'], 'string', 'max' => 1],
            [['venue_id'], 'exist', 'skipOnError' => true, 'targetClass' => SettingsVenues::className(), 'targetAttribute' => ['venue_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venue_id' => 'Venue ID',
            'day' => 'Day',
            'is_working' => 'Is Working',
            'open_at' => 'Open At',
            'closed_at' => 'Closed At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
        return $this->hasOne(SettingsVenues::className(), ['id' => 'venue_id']);
    }
}
