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
    <form id="transaksi_form" enctype="multipart/form-data" method="post" autocomplete="off">
      <div class="row">
        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align: top;">
                    <label for="date">Date</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control datetimepicker" id="transaksi_tgl" name="transaksi_tgl" required value="<?= to_date(@$transaksi['transaksi_tgl'], '', 'full_date') ?>">

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="date">Petugas</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="petugas_nm" value="<?= @$transaksi['petugas_nm'] ?>" class="form-control" readonly>
                      <input type="hidden" id="petugas_Id" name="petugas_id" value="<?= $transaksi['petugas_id'] ?>" class="form-control">

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="pembooking_id">Pembooking</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <select name="pembooking_id" class="form-control select2">
                        <option value="">-- pilih Nama Pembooking --</option>
                        <?php foreach ($tamu as $key => $value) { ?>
                          <option value="<?= $value->tamu_id ?>" <?= (@$value->tamu_id == @$transaksi['pembooking_id']) ? 'selected' : '' ?>><?= $value->tamu_nama ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </td>
                </tr>

              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align: top;width:30%;">
                    <label for="checkin_tgl">Tgl Checkin</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control datetimepicker" id="checkin_tgl" name="checkin_tgl" required value="<?= to_date(@$transaksi['checkin_tgl'], '', 'full_date') ?>">

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="date">Tgl Checkout</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control datetimepicker" id="checkout_tgl" name="checkout_tgl" required value="<?= to_date(@$transaksi['checkout_tgl'], '', 'full_date') ?>">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="lama_inap">Lama Inap</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" value="1" min="1" class="form-control" id="lama_inap" name="lama_inap" required value="<?= @$transaksi['lama_inap'] ?>">
                    </div>
                  </td>
                </tr>

              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <div align="right">
                <h2>Invoice <b><span><?= @$transaksi['transhotel_id'] ?></span></b></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="row mt-2">
      <div class="col-lg-8">
        <div class="box box-widget">
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th class="text-center text-middle" width="20">No</th>
                    <th class="text-center text-middle" width="80">Aksi</th>
                    <th class="text-center text-middle" width="100">Nama Tamu</th>
                    <th class="text-center text-middle" width="100">Nama Kamar</th>
                    <th class="text-center text-middle" width="100">Jenis Kamar</th>
                    <th class="text-center text-middle" width="100">Total Biaya</th>
                  </tr>
                </thead>
                <tbody id="transaksi_kamar_data">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <form id="transaksi_kamar" enctype="multipart/form-data" method="post" autocomplete="off">
        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align: top;width:30%;">
                    <label for="tamu_id">Tamu</label>
                    <input type="hidden" name="detail_id" id="detail_id" value="">
                  </td>
                  <td>
                    <div class="form-group">
                      <select name="tamu_id" id="tamu_id" class="form-control select2">
                        
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%;">
                    <label for="kamar_id">Kamar</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <select name="kamar_id" id="kamar_id" class="form-control select2">

                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <div>
                      <button id="add_cart_kamar" class="btn btn-primary" type="submit">
                        <i class="fa fa-paper-plane"> Simpan

                        </i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </form>

    </div>

  </section>
</div>
<script src=" <?= base_url() ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>asset/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
  var transaksi_form;
  $(document).ready(function() {

    var transaksi_kamar = $("#transaksi_kamar").validate({
      rules: {
        tamu_id: {
          valueNotEquals: ""
        },
        kamar_id: {
          valueNotEquals: ""
        }
      },
      messages: {
        tamu_id: "Harus diisi!",
        kamar_id: "Pilih Salah Satu!"
      },
      errorElement: "em",
      errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.next("label"));
        } else if ($(element).hasClass('autocomplete')) {
          error.insertAfter(element.next(".select2-container"));
        } else if ($(element).hasClass('select2')) {
          error.insertAfter(element.next(".select2-container"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
      },
      submitHandler: function(form) {
        $("#add_cart_kamar").html('<i class="fa fa-spin fa-spinner"></i> Proses');
        $("#add_cart_kamar").attr("disabled", "disabled");

        var transhotel_id = '<?= @$transaksi['transhotel_id'] ?>';
        var lama_inap = $("#lama_inap").val();

        $.ajax({
          type: 'post',
          url: '<?= base_url('transaksi') ?>/ajax_transaksi/kamar_save',
          data: $(form).serialize() + '&transhotel_id=' + transhotel_id + '&lama_inap=' + lama_inap,
          success: function(data) {

            kamar_reset();

            $.toast({
              heading: 'Sukses',
              text: 'Data berhasil disimpan.',
              icon: 'success',
              position: 'top-right'
            });

            $("#add_cart_kamar").html('<i class="fa fa-save"></i> Simpan');
            $("#add_cart_kamar").attr("disabled", false);


            transaksi_kamar_data('<?= @$transaksi['transhotel_id'] ?>');
          }
        })
        return false;
      }
    });

    // $('#kamar_id').select2({
    //   ajax: {
    //     url: "<?= base_url() ?>/transaksi/ajax/kamar_cek",
    //     dataType: "json",
    //     data: function(params) {
    //       return {
    //         kamar_nm: params.term
    //       }
    //     },
    //     processResults: function(data) {
    //       return {
    //         results: data
    //       }
    //     }
    //   }
    // }).on('change', function(data) {
    //   var selected = $(this).select2('data');
    //   $.each(selected, function(index, value) {
    //     $("#harga").val(value.harga);
    //     // $("#harga_edit").val(value.harga);
    //     // count_jumlah_total();
    //   });
    // });
    $('#kamar_id').select2({
      ajax: {
        url: "<?= base_url() ?>/transaksi/ajax/kamar_cek",
        dataType: "json",
        data: function(params) {
          return {
            kamar_nm: params.term
          }
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    });

    $('#tamu_id').select2({
      ajax: {
        url: "<?= base_url() ?>/transaksi/ajax/tamu_autocomplete",
        dataType: "json",
        data: function(params) {
          return {
            tamu_nm: params.term
          }
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    });

    // $('#lama_inap').on('keyup', function() {
    //   if ($("#harga").val() == '') {
    //     alert('mohon pilih kamar');
    //   } else {
    //     count_jumlah_total();
    //   }
    // });
    // $('#harga').on('change', function() {
    //   count_jumlah_total();
    // });

    $(".datetimepicker").daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      timePickerSeconds: true,
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        cancelLabel: "Clear",
        format: "DD-MM-YYYY H:mm:ss",
      },
      isInvalidDate: function(date) {
        return "";
      },
    });

    transaksi_kamar_data('<?= @$transaksi['transhotel_id'] ?>');
  });

  // function count_jumlah_total() {
  //   var harga = $("#harga").val();
  //   var lama_inap = $("#lama_inap").val();
  //   var total_harga = harga * lama_inap;

  //   $("#total_biaya").val(total_harga);
  // }

  // function stringToNumber() {
  //   return +s;
  // }

  function transaksi_kamar_data(transhotel_id = '') {
    // alert(transhotel_id);
    $('#transaksi_kamar_data').html('<tr><td class="text-center" colspan="99"><i class="fa fa-spin fa-spinner"></i><br>Loading</td></tr>');
    $.post('<?= base_url('transaksi/ajax_transaksi/transaksi_kamar_data') ?>', {
      transhotel_id: transhotel_id
    }, function(data) {
      $('#transaksi_kamar_data').html(data.html);
    }, 'json');
  }

  function kamar_reset() {
    $("#detail_id").val('').removeClass("is-valid").removeClass("is-invalid");
    $("#kamar_id").val('').trigger('change').removeClass("is-valid").removeClass("is-invalid");
    $("#tamu_id").val('').trigger('change').removeClass("is-valid").removeClass("is-invalid");
}
</script>