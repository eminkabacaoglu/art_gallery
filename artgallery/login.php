<?php
    session_start();
    if(isset($_SESSION['user'])){

        header("Location:index.php");
        exit;

    }
    require_once 'admin/class.crud.php';
    $db = new crud();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Art Gallery - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
        .login-page {

            background: url(img/admin/background.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover
        }
    </style>

</head>

<body class="login-page">

    <div class="container ">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-6 col-lg-9 col-md-6 ">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <!-- Nested Row within Card Body -->

                    <!---  <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --->

                    <div class="p-5">

                        <div class="sidebar-brand d-flex align-items-center justify-content-center">
                            <i class="fas fa-paint-brush fa-3x " style="color: #4E73DF"></i>                           
                        </div> <br>

                        <?php

    

                        if($_COOKIE['usersLogin']) {

                            $login=json_decode($_COOKIE['usersLogin']);

                        }   

                        if(isset($_POST['userLogin'])){
                            $result = $db->userLogin(htmlspecialchars($_POST['userUserName']), htmlspecialchars($_POST['userPassword']),$_POST['rememberMe']);

                            if ($result['status'] == true) {

                                header("Location:index.php");
                                exit;
                            } else { ?>
                                <div class="alert alert-danger">Hatalı Giriş!</div>
                        <?php  }
                        
                    }

                        ?>
                        <form class="user" action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"  
                                <?php  
                                    if(isset($_COOKIE['usersLogin'])) {

                                       echo 'value="'.$login->userUserName.'"';
            
                                    }else{
                                       echo 'placeholder="Kullanıcı Adı..."';
                                    }?>
                                       name="userUserName">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword" 
                                <?php  
                                    if(isset($_COOKIE['usersLogin'])) {

                                       echo 'value="'.$login->userPassword.'"';
            
                                    }else{
                                       echo 'placeholder="Şifre..."';
                                    }?>
                                       name="userPassword">
                            </div>
                            <div class="form-group">
                              <!---  <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" 
                                    <?php 
                                    
                                    if(isset($_COOKIE['usersLogin'])) {

                                        echo 'checked';
             
                                     }?>
                                    
                                    id="customCheck" name="rememberMe"> 
                                    <label class="custom-control-label" for="customCheck" >Beni Hatırla</label>
                                </div> --->
                            </div>
                            <button type="submit" name="userLogin" class="btn btn-primary btn-user btn-block">Giriş</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.php">Şifremi Unuttum?</a>
                        </div>
                        <!--- <div class="text-center">
                            <a class="small" href="register.html">Yeni Hesap Oluştur!</a>
                        </div> --->
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>