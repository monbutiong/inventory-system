<!doctype html>
<html lang="en">

    <head>
    
        <meta charset="utf-8">
        <title>Login 2 | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/favicon.ico">
    
        <!-- Bootstrap Css -->
        <link href="<?=base_url('assets/template/assets')?>/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="<?=base_url('assets/template/assets')?>/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="<?=base_url('assets/template/assets')?>/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
    
    </head>

    <body class="account-pages">
        <!-- Begin page -->
        <div class="accountbg" style="background: url('<?=base_url('assets/template/assets')?>/images/bg.jpg?2');background-size: cover;background-position: center;"></div>

        <div class="wrapper-page account-page-full">

            <div class="card shadow-none">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box shadow-none p-4">
                            <div class="p-2">
                                <div class="text-center mt-4">
                                    <a href="index.html" class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="<?=base_url('assets/images/c_logo.png?4')?>" alt="" height="117">
                                        </span>
                                    </a>
                    
                                    <a href="index.html" class="logo logo-light">
                                        <span class="logo-lg">
                                            <img src="<?=base_url('assets/images/c_logo.png?1')?>/images/logo-light.png" alt="" height="18">
                                        </span>
                                    </a>
                                </div>

                                <h4 class="font-size-18 mt-5 text-center">Welcome Back !</h4>
                                <p class="text-muted text-center">Sign in to continue to Inventory System.</p>

                              <form method="post" action="<?php echo base_url();?>Index/validate_login" data-bs-toggle="validator">

                                   <div id="notif_fade" class="col-md-12">
                                    <?php if(isset($_SESSION["error"])){echo '<div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
                                    <?php if(isset($_SESSION["success"])){echo '<div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
                                    <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
                                    </div>

                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                </div>
                              

                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                </div>
    
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                           <!--  <input type="checkbox" class="form-check-input" id="customControlInline">
                                            <label class="form-check-label" for="customControlInline">Remember me</label> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>

                                 

                            </form>

                           

                        </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    

                <!-- JAVASCRIPT -->
                <script src="<?=base_url('assets/template/assets')?>/libs/jquery/jquery.min.js"></script>
                <script src="<?=base_url('assets/template/assets')?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="<?=base_url('assets/template/assets')?>/libs/metismenu/metisMenu.min.js"></script>
                <script src="<?=base_url('assets/template/assets')?>/libs/simplebar/simplebar.min.js"></script>
                <script src="<?=base_url('assets/template/assets')?>/libs/node-waves/waves.min.js"></script>


        <script src="<?=base_url('assets/template/assets')?>/js/app.js"></script>

    </body>
</html>
<?php 
if(@$_SESSION["success"]){unset($_SESSION["success"]);}
if(@$_SESSION["error"]){unset($_SESSION["error"]);}
?>