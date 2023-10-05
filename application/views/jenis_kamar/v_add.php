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
            echo form_open_multipart('jenis_kamar/add');
            ?>
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="nama_kamar">Nama Kamar</label>
                  <input type="text" class="form-control" id="jeniskamar_nama" name="jeniskamar_nama" placeholder="Isi Nama Kamar" required>
                </div>
                <div class="form-group">
                  <label for="fasilitas">Fasilitas</label>
                  <input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Isi Fasilitas" required>
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