<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login - Project SIM Puskesmas</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 

        <link href="<?php echo base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>asset/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>asset/css/font-awesome-4.4.0/font-awesome.css" rel="stylesheet">
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
                    <a class="brand" href="<?php echo base_url(); ?>">
                        <i class="fa fa-hospital-o"></i> Project SIM Puskesmas				
                    </a>		
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li class="">						
                                <a href="<?php echo base_url() ?>home/signup" class="">
                                    <i class="fa fa-users"></i>
                                    Tidak punya akun? Silakan mendaftar.
                                </a>
                            </li>
                            <li class="">						
                                <a href="<?php echo base_url() ?>" class="">
                                    <i class="fa fa-home"></i>
                                    Kembali ke Home
                                </a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->	
                </div> <!-- /container -->
            </div> <!-- /navbar-inner -->
        </div> <!-- /navbar -->
        <div class="account-container">
            <div class="content clearfix">
                <form action="<?php echo base_url() ?>home/login" method="post">
                    <h1 style="text-align: center">Login</h1>
                    <?php echo $this->session->flashdata('pesan');?>
                    <div class="login-fields">
                        <p>Silakan masukkan otentikasi akun Anda</p>
                        <div class="field">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Username" class="login username-field" autocomplete="off" autofocus required="required"/>
                            
                            <?php echo form_error('username') ?>
                        </div> <!-- /field -->
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" class="login password-field" autocomplete="off" required="required"/>
                            
                            <?php echo form_error('password')?>
                        </div> <!-- /password -->
                    </div> <!-- /login-fields -->
                    <div class="login-actions">
                        <span class="login-checkbox">
                            <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                            <label class="choice" for="Field">Biarkan saya tetap masuk</label>
                        </span>
                        <input class="button btn btn-success btn-large" type="submit" value="Sign In"/>
                    </div> <!-- .actions -->
                </form>
            </div> <!-- /content -->
        </div> <!-- /account-container -->
        <div class="login-extra">
            <!--<a href="#">Reset Password</a>-->
        </div> <!-- /login-extra -->
        <script src="<?php echo base_url() ?>asset/js/jquery-1.7.2.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/bootstrap.js"></script>
        <script src="<?php echo base_url() ?>asset/js/signin.js"></script>
    </body>
</html>
