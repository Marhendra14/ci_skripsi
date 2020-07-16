<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $cname = "Logistik/Dashboard";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Logistik/Isi_logistik_model','Superadmin/Petugas_aplikasi_model','Area3/Pembuatan_no_produk_model','Area3/Pembuatan_no_kantong_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Dashboard",
			'cname' => $this->cname,
			'logistik' => "dashboard/index",
			'count_isi_logistik' => $this->Isi_logistik_model->count_isi_logistik(),
			'count_storage_produk' => $this->Pembuatan_no_produk_model->count_storage_produk(),
			'count_storage_cup' => $this->Pembuatan_no_kantong_model->count_storage_cup(),
			'data' => array(),
		];
		$this->load->view('pages/logistik/layouts/dashboard',$data);

		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}
}