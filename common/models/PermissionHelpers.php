<?php
namespace common\models;

use backend\models\UserType;
use common\models\ValueHelpers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermissionHelpers
{

    public static function requireUpgradeTo($user_type_name)
    {

        if (!ValueHelpers::userTypeMatch($user_type_name)) {

            return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));

        }

    }

    public static function requireStatus($status_name)
    {

        return ValueHelpers::statusMatch($status_name);

    }

    public static function requireRole($role_name)
    {

        return ValueHelpers::roleMatch($role_name);

    }

    public static function requireMinimumRole($role_name, $userId=null)
    {

        if (ValueHelpers::isRoleNameValid($role_name)){

            if ($userId == null) {

                $userRoleValue = ValueHelpers::getUsersRoleValue();

            }  else {

                $userRoleValue = ValueHelpers::getUsersRoleValue($userId);

            }

            return $userRoleValue >= ValueHelpers::getRoleValue($role_name) ? true : false;

        } else {

            return false;

        }

    }

    public static function userMustBeOwner($model_name, $model_id)
    {

        $connection = \Yii::$app->db;
        $userid = Yii::$app->user->id;
        $sql = "SELECT id FROM $model_name WHERE user_id=:userid AND id=:model_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":userid", $userid);
        $command->bindValue(":model_id", $model_id);

        if($result = $command->queryOne()) {

            return true;

        } else {

            return false;

        }

    }

    public static function loanPermission ($user_id, $item_id) {
        $user = User::findOne($user_id);
        $item = Item::findOne($item_id);

        $user_type = $user->user_type_id;
        $user_type = UserType::findOne($user_type);

        $spot_tag = $item->spot_tag_id;
        $spot_tag = SpotTag::findOne($spot_tag);

        if (($spot_tag->allowance = 1) &&
            ($spot_tag->minimum_user_type <= $user_type->user_type_value) &&
            ($item->item_status_id == 1)) {
            return true;
        } else {
            return false;
        }
    }

}
