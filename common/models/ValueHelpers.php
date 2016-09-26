<?php
namespace common\models;

use frontend\models\Profile;
use yii;
use backend\models\Role;
use backend\models\Status;
use backend\models\UserType;
use common\models\User;

class ValueHelpers
{

    public static function getFisrtName($profileId)
    {
        $profile = Profile::findOne($profileId);
        if (!is_null($profile)) { return $profile->first_name;
        } else {
            return Yii::$app->user->identity->username;
        }
    }

    public static function roleMatch($role_name)
    {

        $userHasRoleName = Yii::$app->user->identity->role->role_name;

        return $userHasRoleName == $role_name ? true : false;


    }

    public static function getUsersRoleValue($userId=null)
    {

        if ($userId == null){

            $usersRoleValue = Yii::$app->user->identity->role->role_value;

            return isset($usersRoleValue) ? $usersRoleValue : false;

        } else {


            $user = User::findOne($userId);

            $usersRoleValue = $user->role->role_value;

            return isset($usersRoleValue) ? $usersRoleValue : false;

        }

    }

    public static function getRoleValue($role_name)
    {

        $role = Role::find('role_value')
            ->where(['role_name' => $role_name])
            ->one();

        return isset($role->role_value) ? $role->role_value : false;

    }

    public static function isRoleNameValid($role_name)
    {

        $role = Role::find('role_name')
            ->where(['role_name' => $role_name])
            ->one();

        return isset($role->role_name) ? true : false;

    }

    public static function statusMatch($status_name)
    {

        $userHasStatusName = Yii::$app->user->identity->status->status_name;

        return $userHasStatusName == $status_name ? true : false;

    }

    public static function getStatusId($status_name)
    {

        $status = Status::find('id')
            ->where(['status_name' => $status_name])
            ->one();

        return isset($status->id) ? $status->id : false;

    }

    public static function userTypeMatch($user_type_name)
    {

        $userHasUserTypeName = Yii::$app->user->identity->userType->user_type_name;

        return $userHasUserTypeName == $user_type_name ? true : false;

    }

    public static function isAvailableForReservation($item)
    {
        return $item->item_status_id == 5 ? true : false;
    }

    public static function isAvailableForLoan($item, $user = null)
    {
        if (is_null($user)) {
            return $item->item_status_id == 1 ? true : false;
        } elseif ($item->item_status_id == 1) {
            return true;
        } elseif ($item->item_status_id == 5) {
            $connection = \Yii::$app->db;
            $sql = "SELECT id FROM reservation WHERE user_id=:userid AND item_id=:item_id";
            $command = $connection->createCommand($sql);
            $command->bindValue(":userid", $user);
            $command->bindValue(":item_id", $item->id);
            if($result = $command->queryOne()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

