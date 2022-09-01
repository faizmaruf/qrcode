
<?php
class Laporanpdf extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }


    function index()
    {
        $gambar = $this->db->get('mahasiswa');

        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar);
        $pdf->AddPage();

        $pdf->Output();
        redirect('Mahasiswa');
    }
}
