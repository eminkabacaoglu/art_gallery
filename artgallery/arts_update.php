<?php require_once 'header.php'; ?>
</style>
<title>Eserler</title>
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
    margin-left: 5px;
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
  .container input[type=text] {
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



if (isset($_POST["artUpdate"])) {
  $result = $db->update("arts", $_POST, [
    "form_name" => "artUpdate", "Id" => "art_id", "dir" => "arts",
    "file_name" => "art_file", "file_delete" => "current_file",
  ]);

  if ($result["status"] == true) { ?>
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
$sql = $db->qSql("SELECT * FROM arts, artists,arttype WHERE arts.artist_id=artists.artist_id AND arts.arttype_id=arttype.arttype_id and art_id= '" . $_GET['id'] . "' order by arts.art_id ");
$row = $sql->fetch(PDO::FETCH_ASSOC)
?>


<div class="container">
<form  name="art_upd" method="POST" class="form-container" enctype="multipart/form-data">

  <div class="box">
    <img width="100%" height="100%" id="currentart_file" src="img/arts/<?php echo $row["art_file"] ?>" alt="">
    <input type="hidden" placeholder="Resim" name="current_file" id="current_file" value="<?php echo $row["art_file"] ?>">
    <input type="file" placeholder="" name="art_file" id="updart_file">
  </div>

  <div class="box" >


      <h5 class="m-0 font-weight-bold text-primary">Eser Güncelle</h5>


<!---
      <div class="tab">
        <button class="tablinksupd active" onclick="openDetailupd(event, 'Genel1')">Genel</button>
        <button class="tablinksupd " onclick="openDetailupd(event, 'Teknik1')">Teknik</button>
        <button class="tablinksupd" onclick="openDetailupd(event, 'Fiyat1')">Alış Satış Bilgileri</button>

      </div>
      <br>-->

      <label for="art_name"><b>Eser Ad</b></label>
      <input type="text" placeholder="Ad" name="art_name" id="updart_name" value="<?php echo $row["art_name"] ?>" required>
      <label for="arttype_id"><b>Tür</b></label>
      <select name="arttype_id" id="updarttype_id" required>
        <option value=""></option>
        <?php
        $sql2 = $db->read("arttype", ["column_name" => "arttype_name", "column_sort" => "ASC"]);
        while ($typerow = $sql2->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?php echo $typerow['arttype_id'] ?>" <?php if ($typerow['arttype_id'] == $row['arttype_id']) {
                                                                  echo "selected";
                                                                }  ?>><?php echo $typerow["arttype_name"] ?></option>

        <?php  } ?>

      </select>
      <label for="artist_id"><b>Sanatçı</b></label>
      <select name="artist_id" id="updartist_id" required>
        <option value=""></option>
        <?php
        $sql3 = $db->read("artists", ["column_name" => "artist_name", "column_sort" => "ASC"]);
        while ($artistrow = $sql3->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?php echo $artistrow['artist_id'] ?>" <?php if ($artistrow['artist_id'] == $row['artist_id']) {
                                                                  echo "selected";
                                                                }  ?>><?php echo $artistrow["artist_name"] . " " . $artistrow["artist_lastname"] ?></option>

        <?php  } ?>

      </select>



      <label for="art_size"><b>Boyut</b></label>
      <input type="text" placeholder="Boyut" name="art_size" id="updart_size" value="<?php echo $row["art_size"] ?>" required>

      <label for="art_detail"><b>Teknik</b></label>
      <input type="text" placeholder="Teknik" name="art_detail" id="updart_detail" value="<?php echo $row["art_detail"] ?>" required>


      <!---                                                          
      <label for="art_price"><b>Fiyat</b></label>
      <input type="text" placeholder="Fiyat" name="art_price" id="updart_price" onfocusout="numControl(id)" value="<?php echo number_format($row["art_price"], 0, ",", ".") ?>" required>--->



      <input type="hidden" name="art_id" id="updart_id" value="<?php echo $row["art_id"] ?>">
      <div align=center>
        <button type="submit" id="submit_art" class="btn" name="artUpdate" onclick="validateForm()">Güncelle</button>
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
    var art_name = document.forms["art_upd"]["art_name"].value;
    var arttype_id = document.forms["art_upd"]["arttype_id"].value;
    var artist_id = document.forms["art_upd"]["artist_id"].value;
    var art_size = document.forms["art_upd"]["art_size"].value;
    //var art_price = document.forms["art_upd"]["art_price"].value;
    var art_detail = document.forms["art_upd"]["art_detail"].value;
   // var art_file = document.forms["art_upd"]["art_file"].value;
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
    } //else if (art_price == "") {
      //swal("Eser Fiyat Girilmemiş", "", "error");
      //return false;
    //} 
   // else if (art_file == "") {
      //swal("Fotograf Seçilmemiş", "", "error");
      //return false;
    //} 
    else {
      document.getElementById("submit_art").submit()
    }

  }

  document.addEventListener('invalid', (function() {
    return function(e) {
      e.preventDefault();
    };
  })(), true);

/*
  var fnf = document.getElementById("updart_price");
fnf.addEventListener('keyup', function(evt){
    var n = parseInt(this.value.replace(/\D/g,''),10);
    fnf.value = n.toLocaleString();
   
}, false); */


</script>

<?php require_once 'footer.php' ?>