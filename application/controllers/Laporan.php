<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan extends CI_Controller {
    public function __construct()
    {   
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model(['Superadmin/Petugas_aplikasi_model','Area3/Pembuatan_no_kantong_model','Status_model']);
    }

    
    public function contoh($no_batch = '',$no_kantong = '')
	{
		$data['data'] = $this->Pembuatan_no_kantong_model->get_data($no_batch,$no_kantong);
		$this->load->view('contoh', $data);
	}     
}