<?php
class Mahasiswa extends CI_Controller
{
	private $filename = "import_data"; // Kita tentukan nama filenya

	function __construct()
	{
		parent::__construct();
		$this->load->model('mahasiswa_model'); //pemanggilan model mahasiswa
		$this->load->library('form_validation');
	}

	function index()
	{
		$data['judul'] = 'Halaman Mahasiswa';
		$data['data'] = $this->mahasiswa_model->get_all_mahasiswa();
		$this->load->view('auth/header_admin', $data);
		$this->load->view('mahasiswa/mahasiswa_view', $data);
		$this->load->view('auth/footer');
	}

	public function import()
	{
		// Load plugin PHPExcel nya
		include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

		$csvreader = PHPExcel_IOFactory::createReader('CSV');
		$loadcsv = $csvreader->load('csv/' . $this->filename . '.csv'); // Load file yang tadi diupload ke folder csv
		$sheet = $loadcsv->getActiveSheet()->getRowIterator();

		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = [];

		$numrow = 1;
		foreach ($sheet as $row) {
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if ($numrow > 1) {
				// START -->
				// Skrip untuk mengambil value nya
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

				$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
				foreach ($cellIterator as $cell) {
					array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
				}
				// <-- END

				// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
				$nim = $get[0]; // Ambil data Nim dari kolom A di csv
				$nama = $get[1]; // Ambil data nama dari kolom B di csv
				$prodi = $get[2]; // Ambil data prodi dari kolom C di csv
				$email = $get[3]; // Ambil data email dari kolom D di csv

				// Kita push (add) array data ke variabel data
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE

				$config['cacheable'] = true; //boolean, the default is true
				$config['cachedir'] = './assets/'; //string, the default is application/cache/
				$config['errorlog'] = './assets/'; //string, the default is application/logs/
				$config['imagedir'] = './assets/images/'; //direktori penyimpanan qr code
				$config['quality'] = true; //boolean, the default is true
				$config['size'] = '1024'; //interger, the default is 1024
				$config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
				$config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);

				$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

				$params['data'] = $nim; //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
				$params['size'] = 10;
				$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
				$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$temp = "Belum Hadir";

				array_push($data, [
					'nim' => $nim, // Insert data nis
					'nama' => $nama, // Insert data nama
					'prodi' => $prodi, // Insert data prodi
					'email' => $email, // Insert data email
					'qr_code' => $image_name,
					'status_memilih' => $temp
				]);
			}

			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->mahasiswa_model->insert_multiple($data);

		redirect("mahasiswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function form()
	{
		$data = array(); // Buat variabel $data sebagai array

		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada Mahasiswa_model.php
			$upload = $this->mahasiswa_model->upload_file($this->filename);

			if ($upload['result'] == "success") { // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

				$csvreader = PHPExcel_IOFactory::createReader('CSV');
				$loadcsv = $csvreader->load('csv/' . $this->filename . '.csv'); // Load file yang tadi diupload ke folder csv
				$sheet = $loadcsv->getActiveSheet()->getRowIterator();

				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam csv yang sudha di upload sebelumnya
				$data['sheet'] = $sheet;
			} else { // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}

		$this->load->view('form', $data);
	}

	function edit($nim)
	{
		$data['judul'] = 'Halaman Ubah Mahasiswa';

		$data['mahasiswa'] = $this->mahasiswa_model->getMahasiswaByNim($nim);
		$data['prodi'] = ['Teknik Informatika', 'Sistem Informasi', 'Sistem Komputer', 'Manajemen Informatika', 'Komputerisasi Akutansi', 'Teknik Komputer', 'Teknik Komputer Jaringan'];

		$this->form_validation->set_rules('nim', 'NIM', 'required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/header_admin', $data);
			$this->load->view('view_edit', $data);
			$this->load->view('auth/footer');
		} else {
			$this->mahasiswa_model->ubahdata_mahasiswa();
			redirect('mahasiswa');
		}
	}



	function update()
	{
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		$prodi = $this->input->post('prodi');
		$email = $this->input->post('email');

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable'] = true; //boolean, the default is true
		$config['cachedir'] = './assets/'; //string, the default is application/cache/
		$config['errorlog'] = './assets/'; //string, the default is application/logs/
		$config['imagedir'] = './assets/images/'; //direktori penyimpanan qr code
		$config['quality'] = true; //boolean, the default is true
		$config['size'] = '1024'; //interger, the default is 1024
		$config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
		$config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $nim; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$where = array('nim' => $nim,);
		$data = array(
			'nim' => $nim,
			'nama' => $nama,
			'prodi' => $prodi,
			'email' => $email,
			'qr_code' => $image_name
		);


		$this->mahasiswa_model->update_mahasiswa($where, $data); //simpan ke database
		redirect('mahasiswa'); //redirect ke mahasiswa usai simpan data
	}


	function simpan()
	{
		$this->form_validation->set_rules('nim', 'Nim', 'is_unique[mahasiswa.nim]|trim|integer');
		$this->form_validation->set_rules('email', 'Email', 'is_unique[mahasiswa.email]|valid_email');

		if (($this->form_validation->run() == false)) {
			$data['judul'] = 'Halaman Mahasiswa';
			$data['data'] = $this->mahasiswa_model->get_all_mahasiswa();
			$this->load->view('auth/header_admin', $data);
			$this->load->view('mahasiswa/mahasiswa_view', $data);
			$this->load->view('auth/footer');
		} else {

			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$prodi = $this->input->post('prodi');
			$email = $this->input->post('email');


			$this->load->library('ciqrcode'); //pemanggilan library QR CODE

			$config['cacheable'] = true; //boolean, the default is true
			$config['cachedir'] = './assets/'; //string, the default is application/cache/
			$config['errorlog'] = './assets/'; //string, the default is application/logs/
			$config['imagedir'] = './assets/images/'; //direktori penyimpanan qr code
			$config['quality'] = true; //boolean, the default is true
			$config['size'] = '1024'; //interger, the default is 1024
			$config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
			$config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);

			$image_name = $nim . '.png'; //buat name dari qr code sesuai dengan nim

			$params['data'] = $nim; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$this->mahasiswa_model->simpan_mahasiswa($nim, $nama, $prodi, $email, $image_name); //simpan ke database
			redirect('mahasiswa'); //redirect ke mahasiswa usai simpan data
		}
	}
	function data($nim)
	{
		$data['judul'] = '-';
		$data['data'] = $this->mahasiswa_model->detail($nim)->row();

		$this->load->view('mahasiswa/data_view', $data);
	}
	function hapus($nim)
	{
		$where = array('nim' => $nim);
		$this->mahasiswa_model->hapus_data($where, 'mahasiswa');
		redirect('Mahasiswa');
	}
	public function pdf($nim)
	{
		$this->load->library('dompdf_gen');

		$data['data'] = $this->mahasiswa_model->detail($nim)->row();


		$this->load->view('mahasiswa/data_view', $data);
		$paper_size = 'A4';
		$orientation = "landscape";
		$html = $this->output->get_output('');
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('Suket.pdf', array('Attachment' => 0));
	}
	function reset()
	{

		$data['judul'] = 'Mahasiswa';
		$data['data'] = $this->mahasiswa_model->reset();
		$this->load->view('auth/header_admin', $data);
		$this->load->view('mahasiswa/mahasiswa_view', $data);
		$this->load->view('auth/footer');
	}
}
