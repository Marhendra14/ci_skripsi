<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <section class="content">
                    <button class="btn btn-primary btn-sm" onclick="hapus();" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data Produksi dan Penjualan</button>
                    </section>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">    
                            <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title" id="exampleModalLabel">Form Data Produksi dan Penjualan Produk</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open($cname.'/insert',['id' => 'form-data_produksi_dan_penjualan_produk']); ?>
                                    <input type="hidden" class="form-control" name="id_data_produksi_dan_penjualan_produk" placeholder="">
                                    <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('id_petugas') ?>" name="id_petugas" placeholder="">
                                    <div class="form-group">
                                        <label>Nama Petugas</label>
                                        <input type="text" class="form-control" value="<?php echo $this->session->userdata('nama_karyawan') ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label>No Batch</label>
                                      <select name="no_batch" id="" class="form-control input-no-batch">
                                        <option value="" selected disabled>Pilih</option>
                                        <?php foreach ($data['select_no_batch'] as $key => $value): ?>
                                          <option value="<?php echo $value->no_batch ?>"><?php echo $value->no_batch ?></option>
                                      <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>No Produk</label>
                                    <select class="form-control input-no-produk select_no_produk" name="no_produk" id="no_produk">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Produk</label>
                                    <input type="number" class="form-control" name="jumlah_produk" value=24 readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Vendor</label>
                                    <select name="id_vendor" id="" class="form-control input-id-vendor">
                                        <option value="" selected disabled>Pilih</option>
                                        <?php foreach ($data['select_vendor'] as $key => $value): ?>
                                            <option value="<?php echo $value->id_vendor ?>"><?php echo $value->nama_vendor ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Vendor</label>
                                    <input type="text" class="form-control select_alamat_vendor" name="alamat_vendor" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>No. Telephone Vendor</label>
                                    <input type="text" class="form-control no_telephone_vendor" name="no_telephone_vendor" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Status Produk</label>
                                    <input type="text" class="form-control" name="status_show" value="<?php echo $data['select_status'][2]->status ?>" readonly>
                                    <input type="hidden" class="form-control" name="id_status" value="<?php echo $data['select_status'][2]->id_status ?>" readonly>
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
    var url_insert_data_produksi_dan_penjualan_produk = '<?php echo base_url($cname.'/insert') ?>';
    var url_get_no_batch = '<?php echo base_url($cname.'/get_no_batch') ?>';
    var url_get_no_produk = '<?php echo base_url($cname.'/get_no_produk') ?>';
    var url_get_vendor = '<?php echo base_url($cname.'/get_vendor') ?>';
    var base_cname = "<?php echo base_url($cname) ?>";
    var table = "";

    get_data = (table_url) =>
    {
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
                "title" : "Nama Karyawan",
                "data": "nama_karyawan" 
            },            
            { 
                "title" : "No Produk",
                "data": "no_produk" 
            },
            { 
                "title" : "No Batch",
                "data": "no_batch" 
            },            
            { 
                "title" : "Jumlah Produk",
                "data": "jumlah_produk" 
            },
            { 
                "title" : "Tanggal Pembuatan",
                "data": "tanggal_pembuatan" 
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
                "title" : "Status",
                "data": "status" 
            },
            {
                "title": "Actions",
                "width" : "120px",
                "visible":true,
                "class": "text-center th-sticky-action",
                "data": (data, type, row) => {
                    let ret = "";
                    ret += ' <a class="btn btn-info btn-sm text-white" onclick="fill_form('+data.id_data_produksi_dan_penjualan_produk+'); return false;"><i class="fas fa-pencil-alt"></i> Edit</a>';
                    ret += ' <a class="btn btn-danger btn-sm text-white" onclick="delete_data_produksi_dan_penjualan_produk(this)" data-id="'+data.id_data_produksi_dan_penjualan_produk+'"><i class="fas fa-trash-alt"></i> Delete</a>';

                    return ret;
                }
            }
            ]
        });
    }
    $(document).ready(function() {
        var table_url = $('#table-data').data('url');
        console.log(table_url);
        get_data(table_url);

        $('form#form-data_produksi_dan_penjualan_produk').submit(function(e){
            var form = $(this);
            e.preventDefault();
            $.ajax({
                url: url_insert_data_produksi_dan_penjualan_produk,
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
    });

    $('.input-no-batch').change(function(){
        let no_batch = $(this).children('option:selected').val();
        $.ajax({
            url: url_get_no_batch+"/"+no_batch,
            type: 'GET',
            success: function (data)
            {
                var obj = JSON.parse(data);
                $('.select_no_produk').children().remove();
                for (var i=0;i<obj.length;i++) 
                {
                    $('.select_no_produk').append(new Option(obj[i].no_produk,obj[i].no_produk));
                    console.log(obj[i]);
                }
            }
        })
    });

    $('.input-id-vendor').change(function(){
        let id_vendor = $(this).children('option:selected').val();
        $.ajax({
            url: url_get_vendor+"/"+id_vendor,
            type: 'GET',
            success: function (data)
            {
                var obj = JSON.parse(data);
                // console.log(obj[0]['alamat_vendor']);
                $('.select_alamat_vendor').val(obj[0]['alamat_vendor']);
                $('.no_telephone_vendor').val(obj[0]['no_telephone_vendor']);

                // $('.select_alamat_vendor').children().remove();
                // for (var i=0;i<obj.length;i++) 
                // {
                //     $('.select_alamat_vendor').append(new Option(obj[i].alamat_vendor,obj[i].alamat_vendor));
                //     console.log(obj[i]);
                // }
            }
        })
    });


    hapus = () =>
    {
        $('#form-data_produksi_dan_penjualan_produk')[0].reset();
        $('.select_no_batch')
        .empty();
        $('.select_no_produk')
        .empty();
        $('.select_vendor')
        .empty();
        $('.select_alamat_vendor')
        .empty();
        $('.select_id_status')
        .empty();
    }
    var fill_form = (id_data_produksi_dan_penjualan_produk) => {
        $.ajax({
            url: url_fill_form,
            type: 'POST',
            data: {
                'id_data_produksi_dan_penjualan_produk' : id_data_produksi_dan_penjualan_produk
            },
            success: function (data) {
                var json = $.parseJSON(data);
                let form = $('#form-data_produksi_dan_penjualan_produk');
                form_reset();
                form.find('[name="id_data_produksi_dan_penjualan_produk"]').val(json.id_data_produksi_dan_penjualan_produk);
                form.find('[name="nama_karyawan"]').val(json.nama_karyawan);
                form.find('[name="no_produk"]').val(json.no_produk);
                form.find('[name="no_batch"]').val(json.no_batch);
                form.find('[name="jumlah_produk"]').val(json.jumlah_produk);
                form.find('[name="tanggal_pembuatan"]').val(json.tanggal_pembuatan);
                form.find('[name="nama_vendor"]').val(json.nama_vendor);
                form.find('[name="alamat_vendor"]').val(json.alamat_vendor);
                form.find('[name="no_telephone_vendor"]').val(json.no_telephone_vendor);
                form.find('[name="status"]').val(json.status);
                scroll_smooth('body',500);
            },
        });
    }

    var delete_data_produksi_dan_penjualan_produk = (obj) => {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete){
                $.ajax({
                    url : base_cname+"/delete_data_produksi_dan_penjualan_produk",
                    type : 'POST',
                    data : {
                        id_data_produksi_dan_penjualan_produk : $(obj).data('id'),
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
        $('form#form-data_produksi_dan_penjualan_produk').find('input,select').val('');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $('.select_no_produk').empty();
    }

</script>