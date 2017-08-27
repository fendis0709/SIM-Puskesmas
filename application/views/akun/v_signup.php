<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Signup - Bootstrap Admin Template</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 

        <link href="<?php echo base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>asset/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url() ?>asset/css/font-awesome.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

        <link href="<?php echo base_url() ?>asset/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>asset/css/pages/signin.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="navbar navbar-fixed-top">

            <div class="navbar-inner">

                <div class="container">

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="<?php echo base_url() ?>">
                        <i class="icon-hospital"></i>
                        Project SIM Puskesmas				
                    </a>		

                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li class="">						
                                <a href="<?php echo base_url() ?>home/login" class="">
                                    <i class="icon-user"></i>
                                    Sudah punya akun? Silakan login.
                                </a>

                            </li>
                            <li class="">						
                                <a href="<?php echo base_url() ?>" class="">
                                    <i class="icon-home"></i>
                                    Kembali ke home
                                </a>
                            </li>
                        </ul>

                    </div><!--/.nav-collapse -->	

                </div> <!-- /container -->

            </div> <!-- /navbar-inner -->

        </div> <!-- /navbar -->



        <div class="account-container register">

            <div class="content clearfix">

                <form action="<?php echo base_url() ?>home/signup_proses" method="post">

                    <h1>Daftar akun</h1>			
                    
                    <?php echo $this->session->flashdata('pesan'); ?>
                    
                    <div class="login-fields">

                        <p>Masukkan data diri Anda</p>

                        <div class="field">
                            <input type="text" name="nama_admin" value="<?php echo set_value('nama_admin') ?>" placeholder="Nama" class="login" />
                            <span><?php echo form_error('nama_admin'); ?></span>
                        </div> <!-- /field -->

                        <div class="field">
                            <input type="text" name="alamat_admin" value="<?php echo set_value('alamat_admin') ?>" placeholder="Alamat" class="login" />
                            <span></span>
                        </div> <!-- /field -->

                        <div class="field">
                            <input type="text" name="telepon" value="<?php echo set_value('telepon') ?>" placeholder="No. Telepon" class="login"/>
                            <span></span>
                        </div> <!-- /field -->

                        <div class="field">
                            <input type="text" name="username" value="<?php echo set_value('username') ?>" placeholder="Username" class="login"/>
                            <span></span>
                        </div> <!-- /field -->

                        <div class="field">
                            <input type="password" name="password" value="<?php echo set_value('password') ?>" placeholder="Password" class="login"/>
                            <span></span>
                        </div> <!-- /field -->

                        <div class="field">
                            <input type="password" name="confirm_password" value="<?php echo set_value('confirm_password') ?>" placeholder="Confirm Password" class="login"/>
                            <span></span>
                        </div> <!-- /field -->


                        <div class="field">
                            <select name="level" class="login" style="width: 100%">
                                <option value="0" selected="selected" disabled="disabled">---Siapakah Anda?---</option>
                                <option value="1">Admin Master</option>
                                <option value="2">Staff Poli</option>
                                <option value="3">Apoteker</option>
                            </select>		
                        </div> <!-- /control-group -->

                    </div> <!-- /login-fields -->

                    <div class="login-actions">

                        <span class="login-checkbox">
                            <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="Check" required="required" tabindex="4" />
                            <label class="choice" for="Field">Agree with the Terms & Conditions.</label>
                        </span>

                        <button type="submit" class="button btn btn-primary btn-large">Daftar</button>

                    </div> <!-- .actions -->

                </form>

            </div> <!-- /content -->

        </div> <!-- /account-container -->

        <script src="<?php echo base_url() ?>asset/js/jquery-1.7.2.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/bootstrap.js"></script>
        <script src="<?php echo base_url() ?>asset/js/signin.js"></script>
    </body>
</html>
