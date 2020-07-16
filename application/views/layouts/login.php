<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<?php $this->load->view('includes/head'); ?>
</head>
<body class="hold-transition login-page p-t-10" style="background: #343a40;">
	<div class="login-box m-10">
		<div class="login-logo">
			<img src="<?php echo base_url('assets/img/aqua.png') ?>" alt="" style="width: 100%; height: 100%;">
		</div>
		<!-- /.login-logo -->
		<div class="card" style="border: 1px solid #c8ced3; border-radius: 0.25rem;">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sign in to start your session</p>
				<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
				<?php echo $this->session->flashdata('gagal'); ?>
				<?php echo form_open('login/login_ya') ?>
				<div id="demo">					
				</div>
				<div class="input-group mb-3">
					<input type="number" class="form-control" name="nik" pattern="[0-9]{5}" onKeyPress="
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
				" placeholder="Nomor Induk Karyawan"/>

				<div class="input-group-append">
					<div class="input-group-text ">
						<span class="fas fa-address-card"></span>
					</div>
				</div>
			</div>
			<div id="demo"></div>
			<div class="input-group mb-3">
				<input type="password" name="password" class="form-control" placeholder="Password" maxlength="5">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- /.col -->
				<div class="col-12">
					<button type="submit" class="btn btn-primary btn-block">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
			<?php echo form_close(); ?>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php $this->load->view('includes/foot'); ?>
</body>
</html>
