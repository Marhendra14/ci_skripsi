<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo form_open($cname.'/insert',['id' => 'form-pembuatan_no_produk']); ?>
                    <input type="hidden" class="form-control" name="id_produk" placeholder="">
                    <div class="form-group">
                        <label>No Batch</label>
                        <input type="text" class="form-control" name="no_batch" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>No Produk</label>
                        <input type="text" class="form-control" name="no_produk" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pembuatan</label>
                        <input type="date" class="form-control" name="tanggal_pembuatan" placeholder="">
                    </div>
                    <div class="form-group">
                    <label>Status Produk</label>
                                    <select name="id_status" id="" class="form-control">
                                        <option value="" selected disabled>Pilih</option>
                                        <?php foreach ($data['select_status'] as $key => $value): ?>
                                            <option value="<?php echo $value->id_status ?>"><?php echo $value->status ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary" onclick="form_reset();">Reset</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
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
            },
            {
                "title": "Actions",
                "width" : "120px",
                "visible":true,
                "class": "text-center th-sticky-action",
                "data": (data, type, row) => {
                    let ret = "";
                    ret += ' <a class="btn btn-info btn-sm text-white" onclick="fill_form('+data.id_produk+'); return false;"><i class="fas fa-pencil-alt"></i> Edit</a>';
                    ret += ' <a class="btn btn-danger btn-sm text-white" onclick="delete_produk(this)" data-id="'+data.id_produk+'"><i class="fas fa-trash-alt"></i> Delete</a>';

                    return ret;
                }
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