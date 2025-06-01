<!DOCTYPE html>
<?php  
$module_page=NULL;
$main_module=NULL;
if(!in_array($module, array('home','settings','profile','change_password'), true ) ){list($main_module,$module_page) = explode("/",$module);}?>
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
    <link href="<?php echo base_url();?>assets/themes/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/themes/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/themes/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url();?>assets/themes/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/themes/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- alertify -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/alertify/css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/alertify/css/alertify.bootstrap.css" id="toggleCSS" />

    <!-- P-Notify -->
    <link href="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url();?>assets/themes/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

    <?php 
    if(@$module_page){ //print_r($module_page);
    if(in_array(str_replace(' ','',$module_page), array('system_users','master_list','main_table','dashboard','inventory_masterlist','inventory_masterlist_breakdown','create_po','po_list','history','suppliers','purchase_request','confirmed_receiving_records','quotations_confirmed','issue_inventory','adjustments','projects','approvals','quotation_status','active_po','closed_po','create_po','freight_charges','projects_manpower','accounts_payable','projects_control_number','bsp_currency_rate','clients','quotations','overhead_cost','landed_cost_rate','returns','legalization_fees','uploads','masterlist','confirmed_po','receiving_records','issuance_records','confirm_issuance_records','manage_project','terms_and_conditions','suppliers_po','edit_po','create_receiving','job_order','quotations_history','clock_in_out','stock_adjustments','confirmed_stock_adjustments','return_inventory','create_crv','crv_records','manage_client','return_inventory_confirmed','financial_chargers','edit_quotation'), true ) ){?>
      <?php if($module_page != 'inventory_monitoring' && $module_page != 'inventory_project' && $module_page != 'edit_po' && $module_page != 'create_receiving'){ $datatable=1;?> 
        <!-- Datatables -->
        <link href="<?php echo base_url();?>assets/themes/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/themes/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/themes/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/themes/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/themes/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
      <?php }else{ $datatable=2;?> 
        <link href="<?php echo base_url();?>assets/themes/datatables.net/jquery.dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/themes/datatables.net/fixedColumns.dataTables.css" rel="stylesheet">
      <?php }?>
    <?php }}?>

    <!-- Switchery -->
    <link href="<?php echo base_url();?>assets/themes/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- select2 -->
    <link href="<?php echo base_url();?>assets/themes/select2/select2.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url();?>assets/themes/multi_select/multi_select.css" rel="stylesheet" type="text/css" /> 

    <!-- color picker -->
    <link href="<?php echo base_url();?>assets/themes/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!-- loading Progress -->
    <link href="<?php echo base_url();?>assets/themes/loading_progress/loading_progress.css" rel="stylesheet" type="text/css" /> 

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/themes/build/css/custom.css?34" rel="stylesheet">
    <style type="text/css">
    @media (min-width: 992px){
      .modal-lg-mod{
        width: 90% !important;
      } 
    }
    .dropdown-menu{
        min-width: 260px !important;
      }


      <?php 
      $theme = $this->db->get_where('theme',['id'=>1])->row();
      ?>

      body { 
            background: linear-gradient(to bottom, <?=$theme->side_menu_1?>, <?=$theme->side_menu_2?>);  
        }

      .left_col { 
        background: linear-gradient(to bottom, <?=$theme->side_menu_1?>, <?=$theme->side_menu_2?>);  
      }

      .nav_title {
            background: <?=$theme->logo_bg?>;
      }
      
      .nav.side-menu>li.active>a { 
          background: linear-gradient(<?=$theme->active_menu_1?>, <?=$theme->active_menu_2?>), <?=$theme->active_menu_2?>;  
      }

      .nav-sm ul.nav.child_menu { 
          background: linear-gradient(to bottom, <?=$theme->active_sub_menu_1?>, <?=$theme->active_sub_menu_2?>);   
      }

      .nav.side-menu>li.active {
          border-right: 5px solid <?=$theme->bullets_bg?>;
      }

      .nav-md ul.nav.child_menu li:before {
          background: <?=$theme->bullets_bg?>;
      }
      
      .nav-md ul.nav.child_menu li:after {
          border-left: 1px solid <?=$theme->bullets_bg?>;
      }
      
      .nav-sm .nav.child_menu li.active, .nav-sm .nav.side-menu li.active-sm {
          border-right: 5px solid <?=$theme->bullets_bg?>;
      }



      .btn-success {
          background: <?=$theme->success_btn?> ;  
          border-color: <?=$theme->success_border_btn?>;
      }

      .btn-success:hover,
      .btn-success:focus,
      .btn-success:active,
      .btn-success.active,
      .open .dropdown-toggle.btn-success {
          background: <?=$theme->success_btn?> ;  
          opacity: 0.5;
      }

      .btn-primary {
          background: <?=$theme->success_btn?> ;  
          border-color: <?=$theme->success_border_btn?>;
      } 

      .bg-green {
          background: <?=$theme->success_btn?> ;
          border: 1px solid <?=$theme->success_border_btn?> ;
          color: #fff ;  
      }

      .btn-primary {
          background: <?=$theme->primary_btn?> ;  
          border-color: <?=$theme->primary_border_btn?>;
      }

      .btn-primary:hover,
      .btn-primary:focus,
      .btn-primary:active,
      .btn-primary.active,
      .open .dropdown-toggle.btn-primary {
          background: <?=$theme->primary_btn?> ;  
          opacity: 0.5;
      }

      .btn-warning {
          background: <?=$theme->warning_btn?> ;  
          border-color: <?=$theme->warning_border_btn?>;
      }

      .btn-warning:hover,
      .btn-warning:focus,
      .btn-warning:active,
      .btn-warning.active,
      .open .dropdown-toggle.btn-warning {
          background: <?=$theme->warning_btn?> ;  
          opacity: 0.5;
      }

      .btn-danger {
          background: <?=$theme->danger_btn?> ;  
          border-color: <?=$theme->danger_border_btn?>;
      }

      .btn-danger:hover,
      .btn-danger:focus,
      .btn-danger:active,
      .btn-danger.active,
      .open .dropdown-toggle.btn-danger {
          background: <?=$theme->danger_btn?> ;  
          opacity: 0.5;
      }

      .btn-info {
          background: <?=$theme->info_btn?> ;  
          border-color: <?=$theme->info_border_btn?>;
      }

      .btn-info:hover,
      .btn-info:focus,
      .btn-info:active,
      .btn-info.active,
      .open .dropdown-toggle.btn-info {
          background: <?=$theme->info_btn?> ;  
          opacity: 0.5;
      }

      .rid_only{
        background-color: #fff !important;
        border-style: dashed !important;
      }

    </style>
  </head>

  <body class="nav-<?=$theme->side_bar_drawer?>">
    <div id="loading_progress"></div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="Javascript:company_info();" class="site_title">

                <!--<i class="fa fa-cubes"></i>-->
                <img src="<?php echo base_url();?>assets/images/bib_logo_out.png?1" style="height: 45px;">

                 <span><?php echo company_name;?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url(); if($avatar){echo 'assets/uploads/avatar/'.$avatar;}else{echo 'assets/images/img.png';}?>" alt="<?=$avatar?>" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->name_of_user;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu"> 
                
                
                  
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
                  <li><a><i class="fa <?php echo $rs->font_icon;?>"></i> <?php echo $rs->title;?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php 
                    if($sub_menu){
                    foreach ($sub_menu as $rs_sub) {
                      if($rs_sub->main_menu_id==$rs->id && isset($arr_index_user_roles_sub_menu[$rs_sub->id]) && $arr_index_user_roles_sub_menu[$rs_sub->id]){
                    ?>
                    <?php if($rs_sub->border_top==1){?>
                      <li style="border-top: 1px solid #999; cursor: context-menu;"><small style="color: #fff; font-weight: bold;"><?=$rs_sub->group_title?></small></li>
                    <?php }?>
                      <li ><a href="<?php echo base_url().$rs_sub->url_link;?>"> &nbsp; &nbsp; &nbsp; <?php echo $rs_sub->title;?></a></li> 
                    <?php }}}?>
                    </ul>
                  </li>
                <?php }}}?>
                </ul>
              </div>
             

            </div>
      
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); if($avatar){echo 'assets/uploads/avatar/'.$avatar;}else{echo 'assets/images/img.png';}?>" alt=""><?php echo $this->session->name_of_user;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                     
                    <li><a href="<?php echo base_url();?>home/change_password"> Change Password</a></li>  
                    <li><a href="Javascript:logout();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                 
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- jQuery -->
        <script src="<?php echo base_url();?>assets/themes/jquery/dist/jquery.min.js"></script>
        <!-- page content -->
        <div id="my_main_page" class="right_col" role="main">
          
          <div id="notif_fade" class="col-md-12 col-sm-12 col-xs-12">  
          <?php if(isset($_SESSION["error"])){echo '<div class="clearfix"></div><div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
          <?php if(isset($_SESSION["success"])){echo '<div class="clearfix"></div><div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
          <?php echo validation_errors('<div class="clearfix"></div><div class="alert alert-danger">','</div>');?>
          </div>

            <?php  $this->view("admin/$module");  ?>

              
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo system_name;?> - <?php echo company_name;?> <a href="#"><?php echo developer;?></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- SYSTEM MODAL -->
    <div class="modal fade" id="system_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" id="load_modal_fields">
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
        </div>
      </div>
    </div>


    <div class="modal fade bs-example-modal-lg" id="global_modal" role="dialog" aria-labelledby="myLargeModalLabel">
      <div id="gmodal" class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load_modal_fields_large">
           <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
        </div>
      </div>
    </div>
    <!-- /SYSTEM MODAL-->
    <script type="text/javascript">var base_url = '<?=base_url()?>';</script>
    
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/themes/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/themes/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/themes/nprogress/nprogress.js"></script>
    
    <!-- gauge.js
    <script src="<?php echo base_url();?>assets/themes/gauge.js/dist/gauge.min.js"></script> -->
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url();?>assets/themes/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/themes/iCheck/icheck.min.js"></script>
    <!-- Skycons 
    <script src="<?php echo base_url();?>assets/themes/skycons/skycons.js"></script>-->
    
    <!-- money-input-masking-JS -->
    <script src="<?php echo base_url();?>assets/validator/input-money.js"></script>

    <!-- DateJS -->
    <script src="<?php echo base_url();?>assets/themes/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url();?>assets/themes/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url();?>assets/themes/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url();?>assets/themes/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>assets/themes/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url();?>assets/alertify/js/alertify.js"></script>

    <?php if(@$datatable == 1){?>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>assets/themes/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/themes/datatables.net-scroller/js/dataTables.scroller.min.js"></script> 
    <script src="<?php echo base_url();?>assets/themes/datatables.net/js/dataTables.pageResize.min.js"></script>
    <?php }elseif(@$datatable == 2){?>
    <script src="<?php echo base_url();?>assets/themes/datatables.net/js/jquery.dataTables.min.js"></script> 
    <script src="<?php echo base_url();?>assets/themes/datatables.net/js/dataTables.fixedColumns.min.js"></script> 
    <?php }?>

    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url();?>assets/themes/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?php echo base_url();?>assets/themes/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url();?>assets/themes/google-code-prettify/src/prettify.js"></script>

    <!-- PNotify -->
    <script src="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url();?>assets/themes/pnotify/dist/pnotify.nonblock.js"></script>
    
    <!-- Switchery -->
    <script src="<?php echo base_url();?>assets/themes/switchery/dist/switchery.min.js"></script>

    <!-- select2 -->
    <script src="<?php echo base_url();?>assets/themes/select2/select2.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/themes/multi_select/multi_select.js" type="text/javascript"></script>
    <?php if($module_page=='new_quotation'){?>
    <!-- jQuery Smart Wizard -->
    <script src="<?php echo base_url();?>assets/themes/jQuery-Smart-Wizard/js/jquery.smartWizard.js?<?=time()?>"></script>
    <?php }?>
    <!-- color picker -->
    <script src="<?php echo base_url();?>assets/themes/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/themes/build/js/custom.js?123"></script>
	  <script type="text/javascript">  
      $(function() { 
         $('.editor-wrapper').each(function(){
             var id = $(this).attr('id');   
             $(this).wysiwyg(); 
         });

        //$('.datatables').DataTable();
 
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


        //$('body').removeClass('nav-md').addClass('nav-sm');
        <?php if($theme->side_bar_drawer == 'sm'){?>
        $('.left_col').removeClass('scroll-view').removeAttr('style');
        $('#sidebar-menu li').removeClass('active');
        $('#sidebar-menu li ul').slideUp();
        <?php }?>
         
        $('#asset_id').select2();
        $('#to_incharge').select2();
        $('#to_location').select2();
        $('.report_field_multiple').select2(); 
        $('.multiselect-ui').multiselect({ includeSelectAllOption: true, enableFiltering: true, enableCaseInsensitiveFiltering: true });

      });
    
      $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true 
     });

     function reset () {
       
          alertify.set({
            labels : {
              ok     : "OK",
              cancel : "Cancel"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
          });

        }


     function logout(){ 

          reset(); 

          alertify.confirm("logout from account?", function (e) {
                if (e) {  
                    alertify.log(" <i class='fa fa-circle-o-notch fa-spin'></i> signing off...");
                    location.href = "<?php echo base_url();?>admin/logout";
                } else {
                    alertify.log("cancelled");
                }
            }, "Confirm");

       }

    function settings(){ 
      location.href = "<?php echo base_url();?>home/settings";
    }   
 
    $( document ).ready(function() {
      $("#notif_fade").fadeOut(10000);  
    });

    <?php if(@$datatable == 1 || @$datatable == 2 ){?>
    $( document ).ready(function() {
    $('#datatable_reg').DataTable({
       "scrollX": true,
       "lengthMenu": [[10, 25, 50, 100, 150, 200, 500, -1], [10, 25, 50, 100, 150, 200, 500, "All"]]
    });

    $('#datatable_all_search').DataTable({ 
       initComplete: function () {
               this.api()
                   .columns()
                   .every(function () {
                       let column = this;
                       let title = column.footer().textContent;
        
                       // Create input element
                       let input = document.createElement('input');
                       input.placeholder = title;
                       column.footer().replaceChildren(input);
        
                       // Event listener for user input
                       input.addEventListener('keyup', () => {
                           if (column.search() !== this.value) {
                               column.search(input.value).draw();
                           }
                       });
                   });
           }
    });

    $('#datatable2').DataTable({
             <?php if($module_page!='ams'){?>
             responsive: true,
             "autoWidth": false,
             <?php }else{?>
                "scrollX": true,
             <?php }?> 
             "bProcessing": true,
             "serverSide": true,
             "ordering": false,
             "lengthMenu": [[10, 25, 50, 100, 150, 200, 500, -1], [10, 25, 50, 100, 150, 200, 500, "All"]],             
             "order": [],
             "ajax":{
                url :"<?php echo base_url(); if($module_page=='dashboard'){?>home/inventory_data<?php }elseif($module_page=='inventory_masterlist'){?>inventory/inventory_data<?php }elseif($module_page=='inventory_masterlist_breakdown'){?>inventory/inventory_breakdown_data?filter_accounts=<?=@$_GET['filter_accounts']?>&is_project=<?=@$_GET['is_project']?><?php }?>", // json datasource
                type: "post",  // type of method  ,GET/POST/DELETE 
                error: function(){
                  $("#datatable_processing").css("display","none");
                }
              },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        }]
            });   
    }); 

    $('#datatableShowAll').dataTable({
        "bPaginate": false,
        "scrollX": true,
        "scrollY": "500px"
    });
    <?php }?>


    <?php if($module_page == 'create_returns' || $module_page == 'edit_returns'){ ?>
 
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
 
  <?php }elseif($module_page == 'create_issuance' || $module_page == 'edit_ii'){ ?>
  
    $(".select2-ajax").select2({
     placeholder: "Select Item", 
     ajax: { 
      url: "<?=base_url("outgoing/load_items")?>",
      type: "post",
      dataType: 'json',
      delay: 250,
      dropdownAutoWidth : true,
      data: function (params) {
       return {
         searchTerm: params, // search term
         excluded_ids: $('#selected_ids').val()
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
                  unit_price: obj.unit_price,
                  unit_cost_price: obj.unit_cost_price
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

        if(e.object.qty<=0){
              alert("Error: The item quantity is zero, and cannot be issued.");
              $('.add_item .select2-container .select2-choice').html('(+) add more item');
        }else{

              if($('#added'+e.object.id).length == 0) {

                $('#selected_ids').val($('#selected_ids').val() + '(' + e.object.id + ')-');
              
                var price = e.object.unit_price ;

                $('#item_selector').before('<tr id="tr' + e.object.id + '"><td>'+e.object.item_code+'<input type="hidden" name="items['+e.object.id+']" id="added'+e.object.id+'" value="'+e.object.id+'"/><input type="hidden" name="inventory_id'+e.object.id+'" value="'+e.object.id+'"/></td><td>'+e.object.item_name+'</td><td align="right">'+price+'<input type="hidden" name="unit_cost_price'+e.object.id+'" id="unit_cost_price'+e.object.id+'" value="'+e.object.unit_cost_price+'"/></td><td align="center" id="t_qty'+e.object.id+'">'+e.object.qty+'</td><td align="center"><input type="number" id="qty'+e.object.id+'" name="qty'+e.object.id+'" required style="border: 0px; text-align: center; width: 75px;" value="'+e.object.qty+'" min="1" max="'+e.object.qty+'"> </td><td><input type="text" name="remarks'+e.object.id+'" style="border: 0px; width: 100%;" > </td><td align="center"><a href="Javascript:remove_item('+e.object.id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');
              }
        

            $('.add_item .select2-container .select2-choice').html('(+) add more item'); 
            //$('.selecta'+c).select2();
            all+=1;

            $('#row_counter').val(c);

        }

    }); 

    $(".select2-ajax").val('').trigger('change');

    <?php }elseif($module_page == 'create_po' || $module_page == 'edit_po'){?>

      $(".select2-ajax").select2({
       placeholder: "Select Item", 
       ajax: { 
        url: "<?=base_url("purchasing/check_item_if_in_inv")?>",
        type: "post",
        dataType: 'json',
        delay: 250,
        dropdownAutoWidth : true,
        data: function (params) {
         return {
           searchTerm: params, // search term
           excluded_ids: $('#selected_ids').val()
         };
        },
        results: function (data, page) {
        return {
            results: $.map(data, function(obj) {  
       
                 return { id: obj.id, text: obj.text,  item_code: obj.item_code, item_name: obj.item_name, manufacturer_price: obj.manufacturer_price };
       
            })
        };
        },
        cache: true
       }
      });

      var c = 0;
      var all = 0; 

      $(".select2-ajax").on("select2-selecting", function(e) {
          
          c+=1;

          if(e.object.id == 0){ // ==== this is for new ITEM
            
            $('#openNewItemModal').click();

          }else{ // === this is for existing item

          console.log('slected', e.object);

            if($('#added'+e.object.id).length == 0) {

              $('#selected_ids').val($('#selected_ids').val() + '(' + e.object.id + ')-');
          
              // $('#last_row').before('<tr id="irow_ind_'+c+'"><td>'+e.object.item_code+'<input type="hidden" name="new'+c+'" id="added'+e.object.id+'" value="0"/></td><td>'+e.object.item_name+'<input type="hidden" name="item'+c+'" value="'+e.object.id+'"></td><td align="center"><input type="number" name="qty'+c+'" style="border: 0px; text-align: center; width: 65px;" value="1" min="1"></td> <td>0.00</td> <td>0.00</td> <td align="center"><a href="Javascript:remove_item('+c+','+e.object.id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');

              var id = 88888888888+e.object.id;
              var part_no = e.object.item_code;
              var desc = e.object.item_name;
              var part_no = e.object.item_code;
              var qty = 1;
              var unit_cost = e.object.manufacturer_price;
              var rate_text = $('#rate_type').val(); 
              var ttl = qty * unit_cost; 
              var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');


              var newRowHtml = '<tr id="irow' + id + '" class="all_po_itm"><td><input type="hidden" name="items[' + id + ']" value="' + id + '">'+part_no+'<input type="hidden" name="item_code' + id + '" value="' + part_no + '"><input type="hidden" name="lcr' + id + '" value="0"><input type="hidden" name="inv_id' + id + '" value="0"></td><td>'+desc+'<input type="hidden" name="item_name' + id + '" value="' + desc + '"><input type="hidden" name="quotation_id' + id + '" value="0"></td><td><input type="number" id="i_qty' + id + '" name="i_qty' + id + '" onkeyup="comp(' + id + ')" value="'+qty+'" style="border: 0;"></td><td align="right" nowrap><font class="rater">'+rate_text+'</font> <input type="number" name="i_unit_cost' + id + '" id="i_unit_cost' + id + '" onkeyup="comp(' + id + ')" value="'+unit_cost+'" style="border: 0; text-align: right;"></td><td align="right"><input type="hidden" class="all_ttl" id="i_ttl' + id + '" value="'+ttl+'"><span id="ttl' + id + '">'+ttl_nf+'</span></td><td><a href="javascript:idel(' + id + ')"><i class="fa fa-remove"></i></a></td></tr>';
               
              $('#last_row').before(newRowHtml);

            }
          }

          $('.add_item .select2-container .select2-choice').html('(+) add more item'); 
          $('.selecta'+c).select2();
          all+=1;

          $('#row_counter').val(c);
      }); 

      $(".select2-ajax").val('').trigger('change');


    <?php }elseif($module_page == 'create_stock_adjustments' || $module_page == 'edit_stock_adjustments'){?>

      $(".select2-ajax").select2({
           placeholder: "Select Item", 
           ajax: { 
            url: "<?=base_url("outgoing/load_items")?>",
            type: "post",
            dataType: 'json',
            delay: 250,
            dropdownAutoWidth : true,
            data: function (params) {
             return {
               searchTerm: params, // search term
               excluded_ids: $('#selected_ids').val()
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
                        unit_price: obj.unit_price,
                        unit_cost_price: obj.unit_cost_price 
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
                
                  var price = e.object.unit_price ;

                  $('#item_selector').before('<tr id="tr' + e.object.id + '"><td>'+e.object.item_code+'<input type="hidden" name="items['+e.object.id+']" id="added'+e.object.id+'" value="'+e.object.id+'"/><input type="hidden" name="inventory_id'+e.object.id+'" value="'+e.object.id+'"/></td><td>'+e.object.item_name+'</td><td align="right">'+price+'<input type="hidden" name="unit_cost_price'+e.object.id+'" id="unit_cost_price'+e.object.id+'" value="'+e.object.unit_cost_price+'"/></td><td align="center" id="t_qty'+e.object.id+'">'+e.object.qty+'</td><td align="center"><input type="number" id="adj_qty'+e.object.id+'" name="adj_qty'+e.object.id+'" required style="border: 0px; text-align: center; width: 75px;" value="0" onkeyup="update_adj(this.value,'+e.object.id+','+e.object.qty+')" > </td><td align="center"><input type="number" id="new_qty'+e.object.id+'" name="new_qty'+e.object.id+'" required style="border: 0px; text-align: center; width: 75px;" value="0" onkeyup="update_new_qty(this.value,'+e.object.id+','+e.object.qty+')"> </td><td><input type="text" name="remarks'+e.object.id+'" style="border: 0px; width: 100%;" > </td><td align="center"><a href="Javascript:remove_item('+c+','+e.object.id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');
                }
          

              $('.add_item .select2-container .select2-choice').html('(+) add more item'); 
              //$('.selecta'+c).select2();
              all+=1;

              $('#row_counter').val(c);
          }); 

          $(".select2-ajax").val('').trigger('change');

    <?php }?>

    </script>
  </body>
</html>
<?php 
if(@$_SESSION["success"]){unset($_SESSION["success"]);}
if(@$_SESSION["error"]){unset($_SESSION["error"]);}
?>