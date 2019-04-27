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

    //Contract
    public static $LIST_CONTRACT = "list_contract";
    public static $VIEW_CONTRACT = "view_contract";
    public static $UPDATE_CONTRACT = "update_contract";


    //Emp Contract
    public static $LIST_EMP_CONTRACT = "list_emp_contact";
    public static $VIEW_EMP_CONTRACT = "view_emp_contact";
    public static $UPDATE_EMP_CONTRACT = "update_emp_contact";
    public static $CREATE_EMP_CONTRACT = "create_emp_contact";
    public static $DELETE_EMP_CONTRACT = "delete_emp_contact";

}