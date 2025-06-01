<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/i.ico" />

    <title><?php echo system_name;?> | <?php echo company_name;?></title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/themes/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/themes/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/themes/build/css/custom.css" rel="stylesheet">
  
  </head>

  <body class="login">

   <div class="corner-ribbon top-right sticky blue"><?php echo system_name;?></div>

    <div> 



      <div class="login_wrapper">
        <div class="animate form login_form"> 

         <div id="notif_fade" class="col-md-12">
		<?php if(isset($_SESSION["error"])){echo '<div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
		<?php if(isset($_SESSION["success"])){echo '<div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
		<?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
		</div>

		<center><img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2"/></center>

          <section class="login_content">
            <form method="post" action="<?php echo base_url();?>Index/validate_login" data-bs-toggle="validator">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Login</button>
                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>

                    <!--<i class="fa fa-cubes"></i>-->
                <img src="<?php echo base_url();?>assets/images/bib_logo_out.png" style="height: 25px;">

                   <?php echo system_name;?></h1>
                  <p>©2024 All Rights Reserved. <?php echo system_name;?>. Ventum Tech Inc. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>2024 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

<script src="<?php echo base_url();?>assets/validator/bootstrap-validator.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      $("#notif_fade").fadeOut(10000); 
    });
</script>
