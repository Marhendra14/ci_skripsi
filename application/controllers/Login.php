<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index()
	{
		$this->load->model('Login_model');
		$data = [
			'title' => "Login",
			'data' => array(),
		];
		$data['data']['select_departemen'] = $this->Login_model->get_data();
		$this->load->view('layouts/login',$data);

		if ($this->session->userdata('isLogin') == TRUE) {
			redirect('Superadmin/dashboard','refresh');
		}
	}

	public function cekLogin(){

		$this->form_validation->set_rules('nik',"Nomor Induk Karyawan","trim|required");
		$this->form_validation->set_rules('password',"Password","trim|required");
		$this->form_validation->set_rules('id_departemen',"Id Departemen","trim|required");
		$this->form_validation->set_message('required',"{field} harus diisi");
		$this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == false)
		{
			$this->load->view('layouts/login',$data);
		}
		else
		{
			$nik = $this->input->post("nik");
			$password = $this->input->post("password");
			$id_departemen = $this->input->post("id_departemen");
			$get_data = $this->Login_model->get_data();
			$get_login = $this->Login_model->getAdmin($nik,$password,$id_departemen);
			if ($get_login)
			{
				foreach ($get_login as $key => $value) 
				{
					$data_session = array(
						'isLogin' => TRUE,
						'user_id' => $value->id_petugas,
						'nama_karyawan' => $value->nama_karyawan,
					);
				}
				$this->session->set_userdata($data_session);
				if($id_departemen==1)
				{
					redirect('Superadmin/dashboard','refresh');
				}
				elseif ($id_departemen==2) 
				{
					redirect('Area3/dashboard','refresh');
				}
				elseif ($id_departemen==3) 
				{
					redirect('Logistik/dashboard','refresh');
				}
				elseif ($id_departemen==4) 
				{
					redirect('Pengeluaran/dashboard','refresh');
				}
				elseif ($id_departemen==5) 
				{
					redirect('Logistik/isi_logistik','refresh');
				}
			}
			else{
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger">Anda Belum Terdaftar Pada Aplikasi</div>');
				redirect('login','refresh');
			}
		}

		

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */