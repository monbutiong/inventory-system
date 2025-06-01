<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Horizontal | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/favicon.ico">


        <!-- DataTables -->
        <link href="<?=base_url('assets/template/assets')?>/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url('assets/template/assets')?>/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
        

        <!-- Sweet Alert-->
        <link href="<?=base_url('assets/template/assets')?>/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- Select2 Css -->
        <link href="<?=base_url('assets/template/assets')?>/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap Css -->
        <link href="<?=base_url('assets/template/assets')?>/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="<?=base_url('assets/template/assets')?>/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="<?=base_url('assets/template/assets')?>/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head>


    <body data-topbar="dark" data-layout="horizontal">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-light.png" alt="" height="18">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm me-2 font-size-24 d-lg-none header-item waves-effect waves-light"
                            data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="mdi mdi-menu"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="fa fa-search"></span>
                            </div>
                        </form>

                        <div class="dropdown d-none d-md-block ms-2">
                            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img class="me-2" src="<?=base_url('assets/template/assets')?>/images/flags/us_flag.jpg" alt="Header Language" height="16"> English
                                <span class="mdi mdi-chevron-down"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?=base_url('assets/template/assets')?>/images/flags/germany_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle"> German </span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?=base_url('assets/template/assets')?>/images/flags/italy_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle"> Italian </span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?=base_url('assets/template/assets')?>/images/flags/french_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle"> French </span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?=base_url('assets/template/assets')?>/images/flags/spain_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle"> Spanish </span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="<?=base_url('assets/template/assets')?>/images/flags/russia_flag.jpg" alt="user-image" class="me-1" height="12"> <span
                                        class="align-middle"> Russian </span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="m-0 font-size-16"> Notifications (258) </h5>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                                        <i class="mdi mdi-cart-outline"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">Dummy text of the printing and typesetting.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                        <i class="mdi mdi-message-text-outline"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">New Message received</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You have 87 unread messages</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title bg-info rounded-circle font-size-16">
                                                        <i class="mdi mdi-glass-cocktail"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It is a long established fact that a reader will</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="mdi mdi-cart-outline"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">Dummy text of the printing and typesetting industry.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                        <i class="mdi mdi-message-text-outline"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">New Message received</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You have 87 unread messages</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            View all
                                        </a>
                                    </div>    
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?=base_url('assets/template/assets')?>/images/users/user-4.jpg"
                                    alt="Header Avatar">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i
                                        class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="mdi mdi-wallet font-size-17 align-middle me-1"></i> My
                                    Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i
                                        class="mdi mdi-cog font-size-17 align-middle me-1"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i
                                        class="mdi mdi-lock-open-outline font-size-17 align-middle me-1"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="Javascript:logout()"><i
                                        class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="mdi mdi-cog-outline"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </header>

            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <?php  
                                if($index_user_roles){
                                  foreach ($index_user_roles as $rs) { 
                                    $arr_index_user_roles_main_menu[$rs->main_menu_id] = 1;
                                    $arr_index_user_roles_sub_menu[$rs->sub_menu_id] = 1;
                                  }
                                }

                                if($main_menu){
                                foreach ($main_menu as $rs) { 
                                  if(isset($arr_index_user_roles_main_menu[$rs->id]) && $arr_index_user_roles_main_menu[$rs->id]){
                                ?>
                                <li class="nav-item dropdown mega-dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-menu<?=$rs->id?>" role="button">
                                        <i class="fa <?php echo $rs->font_icon;?> me-2"></i><?php echo $rs->title;?>
                                    </a> 
                                    <div class="dropdown-menu" aria-labelledby="topnav-menu<?=$rs->id?>"> 
                                            <?php 
                                            if($sub_menu){
                                            foreach ($sub_menu as $rs_sub) {
                                              if($rs_sub->main_menu_id==$rs->id && isset($arr_index_user_roles_sub_menu[$rs_sub->id]) && $arr_index_user_roles_sub_menu[$rs_sub->id]){
                                            ?>
                                            <a href="<?php echo base_url().$rs_sub->url_link;?>" class="dropdown-item"><?php echo $rs_sub->title;?></a>  
                                            <?php }}}?>
                                       </div>
                                    
                                </li>
                                <?php }}}?>

 
                    
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

              <div class="page-content">
                  <div class="container-fluid">

                

                  <?php  $this->view("admin/$module");  ?>

                </div>
              </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                © <script>document.write(new Date().getFullYear())</script> Veltrix<span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                            </div>
                        </div>
                    </div>
                </footer>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title px-3 py-4">
                    <a href="javascript:void(0);" class="right-bar-toggle float-end">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                    <h5 class="m-0">Settings</h5>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="<?=base_url('assets/template/assets')?>/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="<?=base_url('assets/template/assets')?>/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="<?=base_url('assets/template/assets')?>/css/bootstrap-dark.min.css" 
                            data-appStyle="<?=base_url('assets/template/assets')?>/css/app-dark.min.css" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="<?=base_url('assets/template/assets')?>/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="<?=base_url('assets/template/assets')?>/css/app-rtl.min.css" />
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>
                    <div class="d-grid">
                        <a href="https://1.envato.market/grNDB" class="btn btn-primary mt-3" target="_blank"><i class="mdi mdi-cart me-1"></i> Purchase Now</a>
                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- SYSTEM MODAL -->
        <div class="modal fade" id="system_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content"> 
                <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> 
            </div>
          </div>
        </div>


        <div class="modal fade bs-example-modal-lg" id="global_modal" role="dialog" aria-labelledby="myLargeModalLabel">
          <div id="gmodal" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body" id="load_modal_fields_large">
               <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- /SYSTEM MODAL-->

        <!-- JAVASCRIPT -->
        <script src="<?=base_url('assets/template/assets')?>/libs/jquery/jquery.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/simplebar/simplebar.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/node-waves/waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/jszip/jszip.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <!-- Datatable init js -->
        <script src="<?=base_url('assets/template/assets')?>/js/pages/datatables.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="<?=base_url('assets/template/assets')?>/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- for Select2 js -->
        <script src="<?=base_url('assets/template/assets')?>/libs/select2/js/select2.min.js"></script>

        <!-- Plugin Js-->
        <script src="<?=base_url('assets/template/assets')?>/libs/chartist/chartist.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>

        <script src="<?=base_url('assets/template/assets')?>/js/pages/dashboard.init.js"></script>

        <script>
            const bootstrapCSS = "<?=base_url('assets/template/assets')?>/css/bootstrap.min.css";
            const appCSS = "<?=base_url('assets/template/assets')?>/css/app.min.css";
        </script>

        <script src="<?=base_url('assets/template/assets')?>/js/app.js?2"></script>

        <script type="text/javascript">

          $('.select2_').select2(); 
          
          $("body").on("click", ".load_modal_details", function(event){  
          //$(".load_modal_details").click(function(){    //before
            $("#load_modal_fields_large").html('<span style="padding:10px;"> <i class="fa fa-circle-o-notch fa-spin"></i>  LOADING... </span>');
            var href = $(this).attr('href');  
            setTimeout(function() {  
            $("#load_modal_fields_large").load(href, function(){
                 
                 $('.select2_').select2();
                 $('#select2-tags').select2({
                   tags: true
                 }); 

                 $('#datatable_modal2').DataTable();

                 $('.color_picker').colorpicker();

                 $('div.dataTables_filter input', table.table().container()).focus();
                 init_wysiwyg();

            }); 
            }, 1000);
          });


          <?php if(isset($_SESSION["error"])){?>
            Swal.fire({
            title: "Error!",
            text: "<?=@$_SESSION["error"]?>",
            icon: "error",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });
          <?php }?>
          <?php if(isset($_SESSION["success"])){?>
            Swal.fire({
            title: "Success!",
            text: "<?=@$_SESSION["success"]?>",
            icon: "success",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });
          <?php }?>

          function logout(){ 

               Swal.fire({
                   title: 'Are you sure?',
                   text: "You will be logged out from the system.",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#d33',          // Red confirm button
                   cancelButtonColor: '#3085d6',        // Blue cancel button
                   confirmButtonText: 'Yes, Logout',
                   cancelButtonText: 'Cancel'
               }).then((result) => {
                   if (result.isConfirmed) {
                       // Redirect to logout URL
                       window.location.href = "<?php echo base_url('admin/logout')?>";
                   }
               });
          }

        </script>

    </body>
</html>
<?php 
if(@$_SESSION["success"]){unset($_SESSION["success"]);}
if(@$_SESSION["error"]){unset($_SESSION["error"]);}
?>