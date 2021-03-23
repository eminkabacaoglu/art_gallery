<?php 

require_once 'header.php';
?>

<div class="text-center">
  <h1>PAYMENT PAGE</h1>
</div>
<hr>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
    <form name="art_upd" method="POST" class="form-container" enctype="multipart/form-data">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th class="text-center">
              User ID
            </th>
            <th class="text-center">
              Name
            </th>
            <th class="text-center">
              NIC
            </th>
            <th class="text-center">
              Amount
            </th>
            <th class="text-center">
              Date
            </th>
          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
            <td>
              1
            </td>
            <td>
              <input type="text" name='uid' placeholder='User ID' class="form-control" />
            </td>
            <td>
              <input type="text" name='uname' placeholder='Name' class="form-control" />
            </td>
            <td>
              <input type="text" name='nic' placeholder='NIC' class="form-control" />
            </td>
            <td>
              <input type="text" name='amount' placeholder='Amount' class="form-control" />
            </td>
            <td>
              <input type="date" name='dt' placeholder='Date' class="form-control" />
            </td>
          </tr>
          <tr id='addr1'></tr>
        </tbody>
      </table>
      </form>
    </div>
  </div>
  <tr><button id="add_row" class="btn btn-primary btn-lg pull-left"><i class="fas fa-plus"></i></button></tr>
</div>


<script>
   var i = 1;

  $("#add_row").click(function() {
    $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input type='text' name='uid" + i + "'  placeholder='User ID' class='form-control input-md'/></td><td><input type='text' name='uname" + i + "' placeholder='Name' class='form-control input-md'/></td><td><input type='text' name='nic" + i + "' placeholder='NIC' class='form-control input-md'/></td><td><input type='text' name='amount" + i + "' placeholder='Amount' class='form-control input-md'/></td><td><input type='date' name='dt" + i + "' placeholder='Date' class='form-control input-md'/></td>");

    $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
    i++;
  });

</script>