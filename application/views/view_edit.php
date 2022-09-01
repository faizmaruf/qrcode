<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Form Ubah Data Mahasiswa
            </div>
            <div class="card-body">
                
                <form action="<?php echo base_url() . 'index.php/mahasiswa/update' ?> " method="post" >
                <!-- <input type="hidden" name="nim" value="<?= $mahasiswa['nim']; ?>"> -->

					<div class="form-group"> 
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" id="nim" value="<?= $mahasiswa['nim']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $mahasiswa['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <select class="form-control" id="prodi" name="prodi">
						<?php foreach( $prodi as $pro ) : ?>
						<?php if( $pro == $mahasiswa['prodi']) : ?>
                        <option value="<?= $pro; ?>" selected><?= $pro; ?></option>
						<?php else :  ?>
							<option value="<?= $pro; ?>"><?= $pro; ?></option>
							<?php endif ?>
						<?php endforeach; ?>
                        </select>
                    </div>					
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?= $mahasiswa['email']; ?>">
                    </div>

                    <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>

                </form>
            </div>
         </div>       
        </div>
    </div>
</div>