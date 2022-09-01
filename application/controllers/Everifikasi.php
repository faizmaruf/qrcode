<?php

class Everifikasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mahasiswa_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function index()
    {
        $data['judul'] = 'Everifikasi page';
        $data['data'] = $this->mahasiswa_model->get_all_mahasiswa();
        $this->load->view('auth/header_operator', $data);
        $this->load->view('everifikasi/everifikasi_view', $data);
        $this->load->view('auth/footer');
    }

    function ubah_status($nim)
    {
        $mahasiswa = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        $this->mahasiswa_model->ubah_status($nim);
        redirect('everifikasi');
    }




}


