<?php require_once 'header.php'; ?>

<!-- <style>

  tbody tr:nth-child(even){
    background-color: #f2f2f2;
  } 

</style> -->
<title>Üyeler</title>
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
  .form-container input[type=text],[type=email],[type=number]{
    width: 90%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text],[type=email],[type=number]:focus {
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
    vertical-align: middle

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
      <h6 class="m-0 font-weight-bold text-primary">Üyeler</h6>
    </div>
<div class="card-body">

      <?php 
        if(isset($_POST["memberInsert"])){
            $result=$db->insert("members",$_POST,["form_name"=>"memberInsert"]);
            if($result["status"]==true){?>
            <div class="alert alert-success">
              Kayıt Başarılı...
            </div>

            <?php header("Location:members.php?success=True"); ?>
     <?php } else if($result["status"]==false){?>
              <div class="alert alert-danger">
              Kayıt Başarısız...
            </div>
      <?php }

        }


        if(isset($_POST["memberUpdate"])){
          $result=$db->update("members",$_POST,["form_name"=>"memberUpdate","Id"=>"member_id"]);

          if($result["status"]==true){?>
          <div class="alert alert-success">
            Güncelleme Başarılı...
          </div>
          <?php header("Location:members.php?success=True"); ?>
   <?php } else if($result["status"]==false){?>
            <div class="alert alert-danger">
            Güncelleme Başarısız...
          </div>
    <?php }

      }

      if (isset($_GET["memberdelete"])) {
        $id=$_GET['member_id'];
        $result = $db->delete("members","member_id",$_GET['member_id'] );
      
        if ($result["status"] == TRUE) { ?>
          <div class="alert alert-success">
            Silme Başarılı...
          </div>
          <?php header("Location:members.php"); ?>
        <?php } else if ($result["status"] == FALSE) { ?>
          <div class="alert alert-danger">
            Silme Başarısız...
          </div>
      <?php }
      }


      ?>

    
      <div class="table-responsive">
        <div align="right">
          <button class="btn btn-success" onclick="openForm()"><i class="fas fa-plus"></i></button>
        </div> <br>

        <div class="form-popup" id="myForm">
          <form method="POST"  class="form-container">
            <h3>Üye Ekle</h3>

            <i class="fas fa-user" style="color:#17A673;"></i>
            <input type="text" placeholder="Ad" name="member_name" required>

            <i class="fas fa-user" style="color:white;"></i>
            <input type="text" placeholder="Soyad" name="member_lastname"  required>

            <i class="fas fa-envelope" style="color:#17A673;"></i>
            <input type="email" placeholder="E-mail" name="member_email"  >

            <i class="fas fa-mobile-alt" style="color:#17A673;font-size:25px"></i>
            <input type="number" placeholder="Mobil" name="member_mobile"  >

            <button type="submit" class="btn" name="memberInsert">Ekle</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
          </form>
        </div>

     <!--- update Form ---> 
     <?php if ($_GET["success"] == True) {?>
            <div class="alert alert-success">
             İşlem Başarılı.
          </div> <?php } ?>   
        <div class="form-popup" id="updForm">
          <form method="POST"  class="form-container">
            <h3>Üye Güncelle</h3>
            
            <i class="fas fa-user" style="color:#17A673;"></i>
            <input type="text" placeholder="Ad" name="member_name" id="member_name" required>

            <i class="fas fa-user" style="color:white"></i>
            <input type="text" placeholder="Soyad" name="member_lastname" id="member_lastname" required>
            

            <i class="fas fa-envelope" style="color:#17A673;"></i>
            <input type="email" placeholder="E-Mail" name="member_email" id="member_email"  >

            <i class="fas fa-mobile-alt" style="color:#17A673;font-size:25px"></i>
            <input type="number" placeholder="Mobil" name="member_mobile" id="member_mobile"  >

            <input type="hidden" name="member_id" id="member_id" >

            <button type="submit" class="btn" name="memberUpdate">Güncelle</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Çıkış</button>
          </form>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Ad</th>
              <th>Soyad</th>
              <th>E-Mail</th>
              <th>Mobil</th>
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

            $sql = $db->read("members");
            $count = 0;
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
              $count++;
              $memberid=$row["member_id"];
              $sqlRes = $db->qSql("SELECT * FROM art_reservation WHERE art_reservation.member_id=$memberid");
              $rowRes = $sqlRes->fetch(PDO::FETCH_ASSOC);
              $record_res=$sqlRes->rowCount();

              $sqlPur = $db->qSql("SELECT * FROM art_purchase WHERE art_purchase.member_id=$memberid");
              $rowPur = $sqlPur->fetch(PDO::FETCH_ASSOC);
              $record_pur=$sqlPur->rowCount();

              $sqlAct = $db->qSql("SELECT * FROM actions WHERE actions.member_id=$memberid");
              $rowAct = $sqlAct->fetch(PDO::FETCH_ASSOC);
              $record_act=$sqlAct->rowCount();  

              $record=$record_res+$record_pur+ $record_act
            ?>

              <tr>
                <td width="10" align="center" width="5"><?php echo $count ?></td>
                <td  width="150"><?php echo $row["member_name"] ?></td>
                <td  width="150"><?php echo $row["member_lastname"] ?></td>
                <td  width="200"><?php echo $row["member_email"] ?></td>
                <td  width="50"><?php echo $row["member_mobile"] ?></td>
                <td width="50" align="center" width="5"><a href="member_info.php?id=<?php echo $row["member_id"] ?>"><button class="btn btn-warning btn-circle btn-sm" ><i class="fas fa-eye"></i></button></a><span>    </span><button class="btn btn-info btn-circle btn-sm" onclick="openUpdForm('<?php echo $row["member_id"] ?>','<?php echo $row["member_name"] ?>','<?php echo $row["member_lastname"] ?>','<?php echo $row["member_email"] ?>','<?php echo $row["member_mobile"] ?>'  )"><i class="fas fa-edit"></i></button></td>
                <td  align="center"  width="5"><a id="delete_member" onclick="deleteConfirm(<?php echo $row['member_id'] ?>,<?php echo $record ?>)" href="#" class="btn btn-danger btn-circle btn-sm"><i class="far fa-trash-alt"></i></a></td>
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
  text: "Üye Silinecek!",
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
    document.getElementById("delete_member").href="?memberdelete=True&member_id="+id;
    document.getElementById("delete_member").onclick="" //onclick fonksiyonu tekrar çalışmasın diye önce boşalıyoruz.
    document.getElementById("delete_member").click()})
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

    swal("Üye Silinemez", "Üyeye Ait İşlemler Var !", "error");
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

  function openUpdForm(member_id,member_name,member_lastname,member_email,member_mobile) {
    if(document.getElementById("updForm").style.display === "block"){
      document.getElementById("updForm").style.display = "none";

    }else{
      document.getElementById("updForm").style.display = "block";
      document.getElementById("member_name").value=member_name;
      document.getElementById("member_lastname").value=member_lastname;
      document.getElementById("member_email").value=member_email;
      document.getElementById("member_mobile").value=member_mobile;
      document.getElementById("member_id").value=member_id;
      
    }
    
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("updForm").style.display = "none";
  }


</script>

<?php require_once 'footer.php' ?>