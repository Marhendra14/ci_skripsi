<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_aplikasi extends CI_Controller {

	var $cname = "Superadmin/Petugas_aplikasi";

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Superadmin/Petugas_aplikasi_model','Superadmin/Departemen_model','Superadmin/Jabatan_model']);
	}

	public function index()
	{
		$data = [
			'title' => "Petugas Aplikasi",
			'cname' => $this->cname,
			'superadmin' => "petugas_aplikasi/index",
			'count_petugas_aplikasi_all' => $this->Petugas_aplikasi_model->count_petugas_aplikasi_all1(),
			'data' => array(),
		];
		$data['petugas_aplikasi'] = $this->Petugas_aplikasi_model->get_data();
		$data['data']['select_departemen'] = $this->Departemen_model->get_data();
		$data['data']['select_grade'] = $this->Jabatan_model->grade();
		$this->load->view('pages/superadmin/layouts/dashboard', $data);
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login','refresh');
		}
	}

	public function count_pgw(){
		$this->db->where('id_departemen', 1);
		$aaa=$this->db->get('petugas_aplikasi')->num_rows();
		echo $aaa;
	}

	public function get_grade($grade)
	{
		$data = $this->Jabatan_model->get_grade($grade)->result();
		echo json_encode($data);
	}

	public function get_data()
	{
		$data['data'] = $this->Petugas_aplikasi_model->get_data();
		echo json_encode($data);
	}

	public function get_data_by_id()
	{
		$id = $this->input->post('id_petugas');
		$data = $this->Petugas_aplikasi_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function insert()
	{
		$this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','trim|required');
		$this->form_validation->set_rules('id_departemen','Nama Departemen','trim|required');
		$this->form_validation->set_rules('grade','Grade','trim|required');
		$this->form_validation->set_rules('id_jabatan','Jabatan','trim|required');
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id_petugas');
			
			$data = [
				'nik' => $this->input->post('nik'),
				'password' => $this->input->post('password'),
				'nama_karyawan' => $this->input->post('nama_karyawan'),
				'id_departemen' => $this->input->post('id_departemen'),
				'grade' => $this->input->post('grade'),
				'id_jabatan' => $this->input->post('id_jabatan')
			];			

			if ($id == "") {
				$insert = $this->Petugas_aplikasi_model->insert($data);
				if($insert){
					$ret = [
						'title' => "Insert",
						'text' => "Insert success",
						'icon' => "success",
					];
				}
				else{
					$ret = [
						'title' => "Insert",
						'text' => "Insert failed",
						'icon' => "warning",
					];
				}   
			}
			} 
			else {
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

	public function update()
	{
		$id = $this->input->post('id_petugas');
		$data = [
			'nik' => $this->input->post('nik'),
			'password' => $this->input->post('password'),
			'nama_karyawan' => $this->input->post('nama_karyawan'),
			'id_departemen' => $this->input->post('id_departemen'),
			'grade' => $this->input->post('grade'),
			'id_jabatan' => $this->input->post('id_jabatan')
		];

		$update = $this->Petugas_aplikasi_model->update($id, $data);
		if($update){
			$ret = [
				'title' => "Update",
				'text' => "Update success",
				'icon' => "success",
			];
		}else{
			$ret = [
				'title' => "Update",
				'text' => "Update failed",
				'icon' => "warning",
			];
		}
		echo json_encode($ret);
	}

	public function edit_petugas($id)
	{
		$data = $this->Petugas_aplikasi_model->get_data_by_id($id);
		echo json_encode($data);
	}

	public function delete_petugas()
	{
		$id = $this->input->post('id_petugas');

		if ($id != "") {
			$delete = $this->Petugas_aplikasi_model->delete($id);
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
