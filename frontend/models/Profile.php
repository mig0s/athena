<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property integer $gender_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $ic_passport
 * @property string $expiry
 * @property string $mobile_num
 * @property string $home_num
 * @property string $nationality
 * @property string $race
 * @property string $city
 * @property string $address
 * @property integer $postal_code
 * @property integer $group_id
 * @property integer $university_id
 * @property integer $course_id
 *
 * @property Course $course
 * @property Gender $gender
 * @property Group $group
 * @property University $university
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'gender_id', 'ic_passport'], 'required'],
            [['user_id', 'gender_id', 'postal_code', 'group_id', 'university_id', 'course_id'], 'integer'],
            [['first_name', 'last_name', 'nationality', 'race', 'city', 'address'], 'string'],
            [['birthdate', 'created_at', 'updated_at', 'expiry'], 'safe'],
            [['ic_passport', 'mobile_num', 'home_num'], 'string', 'max' => 45],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['university_id'], 'exist', 'skipOnError' => true, 'targetClass' => University::className(), 'targetAttribute' => ['university_id' => 'id']],
            [['gender_id'],'in', 'range'=>array_keys($this->getGenderList())],
            [['birthdate'], 'date', 'format'=>'Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'gender_id' => 'Gender ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ic_passport' => 'Ic Passport',
            'expiry' => 'Expiry',
            'mobile_num' => 'Mobile Num',
            'home_num' => 'Home Num',
            'nationality' => 'Nationality',
            'race' => 'Race',
            'city' => 'City',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'group_id' => 'Group ID',
            'university_id' => 'University ID',
            'course_id' => 'Course ID',
            'genderName' => Yii::t('app', 'Gender'),
            'userLink' => Yii::t('app', 'User'),
            'profileIdLink' => Yii::t('app', 'Profile'),
        ];
    }

    /**
     * behaviors
     */

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
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

    public function getGenderName()
    {
        return $this->gender->gender_name;
    }

    /**
     * get list of genders for dropdown
     */

    public static function getGenderList()
    {

        $droptions = Gender::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'gender_name');

    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @get Username
     */

    public function getUsername()
    {
        return $this->user->username;
    }

    /**
     * @getUserId
     */

    public function getUserId()
    {
        return $this->user ? $this->user->id : 'none';
    }

    /**
     * @getUserLink
     */

    public function getUserLink()
    {
        $url = Url::to(['user/view', 'id'=>$this->UserId]);
        $options = [];
        return Html::a($this->getUserName(), $url, $options);
    }

    /**
     * @getProfileLink
     */

    public function getProfileIdLink()
    {
        $url = Url::to(['profile/update', 'id'=>$this->id]);
        $options = [];
        return Html::a($this->id, $url, $options);
    }

}
