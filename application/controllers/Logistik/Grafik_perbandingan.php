<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_perbandingan extends CI_Controller {

	var $cname = "Logistik/Grafik_perbandingan";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Logistik/Grafik_perbandingan_model');
	}
 
	public function index()
	{
		
		$data = [
				'title' => "Logistik",
				'cname' => $this->cname,
				'logistik' => "grafik_perbandingan/index",
				'data' => array(),
			];
			$data['graph'] = $this->Grafik_perbandingan_model->graph();
			$data['graph2'] = $this->Grafik_perbandingan_model->graph2();
			$data['data']['tahun'] = $this->Grafik_perbandingan_model->get_tahun();
			$this->load->view('pages/logistik/layouts/dashboard', $data);
			if ($this->session->userdata('isLogin') == FALSE) {
				redirect('login','refresh');
			}
	}


}