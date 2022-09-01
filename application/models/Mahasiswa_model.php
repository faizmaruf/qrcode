<?php
class Mahasiswa_model extends CI_Model
{

	function get_all_mahasiswa()
	{
		$hasil = $this->db->get('mahasiswa');
		return $hasil;
	}

			// Fungsi untuk melakukan proses upload file
	public function upload_file($filename)
	{
		$this->load->library('upload'); // Load librari upload

		$config['upload_path'] = './csv/';
		$config['allowed_types'] = 'csv';
		$config['max_size'] = '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;

		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
						// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		} else {
						// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
		
					// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data)
	{
		$this->db->insert_batch('mahasiswa', $data);
	}


	function update_mahasiswa($where, $data)
	{
		$this->db->where($where);
		$this->db->update("mahasiswa", $data);
	}


	public function getMahasiswaByNim($nim)
	{
		return $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
	}
	function ubahdata_mahasiswa()
	{
		$data = [
			"nim" => $this->input->post('nim', true),
			"nama" => $this->input->post('nama', true),
			"prodi" => $this->input->post('prodi', true),
			"email" => $this->input->post('email', true),
			"qr_code" => $this->input->post('qr_code', true)
		];
		

		//$this->db->where('nim', $this->input->post('nim'));
		$this->db->update('mahasiswa', $data);
	}


	function simpan_mahasiswa($nim, $nama, $prodi, $email, $image_name)
	{
		$temp = "Belum Hadir";
		$data = array(
			'nim' => $nim,
			'nama' => $nama,
			'prodi' => $prodi,
			'email' => $email,
			'qr_code' => $image_name,
			'status_memilih' => $temp
		);
		$this->db->insert('mahasiswa', $data);
	}
	function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function detail($nim)
	{
		$this->db->where('nim', $nim);
		$query = $this->db->get('mahasiswa');
		return $query;
	}
	function ubah_status($nim)
	{
		$data = 'Sudah Hadir';

		$this->db->set('status_memilih', $data);
		$this->db->where('nim', $nim);
		$this->db->update('mahasiswa');


	}
	function reset()
	{
		$data = 'Belum Hadir';

		$this->db->set('status_memilih', $data);
		$this->db->update('mahasiswa');

		$hasil = $this->db->get('mahasiswa');
		return $hasil;


	}

}