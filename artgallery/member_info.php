<?php 
require_once 'header.php';

$sql=$db->wread("members","member_id",htmlspecialchars($_GET['id']));
$row_account=$sql->fetch(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="css/AdminLTE.css">


<title>Üye Detay</title>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

          </div>
          <div class="box-body">

            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                  <i class="fas fa-user"></i><?php echo " ".$row_account['member_name']." ".$row_account['member_lastname']?>
                    

                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <hr>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong></strong><br>
                    <i class="fas fa-mobile-alt"></i><?php echo " ".$row_account['member_mobile'] ?><br>
                    <i class="fas fa-envelope"></i><?php echo " ".$row_account['member_email'] ?><br>
                    <i class="fas fa-map-marked-alt"></i><?php echo " ".$row_account['member_address'] ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
          <!--To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address>-->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <!-- <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567-->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row 
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <h2 class="page-header">Üyeye Yapılan Satışlar</h2>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th align="center" width="5">#</th>
                <th>Tarih</th>
                <th>Eser</th>
                <th>Hesap</th>
                <th>Tutar</th>
                <th>Tahsilat</th>
                <th>Kalan</th>

              </tr>
            </thead>
            <tbody>
              <?php 
              $sql=$db->qSql("SELECT * FROM sales INNER JOIN account ON account.account_id=sales.account_id INNER JOIN products ON products.products_id=sales.products_id WHERE sales.account_id='{$_GET['account_id']}'");

              $say=1;
              while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>

                <tr> 
                  <td><?php echo $say++; ?></td>
                  <td width="150"><?php echo $db->tDate($row['sales_date'],["date_time" => TRUE]) ?></td>
                  <td><?php echo $row['products_title'] ?></td>
                  <td><?php echo empty($row['account_company']) ? $row['account_authorized_name_surname'] : $row['account_company'] ?></td>
                  <td><?php echo $row['products_price'] ?> ₺</td>
                  <td>
                    <?php 
                    $sql_revenue=$db->qSql("SELECT SUM(operation_price) as revenue FROM operation WHERE operation_type='Gelir' AND account_id='{$_GET['account_id']}' AND products_id='{$row['products_id']}'");
                    $revenue=$sql_revenue->fetch(PDO::FETCH_ASSOC);
                    echo number_format($revenue['revenue'],2);
                    ?> ₺
                  </td>
                  <td><?php echo $row['products_price']-$revenue['revenue'] ?> ₺</td>


                </tr>

              <?php } ?>

            </table>
          </div>
  
        </div>
      
        -->
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <h2 class="page-header">Satışlar</h2>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th align="center" width="5">#</th>
                  <th>Tarih</th>
                  <th>Tip</th>
                  <th>Eser</th>
                  <th>Sanatçı</th>
                  <th>Tutar ₺</th>
                  


                </tr>
              </thead>
              <tbody>

                <?php 
                
                $sql=$db->qSql("SELECT * FROM actions INNER JOIN members ON members.member_id=actions.member_id INNER JOIN arts ON arts.art_id=actions.art_id INNER JOIN artists ON artists.artist_id=arts.artist_id WHERE actions.member_id='{$_GET['id']} order by actions.action_id DESC'");
                $say=1;
                while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>
                    <?php $date = date_create($row["action_date"]); ?>
                  <tr> 
                    <td><?php echo $say++; ?></td>
                    <td width="100"><?php echo date_format($date, 'd.m.Y');?></td>
                    <td width="50"><span class='label label-success'>Gelir</span></td>
                    <td width="300"><?php echo "Lot-".$row['art_id']." ".$row['art_name'] ?></td>
                    <td width="300"><?php echo $row['artist_name']." ".$row['artist_lastname'] ?></td>
                    <td width="150" align="right"><?php echo number_format($row['sales_price'], 0, ",", "."); ?></td>
                    
                  </tr>

                <?php } ?>

              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <h2 class="page-header">Alışlar</h2>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th align="center" width="5">#</th>
                  <th>Tarih</th>
                  <th>Tip</th>
                  <th>Eser</th>
                  <th>Sanatçı</th>
                  <th>Tutar ₺</th>
                  


                </tr>
              </thead>
              <tbody>

                <?php 
                
                $sql=$db->qSql("SELECT * FROM art_purchase INNER JOIN members ON members.member_id=art_purchase.member_id INNER JOIN arts ON arts.art_id=art_purchase.art_id INNER JOIN artists ON artists.artist_id=arts.artist_id WHERE art_purchase.member_id='{$_GET['id']} order by art_purchase.purchase_date DESC'");
                $say=1;
                while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>
                    <?php $date = date_create($row["action_date"]); ?>
                  <tr> 
                    <td><?php echo $say++; ?></td>
                    <td width="100"><?php echo date_format($date, 'd.m.Y');?></td>
                    <td width="50"><span class='label label-danger'>Gider</span></td>
                    <td width="300"><?php echo "Lot-".$row['art_id']." ".$row['art_name'] ?></td>
                    <td width="300"><?php echo $row['artist_name']." ".$row['artist_lastname'] ?></td>
                    <td width="150" align="right"><?php echo number_format($row['purchase_price'], 0, ",", "."); ?></td>
                    


                  </tr>

                <?php } ?>

              </table>
            </div>
            <!-- /.col -->
          </div>

          <div class="row">
            <hr>
            <!-- accepted payments column
            <div class="col-xs-4">
              <p class="lead">Bilgi:</p>


              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div> -->
            <!-- /.col -->
            <div class="col-md-4">
              <p class="lead">Hesap Özeti</p>

              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Toplam Satış:</th>
                    <td style="color:green" align="right">
                      <?php 
                      $sql=$db->qSql("SELECT SUM(sales_price) as sales_total FROM actions INNER JOIN members ON members.member_id=actions.member_id  WHERE actions.member_id='{$_GET['id']}'");
                       $sales_total=$sql->fetch(PDO::FETCH_ASSOC);
                       echo number_format($sales_total=$sales_total['sales_total'], 0, ",", ".");
                      ?> ₺

                    </td>
                  </tr>
                  <!---
                  <tr>
                    <th>Gelir (Tahsil)</th>
                    <td>
                      <?php 
                      $sql=$db->qSql("SELECT SUM(operation_price) as revenue FROM operation  WHERE operation.operation_type='Gelir' AND account_id='{$_GET['account_id']}'");
                       $revenue=$sql->fetch(PDO::FETCH_ASSOC);
                       echo number_format($revenue=$revenue['revenue'], 0, ",", ".");
                      ?> ₺

                    </td>
                  </tr>
                  ---> 
                  <tr>
                    <th>Toplam Alış:</th>
                    <td style="color:orangered" align="right"><?php 
                      $sql=$db->qSql("SELECT SUM(purchase_price) as purchase_total FROM art_purchase INNER JOIN members ON members.member_id=art_purchase.member_id  WHERE art_purchase.member_id='{$_GET['id']}'");
                       $expense=$sql->fetch(PDO::FETCH_ASSOC);
                       echo number_format($expense=$expense['purchase_total'], 0, ",", ".");
                   
                      ?> ₺</td>
                  </tr>
                <!---  <tr>
                    <th>Bakiye:</th>
                    <td>
                      <?php echo number_format($sales_total-$revenue) ?>₺
                    </td>
                  </tr> --->
                  <tr>
                    <th><?php if(($sales_total-$expense)>=0){echo "Kar:";}else{ echo "Zarar:";} ?></th>
                    <td <?php if(($sales_total-$expense)>=0){echo "style='color:green'";}else{ echo "style='color:orangered'";} ?>  align="right">
                      <?php echo number_format($sales_total-$expense, 0, ",", "."); ?> ₺
                    </td>
                  </tr>
                </tbody></table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->

        </section>
      </div>
      <!-- /.box-body -->
       <!--  <div class="box-footer">
          Footer
        </div> -->
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once 'footer.php' ?>