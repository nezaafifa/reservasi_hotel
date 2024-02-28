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
                      <input type="text" class="form-control datetimepicker" id="transaksi_tgl" name="transaksi_tgl" required value="<?= date('d-m-Y H:i:s') ?>">

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="date">Petugas</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="petugas_nm" value="<?= @$this->session->userdata('nama') ?>" class="form-control" readonly>
                      <input type="hidden" id="petugas_Id" name="petugas_id" value="<?= @$this->session->userdata('user_id') ?>" class="form-control">

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
                          <option value="<?= $value->tamu_id ?>"><?= $value->tamu_nama ?></option>
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
                      <input type="text" class="form-control datetimepicker" id="checkin_tgl" name="checkin_tgl" required value="<?= date('d-m-Y H:i:s') ?>">

                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="date">Tgl Checkout</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control datetimepicker" id="checkout_tgl" name="checkout_tgl" required value="<?= date('d-m-Y H:i:s') ?>">


                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;width:30%">
                    <label for="lama_inap">Lama Inap</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" value="1" min="1" class="form-control" id="lama_inap" name="lama_inap" required value="">
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
                    <label for="keterangan">Keterangan</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <textarea class="form-control" name="keterangan" rows="4" cols="3"></textarea>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <div>
                      <button id="add_cart" class="btn btn-primary" type="submit">
                        <i class="fa fa-cart-plus"> Add

                        </i>
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

      </div>
    </form>

  </section>
</div>
<script src=" <?= base_url() ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>asset/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
  var transaksi_form;
  $(document).ready(function() {

    var transaksi_form = $("#transaksi_form").validate({
      rules: {
        lama_inap: {
          valueNotEquals: ""
        },
        pembooking_id: {
          valueNotEquals: ""
        }
      },
      messages: {
        lama_inap: "Harus diisi!",
        pembooking_id: "Pilih Salah Satu!"
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
        $("#add_cart").html('<i class="fa fa-spin fa-spinner"></i> Proses');
        $("#add_cart").attr("disabled", "disabled");

        // alert('p');

        $.ajax({
          type: 'post',
          url: '<?= base_url('transaksi') ?>/ajax_transaksi/save',
          data: $(form).serialize(),
          success: function(data) {
            // tindakan_reset();
            console.log(data);
            $.toast({
              heading: 'Sukses',
              text: 'Data berhasil disimpan.',
              icon: 'success',
              position: 'top-right'
            });
            $("#add_cart").html('<i class="fa fa-save"></i> Simpan');
            $("#add_cart").attr("disabled", false);


            var edit_url = '<?= base_url('transaksi/edit/') ?>';
            const idd = JSON.parse(data);
            location.href = edit_url + idd;
          }
        })
        return false;
      }
    });

    $('#kamar_id').select2({
      ajax: {
        url: "<?= base_url() ?>/transaksi/ajax/kamar_cek",
        dataType: "json",
        data: function(params) {
          return {
            kamar_no: params.term
          }
        },
        processResults: function(data) {
          return {
            results: data
          }
        }
      }
    }).on('change', function(data) {
      var selected = $(this).select2('data');
      $.each(selected, function(index, value) {
        $("#harga").val(value.harga);
        count_jumlah_total();
      });
    });

    $('#lama_inap').on('keyup', function() {
      if ($("#harga").val() == '') {
        alert('mohon pilih kamar');
      } else {
        count_jumlah_total();
      }
    });
    $('#harga').on('change', function() {
      count_jumlah_total();
    });

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
  });

  function count_jumlah_total() {
    var harga = $("#harga").val();
    var lama_inap = $("#lama_inap").val();
    var total_harga = harga * lama_inap;

    $("#total_biaya").val(total_harga);
  }

  function stringToNumber()
  {
    return +s;
  }
</script>