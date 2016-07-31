<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property integer $user_type_id
 * @property string $name
 * @property integer $loan_limit
 *
 * @property Profile[] $profiles
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_id', 'name', 'loan_limit'], 'required'],
            [['user_type_id', 'loan_limit'], 'integer'],
            [['name'], 'string'],
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
            'name' => 'Name',
            'loan_limit' => 'Loan Limit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['course_id' => 'id']);
    }
}
