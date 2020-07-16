<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_produksi_cup extends CI_Controller 
{

	var $cname = "Area3/Laporan_produksi_cup";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Area3/Laporan_produksi_cup_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Laporan Produksi Cup",
			'cname' => $this->cname,
			'area3' => "laporan_produksi_cup/index",
			'data' => array(),
		];
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data_report()
	{
		$start = ($this->input->post('start') != '0' ? $this->input->post('start') : null);
		$end = ($this->input->post('end') != '0' ? $this->input->post('end') : null);
		$data['data'] = $this->Laporan_produksi_cup_model->get_data_report($start, $end);
		echo json_encode($data);
	}
}


