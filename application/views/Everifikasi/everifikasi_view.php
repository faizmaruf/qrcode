
<body class="box">

<div class="container">
    <div class="flash-data" data-flash="<?= $this->session->flashdata('flash'); ?>">
    </div>
    <div class="row"> 
    <h2>Data <small>Mahasiswa</small></h2>
            <div class="form-group">
             <div class="col-md-2"> 
                    <input type="text" id="keyword"name="keyword" class="form-control" placeholder="Cari.." autocomplete="off" autofocus >
                    <br>  
                    </div>
<!--                     
                        <input class="btn btn-secondary " type="submit" value="Cari" disabled> -->
            </form>
        </div>
    </div>
<div id="result">
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>PRODI</th>
                    <th>STATUS MEMILIH</th>
                </tr>
            </thead>
            <tbody id="ubah">
                    <?php foreach ($data->result() as $row) : ?>
                    <tr>
                        <td style="vertical-align: middle;"><?= $row->nim; ?></td>
                        <td style="vertical-align: middle;"><?= $row->nama; ?></td>
                        <td style="vertical-align: middle;"><?= $row->prodi; ?></td>


                        <td style="vertical-align: middle;"> 
                        <?php if ($row->status_memilih == 'Sudah Hadir') : ?>
                            <button type="button" class="btn btn-danger" disabled>
                                <?= $row->status_memilih; ?> </button>
                        <?php else : ?>
                                <?php $temp = $row->nim; ?>
                                <a href="<?= base_url() . 'everifikasi/ubah_status/' . $temp ?>" method="post"  class="btn btn-success" onclick="return confirm('apakah anda akan mengubah data');">
                                <?= $row->status_memilih; ?>
                                </a>


                        <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-2.1.4.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>


</body>