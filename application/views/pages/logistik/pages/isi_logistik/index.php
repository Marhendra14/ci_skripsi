  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><?php echo $title ?></h3>

          </div>
          <div class="card-body">
            <?php echo form_open($cname.'/insert',['id'=>'form-isi_logistik']); ?>
            <input type="hidden" class="form-control" name="id_isi_logistik" placeholder="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Petugas</label>
                  <select name="id_petugas" id="" class="form-control">
                    <option value="" selected disabled>Pilih</option>
                    <?php foreach ($data['select_petugas'] as $key => $value): ?>
                      <option value="<?php echo $value->id_petugas ?>"><?php echo $value->nama_karyawan ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Bulan</label>
                  <input type="text" class="form-control" name="bulan" placeholder="Bulan">
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="text" class="form-control" name="tahun" placeholder="Tahun">
                </div>
                <div class="form-group">
                  <label>Data Produksi Bulan Lalu</label>
                  <input type="text" class="form-control" name="data_produksi_bulan_lalu" placeholder="Data Produksi Bulan Lalu">
                </div>                
              </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary" onclick="form_reset();">Reset</button>
            <?php echo form_close(); ?>
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
    </div>
  </div>

  <script>

    var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
    var url_insert_isi_logistik = '<?php echo base_url($cname.'/insert') ?>';
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
            ret += ' <a class="btn btn-info btn-sm text-white" onclick="fill_form('+data.id_isi_logistik+'); return false;"><i class="fas fa-pencil-alt"></i> Edit</a>';
            ret += ' <a class="btn btn-danger btn-sm text-white" onclick="delete_isi_logistik(this)" data-id="'+data.id_isi_logistik+'"><i class="fas fa-trash-alt"></i> Delete</a>';
            return ret;
          }
        }
        ]
      });

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


    var fill_form = (id_isi_logistik) => {
      $.ajax({
        url: url_fill_form,
        type: 'POST',
        data: {
          'id_isi_logistik' : id_isi_logistik
        },
        success: function (data) {
          var json = $.parseJSON(data);
          let form = $('#form-isi_logistik');
          form_reset();
          form.find('[name="id_isi_logistik"]').val(json.id_isi_logistik);
          form.find('[name="nama_karyawan"]').val(json.nama_karyawan);
          form.find('[name="bulan"]').val(json.bulan);
          form.find('[name="tahun"]').val(json.tahun);
          form.find('[name="data_produksi_bulan_lalu"]').val(json.data_produksi_bulan_lalu);
          scroll_smooth('body',500);
        },
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