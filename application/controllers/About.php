<?php 
class About extends CI_Controller
{

    function index_Admin()
    {
        $data['judul'] = 'About page';
        $this->load->view('auth/header_admin', $data);
        $this->load->view('about/about_view');
        $this->load->view('auth/footer');
    }

    function index_opertor()
    {
        $data['judul'] = 'About page';
        $this->load->view('auth/header_operator', $data);
        $this->load->view('about/about_view');
        $this->load->view('auth/footer');
    }
}