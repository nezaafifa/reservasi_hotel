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
            echo form_open_multipart('tamu/add_tambah');
            ?>
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="tamu_nama">Nama Tamu</label>
                  <input type="text" class="form-control" id="tamu_nama" name="tamu_nama" placeholder="Isi Nama Tamu" required>
                </div>
                <div class="form-group">
                  <label for="jns_kelamin">Jenis Kelamin</label>
                  <input type="text" class="form-control" id="jns_kelamin" name="jns_kelamin" placeholder="Isi Jenis Kelamin" required>
                </div>
                <div class="form-group">
                  <label for="warganegaraan">Warganegaraan</label>
                  <input type="text" class="form-control" id="warganegaraan" name="warganegaraan" placeholder="Isi wargenegaraan" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isi Alamat" required>
                </div>
                <div class="form-group">
                  <label for="no_tlp">Telepon</label>
                  <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Isi Telepon" required>
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