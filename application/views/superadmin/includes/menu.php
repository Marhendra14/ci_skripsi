<nav class="mt-2">

  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="<?php echo base_url('dashboard/index') ?>" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard Super Admin
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Fitur Super Admin
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('superadmin/petugas_aplikasi') ?>" class="nav-link">
            <p>
              Petugas Aplikasi
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('superadmin/departemen') ?>" class="nav-link">
            <p>
              Departemen
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('superadmin/jabatan') ?>" class="nav-link">
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