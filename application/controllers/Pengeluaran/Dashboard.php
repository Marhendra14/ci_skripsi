<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $cname = "Pengeluaran/Dashboard";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Pengeluaran/Data_pengeluaran_model','Pengeluaran/Vendor_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Dashboard",
			'cname' => $this->cname,
			'pengeluaran' => "dashboard/index",
			'count_data_pengeluaran' => $this->Data_pengeluaran_model->count_data_pengeluaran(),
			'count_vendor' => $this->Vendor_model->count_vendor(),
			'data' => array(),
		];
		$this->load->view('pages/pengeluaran/layouts/dashboard',$data);

		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */