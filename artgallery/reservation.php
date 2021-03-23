<?php require_once 'header.php';
setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');
?>


<title>Rezervasyon</title>
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
    .form-containerupd input[type=text] {
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

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }

    tr {
        font-size: 13px;

    }
    option {
         width: 100%;
        font-size: 13.5px;

    }

    #dataTable td {
        color: black;
        vertical-align: middle
    }

</style>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid" id="container-fluid">
  <!-- Content Header (Page header) -->

   <?php 


if (isset($_GET["reservationdelete"])) {
  $id=$_GET['art_id'];
  $result = $db->delete("art_reservation","art_id",$_GET['art_id'] );

  if ($result["status"] == TRUE) { ?>
    <div class="alert alert-success">
      Silme Başarılı...
    </div>
    <?php  $sql = $db->qSql("UPDATE arts SET art_status='1' WHERE arts.art_id=$id "); 
  
  ?>
    <?php header("Location:reservation.php?success=True"); ?>

  <?php } else if ($result["status"] == FALSE) { ?>
    <div class="alert alert-danger">
      Silme Başarısız...
    </div>
<?php }
}




   if (isset($_GET["reservationInsert"])) {?>
    <div class="card shadow mb-4">

      <div class="card-header py-3">
        <h5 >Rezerve Et</h5>      
      </div>

      <div class="card-body">

        <?php 
        if (isset($_POST["reservation_insert"])) {

         $result=$db->insert("art_reservation",$_POST,[
          "form_name" => "reservation_insert","Id" => "art_id"
        ]
      );

      if ($result["status"] == TRUE) {?>
       <div class="alert alert-success">
         Kayıt Başarılı.
       </div>
       
     <?php  header("Location:reservation.php?success=True"); } else {?>

      <div class="alert alert-danger">
       Kayıt Başarısız.<?php echo $result['error'] ?>
     </div>

      <?php }
    }

 ?>

      <!--  <div class="alert alert-success">
        Kayıt Başarılı
      </div> -->

      <form name="purchase_add" method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <label>Eser Seç</label>
              <select class="form-control"  name="art_id" id="art_id" required>
                <option value="">Seçim Yapın</option>
                <?php
                
                $sql = $db->qSql("SELECT * FROM arts WHERE art_status='1' order by art_id ASC");
                while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {
                    $id=$row['art_id'];  
                    $purchase_sql = $db->qSql("SELECT * FROM art_reservation where art_reservation.art_id=$id");
                    $purchase= $purchase_sql->rowCount();
                    if($purchase==0){   
                    ?>

                  <option value="<?php echo $row['art_id'] ?>"><?php echo "Lot-".$row['art_id']." ".$row['art_name'] ?></option>
                <?php }}?>
              </select>
    
          <br>
          <label>Üye Seç</label>
 
              <select  class="form-control" name="member_id" id="member_id" required>
                <option value="">Seçim Yapın</option>
                <?php 
                $sql2=$db->read("members",[
                  "columns_name" => "member_id",
                  "columns_sort" => "ASC"
                ]);
                
                while ($row2=$sql2->fetch(PDO::FETCH_ASSOC)) {  ?>
                  <option value="<?php echo $row2['member_id'] ?>"><?php echo $row2['member_name']." ".$row2['member_lastname'] ?></option>
                <?php } ?>
              </select>

              <br>
         <label>Alınan Avans</label>

              <input onfocusout="validatePrice()"  class="form-control" type="text" name="reservation_price" id="reservation_price" required>
          
        </div>

        <div align="right" >
          <button type="submit" class="btn btn-success" name="reservation_insert">Ekle</button>
       
        <a href="<?php $link=explode("?",$_SERVER['REQUEST_URI']); echo $link[0]; ?>"><button class="btn btn-danger" type="button">Çıkış</button></a>
       </div>

      </form>
    </div>

  </div>
<?php } ?>

 </div>

<!-- Begin Page Content -->
<div class="container-fluid" id="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">Sanatçılar Liste<a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rezerveler</h6>
        </div>
        <div class="card-body">
          <?php if ($_GET["success"] == TRUE) {?>
            <div class="alert alert-success">
             İşlem Başarılı.
          </div> <?php } ?> 
            <div class="table-responsive">

                <div align="right">
                    <a href="?reservationInsert=true"><button class="btn btn-success">Rezerve Et</button></a>
                    <br><br>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kod</th>
                            <th>Görsel</th>
                            <th>Eser Ad</th>
                            <th>Tür</th>
                            <th>Avans</th>
                            <th>Üye</th>
                            <th>Tarih</th>
                            <th>Boyut</th>
                            <th>Teknik</th>
                            <th>Sanatçı</th>
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

                        $sql = $db->qSql("SELECT * FROM arts, artists,arttype,art_reservation,members WHERE arts.artist_id=artists.artist_id AND arts.art_id=art_reservation.art_id AND arts.arttype_id=arttype.arttype_id AND members.member_id=art_reservation.member_id order by arts.art_id DESC");
                        $count = 0;
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            $count++
                        ?>
                            <?php $date = date_create($row["reservation_date"]); ?>

                            <tr>
                                <td width="1"><?php echo $count ?></td>
                                <td width="55">Lot-<?php echo $row["art_id"] ?></td>
                                <td width="55"><img src="img/arts/<?php echo $row["art_file"] ?>" alt="" border=3 height=100 width=100></img></td>
                                <td width="150"><?php echo $row["art_name"] ?></td>
                                <td width="30"><?php echo $row["arttype_name"] ?></td>
                               <td width="50" align="right"><?php echo number_format($row["reservation_price"], 0, ",", ".") ?>₺</td>
                                <td width="150"><?php echo $row["member_name"] . " " . $row["member_lastname"]  ?></td>
                                <td width="30"><?php echo  date_format($date, 'd.m.Y'); ?></td>
                                <td width="30" align="right"><?php echo $row["art_size"] ?></td>
                                <td width="200"><?php echo $row["art_detail"] ?></td>
                                <td width="190"><?php echo $row["artist_name"] . " " . $row["artist_lastname"]  ?></td>
                                <td  align="center"  width="5"><a id="delete_reservation" onclick="deleteConfirm(<?php echo $row['art_id'] ?>)" href="#" class="btn btn-danger btn-circle btn-sm"><i class="far fa-trash-alt"></i></a></td>

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
function deleteConfirm(id){
/*  if(confirm("Lot-"+id+" Nolu Kayıt Silinecek Emin Misiniz?")){
    document.getElementById("delete_action").href="?actiondelete=True&art_id="+id;
    document.getElementById("delete_action").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_action").click()
  }*/


  Swal.fire({
  title: 'Emin Misiniz?',
  text: "Lot-"+id+" Numaralı Kayıt Silinecek!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#17A673',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sil',
  cancelButtonText: 'İptal',
  
  
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Silindi!',
      'Kayıt Başarıyla Silindi.',
      'success',
    ).then((result) => {
    document.getElementById("delete_reservation").href="?reservationdelete=True&art_id="+id;
    document.getElementById("delete_reservation").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_reservation").click()})
  }
  else{
    Swal.fire(
      'İptal Edildi!',
      'Kayıt Silinmedi.',
      'error',
    )
  }
  
})




}

function validatePrice() {

    //if (id_val == "updart_price" || id_val == "updart_purchase" || id_val == "updart_price") {
      if (isNaN(Number(document.getElementById("reservation_price").value))) {
        swal("Sayısal Değer Girin", "", "error");
        document.getElementById("reservation_price").value = "";
      }

 } 
  //}

</script>

<?php require_once 'footer.php' ?>