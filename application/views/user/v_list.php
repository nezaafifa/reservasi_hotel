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
              <h3 class="box-title"> Data User</h3>
            </div>
            <div class="panel-heading">
                <a href="<?= base_url('user/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
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
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>TTD</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($user as $key => $value) { ?>
                    <tr>
                        <td>
                            <a href="<?= base_url('user/edit/'.$value->user_id) ?>" class="btn btn-sm btn-outline-success"><i class="fa fa-fw fa-pencil"></i> </a>
                            <a href="<?= base_url('user/delete/'.$value->user_id) ?>" onclick="return confirm('Apakah data ini akan dihapus ???')"  class="btn btn-sm btn-outline-danger"><i class="fa fa-fw fa-trash"></i> </a>
                        </td>
                        <td><?= $no++ ?></td>
                        <td><?= $value->username?></td>
                        <td><?= $value->password?></td>
                        <td><?= $value->nama?></td>
                        <td><?= $value->alamat?></td>
                        <td><img src="<?= base_url('ttd/'.$value->ttd) ?>" width="100px"></td>
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