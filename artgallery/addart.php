<?php require_once 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid" id="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">Sanatçılar Liste<a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->
    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Eser Kaydet</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <form method="POST" enctype="multipart/form-data">


                    <div class="form-group">
                        <label>Ürün, Hizmet Adı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="text" name="products_title" required="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ürün, Hizmet Detay</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea id="editor1" class="form-control" name="products_content"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ürün, Hizmet Fiyat</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="text" name="products_price" required="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success" name="products_insert">Ekle</button>
                    </div>



                </form>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<?php require_once 'footer.php' ?>