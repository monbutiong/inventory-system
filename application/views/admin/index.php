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

                      

                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
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

          if($('.select2_').length){
            $('.select2_').select2(); 
          }
          if($('.select2-tags_').length){
            $('.select2-tags_').select2({  
                tags: true 
            }); 
          }

         $("body").on("click", ".load_modal_details", function(event) {
             var href = $(this).attr('href');
             
             $("#load_modal_fields_large").html('<div class="p-3 text-center"><i class="fa fa-circle-o-notch fa-spin"></i> LOADING...</div>');
             
             setTimeout(function() {
                 $("#load_modal_fields_large").load(href, function() {
                     $('#global_modal').modal('show');

                     if ($('.select2-tags').length) {
                         $('.select2-tags').select2({
                             tags: true,
                             width: '100%',
                             dropdownParent: $('#global_modal')
                         });
                     }

                     if ($('.select2').length) {
                         $('.select2').select2({
                             width: '100%',
                             dropdownParent: $('#global_modal')
                         });
                     }

                     if ($('#datatable_modal').length) {
                         $('#datatable_modal').DataTable();
                     }

                     if ($('.color_picker').length) {
                         $('.color_picker').colorpicker();
                     }
                 });
             }, 300);
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

          function prompt(title,desc,link,form=null) {
            Swal.fire({
                title: title,
                text: desc,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',          // Red confirm button
                cancelButtonColor: '#d33',        // Blue cancel button
                confirmButtonText: 'Continue',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(form){
                      form.submit();
                    }else{
                      window.location.href = link;
                    } 
                }
            });
          }

          if($(".select2-ajax").length){

                $(".select2-ajax").select2({
                 placeholder: "Select Item", 
                 ajax: { 
                  url: "<?=base_url("outgoing/load_issued_items")?>",
                  type: "post",
                  dataType: 'json',
                  delay: 250,
                  dropdownAutoWidth : true,
                  data: function (params) {
                   return {
                     searchTerm: params, // search term
                     excluded_ids: $('#selected_ids').val(),
                     job_order_id:  $('#job_order_id').val()
                   };
                  },
                  results: function (data, page) {
                  return {
                      results: $.map(data, function(obj) {   
                        console.log('obj', obj);
                           return { 
                              id: obj.id,
                              text: obj.text,
                              item_code: obj.item_code,
                              item_name: obj.item_name,
                              qty: obj.qty,
                              inventory_id: obj.inventory_id,
                              sales_order_number: obj.sales_order_number,
                              issued_date: obj.issued_date,
                              issuance_id: obj.issuance_id
                            }; 
                      })
                  };
                  },
                  cache: true
                 }
                }); 
               
              $(".select2-ajax").on("select2-selecting", function(e) {
                  
                  c+=1;
                   
                  console.log('slected', e.object);

                    if($('#added'+e.object.id).length == 0) {

                      $('#selected_ids').val($('#selected_ids').val() + '(' + e.object.id + ')-');
                     
                      $('#item_selector').before('<tr id="tr' + e.object.id + '"><td>'+e.object.sales_order_number+'<input type="hidden" name="issuance_id'+e.object.id+'"  value="'+e.object.issuance_id+'"/></td><td>'+e.object.issued_date+'<input type="hidden" name="date_issued'+e.object.id+'" value="'+e.object.issued_date+'"></td><td>'+e.object.item_code+'<input type="hidden" name="items['+e.object.id+']" id="added'+e.object.id+'" value="'+e.object.id+'"/><input type="hidden" name="inventory_id'+e.object.id+'" value="'+e.object.inventory_id+'"/></td><td>'+e.object.item_name+'</td><td align="center" id="t_qty'+e.object.id+'">'+e.object.qty+'<input type="hidden" name="issued_qty'+e.object.id+'" value="'+e.object.qty+'"></td><td align="center"><input type="number" id="qty'+e.object.id+'" name="qty'+e.object.id+'" required style="border: 0px; text-align: center; width: 75px;" value="'+e.object.qty+'" min="1" max="'+e.object.qty+'"> </td><td><input type="text" name="remarks'+e.object.id+'" style="border: 0px; width: 100%;" > </td><td align="center"><a href="Javascript:remove_item('+c+','+e.object.id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');
                    }
              

                  $('.add_item .select2-container .select2-choice').html('(+) add more item'); 
                  //$('.selecta'+c).select2();
                  all+=1;

                  $('#row_counter').val(c);
              }); 

              $(".select2-ajax").val('').trigger('change');

          }

        </script>

    </body>
</html>
<?php 
if(@$_SESSION["success"]){unset($_SESSION["success"]);}
if(@$_SESSION["error"]){unset($_SESSION["error"]);}
?>