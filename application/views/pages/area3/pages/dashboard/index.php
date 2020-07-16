<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h1><i class="ion fas fa-qrcode"></i></h1>
          <h3><?php echo $count_pembuatan_no_kantong; ?></h3>
          
          <p>Jumlah Nomer Kantong Yang Dibuat</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('Area3/pembuatan_no_kantong') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h1><i class="ion fas fa-sticky-note"></i></h1>
          <h3><?php echo $count_pembuatan_no_produk; ?></h3>
          
          <p>Jumlah Nomer Produk Yang Dibuat</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo base_url('Area3/pembuatan_no_produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h1><i class="ion fas fa-shipping-fast"></i></h1>
          <h3><?php echo $count_vendor; ?></h3>
          
          <p>Jumlah Vendor</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('Area3/vendor') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h1><i class="ion fas fa-file-invoice"></i></h1>
          <h3><?php echo $count_data_produksi_dan_penjualan_produk; ?></h3>

          <p>Data Produksi dan Penjualan Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('Area3/data_produksi_dan_penjualan_produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h1><i class="ion fas fa-glass-whiskey"></i></h1>
          <h3><?php echo $count_storage_cup; ?></h3>
          
          <p>Storage Cup</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a class="small-box-footer">Storage Cup</a>
      </div>
    </div>

    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h1><i class="ion fas fa-cubes"></i></h1>
          <h3><?php echo $count_storage_produk; ?></h3>
          
          <p>Storage Produk</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a class="small-box-footer">Storage Produk</a>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>

</div>