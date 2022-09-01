<?php 
class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model'); //pemanggilan model login    

    }

    function index()
    {
        $this->_login();

    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');


    }


}