<nav class="mt-2">

  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="<?php echo base_url('logistik/dashboard') ?>" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard Logistik
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Fitur Logistik
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('logistik/isi_logistik') ?>" class="nav-link">
            <p>
              Isi Logistik
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('logistik/isi_logistik') ?>" class="nav-link">
            <p>
              X Grafik Perbandingan
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('logistik/history_cup') ?>" class="nav-link">
            <p>
              History Cup
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('logistik/history_produk') ?>" class="nav-link">
            <p>
              History Produk
            </p>
          </a>
        </li>
      </ul>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('logistik/history_produk') ?>" class="nav-link">
            <p>
              Laporan Logistik
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