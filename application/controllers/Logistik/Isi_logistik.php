	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	 
	class Isi_logistik extends CI_Controller {

		var $cname = "Logistik/Isi_logistik";

		public function __construct()
		{
			parent::__construct();
			$this->load->model(['Logistik/Isi_logistik_model','Superadmin/Petugas_aplikasi_model']);
		}

		public function index()
		{
			$data = [
				'title' => "Logistik",
				'cname' => $this->cname,
				'logistik' => "isi_logistik/index",
				'count_isi_logistik' => $this->Isi_logistik_model->count_isi_logistik(),
				'data' => array(),
			];
			$data['data']['select_petugas'] = $this->Petugas_aplikasi_model->get_data_logistik();
			$this->load->view('pages/logistik/layouts/dashboard', $data);
			if ($this->session->userdata('isLogin') == FALSE) {
				redirect('login','refresh');
			}
		}

		public function get_data()
		{
			$data['data'] = $this->Isi_logistik_model->get_data();
			echo json_encode($data);
		}

		public function get_data_by_id()
		{
			$id = $this->input->post('id_isi_logistik');
			$data = $this->Isi_logistik_model->get_data_by_id($id);
			echo json_encode($data);
		}

		public function insert()
		{
			$this->form_validation->set_rules('id_petugas','Nama Karyawan','trim|required');
			$this->form_validation->set_rules('bulan','Bulan','trim|required');
			$this->form_validation->set_rules('tahun','Tahun','trim|required');
			$this->form_validation->set_rules('data_produksi_bulan_lalu','Data Produksi Bulan Lalu','trim|required');
			$this->form_validation->set_message('required',"{field} harus diisi");
			$this->form_validation->set_error_delimiters('','');

			if ($this->form_validation->run() == TRUE) 
			{
				$id = $this->input->post('id_isi_logistik');
				
				$data = [
					'id_petugas' => $this->input->post('id_petugas'),
					'bulan' => $this->input->post('bulan'),
					'tahun' => $this->input->post('tahun'),
					'data_produksi_bulan_lalu' => $this->input->post('data_produksi_bulan_lalu'),
				];			

				if ($id == "") 
				{
					$insert = $this->Isi_logistik_model->insert($data);
					$last_id = $this->Isi_logistik_model->get_last_id();
					$perkalian_data = $last_id*$this->input->post('data_produksi_bulan_lalu');
					$data_ke_kuadrat = $perkalian_data*$perkalian_data;
					$data_yang_akan_diramal = array(
						'data_ke' => $last_id, 
						'data_produksi_bulan_lalu' => $this->input->post('data_produksi_bulan_lalu'), 
						'perkalian_data' => $perkalian_data,
						'data_ke_kuadrat' => $last_id*$last_id
						);
					$insert = $this->db->insert('data_yang_akan_diramal',$data_yang_akan_diramal);

					if($insert)
					{
						$sum = $this->Isi_logistik_model->sum_data();
						$count = $this->Isi_logistik_model->count_data();
						$sum_data_ke = $sum[0]->data_ke;
						$sum_data_produksi_bulan_lalu = $sum[0]->data_produksi_bulan_lalu;
						$sum_perkalian_data = $sum[0]->perkalian_data;
						$sum_data_ke_kuadrat = $sum[0]->data_ke_kuadrat;

						$resultb = (($count*$sum_perkalian_data)-($sum_data_ke*$sum_data_produksi_bulan_lalu))/(($count*$sum_data_ke_kuadrat)-($sum_data_ke*$sum_data_ke));
						$resulta = (($sum_data_produksi_bulan_lalu/$count)-(($resultb*$sum_data_ke)/$count));
						$hasil_peramalan = ($resulta+($resultb*($count+1)));						
						$update = $this->Isi_logistik_model->update_data_yang_akan_diramal($last_id, $hasil_peramalan);
						if($update)
						{
							$ret = [
							'title' => "Insert",
							'text' => "Hasil Peramalan Bulan Ini = {$hasil_peramalan}",
							'icon' => "success",
						];
						}					
					}
					else
					{
						$ret = [
							'title' => "Insert",
							'text' => "Insert failed",
							'icon' => "warning",
						];
					}   
				}
				else 
				{
					$update = $this->Isi_logistik_model->update($id, $data);
					if($update)
					{
						$ret = [
							'title' => "Update",
							'text' => "Update success",
							'icon' => "success",
						];
					}
					else
					{
						$ret = [
							'title' => "Update",
							'text' => "Update failed",
							'icon' => "warning",
						];
					}
				}
			} 
			else 
			{
				$ret = [
					'code' => 2,
					'title' => 'Warning',
					'text' => ''.validation_errors('',''),
					'field' => $this->form_validation->error_array(),
					'icon' => 'warning'
				];
			}
			$all = array(
						'sum_data_ke' => $sum_data_ke, 
						'sum_data_produksi_bulan_lalu' => $sum_data_produksi_bulan_lalu, 
						'sum_perkalian_data' => $sum_perkalian_data,
						'sum_data_ke_kuadrat' => $sum_data_ke_kuadrat,
						'resultb' => $resultb,
						'resulta' => $resulta,
						'$hasil_peramalan' => $hasil_peramalan
						);
			echo json_encode($ret);
		}

		public function delete_isi_logistik()
		{
			$id = $this->input->post('id_isi_logistik');

			if ($id != "") {
				$delete = $this->Isi_logistik_model->delete($id);
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
