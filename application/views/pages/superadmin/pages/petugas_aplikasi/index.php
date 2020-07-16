<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <section class="content">
            <button class="btn btn-primary btn-sm" onclick="hapus();" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Petugas Aplikasi</button>
          </section>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Form Tambah Petugas Aplikasi</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open($cname.'/insert',['id' => 'form-petugas']); ?>
                  <input type="hidden" class="form-control" name="id_petugas" placeholder="">
                  <div id="demo"></div>
                  <div class="form-group">
                    <label>Nomor Induk Karyawan</label>
                    <input type="number" class="form-control" placeholder="Nomor Induk Karyawan" name="nik" pattern="[0-9]{5}" onKeyPress="
                    if(this.value.length<3)
                    {
                      document.getElementById('demo').innerHTML = 'NIK Minimal 4 Angka';
                    }
                    else
                    {
                      document.getElementById('demo').innerHTML = '';
                    }
                    if(this.value.length<5)
                    { 
                      return event.charCode >= 48;
                    }
                    else if(this.value.length==5){
                    return false;
                  }
                  "/>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label>Nama Karyawan</label>
                  <input type="text" class="form-control" name="nama_karyawan" placeholder="Nama Karyawan">
                </div>
                <div class="form-group">
                  <label>Departemen</label>
                  <select name="id_departemen" id="" class="form-control">
                    <option value="" selected disabled>Pilih</option>
                    <?php foreach ($data['select_departemen'] as $key => $value): ?>
                      <option value="<?php echo $value->id_departemen ?>"><?php echo $value->nama_departemen ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Grade</label>
                  <select class="form-control input-grade" name="grade">
                    <option value="" selected disabled>Pilih</option>
                    <?php foreach ($data['select_grade'] as $key => $value): ?>
                      <option value="<?php echo $value->grade ?>"><?php echo $value->grade ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <select class="form-control select_jabatan" name="id_jabatan" id="id_jabatan">
                  </select>
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
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="modal fade" id="modal_edit">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit Petugas Aplikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php echo form_open($cname.'/update',['id' => 'form-edit']); ?>
                <input type="hidden" class="form-control" name="id_petugas" placeholder="">
                <div class="form-group">
                  <div id="demo"></div>
                  <label>Nomor Induk Karyawan</label>
                  <input type="number" class="form-control" readonly placeholder="Nomor Induk Karyawan" name="nik" pattern="[0-9]{5}" onKeyPress="
                  if(this.value.length<3)
                  {
                    document.getElementById('demo').innerHTML = 'NIK Minimal 4 Angka';
                  }
                  else
                  {
                    document.getElementById('demo').innerHTML = '';
                  }
                  if(this.value.length<5)
                  { 
                    return event.charCode >= 48;
                  }
                  else if(this.value.length==5){
                  return false;
                }
                "/>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label>Nama Karyawan</label>
                <input type="text" class="form-control" name="nama_karyawan" placeholder="Nama Karyawan">
              </div>
              <div class="form-group">
                <label>Departemen</label>
                <select name="id_departemen" class="form-control">
                  <option value="" selected disabled>Pilih</option>
                  <?php foreach ($data['select_departemen'] as $key => $value): ?>
                    <option value="<?php echo $value->id_departemen ?>"><?php echo $value->nama_departemen ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Grade</label>
                <select class="form-control input-grade" name="grade">
                  <option value="" selected disabled>Pilih</option>
                  <?php foreach ($data['select_grade'] as $key => $value): ?>
                    <option value="<?php echo $value->grade ?>"><?php echo $value->grade ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jabatan</label>
                <select class="form-control select_jabatan" name="id_jabatan" id="id_jabatan">
                </select>
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
</div>
</div>

<!-- End Bootstrap modal -->  

<script>

  var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
  var url_insert_petugas = '<?php echo base_url($cname.'/insert') ?>';
  var url_update_petugas = '<?php echo base_url($cname.'/update') ?>';
  var url_edit_petugas = '<?php echo base_url($cname.'/edit_petugas') ?>';
  var url_get_grade = '<?php echo base_url($cname.'/get_grade') ?>';
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
        "title" : "Nomor Induk Karyawan",
        "data": "nik" 
      },      
      { 
        "title" : "Password",
        "data": "password" 
      },
      { 
        "title" : "Nama Karyawan",
        "data": "nama_karyawan" 
      },
      { 
        "title" : "Departemen",
        "data": "nama_departemen" 
      },
      { 
        "title" : "Grade",
        "data": "grade" 
      },
      { 
        "title" : "Jabatan",
        "data": "nama_jabatan" 
      },
      {
        "title": "Actions",
        "width" : "120px",
        "visible":true,
        "class": "text-center th-sticky-action",
        "data": (data, type, row) => {
          let ret = "";
          ret += ' <a class="btn btn-info btn-sm text-white" onclick="edit_petugas('+data.id_petugas+')"><i class="fas fa-pencil-alt"></i> Edit</a>';
          ret += ' <a class="btn btn-danger btn-sm text-white" onclick="delete_petugas(this)" data-id="'+data.id_petugas+'"><i class="fas fa-trash-alt"></i> Delete</a>';
          return ret;
        }
      }
      ]
    });

    $('form#form-petugas').submit(function(e){
      var form = $(this);
      e.preventDefault();

      $.ajax({
        url: url_insert_petugas,
        type: 'POST',
        data: form.serialize(),
        dataType : "JSON",
        success: function (data) {
          if(data.code == '2')
          {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            Object.keys(data.field).forEach(function(key) {
              $('#form-petugas').find('[name="'+key+'"]').parent().find('input,select').addClass('is-invalid');
              $('#form-petugas').find('[name="'+key+'"]').parent().append('<div class="invalid-feedback">'+data.field[key]+'</div>');
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

    $('form#form-edit').submit(function(e){
      var form = $(this);
      e.preventDefault();

      $.ajax({
        url: url_update_petugas,
        type: 'POST',
        data: form.serialize(),
        dataType : "JSON",
        success: function (data) {
          swal(data.title,data.text,data.icon);
          scroll_smooth('table',500);
          form_reset();
          $('#modal_edit').modal('hide');
          table.ajax.reload(null,false);          
        }
      });
    });
  });

  hapus = () =>
  {
    $('#form-petugas')[0].reset();
    $('.select_jabatan')
    .empty();
  }

  var edit_petugas = (id_petugas) => {
    $.ajax({
      url : url_edit_petugas+"/"+id_petugas,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
       $('[name="id_petugas"]').val(data.id_petugas);
       $('[name="nik"]').val(data.nik);
       $('[name="password"]').val(data.password);
       $('[name="nama_karyawan"]').val(data.nama_karyawan);
       $('[name="edit_nama_departemen"]').val(data.nama_departemen);
       $('[name="grade"]').val(data.grade);
       $('[name="nama_jabatan"]').val(data.nama_jabatan);
               // console.log(data.nama_departemen);
               $('#modal_edit').modal('show');
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
              alert('Error get data from ajax');
            }
          });
  }

  var delete_petugas = (obj) => {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        $.ajax({
          url : base_cname+"/delete_petugas",
          type : 'POST',
          data : {
            id_petugas : $(obj).data('id'),
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
    $('form#form-petugas').find('input,select').val('');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.select_jabatan').empty();
  }

  $('.input-grade').change(function(){
    let grade = $(this).children('option:selected').val();
    $.ajax({
      url: url_get_grade+"/"+grade,
      type: 'GET',
      success: function (data)
      {
        console.log(data);
        var obj = JSON.parse(data);
        $('.select_jabatan').children().remove();
        for (var i=0;i<obj.length;i++) 
        {
          $('.select_jabatan').append(new Option(obj[i].nama_jabatan,obj[i].id_jabatan));
          console.log(obj[i]);
        }
      }
    })
  });

</script>