<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<?php $this->load->view('includes/head'); ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<?php $this->load->view('includes/header'); ?>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url('assets/img/placeholder-user.png') ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block"><?php echo $this->session->userdata('nama_karyawan') ?></a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<?php $this->load->view('pages/superadmin/includes/menu'); ?>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<?php $this->load->view('includes/breadcrumb'); ?>

			<!-- Main content -->
			<section class="content">
				<?php $this->load->view('pages/superadmin/pages/'.$superadmin); ?>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
			<i class="fas fa-chevron-up"></i>
		</a>

		<!-- Main Footer -->
		<footer class="main-footer">
			
			<!-- Default to the left -->
			<strong>Copyright &copy; 2020 <a>PT. Tirta Investama (AQUA) Pandaan</a></strong>
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<?php $this->load->view('includes/foot'); ?>
</body>
</html>
