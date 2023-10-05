<div class="content-wrapper">
  <section class="content-header">
        <h1>
          <?= $title ?>
          <small><?= $title2 ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?= $title2 ?></li>
        </ol>
      </section>

      <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Detail Transaksi</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
              <tr>
                <td class="text-left" width="20px">Kode Pemesanan</td>
                <td class="text-center" width="5px">:</td>
                <td class="text-center" width="200px"><?= $detail_transaksi->detail_transaksi_id ?></td>
              </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- ./col -->
      </div>
      <!-- /.row (main row) -->

    </section>
</div>