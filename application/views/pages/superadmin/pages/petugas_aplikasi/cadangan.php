<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center"></h2>
      <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ModalAdd">Tambah Petugas Aplikasi</button>
      <div class="table-responsive">
        <table id="table-data" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Password</th>
              <th>Nama Karyawan</th>
              <th>Nama Departemen</th>
              <th>Grade</th>
              <th>Nama Jabatan</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody data-url="<?php echo base_url($cname.'/get_data') ?>">
            <?php $no=1; foreach($petugas_aplikasi as $row): ?>
            <tr class="odd gradeX">
              <td><?php echo $no++; ?></td>
              <td><?php echo $row->nik; ?></td>
              <td><?php echo $row->password; ?></td>
              <td><?php echo $row->nama_karyawan; ?></td>
              <td><?php echo $row->nama_departemen; ?></td>
              <td><?php echo $row->grade; ?></td>
              <td><?php echo $row->nama_jabatan; ?></td>
              <td class="btn btn-info btn-sm text-white" onclick="<?php echo base_url($cname.'/edit_petugas') ?>"><i class="fas fa-pencil-alt"></i> Edit</td>
              <td class="btn btn-danger btn-sm text-white" onclick="<?php echo base_url($cname.'/delete_petugas') ?>"><i class="fas fa-trash-alt"></i> Delete</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <?php echo form_open($cname.'/insert',['id' => 'form-petugas']); ?>
          <input type="hidden" class="form-control" name="id_petugas" placeholder="">
          <div class="form-group">
            <label>Nomor Induk Karyawan</label>
            <input type="number" class="form-control" name="nik" placeholder="Nomor Induk Karyawan">
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

<!-- Modal Edit Product -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Petugas Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-body">
          <?php echo form_open($cname.'/update',['id'=>'form-petugas']); ?>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control nik_edit" name="nik" placeholder="" readonly>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control password_edit" name="password" placeholder="">
          </div>
          <div class="form-group">
            <label for="nama_karyawan">Nama Karyawan</label>
            <input type="text" class="form-control nama_karyawan_edit" name="nama_karyawan" placeholder="" readonly>
          </div>
          <div class="form-group">
            <label for="id_departemen">Departemen</label>
            <input type="text" class="form-control nama_departemen_edit" name="id_departemen" readonly>
          </div>
          <div class="form-group">
            <label for="grade">Grade</label>
            <input type="text" class="form-control grade_edit" name="grade" readonly>
          </div>
          <div class="form-group">
            <label for="id_jabatan">Jabatan</label>
            <input type="text" class="form-control id_jabatan_edit" name="id_jabatan" readonly>
          </div> 
          <div class="modal-footer">
            <input type="hidden" name="id_petugas" class="id_petugas_edit">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-edit">Edit</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Petugas Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">
          Anda yakin mau menghapus data ini?
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_petugas" class="id_petugas">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary btn-delete">Yes</button>
      </div>
    </div>
  </div>
</div>

<script>

  var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
  var url_insert_petugas = '<?php echo base_url($cname.'/insert') ?>';
  var url_update_petugas = '<?php echo base_url($cname.'/update') ?>';
  var url_edit_petugas = '<?php echo base_url($cname.'/edit_petugas') ?>';
  var base_cname = "<?php echo base_url($cname) ?>";
  var table = "";
  $(document).ready(function() {
    // var table_url = $('#table-data').data('url');

    // $('form#form-petugas').submit(function(e){
    //   var form = $(this);
    //   e.preventDefault();

    //   $.ajax({
    //     url: url_update_petugas,
    //     type: 'POST',
    //     data: form.serialize(),
    //     dataType : "JSON",
    //     success: function (data) {
    //       swal(data.title,data.text,data.icon);
    //       scroll_smooth('table',500);
    //       form_reset();
    //       $('#modal_form').modal('hide');
    //       table.ajax.reload(null,false);          
    //     }
    //   });
    // });

    $('.btn-save').on('click',function(){
      var nik = $('.nik').val();
      var password = $('.password').val();
      var nama_karyawan = $('.nama_karyawan').val();
      var nama_departemen = $('.nama_departemen').val();
      var grade = $('.grade').val();
      var id_jabatan = $('.id_jabatan').val();
      $.ajax({
        url    : '<?php echo base_url($cname.'/insert') ?>',
        method : 'POST',
        data: form.serialize(),
        dataType : "JSON",
        data   : {nik: nik, password: password, nama_karyawan: nama_karyawan, nama_departemen: nama_departemen, grade: grade, id_jabatan: id_jabatan},
        success: function()
        {
          $('#ModalAdd').modal('hide');
          $('.id_petugas').val("");
          $('.nik').val("");
          $('.password').val("");
          $('.nama_karyawan').val("");
          $('.nama_departemen').val("");
          $('.grade').val("");
          $('.id_jabatan').val("");
          $('#modal_form').modal('show');
        }
      });
    });
            // END CREATE PRODUCT

            // UPDATE PRODUCT
            $('#mytable').on('click','.item_edit',function(){
              var id_petugas = $(this).data('id_petugas');
              var nik = $(this).data('nik');
              var password = $(this).data('password');
              var nama_karyawan = $(this).data('nama_karyawan');
              var nama_departemen = $(this).data('nama_departemen');
              var grade = $(this).data('grade');
              var id_jabatan = $(this).data('id_jabatan');
              $('#ModalEdit').modal('show');
              $('.id_petugas_edit').val(id_petugas);
              $('.nik_edit').val(nik);
              $('.password_edit').val(password);
              $('.nama_karyawan_edit').val(nama_karyawan);
              $('.nama_departemen_edit').val(nama_departemen);
              $('.grade_edit').val(grade);
              $('.id_jabatan_edit').val(id_jabatan);
            });

            $('.btn-edit').on('click',function(){
              var id_petugas = $('.id_petugas_edit').val();
              var nik = $('.nik_edit').val();
              var password = $('.password_edit').val();
              var nama_karyawan = $('.nama_karyawan_edit').val();
              var nama_departemen = $('.nama_departemen_edit').val();
              var grade = $('.grade_edit').val();
              var id_jabatan = $('.id_jabatan_edit').val();
              $.ajax({
                url    : '<?php echo site_url("Petugas_aplikasi/update");?>',
                method : 'POST',
                data   : {id_petugas: id_petugas, nik: nik, password: password, nama_karyawan: nama_karyawan, nama_departemen: nama_departemen, grade: grade, id_jabatan: id_jabatan},
                success: function(){
                  $('#ModalEdit').modal('hide');
                  $('.id_petugas_edit').val("");
                  $('.nik_edit').val("");
                  $('.password_edit').val("");
                  $('.nama_karyawan_edit').val("");
                  $('.nama_departemen_edit').val("");
                  $('.grade_edit').val("");
                  $('.id_jabatan_edit').val("");
                }
              });
            });
            // END EDIT PRODUCT

            // DELETE PRODUCT
            $('#mytable').on('click','.item_delete',function(){
              var id_petugas = $(this).data('id');
              $('#ModalDelete').modal('show');
              $('.id_petugas').val(id_petugas);
            });

            $('.btn-delete').on('click',function(){
              var id_petugas = $('.id_petugas').val();
              $.ajax({
                url    : '<?php echo site_url("Petugas_aplikasi/delete_petugas");?>',
                method : 'POST',
                data   : {id_petugas: id_petugas},
                success: function(){
                  $('#ModalDelete').modal('hide');
                  $('.id_petugas').val("");
                }
              });
            });
            // END DELETE PRODUCT
          });

var fill_form = (id_petugas) => {
  $.ajax({
    url: url_fill_form,
    type: 'POST',
    data: {
      'id_petugas' : id_petugas
    },
    success: function (data) {
      var json = $.parseJSON(data);
      let form = $('#form-petugas');
      form_reset();
      form.find('[name="id_petugas"]').val(json.id_petugas);
      form.find('[name="nik"]').val(json.nik);
      form.find('[name="password"]').val(json.password);
      form.find('[name="nama_karyawan"]').val(json.nama_karyawan);
      form.find('[name="nama_departemen"]').val(json.nama_departemen);
      form.find('[name="grade"]').val(json.grade);
      form.find('[name="nama_jabatan"]').val(json.nama_jabatan);
      scroll_smooth('body',500);
    },
  });
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
     $('[name="nama_departemen"]').val(data.nama_departemen);
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
}

$('.input-grade').change(function(){
  let grade = $('.input-grade option:selected').val();
  $.ajax({
    url: "http://localhost/ci_skripsi/Superadmin/petugas_aplikasi/get_grade/" +grade,
    type: 'GET',
    success: function (data)
    {
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