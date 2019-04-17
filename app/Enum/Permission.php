<?php

namespace App\Enum;

class Permission {
    //Admin
    public static $ADMIN = "Admin";

    //User
    public static $LIST_USER = "list_user";
    public static $VIEW_USER = "view_user";
    public static $CREATE_USER = "create_user";
    public static $UPDATE_USER = "update_user";
    public static $DELETE_USER = "delete_user";

    //Group
    public static $LIST_GROUP = "list_group";
    public static $VIEW_GROUP = "view_group";
    public static $CREATE_GROUP = "create_group";
    public static $UPDATE_GROUP = "update_group";
    public static $DELETE_GROUP = "delete_group";


}