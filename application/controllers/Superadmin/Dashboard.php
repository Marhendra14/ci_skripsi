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
			'count_petugas_aplikasi' => $this->Petugas_aplikasi_model->count_petugas_aplikasi(),
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


	// public function get_chart_pengaduan()
	// {
	// 	$id_kategori = ($this->input->post('id_kategori') != '0' ? $this->input->post('id_kategori') : null);
	// 	$waktu_lapor = ($this->input->post('waktu_lapor') != '0' ? $this->input->post('waktu_lapor') : null);
	// 	$data = $this->Pengaduan_model->get_chart_pengaduan($id_kategori, $waktu_lapor);
	// 	echo json_encode($data);
	// }

	// public function get_table_pengaduan()
	// {
	// 	$id_kategori = ($this->input->post('pilih_kategori') != '0' ? $this->input->post('pilih_kategori') : null);
	// 	$waktu_lapor = ($this->input->post('pilih_tahun') != '0' ? $this->input->post('pilih_tahun') : null);
	// 	$data['data'] = $this->Dashboard_model->get_table_pengaduan($id_kategori, $waktu_lapor);
	// 	echo json_encode($data);
	// }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */