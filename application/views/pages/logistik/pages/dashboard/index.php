<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php echo $count_isi_logistik; ?></h3>

          <p>Isi Logistik</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo base_url('logistik/isi_logistik') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>

</div>
<script>
  var table = "";
  var base_cname = "<?php echo base_url($cname) ?>";
  $(document).ready(function(){
   var kategori = document.getElementById("select-kategori");
   var id_kategori = kategori.options[kategori.selectedIndex].value;
   if(id_kategori == 0){
    id_kategori = "Semua";
   }else if(id_kategori == 1){
    id_kategori = "Fisik";
   }else if(id_kategori == 2){
    id_kategori = "Psikis";
   }else if(id_kategori == 3){
    id_kategori = "Seksual";
   }else if(id_kategori == 4){
    id_kategori = "Eksploitasi";
   }else if(id_kategori == 5){
    id_kategori = "Trafficking";
   }else if(id_kategori == 6){
    id_kategori = "Penelantaran";
   }else if(id_kategori == 7){
    id_kategori = "Lainnya";
   }
   var tahun = document.getElementById("select-tahun");
   var waktu_lapor = tahun.options[tahun.selectedIndex].value;
   if(waktu_lapor == 0){
    waktu_lapor = "Semua Tahun";
   }
  var table_url = $('#table-data').data('url');
  table = $('#table-data').DataTable({
    orderCellsTop : true,
    responsive : true,
    dom: "'B<'row'<'col-6'l><'col-6'f>>rtip'",
    scrollY: true,
    scrollX: true,
    buttons: [
    {
      extend: 'excelHtml5',
      className : 'mb-2',
      title : 'Report Pengaduan Kategori ' + id_kategori + ' Pada Tahun ' + '\n' + waktu_lapor,
    },
    {
      extend: 'pdfHtml5',
      orientation: 'landscape',
      className : 'mb-2',
      title: 'Report Pengaduan Kategori ' + id_kategori + ' Pada Tahun ' + '\n' + waktu_lapor,
      customize: function(doc) {
        doc.styles.title = {
          alignment: 'center'
        }
      }
    },
    ],
    "ajax": {
      'url': table_url,
    },
    "columns": [
    {
      "title" : "No",
      "width" : "15px",
      "data": null,
      "class": "text-center",
      render: (data, type, row, meta) => {
        return meta.row + meta.settings._iDisplayStart + 1;
      }
    },
    { 
      "title" : "Nama Kategori",
      data : (data, type, row, meta) => {
        ret = "";
        if(data.id_kategori == '1'){
          ret += 'Fisik';
        }else 
        if(data.id_kategori == '2'){
          ret += 'Psikis';
        }else 
        if(data.id_kategori == '3'){
          ret += 'Seksual';
        }else 
        if(data.id_kategori == '4'){
          ret += 'Eksploitasi';
        }else 
        if(data.id_kategori == '5'){
          ret += 'Trafficking';
        }else 
        if(data.id_kategori == '6'){
          ret += 'Penelantaran';
        }else{
          ret += 'Lainnya';
        }
        return ret;
      } 
    },
    { 
      "title" : "Sudah Teratasi",
      "class": "text-center",
      "data": "jumlah_direspon" 
    },
    { 
      "title" : "Belum Direspon",
      "class": "text-center",
      "data": "jumlah_blm_direspon" 
    },
    ]
  });

  $("form#form-filter").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var url = $(this).attr('action');
    $.ajax({
      url : url,
      type: 'POST',
      data: formData,
      success: function (data) {
        var json = $.parseJSON(data);
        reload_table(json.data);
      },
      cache: false,
      contentType: false,
      processData: false
    });
  });

  $('#dashboard-submit').click();
  $( "#dashboard-submit" ).click(function() {
    draw_chart($(this).val());
  });

  var reload_table = (data) => {
    table.clear();
    table.rows.add(data);
    table.draw();
  } 

    // $('#select-kategori').change(function(){
    //   draw_chart($(this).val());
    // })
    // $('#select-kategori').trigger('change');
    // $('#select-tahun').change(function(){
    //   draw_chart($(this).val());
    // })
    // $('#select-tahun').trigger('change');
  });

  var draw_chart = () => {

    var kategori = document.getElementById("select-kategori");
    var id_kategori = kategori.options[kategori.selectedIndex].value;
    var nama_kategori = "";
    if(id_kategori == 1){
      nama_kategori = "Fisik";
    } else if(id_kategori == 2){
      nama_kategori = "Psikis";
    } else if(id_kategori == 3){
      nama_kategori = "Seksual";
    } else if(id_kategori == 4){
      nama_kategori = "Eksploitasi";
    } else if(id_kategori == 5){
      nama_kategori = "Trafficking";
    } else if(id_kategori == 6){
      nama_kategori = "Penelantaran";
    } else if(id_kategori == 7){
      nama_kategori = "Lainnya";
    } else if(id_kategori == 0){
      nama_kategori = "Semua Kategori";
    } 

    var tahun = document.getElementById("select-tahun");
    var waktu_lapor = tahun.options[tahun.selectedIndex].value;
    var nama_tahun = "";
    if(waktu_lapor != 0){
      nama_tahun = tahun.options[tahun.selectedIndex].value;
    } else {
      nama_tahun = "Semua";
    }

    $.ajax({
      url: base_cname+"/get_chart_pengaduan",
      type: 'POST',
      data: {id_kategori:id_kategori,waktu_lapor:waktu_lapor},
      success: function (data) {
        var json = $.parseJSON(data);
        var ctx = document.getElementById('bar_pengaduan').getContext('2d');

        var datasets = [];
        Object.keys(json.label).forEach(function(key) {
          datasets.push({
            label: json.label[key],
            backgroundColor: json.backgroundColor[key],
            borderColor: json.borderColor[key],
            data: json.data[key],
            borderWidth : 1,
          });
        })

        var optionBar = {
          title: {
            display: true,
            text: ['Grafik Pengaduan Kategori ' + nama_kategori,'Tahun ' + nama_tahun ],
            fontSize: 14,
            lineHeight: 2,
          },
          tooltips: {
            mode: 'index',
            intersect: false
          },
          responsive: true,
          scales: {
            xAxes: [{
              stacked: true,
            }],
            yAxes: [{
              ticks: {
                stepSize: 1
              },
              stacked: true
            }]
          },
          
        }
        var data = {
          labels: json.labels,
          datasets: datasets,
        };

        if(window.chart1 != undefined){
          window.chart1.destroy(); 
        }

        window.chart1 = new Chart(ctx, {
          type: 'bar',

          data: data,

          options: optionBar
        });

      }
    });
  }


</script>
