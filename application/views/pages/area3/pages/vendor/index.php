<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?php echo $title ?></h3>

        </div>
        <div class="card-body">
          <?php echo form_open($cname.'/insert',['id' => 'form-vendor']); ?>
          <input type="hidden" class="form-control" name="id_vendor">
          <div class="row">
          <div class="col-md-6">
          <div class="form-group">
            <label>Nama Vendor</label>
            <input type="text" class="form-control" name="nama_vendor">
          </div>
          <div class="form-group">
            <label>Alamat Vendor</label>
            <input type="text" class="form-control" name="alamat_vendor">
          </div>
          <div class="form-group">
            <label>No Telephone Vendor</label>
            <input type="number" class="form-control" name="no_telephone_vendor">
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
                  <th class="th-sticky-action">-</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>

  var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
  var url_insert_vendor = '<?php echo base_url($cname.'/insert') ?>';
  var base_cname = "<?php echo base_url($cname) ?>";
  var table = "";
  $(document).ready(function() {
    var table_url = $('#table-data').data('url');
    table = $('#table-data').DataTable({
      orderCellsTop : true,
      responsive : true,
      dom: "<'row'<'col-6'l><'col-6'f>>rtip'",
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
        "title" : "Nama Vendor",
        "data": "nama_vendor" 
      },
      { 
        "title" : "Alamat Vendor",
        "data": "alamat_vendor" 
      },
      { 
        "title" : "No Telephone Vendor",
        "data": "no_telephone_vendor" 
      },
      {
        "title": "Actions",
        "width" : "120px",
        "visible":true,
        "class": "text-center th-sticky-action",
        "data": (data, type, row) => {
          let ret = "";
          ret += ' <a class="btn btn-info btn-sm text-white" onclick="fill_form('+data.id_vendor+'); return false;"><i class="fas fa-pencil-alt"></i> Edit</a>';
          ret += ' <a class="btn btn-danger btn-sm text-white" onclick="delete_vendor(this)" data-id="'+data.id_vendor+'"><i class="fas fa-trash-alt"></i> Delete</a>';

          return ret;
        }
      }
      ]
    });

    $('form#form-vendor').submit(function(e){
      var form = $(this);
      e.preventDefault();
      $.ajax({
        url: url_insert_vendor,
        type: 'POST',
        data: form.serialize(),
        dataType : "JSON",
        success: function (data) {
          if(data.code == '2'){
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            Object.keys(data.field).forEach(function(key) {
              $('#form-vendor').find('[name="'+key+'"]').parent().find('input,select').addClass('is-invalid');
              $('#form-vendor').find('[name="'+key+'"]').parent().append('<div class="invalid-feedback">'+data.field[key]+'</div>');
            })
          }else{
            form_reset();
            swal(data.title,data.text,data.icon);
          }
        }
      });
    });
  });

  var fill_form = (id_vendor) => {
    $.ajax({
      url: url_fill_form,
      type: 'POST',
      data: {
        'id_vendor' : id_vendor
      },
      success: function (data) {
        var json = $.parseJSON(data);
        let form = $('#form-vendor');
        form_reset();
        form.find('[name="id_vendor"]').val(json.id_vendor);
        form.find('[name="nama_vendor"]').val(json.nama_vendor);
        form.find('[name="alamat_vendor"]').val(json.alamat_vendor);
        form.find('[name="no_telephone_vendor"]').val(json.no_telephone_vendor);
        scroll_smooth('body',500);
      },
    });
  }

  var delete_vendor = (obj) => {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url : base_cname+"/delete_vendor",
          type : 'POST',
          data : {
            id_vendor : $(obj).data('id'),
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
    $('form#form-vendor').find('input,select').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
  }

</script>