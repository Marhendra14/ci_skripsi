<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	 
class History_cup extends CI_Controller 
	{
		var $cname = "Logistik/History_cup";
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['Superadmin/Petugas_aplikasi_model','Logistik/History_cup_model','Status_model']);
		}

		public function index()
		{
			$data = 
			[
				'title' => "History Cup",
				'cname' => $this->cname,
				'logistik' => "history_cup/index",
				'data' => array(),
			];
			$data['data']['select_no_batch'] = $this->History_cup_model->distinct_no_batch();
			$this->load->view('pages/logistik/layouts/dashboard', $data);
			if ($this->session->userdata('isLogin') == FALSE) {
				redirect('login','refresh');
			}
		}

		public function get_data($no_batch = '',$no_kantong = '')
		{
			$data['data'] = $this->History_cup_model->get_data($no_batch,$no_kantong);
			echo json_encode($data);
		}
	}
