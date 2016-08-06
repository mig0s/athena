<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings_venues".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $venue_desc
 * @property string $address
 * @property string $telephone_num
 * @property string $fax_num
 * @property string $email
 *
 * @property Item[] $items
 * @property SettingsWorkingDays[] $settingsWorkingDays
 */
class SettingsVenues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings_venues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'address', 'telephone_num', 'email'], 'required'],
            [['name', 'description', 'venue_desc', 'address'], 'string'],
            [['telephone_num', 'fax_num', 'email'], 'string', 'max' => 45],
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
            'description' => 'Description',
            'venue_desc' => 'Venue Desc',
            'address' => 'Address',
            'telephone_num' => 'Telephone Num',
            'fax_num' => 'Fax Num',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingsWorkingDays()
    {
        return $this->hasMany(SettingsWorkingDays::className(), ['venue_id' => 'id']);
    }
}
