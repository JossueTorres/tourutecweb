<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class funciones_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Funciones');
    }

    public function Login_post()
    {
        $usr = $this->post('usr');
        $pass = $this->post('pass');
        $r = $this->Funciones->login($usr, $pass);
        if ($r) {
            $list = array('resp' => $r);
            $this->response($r, REST_Controller::HTTP_OK);
        } else
            $this->response(0, REST_Controller::HTTP_NOT_FOUND);
    }
}
