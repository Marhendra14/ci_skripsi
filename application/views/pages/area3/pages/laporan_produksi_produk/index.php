<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 mb-4">
			<?php echo form_open('Area3/Laporan_produksi_produk/get_data_report',['id' => 'form-filter']) ?>
			<div class="form-group row mb-1 filter-input">
				<label for="" class="control-label col-form-label col-md-2 ml-1">Tanggal</label>
				<div class="col-md-7">
					<div class="input-daterange input-group" id="datepicker">
						<input value="<?php echo date('01/01/Y') ?>" type="text" class="form-control start" name="start">
						<div class="input-group-append">
							<span class="input-group-text bg-info b-0 text-white">TO</span>
						</div>
						<input value="<?php echo date('m/d/Y') ?>" type="text" class="form-control end" name="end">
					</div>
				</div>
				<div class="col-md-1">
					<button type="submit" class="btn btn-primary filter-input" id="laporan-layanan-submit">Submit</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="table-data" class="table table-hover table-striped table-bordered border-collapse" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 200%;" data-url="<?php echo base_url('Area3/Laporan_produksi_produk/get_data_report') ?>">
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
	var table = "";
	var base_cname = "<?php echo base_url($cname) ?>";
	$(document).ready(function(){
		var start_date = $('.start').val();
		var end_date = $('.end').val();
		var table_url = $('#table-data').data('url');
		table = $('#table-data').DataTable({
			responsive : true,
			dom: "'B<'row'<'col-6'l><'col-6'f>>rtip'",
			buttons: [
			{
				extend: 'excelHtml5',
				className : 'mb-2',
				title : 'Report Data Produksi Produk Tanggal ' + '\n' + start_date + ' - ' + end_date,
			},
			{
				extend: 'pdfHtml5',
				orientation: 'landscape',
				className : 'mb-2',
				title: 'Report Data Produksi Produk Tanggal ' + '\n' + start_date + ' - ' + end_date,
				customize: function(doc) {
					doc.styles.title = {
						alignment: 'center'
					}
				}
			},
			],
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
				"data": "nama_karyawan",
				"class": "text-center",
			},
			{ 
				"title" : "No Batch",
				"data": "no_batch",
				"class": "text-center",
			},
			{ 
				"title" : "No Produk",
				"data": "no_produk",
				"class": "text-center",
			},
			{ 
				"title" : "Jumlah_produk",
				"data": "jumlah_produk",
				"class": "text-center",
			},
			{ 
				"title" : "Tanggal Pembuatan",
				"data": "tanggal_pembuatan",
				"class": "text-center",
			},
			{ 
				"title" : "Tanggal Nomor Produk Diangkut Customer",
				"data": "tanggal_sudah_digunakan",
				"class": "text-center",
			},
			{ 
				"title" : "Nama Vendor",
				"data": "nama_vendor",
				"class": "text-center",
			},
			{ 
				"title" : "Alamat Vendor",
				"data": "alamat_vendor",
				"class": "text-center",
			},
			{ 
				"title" : "No Telephone Vendor",
				"data": "no_telephone_vendor",
				"class": "text-center",
			},
			{ 
				"title" : "Status",
				"data": "status",
				"class": "text-center",
			},
			]
		});

		$("form#form-filter").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);    
			var url = $(this).attr('action');
			$.ajax({
				url : url,
				type: 'POST',
				data: formData,
				success: function (data) {
					var json = $.parseJSON(data);
					reload_table(json.data);
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});


		$('#datepicker').datepicker({
			todayHighlight:'TRUE',
			autoclose: true,
		});

	});  

	var reload_table = (data) => {
		table.clear();
		table.rows.add(data);
		table.draw();
	} 	

</script>
