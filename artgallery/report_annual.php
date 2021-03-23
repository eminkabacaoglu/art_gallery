<?php require_once 'header.php';
setlocale (LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');
$yearNow=date("Y");
$sqlAct = $db->qSql("SELECT MIN(YEAR(action_date)) as minActYear FROM actions");
$rowAct = $sqlAct->fetch(PDO::FETCH_ASSOC);
$minYearAct=$rowAct["minActYear"];
$sqlExp = $db->qSql("SELECT MIN(YEAR(expense_date)) as minExpYear FROM expenses");
$rowExp = $sqlExp->fetch(PDO::FETCH_ASSOC);
$minYearExp=$rowExp["minExpYear"];
$sqlPur = $db->qSql("SELECT MIN(YEAR(purchase_date)) as minPurYear FROM art_purchase");
$rowPur = $sqlPur->fetch(PDO::FETCH_ASSOC);
$minYearPur=$rowPur["minPurYear"];
$minYear=min($minYearAct,$minYearExp,$minYearPur);
?>
</style>
<title>Yıllara Göre Aylık Durum</title>
<style type="text/css">


  tr {
    font-size: 15px;

  }

  #dataTable td {
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
      <h6 class="m-0 font-weight-bold text-primary">Yıllara Göre Aylık Durum</h6>
    </div>
    <div class="card-body">

      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Yıl</th>
              <!---<th>Satış Adet</th>--->
              <th>Satış</th>
              <th>Alışlar</th>
              <th>Masraflar</th>
              <th>Kar/Zarar</th>
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

            $count = 0;
            while ($minYear<=$yearNow) {

                  $sqlAct = $db->qSql("SELECT SUM(actions.sales_price) as sales_total  FROM actions where YEAR(actions.action_date)=$yearNow ");
                  $rowAct = $sqlAct->fetch(PDO::FETCH_ASSOC);

                  $sqlExp = $db->qSql("SELECT SUM(expenses.expense_amount) as expenses_total  FROM expenses where YEAR(expenses.expense_date)=$yearNow");
                  $rowExp = $sqlExp->fetch(PDO::FETCH_ASSOC);

                  $sqlPur= $db->qSql("SELECT SUM(art_purchase.purchase_price) as purchase_total  FROM art_purchase where YEAR(art_purchase.purchase_date)=$yearNow");
                  $rowPur = $sqlPur->fetch(PDO::FETCH_ASSOC);
                  
                  
            ?>
            <?php 
            
                  $expenses= number_format($rowExp["expenses_total"], 2, ",", ".");
                  $purchase= $rowPur["purchase_total"];  
                  $sales=$rowAct["sales_total"];
                  $profit=round($rowAct["sales_total"]-$rowPur["purchase_total"]-$rowExp["expenses_total"],2);

              if($expenses==0 and $purchase==0 and $sales==0 and $profit==0){
                continue;
              }
              else{    
              $count++
            ?>
            
             <tr>
                <td width="1"><?php echo $count ?></td>
                <td width="55"><?php echo $yearNow;  ?></td>
                <td width="100" align="right"><?php echo  number_format($sales, 0, ",", ".")?></td>
                <td width="100" align="right"><?php echo  number_format($purchase, 0, ",", ".")?></td>
                <td width="100" align="right"><?php echo $expenses ?></td>
                <td width="100" align="right" <?php if($profit>=0){ ?> style="color: green; <?php } else if($profit<0){?> style="color: red;<?php }  ?>font-weight: bold"><?php echo number_format($profit, 2, ",", ".") ?></td>
              </tr>
              <?php }  $yearNow-=1;}  ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<?php require_once 'footer.php' ?>