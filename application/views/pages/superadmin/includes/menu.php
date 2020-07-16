<nav class="mt-2">

  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="<?php echo base_url('Superadmin/dashboard') ?>" class="nav-link">
        <i class="nav-icon fas fa-desktop"></i>
        <p>
          Dashboard Superadmin
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Fitur Superadmin
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('Superadmin/petugas_aplikasi') ?>" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Petugas Aplikasi
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('Superadmin/departemen') ?>" class="nav-link">
            <i class="nav-icon fas fa-city"></i>
            <p>
              Departemen
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('Superadmin/jabatan') ?>" class="nav-link">
            <i class="nav-icon fas fa-suitcase"></i>
            <p>
              Jabatan
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