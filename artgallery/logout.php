<?php 
    session_start();
    unset($_SESSION['user']);
    //setcookie("usersLogin",json_encode($userCookie),strtotime("-30 days"),"/");
    header("Location:login.php");
    exit;

?>