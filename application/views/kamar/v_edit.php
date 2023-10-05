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
            echo form_open_multipart('kamar/edit/'.$kamar->kamar_id);
            ?>
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="jeniskamar_id">Nama Kamar</label>
                  <select name="jeniskamar_id" class="form-control" >
                        <option value="<?= $kamar->jeniskamar_id?>"><?= $kamar->jeniskamar_nama?></option>
                        <?php foreach($jenis_kamar as $key => $value) { ?>
                        <option value="<?= $value->jeniskamar_id ?>"><?= $value->jeniskamar_nama?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" value="<?= $kamar->harga?>" required>
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