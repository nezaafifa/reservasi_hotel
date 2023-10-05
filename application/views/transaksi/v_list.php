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
              <h3 class="box-title"> Data Transaksi</h3>
            </div>
            <div class="panel-heading">
                <a href="<?= base_url('transaksi/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
            </div>

            <?php 
            if($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">   
                    <button type="button" class="close" data-dismiss="alert" 
                    aria-hidden="true">&times;</button>';
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
                        <th>Nama Pembooking</th>
                        <th>Tanggal Checkin</th>
                        <th>Tanggal Checkout</th>
                        <th>Lama Inap</th>
                        <th>Petugas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($transaksi as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value['pembooking_nm']?></td>
                        <td><?= to_date($value['checkin_tgl'],'','full_date')?></td>
                        <td><?= to_date($value['checkout_tgl'],'','full_date')?></td>
                        <td><?= $value['lama_inap']?></td>
                          <td><?= $value['petugas_nm']?></td>
                        <td>
                            <a href="<?= base_url('transaksi/edit/'.$value['transhotel_id']) ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> </a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-xs btn-table btn-delete" data-transhotel-id="<?= $value['transhotel_id'] ?>" title="Hapus Data"><i class="fa fa-sm fa-trash"></i></a>
                            <a href="<?= base_url('transaksi/show/'.$value['transhotel_id']) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> </a>
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

<script>
   $(document).ready(function() {
        // delete
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Aksi ini tidak bisa dikembalikan. Data ini mungkin terhubung dengan data lain.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#eb3b5a',
                cancelButtonColor: '#b2bec3',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                customClass: 'swal-wide'
            }).then((result) => {
                if (result.value) {
                    var transhotel_id = $(this).attr("data-transhotel-id");
                    //
                    $('#v_list').html('<tr><td class="text-center" colspan="99"><i class="fas fa-spin fa-spinner"></i><br>Loading</td></tr>');
                    $.post('<?= base_url('transaksi/delete') ?>', {
                        detail_id: detail_id,
                        transhotel_id: transhotel_id
                    }, function(data) {
                        $.toast({
                            heading: 'Sukses',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            position: 'top-right'
                        })
                        $('#v_list').html(data.html);
                    }, 'json');
                }
            })
        })
      });
</script>