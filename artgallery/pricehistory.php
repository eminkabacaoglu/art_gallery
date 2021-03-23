<?php require_once 'header.php';
setlocale (LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');
?>
</style>
<title>Eser Fiyat Tarihçesi</title>
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




</style>

<?php 
if (isset($_GET["pricedelete"])) {
  $id=$_GET['price_id'];
  $result = $db->delete("art_list_price","list_price_id",$_GET['price_id'] );

  if ($result["status"] == TRUE) { ?>
    <div class="alert alert-success">
      Silme Başarılı...
    </div>
    <?php header("Location:pricehistory.php"); ?>
  <?php } else if ($result["status"] == FALSE) { ?>
    <div class="alert alert-danger">
      Silme Başarısız...
    </div>
<?php }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid" id="container-fluid">

  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">Sanatçılar Liste<a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Eser Fiyat Tarihçesi</h6>
    </div>
    <div class="card-body">

      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Kod</th>
              <th>Görsel</th>
              <th>Eser Ad</th>
              <th>Tür</th>
              <th>Fiyat</th>
              <th>Tarih</th>
              <th>Boyut</th>
              <th>Teknik</th>
              <th>Sanatçı</th>
              <th>Statü</th>
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

            $sql = $db->qSql("SELECT * FROM arts, artists,arttype,art_list_price WHERE arts.artist_id=artists.artist_id AND arts.arttype_id=arttype.arttype_id AND  art_list_price.art_id=arts.art_id order by arts.art_status DESC, arts.art_id ASC,list_price_id DESC");
            $count = 0;
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
              $count++
            ?>
             <?php $date= date_create($row["list_price_date"]); ?>
            
             <tr>
                <td width="1"><?php echo $count ?></td>
                <td width="55">LOT-<?php echo $row["art_id"] ?></td>
                <td width="55"><img src="img/arts/<?php echo $row["art_file"] ?>" alt="" border=3 height=100 width=100></img></td>
                <td width="150"><?php echo $row["art_name"] ?></td>
                <td width="30"><?php echo $row["arttype_name"] ?></td>
                <td width="50" align="right"><?php echo number_format($row["list_price_amount"], 0, ",", ".") ?></td>
                <td width="30"><?php echo  date_format($date, 'd.m.Y H:i:s'); ?></td>
                <td width="30" align="right"><?php echo $row["art_size"] ?></td>
                <td width="240"><?php echo $row["art_detail"] ?></td>
                <td width="150"><?php echo $row["artist_name"] . " " . $row["artist_lastname"]  ?></td>
                <td align="center" width="5">
                  <?php if($row["art_status"]==1) {?>
                      <button class="btn btn-success btn-sm">Aktif</button>
                      <?php }else if($row["art_status"]==3){ ?>   
                        <button class="btn btn-danger btn-sm">Satıldı</button>
                      <?php }else if($row["art_status"]==2){ ?>
                      <button class="btn btn-primary btn-sm">Rezerve</button>   <?php } ?>
                </td>
                <td  align="center"  width="5"><a id="delete_price" onclick="deleteConfirm(<?php echo $row['list_price_id'] ?>,<?php echo $row['art_id'] ?>)" href="#" class="btn btn-danger btn-circle btn-sm"><i class="far fa-trash-alt"></i></a></td>
              </tr>
            <?php  }  ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<script>
function deleteConfirm(id,art_id){
/*  if(confirm("Lot-"+id+" Nolu Kayıt Silinecek Emin Misiniz?")){
    document.getElementById("delete_action").href="?actiondelete=True&art_id="+id;
    document.getElementById("delete_action").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_action").click()
  }*/


  Swal.fire({
  title: 'Emin Misiniz?',
  text: "Lot-"+art_id+" İçin Fiyat Kayıdı Silinecek!",
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
    document.getElementById("delete_price").href="?pricedelete=True&price_id="+id;
    document.getElementById("delete_price").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_price").click()})
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

</script>
<?php require_once 'footer.php' ?>