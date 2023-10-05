<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url() ?>asset/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= base_url('/');?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= base_url('menu');?>"><i class="fa fa-fw fa-solid fa-bars"></i> Menu Resto</a></li>
        <li>
          <a href="<?= base_url('jenis_kamar')?>">
            <i class="fa fa-fw fa-solid fa-bed"></i> <span>Jenis Kamar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li><a href="<?= base_url('kamar');?>"><i class="fa fa-fw fa-solid fa-bed"></i>  Kamar</a></li>
        <li><a href="<?= base_url('tamu');?>"><i class="fa fa-fw fa-solid fa-user"></i>  Tamu</a></li>
        <li><a href="<?= base_url('transaksi');?>"><i class="fa fa-fw fa-cart-arrow-down"></i>  Transaksi</a></li>
      
        <li class="header">Setting</li>
        <li><a href="<?= base_url('user') ?>"><i class="fa fa-circle-o text-red"></i> <span>User</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>