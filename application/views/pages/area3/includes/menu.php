<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="<?php echo base_url('Area3/dashboard') ?>" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard Admin Area 3
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Data Kantong
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">        
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/pembuatan_no_kantong') ?>" class="nav-link">
            <p>
              Pembuatan No Kantong
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/no_kantong_belum_digunakan') ?>" class="nav-link">
            <p>
              NO. Belum Digunakan
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/pembuatan_no_kantong') ?>" class="nav-link">
            <p>
              X Laporan Produksi Cup
            </p>
          </a>
        </li>
      </ul>
    </li>
        <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Data Produk
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/pembuatan_no_produk') ?>" class="nav-link">
            <p>
              Pembuatan No Produk 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/no_produk_belum_digunakan') ?>" class="nav-link">
            <p>
              No. Belum Digunakan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/data_produksi_dan_penjualan_produk') ?>" class="nav-link">
            <p>
              X Data Produksi-Keluar Produk
            </p>
          </a>
        </li>        
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/data_produksi_dan_penjualan_produk') ?>" class="nav-link">
            <p>
              X Laporan Produksi Produk
            </p>
          </a>
        </li>
      </ul>
          <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Data Vendor
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">        
        <li class="nav-item">
          <a href="<?php echo base_url('Area3/vendor') ?>" class="nav-link">
            <p>
              Pembuatan Data Vendor
            </p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
  <script>
    var url = window.location;
    $('[href*="'+url+'"]').addClass('active');
  </script>
</nav>