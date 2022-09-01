

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/wickedcss.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/home.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/main.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/hamburgermenu.css' ?>">
    <link href="<?= base_url() . 'aset/images/intens.png ' ?>" rel="shortcut icon">
    <script src="main.js"></script>
    <style type="text/css">
		body{
			font-family: Arial;
		}

		@media print{
			.no-print{
				display: none;
			}
		}

		table{
			border-collapse: collapse;
		}
        
	</style>
    <header>
        
            </header>
</head><body class="box">

	
		
                    

	
</head>
<body>
<table border="6" cellpadding="80" cellspacing="0" width="100%">
<tr>
	<td>
	<table width="100%">
		
		<tr>
			<td colspan="3"><center>
				
				<img src="<?= base_url() . 'aset/images/logounsri.jpg ' ?>" width="90px">
				<h1>UNIVERSITAS SRIWIJAYA</h1>
				<p>Jl. Palembang-Prabumulih KM.32 Indralaya</p>
                </center>
				<hr>
				<br>
                <p align="justify" style="text-indent: 10em;">
				Bersama ini diberitahukan bahwa Komisi Pemilihan Umum UNSRI(KPUU) 
                mengundang Saudara/i <b><?php echo $data->nama; ?></b> (L/P*). Nim <b><?php echo $data->nim; ?></b>
                 untuk memberikan suara pada Pemilihan Gubernur dan Wakil Gubernur Mahasiswa FASILKOM UNSRI Tahun 2020 pada :<br/>
<p style="text-indent: 10em;">Hari/tanggal                            : 30 Maret 2020 </p><br/>
<p style="text-indent: 10em;">Pukul                                   : 08.30 WIB </p><br/>
<p style="text-indent: 10em;">Tempat Pemungutan Suara (TPS)           : Fakultas ILmu Komputer UNSRI  </p><br/>
<p style="text-indent: 10em;">Alamat                                  : Universitas Sriwijaya Kab. Ogan Ilir,Kec. Indralaya Utara </p><br/>
				</p>
               
			</td>
		</tr>
		<tr>
			<td><img style="width: 150px;" src="<?php echo base_url() . 'assets/images/' . $data->qr_code; ?>"><br/><br/><br/>
            <b>Catatan : </b><br>
- Surat Pemberitahuan ini agar dibawa pada saat pemungutan suara<br>
- CodeQR untuk selalu dijaga kerahasiaanya.<br><br>
            </td>
			<td></td>
			<td width="300px">
				<p>Indralaya, 17 januari 2020<br/>
				Komisi Pemilihan Umum UNSRI,<br/>KETUA</p>
			
				<br/>
				<br/>
				<p>Defrian Afandi</p>
				<p>090212722075</p>
                
			</td>
            
		</tr>
        
        
	</table>
    
	</td>
</tr>
</table>
<br>
<center><a href="#" class="no-print" onclick="window.print();">Cetak/Print</a></center>

</body>
</html>