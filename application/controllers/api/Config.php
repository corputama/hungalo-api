<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Config extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_api');
    }
    public function index_get()
    {
        $config_name = $this->get('config_name');
        $where = array(
            "config_name" => $config_name,
        );
        $config = $this->Data_api->getData('config', $where, '');
        if ($config) {
            $this->response([
                'status' => TRUE,
                'data' => $config
            ], REST_Controller::HTTP_OK);
        }
    }
}
