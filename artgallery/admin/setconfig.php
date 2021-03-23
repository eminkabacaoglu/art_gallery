<?php  
require_once 'admin/class.crud.php';
$db = new crud();

// if(!isset($_SESSION['user']) && isset($_COOKIE['usersLogin'])){

//     $login=json_decode($_COOKIE['usersLogin']);

//     $result=$db->userLogin( $login->userUserName,$login->userPassword,true);

//     if($result['status']==true){

//         header("Location:index.php");
//         exit;
//     }

// }//güvenli çıkış için

    // if(!isset($_SESSION['user']) && !isset($_COOKIE['usersLogin'])){ //güvenli çıkış için
    if(!isset($_SESSION['user']) ){
        header("Location:login.php");
        exit;

    }


?>