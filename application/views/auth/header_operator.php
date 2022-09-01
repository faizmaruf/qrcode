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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="<?= base_url() . 'aset/images/intens.png ' ?>" rel="shortcut icon">
    <script src="main.js"></script>
    <script src="<?= base_url() . 'assets/js/jquery-2.1.4.min.js' ?>" > </script>
    <script src="<?= base_url() . 'assets/js/script.js' ?>" > </script>
    <div class="menu-wrap">
    <input type="checkbox" class="toggler">
    <div class="hamburger">
      <div></div>
    </div>
    <div class="menu">
      <div>
        <div>
          <ul>
            
            <li>
              <a href="<?= site_url('Everifikasi') ?>">E-verifikasi</a>
            </li>
            <li>
              <a href="#">Tentang</a>
            </li>
            <li>
              <a href="<?= site_url('Login/logout') ?>">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <header>
        <a class="logo">Fasilkom Unsri</a>
    <img src="<?= base_url() . 'aset/images/logounsri.jpg ' ?>" class="logounsri"></<img>

            </header>
</head>