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
      <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Data Tamu</h3>
            </div>
            <div class="panel-heading">
                <a href="<?= base_url('tamu/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>

            <?php 
            if($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                echo $this->session->flashdata('pesan');
                echo '</div>';
            }
            ?>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Tamu</th>
                        <th>Jenis Kelamin</th>
                        <th>Warganegaraan</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($tamu as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->tamu_nama?></td>
                        <td><?= $value->jns_kelamin?></td>
                        <td><?= $value->warganegaraan?></td>
                        <td><?= $value->alamat?></td>
                        <td><?= $value->no_tlp?></td>
                        <td>
                            <a href="<?= base_url('tamu/edit/'.$value->tamu_id) ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> </a>
                            <a href="<?= base_url('tamu/delete/'.$value->tamu_id) ?>" onclick="return confirm('Apakah data ini akan dihapus ???')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> </a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
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