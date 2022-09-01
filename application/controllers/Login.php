<?php 
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');

    }

    function index()
    {
        $data['judul'] = 'Login page';

        $this->load->view('Login/login_view');
        $this->load->view('auth/footer');
    }
    function auth()
    {
        $username = htmlspecialchars($this->input->post('username', true), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', true), ENT_QUOTES);

        $cek_admin = $this->login_model->get_admin($username, $password);
        $cek_operator = $this->login_model->get_operator($username, $password);

        if ($cek_admin->num_rows() > 0) {
            $data = $cek_admin->row_array();
            $this->session->set_userdata('masuk', true);
            if ($data['level'] == '1') { //Akses admin
                $this->session->set_userdata('akses', '1');
                $this->session->set_userdata('username', $data['nama']);

                redirect('Mahasiswa');

            }

        } elseif ($cek_operator->num_rows() > 0) { //jika login sebagai operator
            $data = $cek_operator->row_array();
            $this->session->set_userdata('masuk', true);
            $this->session->set_userdata('akses', '2');
            $this->session->set_userdata('username', $data['nama']);

            redirect('Everifikasi');

        } else {  // jika username dan password tidak ditemukan atau salah
            $url = base_url();
            echo $this->session->set_flashdata('msg', 'Username Atau Password Salah');
            redirect($url);

        }

    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('');
        redirect($url);
    }


}