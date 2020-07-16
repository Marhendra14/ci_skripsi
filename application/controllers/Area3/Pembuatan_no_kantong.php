<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembuatan_no_kantong extends CI_Controller {

	var $cname = "Area3/Pembuatan_no_kantong";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Petugas_aplikasi_model','Area3/Pembuatan_no_kantong_model','Status_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Pembuatan Nomor Kantong",
			'cname' => $this->cname,
			'area3' => "pembuatan_no_kantong/index",
			'count_pembuatan_no_kantong' => $this->Pembuatan_no_kantong_model->count_pembuatan_no_kantong(),
			'data' => array(),
		];
		$data['data']['select_petugas'] = $this->Petugas_aplikasi_model->get_data_area3();
		$data['data']['select_status'] = $this->Status_model->get_data();
		$this->load->view('pages/area3/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function get_data($no_batch = '',$no_kantong = '')
	{
		$data['data'] = $this->Pembuatan_no_kantong_model->get_data($no_batch,$no_kantong);
		echo json_encode($data);
	}

	public function get_max_no_kantong()
	{
		$data = $this->Pembuatan_no_kantong_model->get_max();
		echo json_encode($data);			
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_kantong');
		$data = $this->Pembuatan_no_kantong_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function get_data_history()
	{
		$no_batch = ($this->input->post('no_batch') != '0' ? $this->input->post('no_batch') : null);
		$no_kantong = ($this->input->post('no_kantong') != '0' ? $this->input->post('no_kantong') : null);
		$data['data'] = $this->Pembuatan_no_kantong_model->get_data_history($no_batch,$no_kantong);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('no_batch','No Batch','trim|required');
		$this->form_validation->set_rules('no_kantong','No Kantong','trim|required');
		$this->form_validation->set_rules('id_status','Status Kantong','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$get_id = $this->Pembuatan_no_kantong_model->get_next_id();
			$id = $get_id[0]['auto_increment'];
			$id_petugas = $this->input->post('id_petugas');
			$no_batch = $this->input->post('no_batch');
			$no_kantong = $this->input->post('no_kantong');
			$tanggal_pembuatan = date("Y-m-d H:i:s");
			$id_status = $this->input->post('id_status');

			$this->load->library('ciqrcode');

			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './assets/img/tesqr'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name = 'Kantong'.$no_batch.$no_kantong.'.png';
			$params['data'] = $id."_".$no_batch."_".$no_kantong;//data yang akan di jadikan QR CODE
			// $params['data'] = $id."_".$id_petugas."_".$no_batch."_".$no_kantong."_".$tanggal_pembuatan."_".$id_status;//data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			// $params['savename'] = FCPATH.$config['imagedir'].$image_name;
			$params['savename'] = FCPATH."assets/img/".$image_name;
			$this->ciqrcode->generate($params);

			$data = [
				'id_kantong' => $id,
				'id_petugas' => $id_petugas,
				'no_batch' => $no_batch,
				'no_kantong' => $no_kantong,
				'tanggal_pembuatan' => date("Y-m-d H:i:s"),
				'id_status' => $id_status,
				'qrcode' => $image_name,
			];

			$insert = $this->Pembuatan_no_kantong_model->insert($data);
			if($insert){
				$ret = [
					'title' => "Insert",
					'text' => "Insert success",
					'icon' => "success",
				];
			}else{
				$ret = [
					'title' => "Insert",
					'text' => "Insert failed",
					'icon' => "warning",
				];
			}   
		// if ($id_update == "") {
		// 	$insert = $this->Pembuatan_no_kantong_model->insert($data);
		// 	$insert = $this->db->insert('history_cup',$data_history);
		// 	if($insert){
		// 		$ret = [
		// 			'title' => "Insert",
		// 			'text' => "Insert success",
		// 			'icon' => "success",
		// 		];
		// 	}else{
		// 		$ret = [
		// 			'title' => "Insert",
		// 			'text' => "Insert failed",
		// 			'icon' => "warning",
		// 		];
		// 	}   
		// }else {

		// 	$update = $this->Pembuatan_no_kantong_model->update($id, $data);
		// 	if($update){
		// 		$ret = [
		// 			'title' => "Update",
		// 			'text' => "Update success",
		// 			'icon' => "success",
		// 		];
		// 	}else{
		// 		$ret = [
		// 			'title' => "Update",
		// 			'text' => "Update failed",
		// 			'icon' => "warning",
		// 		];
		// 	}
		// }
		} else {
			$ret = [
				'code' => 2,
				'title' => 'Warning',
				'text' => ''.validation_errors('',''),
				'field' => $this->form_validation->error_array(),
				'icon' => 'warning'
			];
		}
		echo json_encode($ret);
	}

	public function delete_kantong()
	{
		$id = $this->input->post('id_kantong');

		if ($id != "") {
			$delete = $this->Pembuatan_no_kantong_model->delete($id);
			if($delete){
				$ret = [
					'text' => "Delete success",
					'title' => "Delete",
					'icon' => "success",
				];
			}else{
				$ret = [
					'text' => "Delete failed",
					'title' => "Delete",
					'icon' => "warning",
				];
			}

		} else {
			$ret = [
				'text' => "Delete failed",
				'title' => "Delete",
				'icon' => "warning",
			];
		}
		echo json_encode($ret);
	}

}
