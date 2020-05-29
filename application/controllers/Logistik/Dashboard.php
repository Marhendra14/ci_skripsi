<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $cname = "Logistik/Dashboard";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Logistik/Isi_logistik_model','Superadmin/Petugas_aplikasi_model']);

	}

	public function index()
	{
		$data = [
			'title' => "Dashboard",
			'cname' => $this->cname,
			'logistik' => "dashboard/index",
			'count_isi_logistik' => $this->Isi_logistik_model->count_isi_logistik(),
			'data' => array(),
		];
		$this->load->view('pages/logistik/layouts/dashboard',$data);

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