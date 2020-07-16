<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

date_default_timezone_set('Asia/Jakarta');

class Api_Controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Api_model');
    }

    public function idKantongDua_get(){
        $id = $this->get('id');

        $data_kantong = $this->Api_model->get_kantong($id);

        if($data_kantong){
             $this->response([
            'status' => TRUE,
            'data' => $data_kantong
            ], REST_Controller::HTTP_OK); 
        }else{
            $this->response([
            'status' => FALSE,
            'message' => "Tidak Ada"
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }

    public function cekStatusKantong_get(){
        $id = $this->get('id');

        $data_kantong = $this->Api_model->get_kantong_status($id);

        if($data_kantong){
             $this->response([
            'status' => TRUE,
            'data' => $data_kantong
            ], REST_Controller::HTTP_OK); 
        }else{
            $this->response([
            'status' => FALSE,
            'message' => "Tidak Ada"
            ], REST_Controller::HTTP_NOT_FOUND); 
        }   
    }

    public function kantong_put()
    {
        $id = $this->put("kantong_id");
        $id_status = $this->put("status");

        if($id_status == "2"){
             $data = [
                'jumlah_cup' => $this->put("jumlah_cup"),
                'cup_bersih' => $this->put("cup_bersih"),
                'cup_reject' => $this->put("cup_reject"),
                'tanggal_sedang_digunakan' => date("Y-m-d H:i:s"),
                'id_status' => $id_status
            ];
        }
        else if($id_status == "3"){
           $data = [
                'jumlah_cup' => $this->put("jumlah_cup"),
                'cup_bersih' => $this->put("cup_bersih"),
                'cup_reject' => $this->put("cup_reject"),
                'tanggal_sudah_digunakan' => date("Y-m-d H:i:s"),
                'id_status' => $id_status
            ]; 
        }

        if($this->Api_model->editKantong($id,$data)>0){
             $this->response([
            'status' => TRUE,
            'message' => "Berhasil"
            ], REST_Controller::HTTP_OK); 
        }else{
            $this->response([
            'status' => FALSE,
            'message' => "Tidak Ketemu"
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }
}
?>
