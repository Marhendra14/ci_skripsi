<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	 
class History_produk extends CI_Controller 
	{
		var $cname = "Logistik/History_produk";
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['Superadmin/Petugas_aplikasi_model','Logistik/History_produk_model','Status_model']);
		}

		public function index()
		{
			$data = 
			[
				'title' => "History produk",
				'cname' => $this->cname,
				'logistik' => "history_produk/index",
				'data' => array(),
			];
			$data['data']['select_no_batch'] = $this->History_produk_model->distinct_no_batch();
			$this->load->view('pages/logistik/layouts/dashboard', $data);
			if ($this->session->userdata('isLogin') == FALSE) {
				redirect('login','refresh');
			}
		}

		public function get_data($no_batch = '',$no_produk = '')
		{
			$data['data'] = $this->History_produk_model->get_data($no_batch);
			echo json_encode($data);
		}
	}
