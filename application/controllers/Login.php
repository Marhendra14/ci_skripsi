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
			'title' => "Dashboard",
			'data' => array(),
		];
		$data['data']['select_departemen'] = $this->Login_model->get_data();
		$this->load->view('superadmin/layouts/login',$data);

		if ($this->session->userdata('isLogin') == TRUE) {
			redirect('dashboard','refresh');
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
			$this->load->view('superadmin/layouts/login',$data);
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
					redirect('dashboard','refresh');
				}
				elseif ($id_departemen==2) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==3) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==4) 
				{
					redirect('dashboard2','refresh');
				}
				elseif ($id_departemen==5) 
				{
					redirect('Logistik/isi_logistik','refresh');
				}
				elseif ($id_departemen==6) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==7) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==8) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==9) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==10) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==11) 
				{
					echo("Hello world!<br>");
				}
				elseif ($id_departemen==12) 
				{
					echo("Hello world!<br>");
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