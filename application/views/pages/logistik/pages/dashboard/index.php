<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h1><i class="nav-icon fas fa-print"></i></h1>
          <h3><?php echo $count_isi_logistik; ?></h3>

          <p>Isi Logistik</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('Logistik/isi_logistik') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h1><i class="nav-icon fas fa-history"></i><i class="nav-icon fas fa-glass-whiskey"></i></h1>
          <h3><?php echo $count_isi_logistik; ?></h3>

          <p>History Cup</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('Logistik/history_cup') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h1><i class="ion fas fa-history"></i><i class="nav-icon fas fa-cubes"></i></h1>
          <h3><?php echo $count_isi_logistik; ?></h3>

          <p>History Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('Logistik/history_produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h1><i class="ion fas fa-glass-whiskey"></i></h1>
          <h3><?php echo $count_storage_cup; ?></h3>

          <p>Hasil Akhir Produksi Cup</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h1><i class="ion fas fa-cubes"></i></h1>
          <h3><?php echo $count_storage_produk; ?></h3>

          <p>Hasil Akhir Produksi Produk</p>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>

</div>