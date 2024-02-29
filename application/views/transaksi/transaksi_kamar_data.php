<?php if (@$main == null) : ?>
    <tr>
        <td class="text-center" colspan="99"><i>Tidak ada data!</i></td>
    </tr>
<?php else : ?>
    <?php
    $i = 1;
    $tot_biaya = 0;
    foreach ($main as $row) :
        $tot_biaya += $row['total_biaya'];
        if ($i % 2 != 0) {
            $background = '#f5f5f5';
        } else {
            $background = '#ffffff';
        }
    ?>
        <tr style="background-color: <?= $background ?>">
            <td class="text-center"><?= $i++ ?></td>
            <td class="text-center">
                <a href="javascript:void(0)" class="btn btn-primary btn-xs btn-table btn-edit" data-detail-id="<?= $row['detail_id'] ?>" data-transhotel-id="<?= $row['transhotel_id'] ?>" title="Ubah Data"><i class="fa fa-sm fa-pencil"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-xs btn-table btn-delete" data-detail-id="<?= $row['detail_id'] ?>" data-transhotel-id="<?= $row['transhotel_id'] ?>" title="Hapus Data"><i class="fa fa-sm fa-trash"></i></a>
            </td>
            <td class="text-left">
                <?= $row['tamu_nama'] ?><br>
            </td>
            <td class="text-left"><?= $row['kamar_no'] ?></td>
            <td class="text-left"><?= $row['jeniskamar_nama'] ?></td>
            <td class="text-right"><?= number_format(@$row['total_biaya'], '2', ',', '.') ?></td>
        </tr>

    <?php endforeach; ?>
    <tr>
        <td class="text-right" colspan="5">
            <b>Total Biaya</b>
        </td>
        <td class="text-right">
            <b>
                <?= number_format(@$tot_biaya, '2', ',', '.') ?>
            </b>
        </td>
    </tr>
<?php endif; ?>
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
                    var detail_id = $(this).attr("data-detail-id");
                    var transhotel_id = $(this).attr("data-transhotel-id");
                    //
                    $('#transaksi_kamar_data').html('<tr><td class="text-center" colspan="99"><i class="fas fa-spin fa-spinner"></i><br>Loading</td></tr>');
                    $.post('<?= base_url('transaksi/ajax_transaksi/delete_transaksi_kamar') ?>', {
                        detail_id: detail_id,
                        transhotel_id: transhotel_id
                    }, function(data) {
                        $.toast({
                            heading: 'Sukses',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            position: 'top-right'
                        })
                        $('#transaksi_kamar_data').html(data.html);
                    }, 'json');
                }
            })
        })

        //edit
        $('.btn-edit').bind('click', function(e) {
            e.preventDefault();
            var detail_id = $(this).attr("data-detail-id");
            var transhotel_id = $(this).attr("data-transhotel-id");
            //
            $.post('<?= base_url('transaksi/ajax_transaksi/transaksi_kamar_get') ?>', {
                detail_id: detail_id,
                transhotel_id: transhotel_id
            }, function(data) {

                $('#detail_id').val(data.main.detail_id);
                $('#harga').val(data.main.harga);
                // alert(data.main.harga);
                $('#harga_edit').val(data.main.harga);

                // autocomplete
                var tamuData = {
                    id: data.main.tamu_id,
                    text: data.main.tamu_nama
                };
                var tamuDataOpt = new Option(tamuData.text, tamuData.id, false, false);
                $('#tamu_id').append(tamuDataOpt).trigger('change');
                $('#tamu_id').val(data.main.tamu_id);
                $('#tamu_id').trigger('change');

                var data3 = {
                    id: data.main.kamar_id,
                    text: data.main.kamar_nama
                };
                var newOption = new Option(data3.text, data3.id, false, false);
                $('#kamar_id').append(newOption).trigger('change');
                $('#kamar_id').val(data.main.kamar_id);
                $('#kamar_id').trigger('change');
                $('.select2-container').css('width', '100%');

                $("#total_biaya").val(data.main.total_biaya).removeClass("is-valid").removeClass("is-invalid");
                $('.select2-container').css('width', '100%');
                $('#add_cart_kamar').html('<i class="fa fa-save"></i> Ubah');
            }, 'json');
        });
    });
</script>