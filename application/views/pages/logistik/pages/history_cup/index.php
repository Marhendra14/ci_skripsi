<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="col-lg-10 col-md-8 col-sm-12 pb-2">
            <form method="post" id="form-filter">
              <input type="hidden" id="url_filter" value="<?php echo base_url($cname.'/get_data') ?>">
              <div class="form-group row mb-1 filter-input">
                <label for="" class="control-label col-form-label col-md-2">No Batch</label>
                <div class="col-md-3">
                  <select name="no_batch" id="no_batch_val" class="form-control input-no-batch">
                    <option value="" selected disabled>Pilih</option>
                    <?php foreach ($data['select_no_batch'] as $key => $value): ?>
                      <option value="<?php echo $value->no_batch ?>"><?php echo $value->no_batch ?></option>
                    <?php endforeach ?>
                  </select>
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
  var base_cname = "<?php echo base_url($cname) ?>";
  var table = "";

  get_data = (table_url) => {
    table = $('#table-data').DataTable({
      orderCellsTop : true,
      responsive : true,
      "ajax": {
        'url': table_url,
      },
      "columns": [
      {
        "title" : "No",
        "width" : "15px",
        "data": null,
        "class": "text-center",
        render: (data, type, row, meta) => 
        {
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
        "title" : "Jumlah Cup",
        "data": "jumlah_cup" 
      },      
      { 
        "title" : "Cup Berih",
        "data": "cup_bersih" 
      },
      { 
        "title" : "Cup Reject",
        "data": "cup_reject" 
      },
      { 
        "title" : "Tanggal Pembuatan",
        "data": "tanggal_pembuatan" 
      },
      { 
        "title" : "Tanggal Cup Masuk Pada Storage Cup",
        "data": "tanggal_sedang_digunakan" 
      },
      { 
        "title" : "Tanggal Cup Masuk Filler",
        "data": "tanggal_sudah_digunakan" 
      },
      { 
        "title" : "Status",
        "data": "status" 
      }
      ]
    });
  }
  $(document).ready(function() {

    var table_url = $('#table-data').data('url');
    get_data(table_url);

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

  var form_reset = () => {
    table.ajax.reload(null,false);
    $('form#form-pembuatan_no_kantong').find('input,select').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
  }
</script>