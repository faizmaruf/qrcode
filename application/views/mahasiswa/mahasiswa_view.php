<body class="box">




	<div class="container">
		<div class="row">
			<h2>Data <small>Mahasiswa</small></h2>
			<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Tambah</button>
			<a href="<?php echo base_url("Mahasiswa/form"); ?>" class="btn btn-primary ">Import Data CSV</a><br><br>





			<?php
			if (!empty($mahasiswa)) { // Jika data pada database tidak sama dengan empty (alias ada datanya)
				foreach ($mahasiswa as $data) { // Lakukan looping pada variabel siswa dari controller
					echo "<tr>";
					echo "<td>" . $data->nim . "</td>";
					echo "<td>" . $data->nama . "</td>";
					echo "<td>" . $data->prodi . "</td>";
					echo "<td>" . $data->email . "</td>";
					echo "</tr>";
				}
			} else { // Jika data tidak ada
				//echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
			}
			?>
			<table class="table table-striped">

				<div class="container mt-3">
					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger">
							<?= validation_errors(); ?>
						</div>
					<?php endif; ?>
				</div>

				<thead>
					<tr>
						<th>NIM</th>
						<th>NAMA</th>
						<th>PRODI</th>
						<th>EMAIL</th>
						<th>QR CODE</th>
						<th>Kehadiran</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php $hapus = "Hapus" ?>
					<?php foreach ($data->result() as $row) : ?>
						<tr>
							<td style="vertical-align: middle;">

								<?= $row->nim; ?>
							</td>
							<td style="vertical-align: middle;"><?php echo $row->nama; ?></td>
							<td style="vertical-align: middle;"><?php echo $row->prodi; ?></td>
							<td style="vertical-align: middle;"><?php echo $row->email; ?></td>
							<td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $row->qr_code; ?>"></td>
							<td style="vertical-align: middle;">
								<?php if ($row->status_memilih == 'Sudah Hadir') : ?>
									<button type="button" class="btn btn-danger" disabled>
										<?= $row->status_memilih; ?> </button>
								<?php else : ?>
									<button type="button" class="btn btn-success" disabled><?= $row->status_memilih; ?> </button>
								<?php endif ?>
							</td>
							<td style="vertical-align: middle;">
								<a href="<?= site_url('Mahasiswa/edit/' . $row->nim); ?>" class='btn btn-success'><i class="fa fa-edit"></i></a>

								<a href="<?= site_url('Mahasiswa/hapus/' . $row->nim); ?> " class='btn btn-danger' onClick="return konfirmasi()"><i class="fa fa-trash"></i></a>


								<a href="<?= site_url('mahasiswa/data/' . $row->nim); ?> " class='btn btn-primary' target='_blank'><i class="fa fa-print"></i></a>


							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<center>
		<div class="container center">
			<a type="submit" href="<?= base_url() . 'mahasiswa/reset/' ?>" method="post" class="btn btn-warning" onclick="return confirm('apakah anda akan mengubah data');">
				Reset Kehadiran
			</a>
		</div>
	</center>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>


	<!-- Modal add new mahasiswa-->
	<form action="<?php echo base_url() . 'index.php/mahasiswa/simpan' ?>" method="post">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add New Mahasiswa</h4>
					</div>

					<div class="modal-body">

						<div class="form-group">
							<label for="nim" class="control-label">NIM:</label>
							<input type="text" name="nim" class="form-control" id="nim" required="required" pattern="[0-9]{14}">

						</div>
						<div class="form-group">
							<label for="nama" class="control-label">NAMA:</label>
							<input type="text" name="nama" class="form-control" id="nama" required="required">
						</div>
						<div class="form-group">
							<label for="prodi" class="control-label">PRODI:</label>
							<select name="prodi" class="form-control" id="prodi">
								<option>Teknik Informatika</option>
								<option>Sistem Informasi</option>
								<option>Sistem Komputer</option>
								<option>Manajemen Informatika</option>
								<option>Komputerisasi Akutansi</option>
								<option>Teknik Komputer</option>
								<option>Teknik Komputer Jaringan </option>
							</select>
						</div>
						<div class="form-group">
							<label for="email" class="control-label">EMAIL:</label>
							<input type="email" name="email" class="form-control" id="email" required="required">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</div>
		</div>

	</form>

	<script type='text/javascript' language='JavaScript'>
		function konfirmasi() {
			tanya = confirm('Anda Yakin Data dihapus?');
			if (tanya == true) return true;
			return false;
		}
	</script>


	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-2.1.4.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>


</body>