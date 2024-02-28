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
      <div class="callout callout-info">
        <h4>
        <?php
        // Check if the 'fullname' session variable exists
        if ($this->session->userdata('nama')) {
            $nama = $this->session->userdata('nama');
            echo 'Welcome, ' . $nama;
        }
        ?>
        </h4>
      </div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$kamar;?></h3>

              <p>KAMAR SELURUHNYA</p>
            </div>
            <div class="icon">
              <i class="fa fa-solid fa-bed"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$kamar_kosong;?></h3>

              <p>KAMAR KOSONG</p>
            </div>
            <div class="icon">
            <i class="fa fa-solid fa-bed"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$kamar_terisi;?></h3>

              <p>KAMAR TERISI</p>
            </div>
            <div class="icon">
            <i class="fa fa-solid fa-bed"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>65</h3>

              <p>KRITIK & SARAN</p>
            </div>
            <div class="icon">
            <i class="fa fa-solid fa-bed"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-6 col-xs-6 text-center">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$kamar_kosong;?></h3>

              <p>KAMAR KOSONG</p>
            </div>
            <div class="icon">
            <i class="fa fa-solid fa-bed"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6 text-center">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$kamar_terisi;?></h3>

              <p>KAMAR TERISI</p>
            </div>
            <div class="icon">
            <i class="fa fa-solid fa-bed"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
       
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
      
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
</div>