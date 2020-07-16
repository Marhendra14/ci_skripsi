<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == false)
		{	
			$data = [
			'title' => "Login",
			'data' => array(),
			];
			$this->load->view('layouts/login',$data);
		}
		else 
		{
			$this->login();	
		}
	}

	public function login_ya()
	{
		$nik = $this->input->post('nik');
		$password = $this->input->post('password');
		$nama_karyawan = $this->input->post('nama_karyawan');
		$id_departemen = $this->input->post('id_departemen');
		$grade = $this->input->post('grade');
		$id_jabatan = $this->input->post('id_jabatan');
		$login = $this->db->get_where('petugas_aplikasi', ['nik' => $nik])->row_array();
		
		if($login)
		{
			if($password == $login['password'])
			{
				$data = [
					'id_petugas' => $login['id_petugas'],
					'nik' => $login['nik'],
					'password' => $login['password'],
					'nama_karyawan' => $login['nama_karyawan'],
					'id_departemen' => $login['id_departemen'],
					'grade' => $login['grade'],
					'id_jabatan' => $login['id_jabatan'],
					'isLogin' => TRUE
				];
				$this->session->set_userdata($data);
				if($login['id_departemen'] == 1)
				{
					redirect('Superadmin/dashboard','refresh');
				}
				else if(($login['id_departemen'] == 2))
				{
					redirect('Logistik/dashboard','refresh');
				}
				else if(($login['id_departemen'] == 3))
				{
					redirect('Area3/dashboard','refresh');
				}
				else
				{
					$this->session->set_flashdata('gagal', '<div class="alert alert-danger">Anda Belum Terdaftar Pada Aplikasi</div>');
				redirect('login','refresh');
				}
				
			}
			else
			{
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger">NIK/Password Salah</div>');
				redirect('login','refresh');
			}
		}

		else
		{
			$this->session->set_flashdata('gagal', '<div class="alert alert-danger">Data Tidak Ditemukan Hubungi Admin</div>');
				redirect('login','refresh');
		}
	}

	// Sengaja ditutup soalnya mau buat fungsi baru di login_ya
	// public function cekLogin()
	// {

	// 	$this->form_validation->set_rules('nik',"Nomor Induk Karyawan","trim|required");
	// 	$this->form_validation->set_rules('password',"Password","trim|required");
	// 	$this->form_validation->set_rules('id_departemen',"Nama Departemen","trim|required");
	// 	$this->form_validation->set_message('required',"{field} harus diisi");
	// 	$this->form_validation->set_error_delimiters('','');

	// 	if($this->form_validation->run() == false)
	// 	{	
	// 		$data = [
	// 		'title' => "Login",
	// 		'data' => array(),
	// 		];
	// 		$data['data']['select_departemen'] = $this->Login_model->get_data();
	// 		$this->load->view('layouts/login',$data);
	// 	}
	// 	else
	// 	{
	// 		$nik = $this->input->post("nik");
	// 		$password = $this->input->post("password");
	// 		$id_departemen = $this->input->post("id_departemen");
	// 		$get_data = $this->Login_model->get_data();
	// 		$get_login = $this->Login_model->getAdmin($nik,$password,$id_departemen);
	// 		if ($get_login)
	// 		{
	// 			foreach ($get_login as $key => $value) 
	// 			{
	// 				$data_session = array(
	// 					'isLogin' => TRUE,
	// 					'user_id' => $value->id_petugas,
	// 					'nama_karyawan' => $value->nama_karyawan,
	// 				);
	// 			}
	// 			$this->session->set_userdata($data_session);
	// 			if($id_departemen==1)
	// 			{
	// 				redirect('Superadmin/dashboard','refresh');
	// 			}
	// 			elseif ($id_departemen==2) 
	// 			{
	// 				redirect('Logistik/dashboard','refresh');
	// 			}
	// 			elseif ($id_departemen==3) 
	// 			{
	// 				redirect('Area3/dashboard','refresh');
	// 			}
	// 			elseif ($id_departemen==4) 
	// 			{
	// 				redirect('Pengeluaran/dashboard','refresh');
	// 			}
	// 		}
	// 		else{
	// 			$this->session->set_flashdata('gagal', '<div class="alert alert-danger">Anda Belum Terdaftar Pada Aplikasi</div>');
	// 			redirect('login','refresh');
	// 		}
	// 	}

	// }

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}

}