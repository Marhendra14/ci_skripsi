<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title"><?php echo $title ?></h3>
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
    var url_insert_produk = '<?php echo base_url($cname.'/insert') ?>';
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
                "title" : "No Batch",
                "data": "no_batch" 
            },
            { 
                "title" : "No Produk",
                "data": "no_produk" 
            },
            { 
                "title" : "Tanggal Pembuatan",
                "data": "tanggal_pembuatan" 
            },
            { 
                "title" : "Status",
                "data": "status" 
            }
            ]
        });

        $('form#form-pembuatan_no_produk').submit(function(e){
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
                            $('#form-pembuatan_no_produk').find('[name="'+key+'"]').parent().find('input,select').addClass('is-invalid');
                            $('#form-pembuatan_no_produk').find('[name="'+key+'"]').parent().append('<div class="invalid-feedback">'+data.field[key]+'</div>');
                        })
                    }else{
                        form_reset();
                        swal(data.title,data.text,data.icon);
                    }
                }
            });
        });
    });

    var fill_form = (id_produk) => {
        $.ajax({
            url: url_fill_form,
            type: 'POST',
            data: {
                'id_produk' : id_produk
            },
            success: function (data) {
                var json = $.parseJSON(data);
                let form = $('#form-pembuatan_no_produk');
                form_reset();
                form.find('[name="id_produk"]').val(json.id_produk);
                form.find('[name="nama_karyawan"]').val(json.nama_karyawan);
                form.find('[name="no_batch"]').val(json.no_batch);
                form.find('[name="no_produk"]').val(json.no_produk);
                form.find('[name="tanggal_pembuatan"]').val(json.tanggal_pembuatan);
                form.find('[name="status"]').val(json.status);
                scroll_smooth('body',500);
            },
        });
    }

    var delete_produk = (obj) => {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete){
                $.ajax({
                    url : base_cname+"/delete_produk",
                    type : 'POST',
                    data : {
                        id_produk : $(obj).data('id'),
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
        $('form#form-pembuatan_no_produk').find('input,select').val('');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

</script>