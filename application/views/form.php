<html>

<head>
	<title>Form Import</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/wickedcss.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/home.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/main.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/hamburgermenu.css' ?>">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="<?= base_url() . 'aset/images/intens.png ' ?>" rel="shortcut icon">
	<header>
		<a class="logo">Fasilkom Unsri</a>
		<img src="<?= base_url() . 'aset/images/logounsri.jpg ' ?>" class="logounsri"></<img>

	</header>

	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

	<script>
		$(document).ready(function() {
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
	</script>
</head>

<body class="box">
	<center>
		<h3>Form Import</h3>
		<hr>

		<a href="<?php echo base_url("csv/format.csv"); ?>">Download Format</a>
		<br>
		<br>

		<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
		<form method="post" action="<?php echo base_url("mahasiswa/form"); ?>" enctype="multipart/form-data">
			<!--
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
			<input type="file" name="file" value="Pilih File">

			<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
			<br>
			<input type="submit" name="preview" value="Preview" class="btn btn-warning">
		</form>

		<?php
		if (isset($_POST['preview'])) { // Jika user menekan tombol Preview pada form
			if (isset($upload_error)) { // Jika proses upload gagal
				echo "<div style='color: red;'>" . $upload_error . "</div>"; // Muncul pesan error upload
				die; // stop skrip
			}

			// Buat sebuah tag form untuk proses import data ke database
			echo "<form method='post' action='" . base_url("Mahasiswa/import") . "'>";

			// Buat sebuah div untuk alert validasi kosong
			echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum terisi semua.
		</div>";

			echo "<table border='1' cellpadding='8'>
		<tr>
			<th colspan='5'>Preview Data</th>
		</tr>
		<tr>
			<th>NIM</th>
			<th>Nama</th>
			<th>Prodi</th>
			<th>Email</th>
		</tr>";

			$numrow = 1;
			$kosong = 0;

			// Lakukan perulangan dari data yang ada di csv
			// $sheet adalah variabel yang dikirim dari controller
			foreach ($sheet as $row) {
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
				$nim = $get[0]; // Ambil data NIM
				$nama = $get[1]; // Ambil data nama
				$prodi = $get[2]; // Ambil data Prodi
				$email = $get[3]; // Ambil data email

				// Cek jika semua data tidak diisi
				if ($nim == "" && $nama == "" && $prodi == "" && $email == "")
					continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if ($numrow > 1) {
					// Validasi apakah semua data telah diisi
					$nim_td = (!empty($nim)) ? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
					$nama_td = (!empty($nama)) ? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
					$prodi_td = (!empty($prodi)) ? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
					$email_td = (!empty($email)) ? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

					// Jika salah satu data ada yang kosong
					if ($nim == "" or $nama == "" or $prodi == "" or $email == "") {
						$kosong++; // Tambah 1 variabel $kosong
					}

					echo "<tr>";
					echo "<td" . $nim_td . ">" . $nim . "</td>";
					echo "<td" . $nama_td . ">" . $nama . "</td>";
					echo "<td" . $prodi_td . ">" . $prodi . "</td>";
					echo "<td" . $email_td . ">" . $email . "</td>";
					echo "</tr>";
				}

				$numrow++; // Tambah 1 setiap kali looping
			}

			echo "</table>";

			// Cek apakah variabel kosong lebih dari 1
			// Jika lebih dari 1, berarti ada data yang masih kosong
			if ($kosong > 1) {
		?>
				<script>
					$(document).ready(function() {
						// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
						$("#jumlah_kosong").html('<?php echo $kosong; ?>');

						$("#kosong").show(); // Munculkan alert validasi kosong
					});
				</script>
		<?php

			} else { // Jika semua data sudah diisi
				echo "<hr>";

				// Buat sebuah tombol untuk mengimport data ke database
				echo "<button type='submit' name='import' class='btn btn-primary'>Import</button> ";
				echo "<a href='" . base_url("Mahasiswa") . "' class='btn btn-danger'>Cancel</a>";
			}

			echo "</form>";
		}
		?>

	</center>
	<div class="footer">
		<p><img src="<?= base_url() . 'aset/images/intens.jpg' ?> " class="logointens"></<img>
		</p>
	</div>

</html>