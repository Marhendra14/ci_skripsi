<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $cname = "Area3/Dashboard";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Area3/Pembuatan_no_kantong_model','Area3/Pembuatan_no_produk_model','Area3/Vendor_model','Area3/Data_produksi_dan_penjualan_produk_model','Superadmin/Petugas_aplikasi_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Dashboard",
			'cname' => $this->cname,
			'area3' => "dashboard/index",
			'count_pembuatan_no_kantong' => $this->Pembuatan_no_kantong_model->count_pembuatan_no_kantong(),
			'count_pembuatan_no_produk' => $this->Pembuatan_no_produk_model->count_pembuatan_no_produk(),
			'count_vendor' => $this->Vendor_model->count_vendor(),
			'count_data_produksi_dan_penjualan_produk' => $this->Data_produksi_dan_penjualan_produk_model->count_data_produksi_dan_penjualan_produk(),
			'data' => array(),
		];
		$this->load->view('pages/area3/layouts/dashboard',$data);

		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}
}