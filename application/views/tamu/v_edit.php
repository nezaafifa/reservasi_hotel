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
            echo form_open_multipart('tamu/edit/'.$tamu->id_tamu);
            ?>
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nama_tamu">Nama Tamu</label>
                  <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" value="<?= $tamu->nama_tamu?>" required>
                </div>
                <div class="form-group">
                  <label for="jns_kelamin">Jenis Kelamin</label>
                  <input type="text" class="form-control" id="jns_kelamin" name="jns_kelamin" value="<?= $tamu->jns_kelamin?>" required>
                </div>
                <div class="form-group">
                  <label for="warganegaraan">Warganegaraan</label>
                  <input type="text" class="form-control" id="warganegaraan" name="warganegaraan" value="<?= $tamu->warganegaraan?>" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $tamu->alamat?>" required>
                </div>
                <div class="form-group">
                  <label for="tlp">Telepon</label>
                  <input type="text" class="form-control" id="tlp" name="tlp" value="<?= $tamu->tlp?>" required>
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