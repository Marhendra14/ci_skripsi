<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title"><?php echo $title ?></h3>
                </div>
                <div class="card-body">
                    <?php echo form_open($cname.'/insert',['id' => 'form-data_produksi_dan_penjualan_produk']); ?>
                    <input type="hidden" class="form-control" name="id_data_produksi_dan_penjualan_produk" placeholder="">
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
                              <label>No Batch</label>
                              <select name="id_petugas" id="" class="form-control">
                                <option value="" selected disabled>Pilih</option>
                                <?php foreach ($data['select_produk'] as $key => $value): ?>
                                  <option value="<?php echo $value->id_produk ?>"><?php echo $value->no_batch ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <label>No Produk</label>
                                <input type="number" class="form-control" name="no_batch" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Jumlah Produk</label>
                                <input type="number" class="form-control" name="jumlah_produk" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Nama Vendor</label>
                                <select name="id_vendor" id="" class="form-control">
                                <option value="" selected disabled>Pilih</option>
                                <?php foreach ($data['select_vendor'] as $key => $value): ?>
                                <option value="<?php echo $value->id_vendor ?>"><?php echo $value->nama_vendor ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat Vendor</label>
                                <input type="text" class="form-control" name="alamat_vendor" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>No. Telephone Vendor</label>
                                <input type="text" class="form-control" name="no_telephone_vendor" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" name="status" placeholder="">
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
        </div>  
    </div>
<script>

    var url_fill_form = '<?php echo base_url($cname.'/get_data_by_id') ?>';
    var url_insert_data_produksi_dan_penjualan_produk = '<?php echo base_url($cname.'/insert') ?>';
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

        $('form#form-data_produksi_dan_penjualan_produk').submit(function(e){
            var form = $(this);
            e.preventDefault();
            $.ajax({
                url: url_insert_produk,
                type: 'POST',
                data: form.serialize(),
                dataType : "JSON",
                success: function (data) {
                    if(data.code == '2'){
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        Object.keys(data.field).forEach(function(key) {
                            $('#form-data_produksi_dan_penjualan_produk').find('[name="'+key+'"]').parent().find('input,select').addClass('is-invalid');
                            $('#form-data_produksi_dan_penjualan_produk').find('[name="'+key+'"]').parent().append('<div class="invalid-feedback">'+data.field[key]+'</div>');
                        })
                    }else{
                        form_reset();
                        swal(data.title,data.text,data.icon);
                    }
                }
            });
        });
    });

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
    }

</script>