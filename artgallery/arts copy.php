<?php require_once 'header.php'; ?>

<title>Eserler</title>
<style type="text/css">
  /* The popup form - hidden by default */

  .form-popupupd {
    display: none;
    position: fixed;
    bottom: 0;
    right: 50px;
    border: 1px solid #17A673;
    z-index: 9;
  }

  .form-containerupd {
    max-width: 300px;
    padding: 10px;
    background-color: white;
  }


  /* Full-width input fields */
  .form-containerupd input[type=text]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-containerupd input[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Set a style for the submit/login button */
  .form-containerupd .btn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
    opacity: 0.8;
  }

  /* Add a red background color to the cancel button */
  .form-containerupd .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-containerupd .btn:hover,
  .open-button:hover {
    opacity: 1;
  }




  .form-popup {
    display: none;
    border: 1px solid #17A673;
    border-right: 6px solid #17A673;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    width: 100%;
    height: 100%;
    margin-left: 5px;
    padding: 10px;
    background-color: white;
  }

  /* Full-width input fields */
  .form-container input[type=text] {
    width: 100%;
    padding: 5px;
    margin: 0 0 20px 0;
    border: none;
    background: #f1f1f1;
  }

  .form-container input[type=file] {
    width: 100%;
    padding: 5px;
    margin: 0 0 20px 0;
    border: none;
    background: #f1f1f1;
  }

  .form-container select {
    width: 100%;
    padding: 5px;
    margin: 0 0 20px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus {
    background-color: #ddd;
    outline: none;
  }



  /* Set a style for the submit/login button */
  .form-container .btn {
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
  .form-container .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .form-container .btn:hover,
  .open-button:hover {
    opacity: 1;
  }

  tr {
    font-size: 13px;

  }

  #dataTable td {
    color: black;
    vertical-align: middle
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
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
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
if (isset($_POST["artInsert"])) {
  $result = $db->insert("arts", $_POST, [
    "form_name" => "artInsert", "dir" => "arts",
    "file_name" => "art_file"
  ]);

  if ($result["status"] == TRUE) { ?>
    <div class="alert alert-success">
      Kayıt Başarılı...
    </div>

  <?php } else if ($result["status"] == TRUE) { ?>
    <div class="alert alert-danger">
      Kayıt Başarısız...
    </div>
  <?php }
}


if (isset($_POST["priceInsert"])) {
  $result = $db->insert("art_list_price", $_POST, [
    "form_name" => "priceInsert"
  ]);

  if ($result["status"] == TRUE) { ?>
    <div class="alert alert-success">
      Güncelleme Başarılı...
    </div>
    <?php header("Location:arts.php"); ?>

  <?php } else if ($result["status"] == FALSE) { ?>
    <div class="alert alert-danger">
      Güncelleme Başarısız...
    </div>
<?php }
}

if (isset($_GET["artdelete"])) {

  $result = $db->delete("arts","art_id",$_GET['art_id'],$_GET['art_file'] );

  if ($result["status"] == TRUE) { ?>
    <div class="alert alert-success">
      Silme Başarılı...
    </div>
    <?php header("Location:arts.php"); ?>

  <?php } else if ($result["status"] == FALSE) { ?>
    <div class="alert alert-danger">
      Silme Başarısız...
    </div>
<?php }
}



?>

<div class="container" id="container">
  <div class="form-popup" id="myForm">
    <form name="art_add" method="POST" class="form-container" enctype="multipart/form-data">
      <h5 class="m-0 font-weight-bold text-primary">Eser Ekle</h5>
      <div class="tab">
        <button class="tablinks active" onclick="openDetail(event, 'Genel')">Genel</button>
        <button class="tablinks" onclick="openDetail(event, 'Teknik')">Teknik</button>
      <!--  <button class="tablinks" onclick="openDetail(event, 'Fiyat')">Alış Satış Bilgileri</button>-->
        <button class="tablinks" onclick="openDetail(event, 'Foto')">Foto</button>
      </div>

      <div id="Genel" style="display:block" class="tabcontent">
        <label for="art_name"><b>Eser Ad</b></label>
        <input type="text" placeholder="" name="art_name" required>
        <label for="arttype_id"><b>Tür</b></label>
        <select name="arttype_id" id="arttype_id" required>
          <option value=""></option>
          <?php
          $sql = $db->read("arttype", ["column_name" => "arttype_name", "column_sort" => "ASC"]);
          while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $row['arttype_id'] ?>"><?php echo $row["arttype_name"] ?></option>

          <?php  } ?>

        </select>
        <label for="art_year"><b>Eser Yılı</b></label>
        <input type="text" placeholder="" name="art_year" id="art_year" onfocusout="numControl(id)">
        <label for="artist_id"><b>Sanatçı</b></label>
        <select class="chosen" name="artist_id" id="artist_id" required>
          <option value=""></option>
          <?php
          $sql = $db->read("artists", ["column_name" => "artist_name", "column_sort" => "ASC"]);
          while ($artistrow = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $artistrow['artist_id'] ?>"><?php echo $artistrow["artist_name"] . " " . $artistrow["artist_lastname"] ?></option>

          <?php  } ?>

        </select>

      </div>

      <div id="Teknik" class="tabcontent">
        <label for="art_size"><b>Boyut</b></label>
        <input type="text" placeholder="Boyut" name="art_size" required>
        <label for="art_detail"><b>Teknik</b></label>
        <input type="text" placeholder="Teknik" name="art_detail" required>
      </div>
      <!---
      <div id="Fiyat" class="tabcontent">
        <label for="art_price"><b>Liste Fiyat</b></label>
        <input type="text" placeholder="" name="art_price" id="art_price" onfocusout="numControl(id)" required>
        <label for="art_purchase"><b>Alış Fiyat</b></label>
        <input type="text" placeholder="" name="art_purchase" id="art_purchase" onfocusout="numControl(id)">
        <label for="member_id"><b>Üye</b></label>
        <select name="member_id" id="member_id">
          <option value=""></option>
          <?php
          $sql = $db->read("members", ["column_name" => "member_name", "column_sort" => "ASC"]);
          while ($memberrow = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo $memberrow['member_id'] ?>"><?php echo $memberrow["member_name"] . " " . $memberrow["member_lastname"] ?></option>

          <?php  } ?>

        </select>
      </div> --->
      <div id="Foto" class="tabcontent">
        <label for="art_file"><b>Resim</b></label>
        <input type="file" placeholder="Resim" name="art_file" required>
      </div>
      <br>
      <div align=center>
        <button type="submit" id="submit_art" class="btn" onclick="validateForm()" name="artInsert">Ekle</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
      </div>

    </form>
  </div>
</div>
<!-- list price update--->
<div class="form-popupupd " id="updForm">
          <form name="price_add" method="POST"  class="form-containerupd">
            <h3>Fiyat Güncelle</h3>
            <i class="fas fa-user" style="color:#17A673;"></i>
            <label for="artist_name" id="artist_namelastname"><p></p></label>
            <br>
            <i class="fas fa-palette" style="color:#17A673;"></i>
            <label for="art_name" id="art_name"><b><p></p></b></label>

            <!---<label for="art_price"><b>Fiyat</b></label>--->
            <input type="text" placeholder="Fiyat" name="list_price_amount" id="list_price_amount" required>
            <input type="hidden"  name="art_id" id="art_id" >

            <button type="submit" class="btn" id="submit_price" onclick="validatePriceForm()" name="priceInsert">Güncelle</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
          </form>
        </div>


<!-- Begin Page Content -->
<div class="container-fluid" id="container-fluid">

  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">Sanatçılar Liste<a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Eserler</h6>
    </div>
    <div class="card-body">

      <div class="table-responsive">
        <div align="right">
          <button class="btn btn-success" onclick="openForm()"><i class="fas fa-plus"></i></button>
        </div> <br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Kod</th>
              <th>Görsel</th>
              <th>Eser Ad</th>
              <th>Tür</th>
              <th>Alış</th>
              <th>Fiyat</th>
              <th>Boyut</th>
              <th>Teknik</th>
              <th>Sanatçı</th>
              <th>Statü</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <!--  <tfoot>
            <tr>
              <th>Ad</th>
              <th>Soyad</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
          </tfoot> -->
          <tbody>

            <?php

            $sql = $db->qSql("SELECT * FROM arts, artists,arttype WHERE arts.artist_id=artists.artist_id AND arts.arttype_id=arttype.arttype_id order by arts.art_status DESC,arts.art_id  ");
            $count = 0;
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
              $count++
            ?>
            <?php 
              $artid=$row["art_id"];
              $sql2 = $db->qSql("SELECT * FROM art_list_price WHERE art_list_price.art_id=$artid ORDER BY list_price_id DESC LIMIT 0 , 1 ");
              $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
              $record_price=$sql2->rowCount();

              $actions_sql = $db->qSql("SELECT * FROM actions WHERE actions.art_id=$artid ");
              $act_row = $actions_sql->fetch(PDO::FETCH_ASSOC);
              $actions= $actions_sql->rowCount();

              $purchase = $db->qSql("SELECT * FROM art_purchase WHERE art_purchase.art_id=$artid ");
              $purch_row = $purchase->fetch(PDO::FETCH_ASSOC);
              $purchase_price=$purchase->rowCount();

              $reservation = $db->qSql("SELECT * FROM art_reservation WHERE art_reservation.art_id=$artid ");
              $reserv_row = $reservation->fetch(PDO::FETCH_ASSOC);
              $reserv=$reservation->rowCount();

              $record=$actions+$record_price+$reserv+$purchase_price
            ?> 
             
             <tr>
                <td width="1"><?php echo $count ?></td>
                <td width="55">Lot-<?php echo $row["art_id"] ?></td>
                <td width="55"><img src="img/arts/<?php echo $row["art_file"] ?>" alt="" border=3 height=100 width=100></img></td>
                <td width="150"><?php echo $row["art_name"] ?></td>
                <td width="30"><?php echo  $row["arttype_name"] ?></td>
                <td width="50" align="right"><?php echo number_format($purch_row["purchase_price"], 0, ",", ".") ?></td>
                <td width="50" align="right"><?php echo number_format($row2["list_price_amount"], 0, ",", ".") ?></td>
                <td width="30" align="right"><?php echo $row["art_size"] ?></td>
                <td width="240"><?php echo $row["art_detail"] ?></td>
                <td width="150"><?php echo $row["artist_name"] . " " . $row["artist_lastname"]  ?></td>
                <td align="center" width="5">
                  <?php if($row["art_status"]==1) {?>
                      <button class="btn btn-success btn-sm">Aktif</button>
                      <?php }else if($row["art_status"]==0){ ?>   
                        <button class="btn btn-danger btn-sm">Satıldı</button>
                      <?php }else if($row["art_status"]==2){ ?>
                      <button class="btn btn-primary btn-sm">Rezerve</button>   <?php } ?>
                </td>
                <td align="center" width="5"><div><button onclick="openUpdForm('<?php echo $row2["list_price_amount"] ?>','<?php echo $row["art_name"] ?>','<?php echo $row["artist_name"] ?>','<?php echo $row["artist_lastname"] ?>','<?php echo $row["art_id"] ?>')" class="btn btn-warning btn-circle btn-sm" ><i class="fas fa-dollar-sign"></i></button></div><br><a href="arts_update.php?id=<?php echo $row["art_id"] ?>"><button class="btn btn-info btn-circle btn-sm" ><i class="fas fa-edit"></i></button></a></td>
                <td  align="center"  width="5"><a id="delete_art"  
                      <?php if($record>0){ if($reserv_price) ?> href="#" class="btn btn-success btn-circle btn-sm"><i class="fas fa-arrow-circle-down"></i></a>  <?php } else{?>
                       href="?artdelete=True&art_id=<?php echo $row["art_id"] ?>&art_file=<?php echo $row["art_file"] ?>" class="btn btn-danger btn-circle btn-sm"><i class="far fa-trash-alt"></i></a></td>
                        <?php } ?>
                </tr>
            <?php  }  ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
<script type="text/javascript">




  function openForm() {
    if (document.getElementById("myForm").style.display === "block") {
      document.getElementById("myForm").style.display = "none";
      document.getElementById("container-fluid").style.opacity = "1";
    } else {
      document.getElementById("myForm").style.display = "block";
      document.getElementById("container-fluid").style.opacity = "0.3";
    }

  }



  function openForm() {
    if (document.getElementById("myForm").style.display === "block") {
      document.getElementById("myForm").style.display = "none";
      document.getElementById("container-fluid").style.opacity = "1";
    } else {
      document.getElementById("myForm").style.display = "block";
      document.getElementById("container-fluid").style.opacity = "0.3";
    }

  }
/*
  function openUpdForm(art_id, artist_id, art_name, art_price, arttype_id, art_size, art_detail, art_file) {
    if (document.getElementById("updForm").style.display === "block") {
      document.getElementById("updForm").style.display = "none";
      document.getElementById("container-fluid").style.opacity = "1";

    } else{

      document.getElementById("updForm").style.display = "block";
      document.getElementById("container-fluid").style.opacity = "0.3";
      document.getElementById("updart_id").value = art_id;
      document.getElementById("updartist_id").value = artist_id;
      document.getElementById("updart_name").value = art_name;
      document.getElementById("updart_price").value = art_price;
      document.getElementById("updarttype_id").value = arttype_id;
      document.getElementById("updart_size").value = art_size;
      document.getElementById("updart_detail").value = art_detail;
      document.getElementById("current_file").value = art_file;
      document.getElementById("currentart_file").src = 'img/arts/' + art_file;

    }

  } */

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("container-fluid").style.opacity = "1";
    document.getElementById("updForm").style.display = "none";

  }

  function numControl(id_val) {
    var x = document.getElementById(id_val);
    if (id_val == "art_price" || id_val == "art_purchase" || id_val == "updart_price") {
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

  function openDetail(evt, detail) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(detail).style.display = "block";
    evt.currentTarget.className += " active";
  }

  function openUpdForm(art_price,art_name,artist_name,artist_lastname,art_id) {
    if(document.getElementById("updForm").style.display === "block"){
      document.getElementById("updForm").style.display = "none";

    }else{
      document.getElementById("updForm").style.display = "block";
      document.getElementById("artist_namelastname").textContent=artist_name+" "+artist_lastname;
      document.getElementById("art_name").textContent=art_name;
      document.getElementById("art_id").value=art_id;
      document.getElementById("list_price_amount").value=art_price;
    }
    
  }


  function validateForm() {
    var art_name = document.forms["art_add"]["art_name"].value;
    var arttype_id = document.forms["art_add"]["arttype_id"].value;
    var artist_id = document.forms["art_add"]["artist_id"].value;
    var art_size = document.forms["art_add"]["art_size"].value;
    var art_price = document.forms["price_add"]["list_price_amount"].value;
    var art_detail = document.forms["art_add"]["art_detail"].value;
    var art_file = document.forms["art_add"]["art_file"].value;
    if (art_name == "") {
      swal("Eser Ad Girilmemiş", "", "error");
      return false;
    } else if (arttype_id == "") {
      swal("Eser Tür Girilmemiş", "", "error");
      return false;
    } else if (artist_id == "") {
      swal("Sanatçı Seçilmemiş", "", "error");
      return false;
    } else if (art_size == "") {
      swal("Eser Boyut Girilmemiş", "", "error");
      return false;
    } else if (art_detail == "") {
      swal("Teknik Bilgi Girilmemiş", "", "error");
      return false;
    } /*else if (art_price == "") {
      swal("Eser Fiyat Girilmemiş", "", "error");
      return false;
    }*/ else if (art_file == "") {
      swal("Fotograf Seçilmemiş", "", "error");
      return false;
    } else {
      document.getElementById("submit_art").submit()
    }

  }


  function validatePriceForm() {
    var art_price = document.forms["price_add"]["list_price_amount"].value;

    if (art_price == "") {
      swal("Eser Fiyat Girilmemiş", "", "error");
      return false;
    }
    else if(isNaN(Number(document.getElementById("list_price_amount").value))){
      swal("Sayısal Değer Giriniz", "", "error");
      document.getElementById("list_price_amount").value="";
      return false;
    }
    else {
      document.getElementById("submit_price").submit()
    }

  }


  document.addEventListener('invalid', (function() {
    return function(e) {
      e.preventDefault();
    };
  })(), true);

  $(".chosen").chosen;
</script>

<?php require_once 'footer.php' ?>