<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Pembayaran extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_api');
    }
    public function index_get(){
        $u_key = $this->get('u_key');
        $inv = $this->get('inv');
        if($u_key === null){
            $this->response([
                'status' => FALSE,
                'data' => 'Invoice tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else if($inv != null){
            $where = array(
                "user_key" => $u_key,
                "pembayaran_inv" => $inv,
            );
            $pembayaran = $this->Data_api->getData('pembayaran', $where, 'pembayaran_id');
            if($pembayaran){
                $this->response([
                    'status' => TRUE,
                    'data' => $pembayaran
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'data' => 'Invoice tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }else{
            $where = array(
                "user_key" => $u_key,
            );
            $pembayaran = $this->Data_api->getData('pembayaran', $where, 'pembayaran_id');
            if($pembayaran){
                $this->response([
                    'status' => TRUE,
                    'data' => $pembayaran
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'data' => 'Invoice tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post(){
        $data = [
            "pembayaran_inv" => $this->post('pembayaran_inv'),
            "pembayaran_email" => $this->post('pembayaran_email'),
            "pembayaran_total_bayar" => $this->post('pembayaran_total_bayar'),
            "pembayaran_pengirim" => $this->post('pembayaran_pengirim'),
            "pembayaran_bank" => $this->post('pembayaran_bank'),
            "pembayaran_rek" => $this->post('pembayaran_rek'),
        ];
        if($this->Data_api->insertData('pembayaran', $data) > 0){
            $this->response([
                'status' => TRUE,
                'data' => 'Tambah pembayaran created'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status' => FALSE,
                'data' => 'Tambah pembayaran gagal'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put(){
        // $inv = $this->put('invoice');     
        $inv = [
            "pembayaran_inv" => $this->put('pembayaran_inv'),
            "pembayaran_email" => $this->put('pembayaran_email'),
        ];        
        $data = [
            "pembayaran_total_bayar" => $this->put('pembayaran_total_bayar'),
            "pembayaran_pengirim" => $this->put('pembayaran_pengirim'),
            "pembayaran_bank" => $this->put('pembayaran_bank'),
            "pembayaran_rek" => $this->put('pembayaran_rek'),
            "pembayaran_status" => "proses",
        ];

        if($this->Data_api->updateData('pembayaran', $data, $inv) > 0){
            $this->response([
                'status' => TRUE,
                'data' => 'Konfirmasi pembayaran berhasil'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'data' => 'Konfirmasi pembayaran gagal'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}