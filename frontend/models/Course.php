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
 * @property integer $university_id
 *
 * @property University $university
 * @property Group[] $groups
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
            [['user_type_id', 'name', 'loan_limit', 'university_id'], 'required'],
            [['user_type_id', 'loan_limit', 'university_id'], 'integer'],
            [['name'], 'string'],
            [['university_id'], 'exist', 'skipOnError' => true, 'targetClass' => University::className(), 'targetAttribute' => ['university_id' => 'id']],
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
            'university_id' => 'University ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversity()
    {
        return $this->hasOne(University::className(), ['id' => 'university_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['course_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['course_id' => 'id']);
    }
}
