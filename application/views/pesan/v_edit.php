<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $title2 ?></h3>
            </div>
            <!-- /.box-header -->
            <?php 
            echo validation_errors('<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>');
            echo form_open_multipart('pesan/edit/'.$pesan->id_pesan);
            ?>
            <!-- form start -->
              <div class="box-body">
              <div class="form-group">
                  <label for="id_tamu">Nama Tamu</label>
                  <select name="id_tamu" class="form-control" >
                        <option value="<?= $pesan->id_tamu?>"><?= $pesan->nama_tamu?></option>
                        <?php foreach($tamu as $key => $value) { ?>
                        <option value="<?= $value->id_tamu ?>"><?= $value->nama_tamu?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="id_kamar">Harga</label>
                  <select name="id_kamar" class="form-control" >
                        <option value="<?= $pesan->id_kamar?>"><?= $pesan->harga?></option>
                        <?php foreach($kamar as $key => $value) { ?>
                        <option value="<?= $value->id_kamar ?>"><?= $value->harga?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="tgl_checkin">Tanggal Checkin</label>
                  <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin" value="<?= $pesan->tgl_checkin?>" required>
                </div>
                <div class="form-group">
                  <label for="tgl_checkout">Tanggal Checkout</label>
                  <input type="date" class="form-control" id="tgl_checkout" name="tgl_checkout" value="<?= $pesan->tgl_checkout?>" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-success">Reset</button>
              </div>
            <?php echo form_close(); ?>
          </div>
      </div>
      <!-- /.row (main row) -->

    </section>
</div>