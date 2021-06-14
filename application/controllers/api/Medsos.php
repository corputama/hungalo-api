<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Medsos extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_api');
    }
    public function index_get(){
        $medsos = $this->Data_api->getData('medsos', '', '');
        if($medsos){
            $this->response([
                'status' => TRUE,
                'data' => $medsos
            ], REST_Controller::HTTP_OK);
        }
    }
}