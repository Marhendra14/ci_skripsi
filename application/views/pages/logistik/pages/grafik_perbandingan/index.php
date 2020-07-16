<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-sm-4">
      <?php echo form_open('Logistik/grafik_perbandingan/get_tahun',['id' => 'form-filter']) ?>
    </div>
    <div class="col-lg-4 col-sm-4">
      <div class="form-group row">
        <label class="col-sm-2 col-md-2 col-form-label">Tahun</label>
        <div class="col-sm-10 col-md-10">
          <select name="pilih_tahun" class="form-control select2" id="select-tahun" style="width: 100%;">
            <option value="0" selected>Semua Tahun</option>
            <?php foreach ($data['tahun'] as $key => $value): ?>
              <option value="<?php echo $value->tahun; ?>"><?php echo $value->tahun;?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-4">
      <button type="submit" class="btn btn-primary filter-input" id="dashboard-submit">Submit</button>
    </div>
    <?php echo form_close(); ?>

    <div class="col-lg-12 col-12">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Grafik Perbandingan</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div>
            <canvas id="myChart" height="254" width="509" style="width: 509px; height: 254px;" data> </canvas>
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

<div class="container">
    <canvas id="myChart"></canvas>
</div>
  <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
          <?php
            if (count($graph)>0) 
            {
              foreach ($graph as $data) 
              {
                echo "'" .$data->bulan ."',";
              }
            }
          ?>
        ],
        datasets: [{
            label: 'Jumlah Hasil Peramalan',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [
              <?php
                if (count($graph)>0) {
                   foreach ($graph as $data) {
                    echo $data->hasil_peramalan . ", ";
                  }
                }
              ?>
            ]
        },
        {
            label: 'Real Produksi Cup',
            backgroundColor: '#DEB887',
            borderColor: '##DEB887',
            data: [
              <?php
                if (count($graph2)>0) {
                   foreach ($graph2 as $data) {
                    echo $data->jumlah_cup . ", ";
                  }
                }
              ?>
            ]
        }
        ]
    },
}); 
  </script>