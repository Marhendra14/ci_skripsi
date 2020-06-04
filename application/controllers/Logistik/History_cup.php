<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	 
class History_cup extends CI_Controller 
	{
		var $cname = "Logistik/History_cup";
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['Logistik/History_cup_model']);
		}

		public function index()
		{
			$data = [
				'title' => "Logistik",
				'cname' => $this->cname,
				'logistik' => "history_cup/index",
				'data' => array(),
			];
			$this->load->view('pages/logistik/layouts/dashboard', $data);
			if ($this->session->userdata('isLogin') == FALSE) {
				redirect('login','refresh');
			}
		}

		public function get_data()
		{
			$data['data'] = $this->History_cup_model->get_data();
			echo json_encode($data);
		}

		public function get_data_by_id()
		{
			$id = $this->input->post('id_history_cup');
			$data = $this->History_cup_model->get_data_by_id($id);
			echo json_encode($data);
		}

	}
