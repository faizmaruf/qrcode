<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/wickedcss.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/home.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/main.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'aset/css/hamburgermenu.css' ?>">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="<?= base_url() . 'aset/images/intens.png ' ?>" rel="shortcut icon">
    <script src="main.js"></script>
    <div class="menu-wrap">
    <input type="checkbox" class="toggler">
    
    </div>
    
  </div>
 
</head>

<body class="box">

    


<div class="container" style="margin-top: 40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
         <div class="account-wall ">   
            
        <h1 class="text-center login-title">LOGIN ADMIN/OPERATOR</h1>
        <h2 class="text-center login-title">E-VERIFIKASI</h2>

            <img class="profile-img" src="<?= base_url() . 'aset/images/unsri.jpg' ?>" alt="not found">
                <form class="form-signin" method="POST" action="<?= base_url() . 'Login/auth' ?>"><center>
                <p style="color:white; background: red; width: 200px; margin: 10px 0;"><?php echo $this->session->flashdata('msg'); ?></p></center> 
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required="required">
                    </div>
                   
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Passwords" required="required">
                    </div>
                   
                    <div class="col-md-3"></div>
                    
                        <button class="btn btn-lg btn-primary btn-block" name="btn-login" type="submit">
                            Masuk</button>
                      
                    </div>
                    
        </div>
    </div>
</div>


</body>
