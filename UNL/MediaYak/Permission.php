<?php

class UNL_MediaYak_Permission extends UNL_MediaYak_Models_BasePermission
{
    const USER_CAN_INSERT = 1;
    const USER_CAN_UPDATE = 2;
    const USER_CAN_DELETE = 3;
    
    const USER_CAN_UPLOAD = 10;
    
    public static function userHasPermission(UNL_MediaYak_User $user, UNL_MediaYak_Permission $permission)
    {
        throw new Exception('todo');
    }
    
    public static function getByID($id)
    {
        return Doctrine::getTable('UNL_MediaYak_Permission')->find($id);
    }
    
    public static function getByTitle($title)
    {
        return Doctrine::getTable('UNL_MediaYak_Permission')->findByTitle($title);
    }
    
    public static function grantUserPermission(UNL_MediaYak_User $user, UNL_MediaYak_Permission $permission)
    {
        throw new Exception('todo');
    }
}