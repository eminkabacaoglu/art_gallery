<?php require_once 'header.php'; ?>
</style>
<title>Profil</title>
<style type="text/css">
    /* The popup form - hidden by default */


    /* Add styles to the form container */
    .container {
        width: 100%;
        height: 100%;
        padding: 15px;
        background-color: white;
        display: flex;
        max-width: 1800px
    }

    .form-container {
        width: 100%;
        height: 100%;
        padding: 15px;
        display: flex;


    }

    .box {

        width: 50%;
        height: 50%;
        margin: auto;
        padding: 10px;
        max-width: 1800px
    }

    @media(max-width:768px) {
        .box {
            width: 100%;

        }

    }

    @media(max-width:500px) {
        .box {
            width: 100%;
        }
    }

    /* Full-width input fields */
    .container input[type=text],[type=password] {
        width: 100%;
        padding: 5px;
        margin: 0 0 20px 0;
        border: 5px;
        background: #f1f1f1;
    }

    .container input[type=file] {
        width: 50%;
        padding: 5px;
        margin: 0 0 20px 0;
        border: none;
        background: white;
    }

    .container select {
        width: 100%;
        padding: 5px;
        margin: 0 0 20px 0;
        border: none;
        background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .container input[type=text]:focus {
        background-color: #ddd;
        outline: none;
    }



    /* Set a style for the submit/login button */
    .container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 35%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }


    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;

    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #4E73DF;
        color: white
    }


    /* Style the tab content */
    .tabcontentupd {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>

<?php



if (isset($_POST["usrUpdate"])) {
    $result = $db->update("users", $_POST, [
        "form_name" => "usrUpdate", "Id" => "user_id", "dir" => "users",
        "file_name" => "user_photo", "file_delete" => "current_file",
    ]);

    if ($_GET["success"] == TRUE) { ?>
        <div class="alert alert-success">
            Güncelleme Başarılı...
        </div>

    <?php } else if ($result["status"] == false) { ?>
        <div class="alert alert-danger">
            Güncelleme Başarısız...
        </div>
<?php }
}



?>

<?php
$id=$_SESSION['user']['userID'];
$sql = $db->qSql("SELECT * FROM users WHERE users.user_id=$id ");
$row = $sql->fetch(PDO::FETCH_ASSOC)
?>


<div class="container">
    <form name="usr_upd" method="POST" class="form-container" enctype="multipart/form-data">

        <div class="box">
        <?php if ($_GET["success"] == TRUE) { ?>
        <div class="alert alert-success">
            Güncelleme Başarılı...
        </div>

    <?php } ?>

            <h5 class="m-0 font-weight-bold text-primary">Kullanıcı Güncelle</h5>


            <!---
      <div class="tab">
        <button class="tablinksupd active" onclick="openDetailupd(event, 'Genel1')">Genel</button>
        <button class="tablinksupd " onclick="openDetailupd(event, 'Teknik1')">Teknik</button>
        <button class="tablinksupd" onclick="openDetailupd(event, 'Fiyat1')">Alış Satış Bilgileri</button>

      </div>
      <br>-->


            <div class="box">
                <img style="width: 200px;height:200px" class="img-profile rounded-circle" src="img/users/<?php if ($row["user_photo"] == null) {
                                                                                echo 'user.png';
                                                                            } else {
                                                                                echo $row["user_photo"];
                                                                            } ?>">
                <input type="hidden" placeholder="Resim" name="current_file" id="current_file" value="<?php echo $row["user_photo"] ?>">
                <input style="width: auto;" type="file" placeholder="" name="user_photo" id="user_photo">
            </div>
            <label for="user_name"><b>Ad</b></label>
            <input type="text" placeholder="Ad" name="user_name" id="user_name" value="<?php echo $row["user_name"] ?>" required>
            <label for="user_lastname"><b>Soyad</b></label>
            <input type="text" placeholder="Ad" name="user_lastname" id="user_lastname" value="<?php echo $row["user_lastname"] ?>" required>



            <label for="user_username"><b>Kullanıcı Adı</b></label>
            <input type="text" placeholder="Boyut" name="user_username" id="user_username" value="<?php echo $row["user_username"] ?>" required>

            <label for="user_password"><b>Şifre</b></label>
            <input type="password" placeholder="Teknik" name="user_password" id="user_password" value="<?php echo $row["user_password"] ?>" required>


            <!---                                                          
      <label for="art_price"><b>Fiyat</b></label>
      <input type="text" placeholder="Fiyat" name="art_price" id="updart_price" onfocusout="numControl(id)" value="<?php echo number_format($row["art_price"], 0, ",", ".") ?>" required>--->



            <input type="hidden" name="user_id" id="user_id" value="<?php echo $row["user_id"] ?>">
            <div align=center>
                <button type="submit" class="btn" name="usrUpdate" onclick="validateForm()">Güncelle</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
            </div>


        </div>

    </form>
</div>



<!-- /.container-fluid -->
<script>

function closeForm() {
    document.location.href = 'arts.php'

  }

  function numControl(id_val) {
    var x = document.getElementById(id_val);
    if (id_val == "updart_price" || id_val == "updart_purchase" || id_val == "updart_price") {
      if (isNaN(Number(x.value))) {
        swal("Sayısal Değer Girin", "", "error");
        x.value = "";
      }
    } else if (id_val == "art_year") {
      if (isNaN(Number(x.value)) || x.value.length != 4) {
        swal("Geçerli Bir Tarih Girin", "", "error");
        x.value = "";
      }
    }


  }
/*
  function openDetailupd(evt, detail) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontentupd");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinksupd");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(detail).style.display = "block";
    evt.currentTarget.className += " active";
  }
*/


  function validateForm() {
    var user_name = document.forms["usr_upd"]["user_name"].value;
    var user_lastname = document.forms["usr_upd"]["user_lastname"].value;
    var user_username = document.forms["usr_upd"]["user_username"].value;
    var user_password = document.forms["usr_upd"]["user_password"].value;
    //var art_price = document.forms["art_upd"]["art_price"].value;
    //var art_detail = document.forms["usr_upd"]["art_detail"].value;
   // var art_file = document.forms["art_upd"]["art_file"].value;
    if (user_name == "") {
      swal("Eser Ad Girilmemiş", "", "error");
      return false;
    } else if (user_lastname == "") {
      swal("Eser Tür Girilmemiş", "", "error");
      return false;
    } else if (user_username == "") {
      swal("Sanatçı Seçilmemiş", "", "error");
      return false;
    } else if (user_password == "") {
      swal("Eser Boyut Girilmemiş", "", "error");
      return false;
    } //else if (art_price == "") {
      //swal("Eser Fiyat Girilmemiş", "", "error");
      //return false;
    //} 
   // else if (art_file == "") {
      //swal("Fotograf Seçilmemiş", "", "error");
      //return false;
    //} 
    else {
      document.getElementById("user_password").value= CryptoJS.MD5(document.getElementById("user_password").value).toString();
      document.getElementById("submit_user").submit()
    }

  }

  document.addEventListener('invalid', (function() {
    return function(e) {
      e.preventDefault();
    };
  })(), true);


</script>

<?php require_once 'footer.php' ?>