<?php require_once 'header.php'; ?>

<!-- <style>

  tbody tr:nth-child(even){
    background-color: #f2f2f2;
  } 

</style> -->
<title>Eser Tip</title>
<style>

  /* The popup form - hidden by default */
  .form-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 50px;
    border: 1px solid #17A673;
    z-index: 9;
  }

  /* Add styles to the form container */
  .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
  }

  /* Full-width input fields */
  .form-container input[type=text]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
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
    width: 100%;
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
  tr{
    font-size: 14px
  }
  #dataTable td{
  color: black;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid" id="container-fluid">

  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">Sanatçılar Liste<a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Masraf Tipleri</h6>
    </div>
<div class="card-body">

      <?php 
        if(isset($_POST["expensetypeInsert"])){
            $result=$db->insert("expensetype",$_POST,["form_name"=>"expensetypeInsert"]);
            if($result["status"]==true || $_GET['success']=="True" ){?>
            <div class="alert alert-success">
              Kayıt Başarılı...
            </div>
         
            <?php header("Location:expensetype.php?success=True"); ?>
      
     <?php } else if($result["status"]==false){?>
              <div class="alert alert-danger">
              Kayıt Başarısız...
            </div>
      <?php }

        }


        if(isset($_POST["expensetypeUpdate"])){
          $result=$db->update("expensetype",$_POST,["form_name"=>"expensetypeUpdate","Id"=>"type_id"]);

          if($result["status"]==true){?>
          <div class="alert alert-success">
            Güncelleme Başarılı...
          </div>
          <?php header("Location:expensetype.php?success=True"); ?>
    
   <?php } else if($result["status"]==false){?>
            <div class="alert alert-danger">
            Güncelleme Başarısız...
          </div>
    <?php }

      }

      if (isset($_GET["expensetypedelete"])) {
        $id=$_GET['type_id'];
        $result = $db->delete("expensetype","type_id",$_GET['type_id'] );
      
        if ($result["status"] == TRUE) { ?>
          <div class="alert alert-success">
            Silme Başarılı...
          </div>
          <?php header("Location:expensetype.php"); ?>
        <?php } else if ($result["status"] == FALSE) { ?>
          <div class="alert alert-danger">
            Silme Başarısız...
          </div>
      <?php }
      }

      ?>

<?php if ($_GET["success"] == True) {?>
            <div class="alert alert-success">
             İşlem Başarılı.
          </div> <?php } ?>  
      <div class="table-responsive">
        <div align="right">
          <button class="btn btn-success" onclick="openForm()"><i class="fas fa-plus"></i></button>
        </div> <br>

        <div class="form-popup" id="myForm">
          <form method="POST"  class="form-container">
            <h3>Masraf Tipi Ekle</h3>
            <br>
            <label for="expenseName"><b>Masraf Tip Adı</b></label>
            <input type="text" placeholder="Ad" name="type_name" required>

            <button type="submit" class="btn" name="expensetypeInsert">Ekle</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
          </form>
        </div>

     <!--- update Form --->   
        <div class="form-popup" id="updForm">
          <form method="POST"  class="form-container">
            <h3>Masraf Tip Güncelle</h3>
            <br>
            <label for="expenseName"><b>Masraf Tip Adı</b></label>
            <input type="text" placeholder="Ad" name="type_name" id="type_name" required>

            <input type="hidden" name="type_id" id="type_id" >

            <button type="submit" class="btn" name="expensetypeUpdate">Güncelle</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
          </form>
        </div>
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Masraf Tipi</th>
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

            $sql = $db->read("expensetype");
            $count = 0;
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
              $count++;
              $typeid=$row["type_id"];
              $sql2 = $db->qSql("SELECT * FROM expenses WHERE expenses.expensetype_id=$typeid");
              $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
              $record=$sql2->rowCount();
            ?>

              <tr>
                <td align="center" width="5"><?php echo $count ?></td>
                <td  width="250"><?php echo $row["type_name"] ?></td>
                <td align="center" width="5"> <button class="btn btn-info btn-circle btn-sm" onclick="openUpdForm('<?php echo $row["type_id"] ?>','<?php echo $row["type_name"] ?>' )"><i class="fas fa-edit"></i></button></td>
                <td  align="center"  width="5"><a id="delete_expensetype" onclick="deleteConfirm(<?php echo $row['type_id'] ?>,<?php echo $record ?>)" href="#" class="btn btn-danger btn-circle btn-sm"><i class="far fa-trash-alt"></i></a></td>
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
    function deleteConfirm(id,record){
/*  if(confirm("Lot-"+id+" Nolu Kayıt Silinecek Emin Misiniz?")){
    document.getElementById("delete_action").href="?actiondelete=True&art_id="+id;
    document.getElementById("delete_action").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_action").click()
  }*/

  if(record==0){
    Swal.fire({
  title: 'Emin Misiniz?',
  text: "Masraf Tipi Silinecek!",
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
    document.getElementById("delete_expensetype").href="?expensetypedelete=True&type_id="+id;
    document.getElementById("delete_expensetype").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_expensetype").click()})
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
  else{

    swal("Masraf Tipi Silinemez", "Masraf İşleminde Kullanılmış", "error");
    return false;
  }
  




}
 
  function openForm() {
    if(document.getElementById("myForm").style.display === "block"){
      document.getElementById("myForm").style.display = "none";
    }else{
      document.getElementById("myForm").style.display = "block";

    }
    
  }

  function openUpdForm(artist_id,artist_name,artist_lastname) {
    if(document.getElementById("updForm").style.display === "block"){
      document.getElementById("updForm").style.display = "none";

    }else{
      document.getElementById("updForm").style.display = "block";
      document.getElementById("type_name").value=artist_name;
      document.getElementById("type_id").value=artist_id;
      
    }
    
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("updForm").style.display = "none";
  }


</script>

<?php require_once 'footer.php' ?>