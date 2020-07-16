<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="<?php echo base_url('Logistik/dashboard') ?>" class="nav-link">
        <i class="nav-icon fas fa-desktop"></i>
        <p>
          Dashboard Logistik
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Logistik/isi_logistik') ?>" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>
          Isi Logistik
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Logistik/grafik_perbandingan') ?>" class="nav-link">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>
          Grafik Perbandingan
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-history"></i>
        <p>
          History
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('Logistik/history_cup') ?>" class="nav-link">
            <p>
              <p><i class="ion fas fa-history"></i><i class="nav-icon fas fa-glass-whiskey"></i>
              History Cup
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('Logistik/history_produk') ?>" class="nav-link">
            <p><i class="ion fas fa-history"></i><i class="nav-icon fas fa-cubes"></i>
              History Produk
            </p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="<?php echo base_url('Logistik/laporan_logistik') ?>" class="nav-link">
        <i class="nav-icon fas fa-print"></i>
        <p>
          Laporan Logistik
        </p>
      </a>
    </li>
  </ul>
</nav>
  <script>
    var url = window.location;
    $('[href*="'+url+'"]').addClass('active');
  </script>
</nav>