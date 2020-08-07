<?php
/*
Template Name: Cafe Index
*/

function display_user_roles(){
    $user_id = get_current_user_id();
    $user_info = get_userdata( $user_id );

    if ($user_info)
    {
        $user_roles = implode(', ', $user_info->roles);
        return $user_roles;
    }
    else return "0";
}
    

    if (display_user_roles() == "administrator")
    {
        include("cafe_cotisation_cafe.php");
    }

    else include("cafe_historique.php");
    

?>