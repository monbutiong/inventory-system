<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>German Auto Line</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/gai.ico">


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
        <style type="text/css">
            .modal-content {
              max-height: 95vh;
              overflow-y: auto;
            }
        </style>
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
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-sm.png?3" alt="" height="32">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-dark.png?3" alt="" height="37">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-sm.png?3" alt="" height="32">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url('assets/template/assets')?>/images/logo-light.png?3" alt="" height="38">
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
                               
                                <a class="dropdown-item d-block" href="#"> <i
                                        class="mdi mdi-cog font-size-17 align-middle me-1"></i> Change Password</a>
                                 
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="Javascript:logout()"><i
                                        class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i> Logout</a>
                            </div>
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
                                © <script>document.write(new Date().getFullYear())</script> <?=company_name?> <span class="d-none d-sm-inline-block"> - <i class="mdi mdi-heart text-danger"></i> <?=system_name?></span>
                            </div>
                        </div>
                    </div>
                </footer>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- SYSTEM MODAL --> 
        <div class="modal fade bs-example-modal-lg" id="global_modal" role="dialog" aria-labelledby="myLargeModalLabel" data-bs-backdrop="static" data-bs-keyboard="false">
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

         
          // Apply to all input and textarea fields
          $(document).on('input', 'input[type="text"], input[type="email"], textarea', function() {
            this.value = this.value.toUpperCase();
          });

          // Optional: Apply CSS for visual cue
          $('input[type="text"], textarea').css('text-transform', 'uppercase');
          

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
             var modalSize = $(this).data('modal-size') || 'lg'; //  
             // Remove any existing size class
             $('#gmodal').removeClass('modal-lg modal-xl');

             // Add the correct size class
             $('#gmodal').addClass('modal-' + modalSize);
             
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

                     if ($('#global_modal .select2').length && $("#global_modal .select2-ajax").length == 0) {
                         $('#global_modal .select2').select2({
                             width: '100%',
                             dropdownParent: $('#global_modal')
                         });
                     }

                     if ($('.select2item').length && $(".select2-ajax").length==0) {
                         $('.select2item').select2({
                             width: '100%',
                             dropdownParent: $('#global_modal'),
                             templateSelection: function(item) {
                                 if (!item.id) return item.text;

                                 // Fallback for non-AJAX
                                 if (!item.item_code || !item.item_name) {
                                     return item.text;
                                 }

                                 return `
                                     <span style="display:inline-flex; align-items:center; gap:5px;">
                                         ${item.item_code} - ${item.item_name}
                                     </span> 
                                 `;
                             },
                             escapeMarkup: function(markup) { return markup; }
                         });
                     } 

                     if ($('#datatable_modal').length) {
                         $('#datatable_modal').DataTable();
                     }

                     if ($('.color_picker').length) {
                         $('.color_picker').colorpicker();
                     }


                     if ($(".select2-ajax-modal").length) {

                       
                       var $select = $(".select2-ajax-modal");

                       // Initialize Select2
                       $select.select2({
                         dropdownParent: $('#global_modal'),
                         placeholder: "Select Item",
                         ajax: {
                           url: "<?=base_url('purchasing/check_item_if_in_inv/simple')?>",
                           type: "post",
                           dataType: 'json',
                           delay: 250,
                           dropdownAutoWidth: true,
                           data: function(params) {
                             return {
                               searchTerm: params.term,
                               excluded_ids: $('#selected_ids').val()
                             };
                           },
                           processResults: function(data) {
                             return {
                               results: $.map(data, function(obj) {
                                 return {
                                   id: obj.id,
                                   text: obj.text,
                                   item_code: obj.item_code,
                                   item_name: obj.item_name,
                                   qty: obj.qty,
                                   manufacturer_price: obj.manufacturer_price,
                                   image_url: obj.image_url 
                                       ? '<?=base_url("assets/uploads/inventory/")?>' + obj.image_url 
                                       : '<?=base_url("assets/images/no-image.png")?>'
                                 };
                               })
                             };
                           },
                           cache: true
                         },
                         templateResult: function(item) {
                           if (!item.id) return item.text;
                           var markup = 
                             '<div style="display:flex; align-items:center;">' +
                               '<div style="flex:0 0 40px; margin-right:8px;">' +
                                 '<img src="' + item.image_url + '" style="width:40px; height:40px; object-fit:cover; border-radius:4px;" />' +
                               '</div>' +
                               '<div style="flex:1;">' +
                                 '<div><strong>Code:</strong> ' + item.item_code + '</div>' +
                                 '<div><strong>Name:</strong> ' + item.item_name + '</div>' +
                                 '<div><small>QOH: ' + item.qty + '</small></div>' +
                               '</div>' +
                             '</div>';
                           return markup;
                         },
                         templateSelection: function(item) {
                           if (!item.id) return item.text;

                           // If item_code and item_name missing on item, try fallback from DOM data
                           let code = item.item_code || $(item.element).data('item_code') || 'N/A';
                           let name = item.item_name || $(item.element).data('item_name') || 'N/A';
                           let qty = item.qty || $(item.element).data('qty') || 0;

                           return `
                             <span style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                               <span>${code} - ${name}</span>
                               <small style="margin-left: 10px; color: #888;">QOH: ${qty}</small>
                             </span>
                           `;
                         },
                         escapeMarkup: function(markup) { return markup; }
                       });

                       // Load preselected items from backend in one call
                       $.ajax({
                         type: 'POST',
                         url: "<?=base_url('purchasing/check_item_if_in_inv/simple')?>",
                         data: { id: preselectedIds.join(','), is_new: 1 }, // send all ids as CSV
                         dataType: 'json'
                       }).then(function(data) {
                         data.forEach(function(item) {
                           var option = new Option(item.text, item.id, true, true);
                           
                           // Attach extra data to option element
                           option.dataset.item_code = item.item_code;
                           option.dataset.item_name = item.item_name;
                           option.dataset.qty = item.qty;

                           // Also store the extra data on the option's jQuery data, so Select2 can access it in templateSelection
                           $(option).data({
                             item_code: item.item_code,
                             item_name: item.item_name,
                             qty: item.qty
                           });

                           $select.append(option);
                         });
                         $select.trigger('change'); // notify select2 about new options
                       });

                     }



                 });
             }, 300);
         });

 
          <?php if(isset($_SESSION["error"])){?>
            Swal.fire({
            title: "Error!",
            html: "<?=@$_SESSION["error"]?>",
            icon: "error",
            confirmButtonColor: "#556ee6", // OK button color
            showCancelButton: false // No Cancel button
            });
          <?php }?>
          <?php if(isset($_SESSION["success"])){?>
            Swal.fire({
            title: "Success!",
            html: "<?=@$_SESSION["success"]?>",
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

          function prompt_delete(title,desc,url_link,element_id) {
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
                    
                    $.get(url_link, function(response) {

                      if(response == 1){
                           $('#'+element_id).remove();
                           Swal.fire({
                           title: "Success!",
                           text: "Successfuly deleted.",
                           icon: "success",
                           confirmButtonColor: "#556ee6", // OK button color
                           showCancelButton: false // No Cancel button
                           });
                       }else{ 
                          $('#'+element_id).remove();
                          Swal.fire({
                          title: "Error!",
                          text: "Image not found.",
                          icon: "error",
                          confirmButtonColor: "#556ee6", // OK button color
                          showCancelButton: false // No Cancel button
                          }); 
                       }
                    });

                }
            });
          }



          //========================================================= AJX for Purchase Orders
          if ($(".select2-ajax-po").length) {

            $(".select2-ajax-po").select2({
              placeholder: "Select Item",
              ajax: {
                url: "<?=base_url('purchasing/check_item_if_in_inv')?>",
                type: "post",
                dataType: 'json',
                delay: 250,
                dropdownAutoWidth: true,
                data: function (params) {
                  return {
                    searchTerm: params.term, // support params.term or params (your original)
                    excluded_ids: $('#selected_ids').val()
                  };
                },
                // NOTE: Select2 v4 expects 'processResults' instead of 'results' to parse AJAX response
                processResults: function (data, page) {
                  return {
                    results: $.map(data, function (obj) {
                      return {
                        id: obj.id,
                        text: obj.text,
                        item_code: obj.item_code,
                        item_name: obj.item_name,
                        qty: obj.qty,
                        manufacturer_price: obj.manufacturer_price,
                        image_url: obj.image_url 
                            ? '<?=base_url("assets/uploads/inventory/")?>' + obj.image_url 
                            : '<?=base_url("assets/images/no-image.png")?>'
                      };
                    })
                  };
                },
                cache: true
              },  
              // Format dropdown items as table-like with image
              templateResult: function(item) {
                if (!item.id) {
                  return item.text;  // placeholder or loading text
                }
                var markup =
                  '<div style="display:flex; align-items:center;">' +
                    '<div style="flex:0 0 40px; margin-right:8px;">' +
                      '<img src="' + item.image_url + '" style="width:40px; height:40px; object-fit:cover; border-radius:4px;" />' +
                    '</div>' +
                    '<div style="flex:1;">' +
                      '<div><strong>Code:</strong> ' + item.item_code + '</div>' +
                      '<div><strong>Name:</strong> ' + item.item_name + '</div>' +
                    '</div>' +
                    '<div style="flex:0 0 80px; text-align:right; font-weight:bold;">' +
                      'QOH: ' + item.qty +
                    '</div>' +
                  '</div>';
                return markup;
              },

              // Format selection box text
              templateSelection: function(item) {
                if (!item.id) {
                  return item.text;
                }
                return item.item_code + ' - ' + item.item_name;
              },

              escapeMarkup: function(markup) { return markup; } // allow html in templateResult
            });


            var c = 0;
            var all = 0;

            // Updated event listener for Select2 v4
            $(".select2-ajax-po").on("select2:select", function(e) {
              var e_obj = e.params.data;

              c += 1;

              if (e_obj.id == 0) { // ==== this is for new ITEM
                $('#openNewItemModal').click();
              } else { // === this is for existing item

                console.log('selected', e_obj);

                if ($('#added' + e_obj.id).length == 0) {

                  $('#selected_ids').val($('#selected_ids').val() + '(' + e_obj.id + ')-');

                  var id = e_obj.id;
                  var part_no = e_obj.item_code;
                  var desc = e_obj.item_name;
                  var qty = 1;
                  var unit_cost = e_obj.manufacturer_price;
                  var rate_text = $('#rate_type').val();
                  var ttl = qty * unit_cost;
                  var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                  var newRowHtml =
                    '<tr id="irow' + id + '" class="all_po_itm">' +
                    '<td><input type="hidden" name="items[' + id + ']" value="' + id + '"><a href="<?=base_url('inventory/view_inventory')?>/' + e_obj.id + '" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl">' + part_no + '</a><input type="hidden" name="item_code' + id + '" value="' + part_no + '"><input type="hidden" name="lcr' + id + '" value="0"><input type="hidden" name="inv_id' + id + '" value="0"></td>' +
                    '<td>' + desc + '<input type="hidden" name="item_name' + id + '" value="' + desc + '"><input type="hidden" name="quotation_id' + id + '" value="0"></td>' +
                    '<td><input type="number" class="require_val" id="i_qty' + id + '" name="i_qty' + id + '" onkeyup="comp(' + id + ')" value="' + qty + '" style="border: 0; text-align: right;" onclick="comp(' + id + ')"></td>' +
                    '<td align="right" nowrap><font class="rater">' + rate_text + '</font> <input class="require_val" type="number" name="i_unit_cost' + id + '" id="i_unit_cost' + id + '" onkeyup="comp(' + id + ')" onclick="comp(' + id + ')" value="' + unit_cost + '" style="border: 0; text-align: right;"></td>' +
                    '<td align="right"><input type="hidden" class="all_ttl" id="i_ttl' + id + '" value="' + ttl + '"><span id="ttl' + id + '">' + ttl_nf + '</span></td>' +
                    '<td><a href="javascript:idel(' + id + ')"><i class="fa fa-trash" style="color: red;"></i></a></td>' +
                    '</tr>';

                  $('#last_row').before(newRowHtml);

                  comp_ttl();

                }
              }

              $('.add_item .select2-container .select2-choice').html('(+) add more item');
              $('.selecta' + c).select2();
              all += 1;

              $('#row_counter').val(c);
            });

            $(".select2-ajax-po").val('').trigger('change');

          }

          //========================================================= END



          //========================================================= AJX for Sales Order
          if ($(".select2-ajax-so").length) {

            $(".select2-ajax-so").select2({
              placeholder: "Select Item",
              ajax: {
                url: "<?=base_url('purchasing/check_item_if_in_inv')?>",
                type: "post",
                dataType: 'json',
                delay: 250,
                dropdownAutoWidth: true,
                data: function (params) {
                  return {
                    searchTerm: params.term, // support params.term or params (your original)
                    excluded_ids: $('#selected_ids').val()
                  };
                },
                // NOTE: Select2 v4 expects 'processResults' instead of 'results' to parse AJAX response
                processResults: function (data, page) {
                  return {
                    results: $.map(data, function (obj) {
                      return {
                        id: obj.id,
                        text: obj.text,
                        item_code: obj.item_code,
                        item_name: obj.item_name,
                        qty: obj.qty,
                        manufacturer_price: obj.manufacturer_price,
                        image_url: obj.image_url 
                            ? '<?=base_url("assets/uploads/inventory/")?>' + obj.image_url 
                            : '<?=base_url("assets/images/no-image.png")?>'
                      };
                    })
                  };
                },
                cache: true
              },  
              // Format dropdown items as table-like with image
              templateResult: function(item) {
                if (!item.id) {
                  return item.text;  // placeholder or loading text
                }
                var markup =
                  '<div style="display:flex; align-items:center;">' +
                    '<div style="flex:0 0 40px; margin-right:8px;">' +
                      '<img src="' + item.image_url + '" style="width:40px; height:40px; object-fit:cover; border-radius:4px;" />' +
                    '</div>' +
                    '<div style="flex:1;">' +
                      '<div><strong>Code:</strong> ' + item.item_code + '</div>' +
                      '<div><strong>Name:</strong> ' + item.item_name + '</div>' +
                    '</div>' +
                    '<div style="flex:0 0 80px; text-align:right; font-weight:bold;">' +
                      'QOH: ' + item.qty +
                    '</div>' +
                  '</div>';
                return markup;
              },

              // Format selection box text
              templateSelection: function(item) {
                if (!item.id) {
                  return item.text;
                }
                return item.item_code + ' - ' + item.item_name;
              },

              escapeMarkup: function(markup) { return markup; } // allow html in templateResult
            });


            var c = 0;
            var all = 0;

            // Updated event listener for Select2 v4
            $(".select2-ajax-so").on("select2:select", function(e) {
              var e_obj = e.params.data;

              c += 1;

              if (e_obj.id == 0) { // ==== this is for new ITEM
                $('#openNewItemModal').click();
              } else { // === this is for existing item

                console.log('selected', e_obj);

                if ($('#added' + e_obj.id).length == 0) {

                  $('#selected_ids').val($('#selected_ids').val() + '(' + e_obj.id + ')-');

                  var id = e_obj.id;
                  var part_no = e_obj.item_code;
                  var desc = e_obj.item_name;
                  var qty = 1;
                  var unit_cost = e_obj.manufacturer_price;
                  var rate_text = $('#rate_type').val();
                  var ttl = qty * unit_cost;
                  var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                  var newRowHtml =
                    '<tr id="irow' + id + '" class="all_po_itm">' +
                    '<td><input type="hidden" name="items[' + id + ']" value="' + id + '"><a href="<?=base_url('inventory/view_inventory')?>/' + e_obj.id + '" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl">' + part_no + '</a><input type="hidden" name="item_code' + id + '" value="' + part_no + '"><input type="hidden" name="lcr' + id + '" value="0"><input type="hidden" name="inv_id' + id + '" value="0"></td>' +
                    '<td>' + desc + '<input type="hidden" name="item_name' + id + '" value="' + desc + '"><input type="hidden" name="quotation_id' + id + '" value="0"></td>' +
                    '<td><input type="number" class="require_val" id="i_qty' + id + '" name="i_qty' + id + '" onkeyup="comp(' + id + ')" value="' + qty + '" style="border: 0; text-align: right;" onclick="comp(' + id + ')"></td>' +
                    '<td align="right" nowrap><font class="rater">' + rate_text + '</font> <input class="require_val" type="number" name="i_unit_cost' + id + '" id="i_unit_cost' + id + '" onkeyup="comp(' + id + ')" onclick="comp(' + id + ')" value="' + unit_cost + '" style="border: 0; text-align: right;"></td>' +
                    '<td align="right"><input type="hidden" class="all_ttl" id="i_ttl' + id + '" value="' + ttl + '"><span id="ttl' + id + '">' + ttl_nf + '</span></td>' +
                    '<td><a href="javascript:idel(' + id + ')"><i class="fa fa-trash" style="color: red;"></i></a></td>' +
                    '</tr>';

                  $('#last_row').before(newRowHtml);

                  comp_ttl();

                }
              }

              $('.add_item .select2-container .select2-choice').html('(+) add more item');
              $('.selecta' + c).select2();
              all += 1;

              $('#row_counter').val(c);
            });

            $(".select2-ajax-po").val('').trigger('change');

          }

          //=========================================================== END












          let inventoryTable;
          
          if ($('#datatable_inventory').length) {
 
            $(document).ready(function () {
              inventoryTable = $('#datatable_inventory').DataTable({
                processing: true,
                serverSide: true,
                order: [[1, 'desc']],
                ajax: {
                  url: "<?= base_url('inventory/get_inventory_ajax') ?>",
                  type: "POST"
                },
                columns: [
                  { data: 'picture', orderable: false },
                  { data: 'item_code' },
                  { data: 'item_name' },
                  { data: 'brand' },
                  { data: 'category' },
                  { data: 'type' },
                  { data: 'qty' },
                  { data: 'bin_location' },
                  { data: 'primary_model' },
                  { data: 'options', orderable: false }
                ],
                createdRow: function (row, data, dataIndex) {
                  // Use `data.id` from your PHP data array
                  $(row).attr('id', 'tr' + data.id);
                  $('td:last', row).css('white-space', 'nowrap');
                }
              });
            });
          }

          function refresh_inv_table() {
              if (inventoryTable) {
                 inventoryTable.ajax.reload(null, false); // false = retain current page
              }
          }


        </script>

    </body>
</html>
<?php 
if(@$_SESSION["success"]){unset($_SESSION["success"]);}
if(@$_SESSION["error"]){unset($_SESSION["error"]);}
?>