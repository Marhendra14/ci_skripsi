<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $cname = "Superadmin/Dashboard";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Petugas_aplikasi_model','Superadmin/Departemen_model','Superadmin/Jabatan_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Dashboard",
			'cname' => $this->cname,
			'superadmin' => "dashboard/index",
			'count_petugas_aplikasi_all' => $this->Petugas_aplikasi_model->count_petugas_aplikasi_all(),
			'count_departemen_all' => $this->Departemen_model->count_departemen_all(),
			'count_jabatan_all' => $this->Jabatan_model->count_jabatan_all(),
			'data' => array(),
		];
		$this->load->view('pages/superadmin/layouts/dashboard',$data);

		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}
}