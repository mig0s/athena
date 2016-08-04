<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $course_group_id
 *
 * @property Course $courseGroup
 * @property Profile[] $profiles
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'course_group_id'], 'required'],
            [['name'], 'string'],
            [['course_group_id'], 'integer'],
            [['course_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_group_id' => 'id']],
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
            'course_group_id' => 'Course Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseGroup()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['group_id' => 'id']);
    }
}
