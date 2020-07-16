<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <section class="content">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Nomor Kantong</button>
          </section>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Form Tambah Nomor Kantong</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open($cname.'/insert',['id' => 'form-pembuatan_no_kantong']); ?>
                  <input type="hidden" class="form-control" name="id_kantong" placeholder="">
                  <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('id_petugas') ?>" name="id_petugas" placeholder="">
                  <div class="form-group">
                    <label>Nama Petugas</label>
                    <input type="text" class="form-control" value="<?php echo $this->session->userdata('nama_karyawan') ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>No Batch</label>
                    <input id="no_batch" type="text" class="form-control no_batch_class" name="no_batch" readonly>
                  </div>
                  <div class="form-group">
                    <label>No Kantong</label>
                    <input type="number" class="form-control" name="no_kantong" id="insert_no_kantong" readonly>
                  </div>
                  <input type="hidden" class="form-control" name="tanggal_pembuatan" readonly>
                  <div class="form-group">
                    <label>Status Kantong</label>
                    <input type="text" class="form-control" name="status_show" value="<?php echo $data['select_status'][0]->status ?>" readonly>
                    <input type="hidden" class="form-control" name="id_status" value="<?php echo $data['select_status'][0]->id_status ?>" readonly>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-primary-default" data-dismiss="modal">Close</button>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="col-lg-10 col-md-8 col-sm-12 pb-2">
            <form method="post" id="form-filter">
              <input type="hidden" id="url_filter" value="<?php echo base_url($cname.'/get_data') ?>">
              <div class="form-group row mb-1 filter-input">
                <label for="" class="control-label col-form-label col-md-2">No Batch</label>
                <div class="col-md-3">
                  <div id="demo"></div>
                  <input type="number" class="form-control" value="" name="no_batch" id="no_batch_val" pattern="[0-9]{8}" onKeyPress="
                  if(this.value.length<7)
                  {
                    document.getElementById('demo').innerHTML = 'Masukkan Minimal 8 Angka';
                  }
                  else
                  {
                    document.getElementById('demo').innerHTML = '';
                  }
                  if(this.value.length<8)
                  { 
                    return event.charCode >= 48;
                  }
                  else if(this.value.length==8){
                  return false;
                }
                "/>
              </div>
            </div>
            <div class="form-group row mb-1 filter-input">
              <label for="" class="control-label col-form-label col-md-2">No Kantong</label>
              <div class="col-md-3">
                <select name="no_kantong" id="no_kantong" class="form-control">
                  <option value="" selected disabled>Choose</option>
                  <option value="" selected>All</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-0 mt-2">
              <label for="" class="control-label col-form-label col-md-2 filter-input"></label>
              <div class="col-md-9">
                <button type="submit" class="btn btn-primary filter-input" id="filter-submit">Submit</button>

            <button class="btn btn-primary" id="cekk">Cetak</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;" data-url="<?php echo base_url($cname.'/get_data') ?>">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
  var url_insert_kantong = '<?php echo base_url($cname.'/insert') ?>';
  var base_cname = "<?php echo base_url($cname) ?>";
  var image_url = '<?php echo base_url('assets/img') ?>';
  var table = "";

  get_data = (table_url) => {
    table = $('#table-data').DataTable({
      orderCellsTop : true,
      responsive : true,
      // dom: "'Blfrtip'",
      // scrollY: true,
      // scrollX: true,
      // buttons: [
      // {
      //   extend: 'excelHtml5',
      //   className : 'mb-2',
      //   title : 'Rekap Jumlah Kekerasan Berdasarkan Lokasi Pada',
      // },
      // {
      //   extend: 'pdfHtml5',
      //   className : 'mb-2',
      //   title: 'Rekap Jumlah Kekerasan Berdasarkan Lokasi Pada',
      //   customize: function(doc) {
      //     doc.styles.title = {
      //       alignment: 'center',
      //       fontSize: '15',
      //     }
      //   }
      // },
      // ],
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
        "title" : "Nama Karyawan",
        "data": "nama_karyawan" 
      },
      { 
        "title" : "No Batch",
        "data": "no_batch" 
      },
      { 
        "title" : "No Kantong",
        "data": "no_kantong" 
      },
      { 
        "title" : "Tanggal Pembuatan",
        "data": "tanggal_pembuatan" 
      },
      { 
        "title" : "Status",
        "data": "status" 
      }
      ,
      { 
        "title" : "QR Code",
        "data": "qrcode",
        "render" : function(data, type, full, meta){
          return "<img src=\"" + image_url + "/"+ data +"\" height=\"100\"/>";
        }
      }
      ]
    });
  }
  $(document).ready(function() {

 

    $('#cekk').on('click', function(){

      var no_batch = document.getElementById("no_batch_val").value;
      var url = "<?php echo base_url('Laporan/contoh')?>"+"/"+no_batch;
      // console.log(no_batch);
      var win = window.open(url, '_blank');
      win.focus();
      
    });


    var table_url = $('#table-data').data('url');
    get_data(table_url);

    $('form#form-pembuatan_no_kantong').submit(function(e){
      var form = $(this);
      e.preventDefault();
      $.ajax({
        url: url_insert_kantong,
        type: 'POST',
        data: form.serialize(),
        dataType : "JSON",
        success: function (data) {
          swal(data.title,data.text,data.icon);
          scroll_smooth('table',500);
          form_reset();
          $('#exampleModal').modal('hide');
          table.ajax.reload(null,false);
        }
      });
    });
    $("form#form-filter").submit(function(e) {
      e.preventDefault();
      var table_url = $('#url_filter').val();
      table_url = table_url+'/'+$("#no_batch_val").val()+'/'+$("#no_kantong").val()
      var table = $('#table-data').DataTable();
      table.clear().draw();
      table.destroy();
      $('#table-data').empty();
      get_data(table_url);

    });
  });
  $(function()
  {
    var date = new Date();
    var dateString;
    date.setDate(date.getDate() + 0 );

    dateString = ('0' + date.getDate()).slice(-2)+('0' + (date.getMonth()+1)).slice(-2)+date.getFullYear();
    document.getElementById("no_batch").value = dateString;

    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day;

    $.ajax({
      url :base_cname+"/get_max_no_kantong",
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        var max=data[0]['max'] ? parseInt(data[0]['max']) : 0;
        var nilaisekarang = (max + 1 );
        document.getElementById("insert_no_kantong").value = nilaisekarang;
      }});
  });

  var form_reset = () => {
    table.ajax.reload(null,false);
    $('form#form-pembuatan_no_kantong').find('input,select').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
  }

  var delete_kantong = (obj) => {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url : base_cname+"/delete_kantong",
          type : 'POST',
          data : {
            id_kantong : $(obj).data('id'),
          },
          dataType : "JSON",
          success : (data) => {
            swal(data.title,data.text,data.icon);
            
          }
        });
      }
    });
  }

</script>