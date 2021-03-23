<?php require_once 'header.php'; ?>
</style>
<title>Eser Satış</title>
<style type="text/css">
  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    right: 50px;
    border: 3px solid #f1f1f1;
    z-index: 9;

  }

  /* Add styles to the form container */
  .container {
    width: 100%;
    height: 100%;
    padding: 15px;
    background-color: white;

    max-width: 1800px
  }

  .form-container {
    width: 100%;
    height: 100%;
    padding: 15px;

  }

  .form-container-art {

    padding: 5px;
    background-color: white;
    max-height: 300px;
    overflow: auto
  }

  .box {

    width: 100%;
    height: 100%;
    margin-left: 5px;
    padding: 10px;
    max-width: 1800px
  }



  /* Full-width input fields */
  .container input[type=text] {

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
  input[type=text]:focus {
    outline-color: #4E73DF;
  }

  input {
    width: 100%
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

  .btn2 {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 25%;
    margin-bottom: 10px;
    opacity: 0.8;
    border-radius: 8px;
  }

  /* Add a red background color to the cancel button */
  .cancel {
    background-color: red;
  }

  /* Add some hover effects to buttons */
  .container .btn:hover,
  .open-button:hover {
    opacity: 1;
  }

  @media(max-width:768px) {
    .box {
      width: 100%;

    }

    .btn2 {
      width: 35%;
    }

  }

  @media(max-width:500px) {
    .box {
      width: 100%;
    }

    .btn2 {
      width: 35%;
    }
  }

  .form-popup tr {
    font-size: 12px;
  }

  .card-body tr {
    font-size: 14px;
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
      GÜncelleme Başarılı...
    </div>

  <?php } else if ($result["status"] == false) { ?>
    <div class="alert alert-danger">
      Güncelleme Başarısız...
    </div>
<?php }
}



?>

<!--- eser seçim --->
<div class="form-popup" id="artsForm">
  <div style="text-align: right">
    <button onclick="close_arts()" type="button" class="btn  btn-circle btn-sm"><b>X</b> </button>
  </div>
  <form method="POST" class="form-container-art">

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>#</th>
          <th>Kod</th>
          <th>Görsel</th>
          <th>Eser Ad</th>
          <th>Sanatçı</th>
        </tr>
      </thead>

      <tbody>

        <?php

        $sql = $db->qSql("SELECT * FROM arts, artists,arttype WHERE arts.artist_id=artists.artist_id AND arts.arttype_id=arttype.arttype_id AND arts.art_status='1' order by arts.art_id ");
        $count = 0;
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
          $count++
        ?>


          <tr>
            <td width="2"><?php echo $count ?></td>
            <td width="75" onclick="get_data(event)"><b style="cursor: pointer;color:#4E73DF;font-size:13px">Lot-<?php echo $row["art_id"] ?></b> </td>
            <td width="55"><img src="img/arts/<?php echo $row["art_file"] ?>" alt="" border=3 height=50 width=50></img></td>
            <td width="100"><?php echo $row["art_name"] ?></td>
            <td width="100"><?php echo $row["artist_name"] . " " . $row["artist_lastname"]  ?></td>

          </tr>
        <?php  }  ?>

      </tbody>
    </table>
  </form>
</div>

<div class="container-fluid" id="container-fluid">


  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">Sanatçılar Liste<a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Yeni Satış</h6>
    </div>
    <div class="card-body">
      <form name="art_upd" method="POST" class="form-container" enctype="multipart/form-data">
        <label for="">Üye</label>
        <input width="50%" type="text">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
            <thead>
              <tr>
                <!---<th>Seç</th>--->

                <th width="200">Eser Adı</th>
                <th width="200">Sanatçı</th>
                <th width="150">Alış Fiyatı</th>
                <th width="150">Satış Fiyatı</th>
                <th width="1" style="text-align:center"><button type="button" class="btn btn-success btn-circle btn-sm" onclick="open_arts()"><i class="fas fa-plus"></i></button></th>

              </tr>

            </thead>
            <div>
              <br>
            </div>
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
            <?php
            $sql2 = $db->qSql("SELECT * FROM arts, artists,arttype WHERE arts.artist_id=artists.artist_id AND arts.arttype_id=arttype.arttype_id AND arts.art_status='1' AND arts.art_id='<script>document.writeln(art_id)</script>'  order by arts.art_id ");
            $row2 = $sql2->fetch(PDO::FETCH_ASSOC);

            $sql3 = $db->qSql("SELECT * FROM art_list_price WHERE art_list_price.art_id=$id ORDER BY list_price_id DESC LIMIT 0 , 1 ");
            $row3 = $sql3->fetch(PDO::FETCH_ASSOC)
            ?>
            <tbody id="art_list">
              <tr id='addr0'></tr>
              <tr id='addr1'></tr>

            </tbody>
          </table>

          <div align=center>
            <button type="submit" class="btn2" name="artUpdate" onclick="validateForm()">Kaydet</button>
            <button type="button" class="btn2 cancel" onclick="closeForm()">Çıkış</button>
          </div>
        </div>

      </form>
    </div>
  </div>

</div>



<!-- /.container-fluid -->
<script>
  var i = 0;

  function remove_line(event) {
    event.target.parentElement.parentElement.remove();
  }


  function get_data(event) {

    var str = event.target.textContent.split("-");
    var art_id = parseInt(str[1]);
    //window.location.href = "artout.php?id=" + art_id
    $.post('artout3.php',{art_id:art_id},function(data){
      $('#newprice' + i).html(data)
    })
    
    <?php 
    $id=$_GET['id'];
    $sql2 = $db->qSql("SELECT * FROM arts, artists,arttype WHERE arts.artist_id=artists.artist_id AND arts.arttype_id=arttype.arttype_id AND arts.art_status='1' AND arts.art_id=$id order by arts.art_id ");
    $row2 = $sql2->fetch(PDO::FETCH_ASSOC);

    $a_id = $row2["art_id"];

    $sql3 = $db->qSql("SELECT * FROM art_list_price WHERE art_list_price.art_id=$a_id ORDER BY list_price_id DESC LIMIT 0 , 1 ");
    $row3 = $sql3->fetch(PDO::FETCH_ASSOC)
   ?>
    $('#addr' + i).html("<td>" + "<?php echo $row2['art_name'] ?>" + "</td><td><input type='text' name='artistname" + i + "' placeholder='Name' class='form-control input-md'/></td><td><input type='text' name='oldprice" + i + "' placeholder='Fiyat' class='form-control input-md'/></td><td><input type='text' id='newprice" + i + "' name='newprice" + i + "' placeholder='Fiyat' class='form-control input-md'/></td><td width='1' align='center'><button onclick='remove_line(event)' type='button' class='btn btn-danger btn-circle btn-sm'>X</button></td>");

    $('#dataTable2').append('<tr id="addr' + (i + 1) + '"></tr>');
    i++;

    event.preventDefault()

  }




  function closeForm() {
    document.location.href = 'arts.php'

  }


  function open_arts() {
    if (document.getElementById("artsForm").style.display === "block") {
      document.getElementById("artsForm").style.display = "none";
    } else {
      document.getElementById("artsForm").style.display = "block";

    }

  }

  function close_arts() {
    document.getElementById("artsForm").style.display = "none";
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
    var art_name = document.forms["art_out"]["art_name"].value;
    var arttype_id = document.forms["art_out"]["arttype_id"].value;
    var artist_id = document.forms["art_out"]["artist_id"].value;
    var art_size = document.forms["art_out"]["art_size"].value;
    //var art_price = document.forms["art_out"]["art_price"].value;
    var art_detail = document.forms["art_out"]["art_detail"].value;
    // var art_file = document.forms["art_out"]["art_file"].value;
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

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/sweetalert.min.js"></script>



</body>

</html>