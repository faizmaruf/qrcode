<?php 
class Home extends CI_Controller
{

    function index()
    {
        $data['judul'] = 'Landing page';
        $this->load->view('auth/header', $data);
        $this->load->view('Home/landing_view');
        $this->load->view('auth/footer');
    }

}