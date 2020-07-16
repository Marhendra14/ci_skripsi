<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
       <section class="content">
    <button class="btn btn-primary btn-sm" onclick="hapus();" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Jabatan</button>
  </section>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Form Tambah Jabatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open($cname.'/insert',['id' => 'form-jabatan']); ?>
          <input type="hidden" class="form-control" name="id_jabatan" placeholder="">
                <div class="form-group">
                  <label>Grade</label>
                  <select class="form-control" name="grade">
                    <option value="" selected disabled>Pilih</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
                </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary" onclick="form_reset();">Reset</button>
          <?php echo form_close(); ?>
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
                  <th class="th-sticky-action">-</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Jabatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <?php echo form_open($cname.'/update',['id'=>'form-edit']); ?>
          <input type="hidden" class="form-control" name="id_jabatan" placeholder="" readonly>
          <div class="row">
            <div class="col-12">           
                <div class="form-group">
                  <label>Grade</label>
                  <input type="text" class="form-control" name="grade" placeholder="" readonly>
                </div>
                <div class="form-group">
                  <label>Nama Jabatan</label>
                  <input type="text" class="form-control" name="nama_jabatan" placeholder="">
                </div>          
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close(); ?>

    </div>
  </div>
</div>

<!-- End Bootstrap modal -->

<script>

  var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
  var url_insert_jabatan = '<?php echo base_url($cname.'/insert') ?>';  
  var url_update_jabatan = '<?php echo base_url($cname.'/update') ?>';
  var url_edit_jabatan = '<?php echo base_url($cname.'/edit_jabatan') ?>';
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
        "title" : "Grade",
        "data": "grade" 
      },
      { 
        "title" : "Nama Jabatan",
        "data": "nama_jabatan" 
      },
      {
        "title": "Actions",
        "width" : "120px",
        "visible":true,
        "class": "text-center th-sticky-action",
        "data": (data, type, row) => {
          let ret = "";
          ret += ' <a class="btn btn-info btn-sm text-white" onclick="edit_jabatan('+data.id_jabatan+')"><i class="fas fa-pencil-alt"></i> Edit</a>';
          ret += ' <a class="btn btn-danger btn-sm text-white" onclick="delete_jabatan(this)" data-id="'+data.id_jabatan+'"><i class="fas fa-trash-alt"></i> Delete</a>';

          return ret;
        }
      }
      ]
    });

    $('form#form-edit').submit(function(e){
              var form = $(this);
              e.preventDefault();

              $.ajax({
                url: url_update_jabatan,
                type: 'POST',
                data: form.serialize(),
                dataType : "JSON",
                success: function (data) {
                  swal(data.title,data.text,data.icon);
                  scroll_smooth('table',500);
                  form_reset();
                  $('#modal_form').modal('hide');
                  table.ajax.reload(null,false);          
                }
              });
            });

    $('form#form-jabatan').submit(function(e){
      var form = $(this);
      e.preventDefault();
      $.ajax({
                url: url_insert_jabatan,
                type: 'POST',
                data: form.serialize(),
                dataType : "JSON",
                success: function (data) {
                  if(data.code == '2')
          {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            Object.keys(data.field).forEach(function(key) {
              $('#form-jabatan').find('[name="'+key+'"]').parent().find('input,select').addClass('is-invalid');
              $('#form-jabatan').find('[name="'+key+'"]').parent().append('<div class="invalid-feedback">'+data.field[key]+'</div>');
            })

          }
          else
          {
            swal(data.title,data.text,data.icon);
                  scroll_smooth('table',500);
                  form_reset();
                  $('#exampleModal').modal('hide');
                  table.ajax.reload(null,false);
          }
                }
              });
    });
  });

  hapus = () =>
          {
            $('#form-jabatan')[0].reset();
          }

  var fill_form = (id_jabatan) => {
    $.ajax({
      url: url_fill_form,
      type: 'POST',
      data: {
        'id_jabatan' : id_jabatan
      },
      success: function (data) {
        var json = $.parseJSON(data);
        let form = $('#form-jabatan');
        form_reset();
        form.find('[name="id_jabatan"]').val(json.id_jabatan);
        form.find('[name="grade"]').val(json.grade);
        form.find('[name="nama_jabatan"]').val(json.nama_jabatan);
        scroll_smooth('body',500);
      },
    });
  }

  var edit_jabatan = (id_jabatan) => {
    $.ajax({
      url : url_edit_jabatan+"/"+id_jabatan,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
       $('[name="id_jabatan"]').val(data.id_jabatan);
       $('[name="grade"]').val(data.grade);
       $('[name="nama_jabatan"]').val(data.nama_jabatan);
       $('#modal_form').modal('show');
     },
     error: function (jqXHR, textStatus, errorThrown)
     {
      alert('Error get data from ajax');
    }
  });
  }

  var delete_jabatan = (obj) => {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url : base_cname+"/delete_jabatan",
          type : 'POST',
          data : {
            id_jabatan : $(obj).data('id'),
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
    $('form#form-jabatan').find('input,select').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
  }

</script>