<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <section class="content">
            <button class="btn btn-primary btn-sm" onclick="hapus();" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Isi Logistik</button>
          </section>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">    
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Form Isi Logistik Produk</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open($cname.'/insert',['id' => 'form-isi_logistik']); ?>
                  <input type="hidden" class="form-control" name="id_isi_logistik" placeholder="">
                  <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('id_petugas') ?>" name="id_petugas" placeholder="">
                  <div class="form-group">
                    <label>Nama Petugas</label>
                    <input type="text" class="form-control" value="<?php echo $this->session->userdata('nama_karyawan') ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Bulan</label>
                    <input type="number" class="form-control" name="bulan" placeholder="Bulan">
                  </div>
                  <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" class="form-control" name="tahun" placeholder="Tahun">
                  </div>
                  <div class="form-group">
                    <label>Data Produksi Bulan Lalu</label>
                    <input type="number" class="form-control" name="data_produksi_bulan_lalu" placeholder="Data Produksi Bulan Lalu">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary" onclick="form_reset();">Reset</button>
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
          <div class="table-responsive">
            <table id="table-data" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;" data-url="<?php echo base_url($cname.'/get_data') ?>">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th class="th-sticky-action">-</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="modal fade" id="modal_edit">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Isi Logistik</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open($cname.'/update',['id' => 'form-edit']); ?>
                  <input type="hidden" class="form-control" name="id_isi_logistik" placeholder="">
                  <input type="hidden" class="form-control" name="id_petugas" value="id_petugas" readonly>
                  <div class="form-group">
                    <label>Nama Petugas</label>
                    <input type="text" class="form-control" name="nama_karyawan" value="<?php echo $this->session->userdata('nama_karyawan') ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Bulan</label>
                    <input type="number" class="form-control" name="bulan" placeholder="Bulan">
                  </div>
                  <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" class="form-control" name="tahun" placeholder="Tahun">
                  </div>
                  <div class="form-group">
                    <label>Data Produksi Bulan Lalu</label>
                    <input type="number" class="form-control" name="data_produksi_bulan_lalu" placeholder="Data Produksi Bulan Lalu">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary" onclick="form_reset();">Reset</button>
                  <?php echo form_close(); ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="modal fade" id="modal_detail">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Detail Perhitungan</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open($cname.'/detail_isi_logistik',['id' => 'form-detail']); ?>
                  <input type="hidden" class="form-control" name="data_ke" readonly>
                  <div class="form-group">
                    <label>Niali a</label>
                    <input type="number" class="form-control" name="nilai_a" readonly>
                  </div>
                  <div class="form-group">
                    <label>Niali b</label>
                    <input type="number" class="form-control" name="nilai_b" readonly>
                  </div>
                  <div class="form-group">
                    <label>Hasil Peramalan</label>
                    <input type="number" class="form-control" name="hasil_peramalan" readonly>
                  </div>
                  <div class="form-group">
                    <label>MAPE</label>
                    <input type="text" class="form-control" name="mape" readonly>
                  </div>
                  <?php echo form_close(); ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

  var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
  var url_insert_isi_logistik = '<?php echo base_url($cname.'/insert') ?>';
  var url_detail_isi_logistik = '<?php echo base_url($cname.'/detail_isi_logistik') ?>';
  var url_edit_isi_logistik = '<?php echo base_url($cname.'/edit_isi_logistik') ?>';
  var url_update_isi_logistik = '<?php echo base_url($cname.'/update') ?>';
  var base_cname = "<?php echo base_url($cname) ?>";
  var table = "";
  $(document).ready(function() {
    var table_url = $('#table-data').data('url');
    table = $('#table-data').DataTable({
      orderCellsTop : true,
      responsive : true,
      dom: "<'row'<'col-6'l><'col-6'f>>trip'",
      scrollY: true,
      scrollX: true,
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
        "title" : "Bulan",
        "data": "bulan" 
      },
      { 
        "title" : "Tahun",
        "data": "tahun" 
      },
      { 
        "title" : "Data Produksi Bulan Lalu",
        "data": "data_produksi_bulan_lalu" 
      },
      {
        "title": "Actions",
        "width" : "120px",
        "visible":true,
        "class": "text-center th-sticky-action",
        "data": (data, type, row) => {
          let ret = "";
          ret += ' <a class="btn btn-white btn-sm text-black" onclick="detail_isi_logistik('+data.id_isi_logistik+'); return false;"><i class="fas fa-eye"></i> Detail Perhitungan</a>';
          // ret += ' <a class="btn btn-info btn-sm text-white" onclick="edit_isi_logistik('+data.id_isi_logistik+'); return false;"><i class="fas fa-pencil-alt"></i> Edit</a>';

          return ret;
        }
      }
      ]
    });

    // $('form#form-edit').submit(function(e){
    //   var form = $(this);
    //   e.preventDefault();

    //   $.ajax({
    //     url: url_update_isi_logistik,
    //     type: 'POST',
    //     data: form.serialize(),
    //     dataType : "JSON",
    //     success: function (data) {
    //       swal(data.title,data.text,data.icon);
    //       scroll_smooth('table',500);
    //       form_reset();
    //       $('#modal_edit').modal('hide');
    //       table.ajax.reload(null,false);          
    //     }
    //   });
    // });

    $('form#form-isi_logistik').submit(function(e){
      var form = $(this);
      e.preventDefault();

      $.ajax({
        url: url_insert_isi_logistik,
        type: 'POST',
        data: form.serialize(),
        dataType : "JSON",
        success: function (data) {
          if(data.code == '2'){
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            Object.keys(data.field).forEach(function(key) {
              $('#form-isi_logistik').find('[name="'+key+'"]').parent().find('input,select').addClass('is-invalid');
              $('#form-isi_logistik').find('[name="'+key+'"]').parent().append('<div class="invalid-feedback">'+data.field[key]+'</div>');
            })
          }else{
            form_reset();
            swal(data.title,data.text,data.icon);
          }
        }
      });
    });
  });

  hapus = () =>
  {
    $('#form-isi_logistik')[0].reset();
  }

  var edit_isi_logistik = (data_ke) => {
    $.ajax({
      url : url_edit_isi_logistik+"/"+data_ke,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
       $('[name="data_ke"]').val(data.data_ke);
       $('[name="id_petugas"]').val(data.id_petugas);
       $('[name="bulan"]').val(data.bulan);
       $('[name="tahun"]').val(data.tahun);
       $('[name="data_produksi_bulan_lalu"]').val(data.data_produksi_bulan_lalu);
       $('#modal_edit').modal('show');
     },
     error: function (jqXHR, textStatus, errorThrown)
     {
      alert('Error get data from ajax');
    }
  });
  }

  var detail_isi_logistik = (id_isi_logistik) => {
    $.ajax({
      url : url_detail_isi_logistik+"/"+id_isi_logistik,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
       $('[name="id_isi_logistik"]').val(data.id_isi_logistik);
       $('[name="nilai_a"]').val(data.nilai_a);
       $('[name="nilai_b"]').val(data.nilai_b);
       $('[name="hasil_peramalan"]').val(data.hasil_peramalan);
       $('[name="mape"]').val(data.mape+" "+"%");
       $('#modal_detail').modal('show');
     },
     error: function (jqXHR, textStatus, errorThrown)
     {
      alert('Error get data from ajax');
    }
  });
  }

  var delete_isi_logistik = (obj) => {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url : base_cname+"/delete_isi_logistik",
          type : 'POST',
          data : {
            id_isi_logistik : $(obj).data('id'),
          },
          dataType : "JSON",
          success : (data) => {
            swal(data.title,data.text,data.icon);
            form_reset();
          }
        });
      }
    });
  }


  var form_reset = () => {
    table.ajax.reload(null,false);
    $('form#form-isi_logistik').find('input,select').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
  }
</script>