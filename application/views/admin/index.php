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
            .badge {
              display: inline-block;
              padding: 0.35em 0.65em;
              font-size: 0.55rem;
              font-weight: 100;
              line-height: 1;
              color: #fff;
              text-align: center;
              white-space: nowrap;
              vertical-align: baseline;
              border-radius: 0.375rem;
            }

            .badge-success {
              background-color: #02a499;
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

                                    $title_link = explode('-',$rs->title);
                                ?>
                                <li class="nav-item dropdown mega-dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-menu<?=$rs->id?>" role="button">
                                        <i class="fa <?php echo $rs->font_icon;?> me-2"></i><?=@$title_link[0];?>
                                        <?php if(@$title_link[1]){?>
                                        <span class="badge badge-success"><?=$title_link[1]?></span>
                                        <?php }?>
                                    </a> 
                                    <div class="dropdown-menu" aria-labelledby="topnav-menu<?=$rs->id?>"> 
                                            <?php 
                                            if($sub_menu){
                                            foreach ($sub_menu as $rs_sub) {
                                              if($rs_sub->main_menu_id==$rs->id && isset($arr_index_user_roles_sub_menu[$rs_sub->id]) && $arr_index_user_roles_sub_menu[$rs_sub->id]){
 
                                            ?>
                                                <?php if($rs_sub->border_top==1){?>
                                                    <a href="<?php echo base_url().$rs_sub->url_link;?>" class="dropdown-item" style="border-top: 1px solid #ccc; cursor: context-menu;"><?php echo $rs_sub->title;?></a>  
                                                <?php }else{?>
                                                    <a href="<?php echo base_url().$rs_sub->url_link;?>" class="dropdown-item"><?php echo $rs_sub->title;?></a>  
                                                <?php }?>

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
 
        <!--tinymce js-->
        <script src="<?=base_url('assets/template/assets')?>/libs/tinymce/tinymce.min.js"></script>
        <script src="<?=base_url('assets/template/assets')?>/js/pages/form-editor.init.js?2"></script>

        <!-- for Select2 js -->
        <script src="<?=base_url('assets/template/assets')?>/libs/select2/js/select2.min.js"></script>
 
        <script>
            const bootstrapCSS = "<?=base_url('assets/template/assets')?>/css/bootstrap.min.css";
            const appCSS = "<?=base_url('assets/template/assets')?>/css/app.min.css";
        </script>

        <script src="<?=base_url('assets/template/assets')?>/js/app.js?2"></script>

        <script type="text/javascript">

         
          // Apply to all input and textarea fields
          $(document).on('input', 'input[type="text"], input[type="email"], textarea', function() {
            const start = this.selectionStart;
            const end = this.selectionEnd;
            const original = this.value;
            const uppercased = original.toUpperCase();

            if (original !== uppercased) {
              this.value = uppercased;
              this.setSelectionRange(start, end); // restore cursor position
            }
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
          if($('.elm1').length){
              tinymce.init({
                    selector: '.elm1' 
                  });
          }

          let dt;

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
                             allowClear: true,
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
                         dt = $('#datatable_modal').DataTable(); 
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
                                   brand: obj.brand,
                                   qty: obj.qty,
                                   supplier_price: obj.supplier_price,
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
                                 '<img src="' + item.image_url + '" style="width:60px; height:60px; object-fit:cover; border-radius:4px;" />' +
                               '</div>' +
                               '<div style="flex:1;">' +
                                 '<div><strong>Code:</strong> ' + item.item_code + '</div>' +
                                 '<div><strong>Name:</strong> ' + item.item_name + '</div>' +
                                 '<div><strong>Brand:</strong> ' + item.brand + '</div>' +
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
                           let brand = item.brand || $(item.element).data('brand') || 'N/A';
                           let qty = item.qty || $(item.element).data('qty') || 0;

                           return `
                             <span style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                               <span>${code} - ${name} (${brand})</span>
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
                           option.dataset.brand = item.brand;

                           // Also store the extra data on the option's jQuery data, so Select2 can access it in templateSelection
                           $(option).data({
                             item_code: item.item_code,
                             item_name: item.item_name,
                             qty: item.qty,
                             brand: item.brand
                           });

                           $select.append(option);
                         });
                         $select.trigger('change'); // notify select2 about new options
                       });

                     }


                   if($('#quotation_datatable_modal').length){ 
                       $('#quotation_datatable_modal').DataTable({
                           processing: true,
                           serverSide: true,
                           ajax: {
                               url: "<?= base_url('outgoing/quotations_ajax/modal') ?>",
                               type: "GET"
                           },
                           columns: [
                               { data: "date_created" },
                               { data: "valid_until" },
                               { data: "quotation_no" },
                               { data: "plate_no" },
                               { data: "vin" },
                               { data: "client_name" },
                               { data: "phone" },
                               { data: "remarks" },
                               { data: "created_by" },
                               { data: "options", orderable: false, searchable: false }
                           ], 
                           createdRow: function (row, data, dataIndex) {
                               // Use `data.id` from your PHP data array
                               $(row).attr('id', 'tr' + data.id);
                               $('td:last', row).css('white-space', 'nowrap');
                           }
                       });

                 }
  
                 });
             }, 300);
         });

        function updateDtatable() { 
            var value = $('#transaction_type').val().toLowerCase(); 
            // Apply filter on 3rd column (index 2)
            dt.column(2).search(value).draw();
        }

 
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
                        supplier_price: obj.supplier_price,
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
                  var unit_cost = e_obj.supplier_price;
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



            var c = $('#row_counter').val();
            var all = 0; 
             
            $(".select2-ajax-so").select2({
              placeholder: "Select Item",
              ajax: {
                url: "<?= base_url('outgoing/load_items') ?>",
                type: "post",
                dataType: 'json',
                delay: 250,
                dropdownAutoWidth: true,
                data: function (params) {
                  return {
                    searchTerm: params.term,
                    excluded_ids: $('#selected_ids').val()
                  };
                },
                processResults: function (data) {
                  return {
                    results: $.map(data, function (obj) {
                      return {
                        id: obj.id,
                        text: obj.text,
                        item_code: obj.item_code,
                        item_name: obj.item_name,
                        brand: obj.brand,
                        qty: obj.qty, 
                        unit_cost_price: obj.unit_cost_price,
                        retail_price: obj.retail_price,
                        image_url: obj.image_url 
                            ? '<?=base_url("assets/uploads/inventory/")?>' + obj.image_url 
                            : '<?=base_url("assets/images/no-image.png")?>'
                      };
  

                    })
                  };
                },
                cache: true
              },

              // ✅ This formats the dropdown result
              templateResult: function (item) {
                if (!item.id) return item.text;

                var markup =
                  '<div style="display:flex; align-items:center;">' +
                    '<div style="flex:0 0 40px; margin-right:8px;">' +
                      '<img src="' + item.image_url + '" style="width:75px; height:75px; object-fit:cover; border-radius:4px;" />' +
                    '</div>' +
                    '<div style="flex:1;">' +
                      '<div><strong>Code:</strong> ' + item.item_code + '</div>' +
                      '<div><strong>Name:</strong> ' + item.item_name + '</div>' +
                      '<div><small>Brand: ' + item.brand + '</small></div>' +
                      '<div><small>Unit Cost Price: ' + formatMoney(item.unit_cost_price) + '</small></div>' +
                      '<div><small>Retail Price: ' + formatMoney(item.retail_price) + '</small></div>' +
                    '</div>' +
                    '<div style="flex:0 0 80px; text-align:right; font-weight:bold;">' +
                      'QOH: ' + item.qty +
                    '</div>' +
                  '</div>';
                return markup

              },

              // ✅ This controls how selected item appears
              templateSelection: function (item) {
                if (!item.id) return item.text;
                return `${item.item_code} - ${item.item_name}`;
              },

              // ✅ Important to allow HTML rendering
              escapeMarkup: function (markup) {
                return markup;
              }
            });

            // Select handler
            $(".select2-ajax-so").on("select2:select", function (e) {
              var e_obj = e.params.data;
              c += 1;

              // if (e_obj.qty <= 0) {
              //   alert("Error: The item quantity is zero, and cannot be issued.");
              //   $('.add_item .select2-container .select2-selection__rendered').html('(+) add more item');
              //   return;
              // }
 
              if ($('#added' + e_obj.id).length == 0) {
                $('#selected_ids').val($('#selected_ids').val() + '(' + e_obj.id + ')-');
                  
                var customerType = $('#customer_number').html();
 
                var price = e_obj.retail_price; 

                console.log('row obj should ad!!!!',price);

                var newRow = `
                  <tr id="tr${e_obj.id}" class="data-row">
                    <td>
                      <a href="<?=base_url('inventory/view_inventory')?>/${e_obj.id}" 
                         class="load_modal_details" 
                         data-bs-toggle="modal" 
                         data-bs-target=".bs-example-modal-lg" 
                         data-modal-size="xl">
                         ${e_obj.item_code}
                      </a>
                      <input type="hidden" class="item_exist" name="items[${e_obj.id}]" id="added${e_obj.id}" value="${e_obj.id}"/>
                      <input type="hidden" name="inventory_id${e_obj.id}" value="${e_obj.id}"/>
                    </td>
                    <td>${e_obj.item_name}</td>
                    <td>${e_obj.brand}</td>
                    <td style="text-align:right;" id="t_qty${e_obj.id}">${e_obj.qty}
                        <input type="hidden" name="qoh${e_obj.id}" id="qoh${e_obj.id}" value="${e_obj.qty}"/>
                    </td>
                    <td style="text-align:right;">${formatMoney(e_obj.unit_cost_price)}
                        <input type="hidden" name="unit_cost_price${e_obj.id}" id="unit_cost_price${e_obj.id}" value="${e_obj.unit_cost_price}"/>
                    </td>

                    <td style="text-align:center;  width:60px;">
                      <input type="number" 
                             id="qty${e_obj.id}" 
                             name="qty${e_obj.id}" 
                             required 
                             value="1" 
                             min="1" 
                             max="${e_obj.qty}" 
                             style="border:0; background:transparent; text-align:right; width:60px;">
                    </td>  

                    <td style="text-align:right;">
                       
                      <span class="retail_price_text">
                        ${formatMoney(e_obj.retail_price)}
                      </span> 

                      <input type="hidden" name="retail_price${e_obj.id}" value="${e_obj.retail_price}"> 
                    </td>

                    <td style="text-align:right;">
                      <span id="row_total">${price}</span>
                    </td> 

                    <td style="text-align:right; width:80px;">
                      <input type="number" 
                             name="discount_percentage${e_obj.id}" 
                             style="border:0; background:transparent; text-align:right; width:60px;" maxlength="5">
                    </td>

                    <td style="text-align:right; width:90px;">
                      <input type="number" 
                             name="discount_amount${e_obj.id}" 
                             maxlength="7" 
                             style="border:0; background:transparent; text-align:right; width:80px;">
                    </td>

                    <td style="text-align:right;">
                      <span id="row_grand_total">${price}</span>
                    </td> 

                    <td style="text-align:center;">
                      <a href="javascript:remove_item(${e_obj.id})">
                        <i title="remove" class="fa fa-trash" style="color:red"></i>
                      </a>
                    </td>
                  </tr>`;



                $('#item_selector').before(newRow);

                const newRowEl = $(`#tr${e_obj.id}`);

                newRowEl.find('[name^="qty"], [name^="discount_amount"], [name^="discount_percentage"]').on('input', function () {
                  calculateRowTotal(newRowEl);
                  computeGrandTotal();
                });

                // Initial calculation
                calculateRowTotal(newRowEl);
                computeGrandTotal();
              }

              $('.add_item .select2-container .select2-selection__rendered').html('(+) add more item');
              all += 1;
              $('#row_counter').val(c);
              $(".select2-ajax-so").val('').trigger('change');
            });

            let pctInputTimeout;
            $('#discount_percentage_total').on('input', function () {
                clearTimeout(pctInputTimeout);
                const $this = $(this);

                pctInputTimeout = setTimeout(() => {
                    const globalDiscountPct = parseFloat($this.val()) || 0;

                    $('tr.data-row').each(function () {
                        const $row = $(this);
                        const $discountPctInput = $row.find('[name^="discount_percentage"]');
                        const $discountAmtInput = $row.find('[name^="discount_amount"]');

                        $discountPctInput.val(globalDiscountPct.toFixed(2));
                        $discountAmtInput.blur();
                        $discountPctInput.trigger('input');
                    });

                    computeGrandTotal();
                }, 500); // 0.5 second delay after last input
            });

 

            function calculateRowTotal(row) {
              if (isUpdating) return;
              isUpdating = true;

              const qty = parseFloat(row.find('[name^="qty"]').val()) || 0;

              //const price = parseFloat(row.find('.default_price').text()) || 0;

              var price = parseFloat(row.find('[name^="retail_price"]').val()) || 0;
              
              console.log('Cust:',$('#customer_number').html());
              console.log('price:',price);

              const $discountPctInput = row.find('[name^="discount_percentage"]');
              const $discountAmtInput = row.find('[name^="discount_amount"]');

              let discountPct = parseFloat($discountPctInput.val()) || 0;
              let discountAmt = parseFloat($discountAmtInput.val()) || 0;

              const totalBeforeDiscount = qty * price;
              row.find('td:nth-child(8)').html(`<span>${formatMoney(totalBeforeDiscount)}</span>`);

              // Clear discount amount if discount percentage is zero
              if (discountPct === 0 && !$discountAmtInput.is(':focus')) {
                discountAmt = 0;
                $discountAmtInput.val('0.00');
              }

              // When quantity changes, recalculate amount if % is available and amount not manually being edited
              if (!$discountAmtInput.is(':focus') && discountPct > 0) {
                discountAmt = totalBeforeDiscount * (discountPct / 100);
                $discountAmtInput.val(discountAmt.toFixed(2));
              }

              // Vice versa: when amount is edited, update percent
              if ($discountAmtInput.is(':focus') && !$discountPctInput.is(':focus')) {
                discountPct = (discountAmt / totalBeforeDiscount) * 100;
                $discountPctInput.val(discountPct.toFixed(2));
              }

              // When % is edited, update amount
              if ($discountPctInput.is(':focus') && !$discountAmtInput.is(':focus')) {
                discountAmt = totalBeforeDiscount * (discountPct / 100);
                $discountAmtInput.val(discountAmt.toFixed(2));
              }

              const rowTotal = totalBeforeDiscount - discountAmt;
              row.find('#row_grand_total').text(formatMoney(rowTotal));

              isUpdating = false;
              return rowTotal;
            }

            function computeGrandTotal() {
                let grandTotal = 0;
                let totalDiscountPercentage = 0;
                let totalDiscountAmount = 0;
                let rowCount = 0;

                $('tr[id^="tr"]').each(function () {
                    const $row = $(this);
                    grandTotal += calculateRowTotal($row);

                    const discountPct = parseFloat($row.find('[name^="discount_percentage"]').val()) || 0;
                    const discountAmt = parseFloat($row.find('[name^="discount_amount"]').val()) || 0;

                    totalDiscountPercentage += discountPct;
                    totalDiscountAmount += discountAmt;
                    rowCount++;
                });

                if($('#issuance_grand_total').length){
                    $('#issuance_grand_total').val(grandTotal.toFixed(2));
                }else{
                    $('#quotation_grand_total').val(grandTotal.toFixed(2));
                }
                
                $('#grand_total').html(formatMoney(grandTotal));

                if (rowCount > 0) {
                    const avgDiscountPct = totalDiscountPercentage / rowCount;

                    // Don't overwrite if the user is actively typing
                    if (!$('#discount_percentage_total').is(':focus')) {
                        $('#discount_percentage_total').val(avgDiscountPct.toFixed(2));
                    }

                    if (!$('#discount_amount_total').is(':focus')) {
                        $('#discount_amount_total').val(totalDiscountAmount.toFixed(2));
                    }
                }
            }

            $(document).ready(function () {
              // Attach event listeners to preloaded rows
              $('#so_table .data-row').each(function () {
                const $row = $(this);

                // Attach input event listener
                $row.find('[name^="qty"], [name^="discount_amount"], [name^="discount_percentage"]').on('input', function () {
                  calculateRowTotal($row);
                  computeGrandTotal();
                });

                // Initial calculation (optional, in case values are not 0)
                calculateRowTotal($row);
              });

              // Also run grand total on load
              computeGrandTotal();
            });
 

          }
 


          if ($('.select2_so_customer').length) {
            $('.select2_so_customer').select2({
              placeholder: 'Search customer...',
              allowClear: true,

              ajax: {
                url: '<?= base_url('outgoing/load_customers') ?>',
                type: 'POST',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    searchTerm: params.term
                  };
                },
                processResults: function (data) {
                  return {
                    results: $.map(data, function (obj) {
                      return {
                        id: obj.id,
                        text: obj.text,
                        phone: obj.phone,
                        qid: obj.qid,
                        bis: obj.business_registration_no,
                        customer_type: obj.customer_type,
                        image: obj.image
                      };
                    })
                  };
                },
                cache: true
              },

              templateResult: function (data) {
                if (!data.id) return data.text;

                const idLabel = data.customer_type === 'business'
                  ? `<strong>Business Reg. #:</strong> ${data.bis || '-'}`
                  : `<strong>QID:</strong> ${data.qid || '-'}`;

                const markup = `
                  <div style="display: flex; align-items: flex-start; gap: 10px; padding: 6px;">
                    <img src="${data.image}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;" />
                    <div style="flex: 1;">
                      <div><strong>${data.text}</strong> (${data.customer_type})</div>
                      <div style="font-size: 12px; color: #555;">
                        <div>${idLabel}</div>
                        <div><strong>Phone:</strong> ${data.phone || '-'}</div>
                      </div>
                    </div>
                  </div>
                `;
                return $(markup);
              },

              templateSelection: function (data) { 
                return data.text || '';
              }
            });

            $('.select2_so_customer').on('select2:select', function (e) {
              const data = e.params.data;

              $('#phone').val(data.phone);
              $('#customer_number').html(data.customer_type === 'business' ? 'Business Reg. #' : 'QID');
              $('#customer_qid_bus').val(data.customer_type === 'business' ? data.bis : data.qid);
              $('#customer_type').val(data.customer_type === 'business' ? 1 : 0);
 
            });

            $('.select2_so_customer').on('select2:clear', function () {
              $('#phone').val('');
              $('#customer_number').html('QID'); // Default label
              $('#customer_qid_bus').val('');
 
            });
          }


          if($('.select2-ajax-vehicle').length){

                $('.select2-ajax-vehicle').select2({
                  placeholder: "Search vehicle...",
                  allowClear: true, 
                  ajax: {
                    url: '<?= base_url('outgoing/load_vehicles') ?>',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                      return {
                        searchTerm: params.term
                      };
                    },
                    processResults: function (data) {
                      return {
                        results: $.map(data, function (obj) {
                          return {
                            id: obj.id,
                            text: obj.plate_no,
                            phone: obj.phone,
                            plate_no: obj.plate_no,
                            model: obj.model,
                            manufacturer: obj.manufacturer,
                            model_year: obj.model_year,
                            customer: obj.customer,
                            customer_type: obj.customer_type,
                            customer_type_label: obj.customer_type_label,
                            customer_qid_bus: obj.customer_qid_bus,
                            vin: obj.vin,
                            image: obj.image
                          };
                        })
                      };
                    },
                    cache: true
                  },

                  templateResult: function (data) {
                    if (!data.id) return data.text;

                    let markup = `
                      <div style="display:flex; align-items:center; gap:10px;">
                        <img src="${data.image}" style="width:70px; height:70px; object-fit:cover; border-radius:4px;" />
                        <div>
                          <div><strong>${data.manufacturer} ${data.model} - ${data.model_year}</strong></div>
                          <div style="font-size:12px; color:#555;"><i>Plate No.: ${data.plate_no}</i></div>
                          <div style="font-size:12px; color:#555;"><i>VIN: ${data.vin}</i></div>
                          <div style="font-size:12px; color:#555;"><i>Owner: ${data.customer}</div>
                          <div style="font-size:12px; color:#555;"><i>${data.customer_type_label}: ${data.customer_qid_bus}</i></div>
                        </div>
                      </div>
                    `;
                    return $(markup);
                  },

                  templateSelection: function (data) {


                        if($('#default_vehicle_id').val() == ''){
        
                            $('#vin').val(data.vin);
                            $('#plate_no').val(data.plate_no);

                            $('#customer_number').html(data.customer_type_label);
                            $('#customer_qid_bus').val(data.customer_qid_bus);

                            $('#phone').val(data.phone);

                            $('#customer').val(data.customer); 

                            $('#customer_type').val(data.customer_type_label=='QID' ? 0 : 1);

                            if(data.customer){    
                                $('#customer_selection').hide();
                                $('#customer_fixed').show();
                            }else{
                                $('#customer_selection').show();
                                $('#customer_fixed').hide();
                            }
         
                            return data.plate_no ? `${data.manufacturer} ${data.model} - ${data.model_year}` : '';
                        }else{
                            $('#default_vehicle_id').val('');
                            return $('#default_vehicle_val').val(); 

                        }
                  }
                });  
  
          }

     
          let isUpdating = false;

          function formatMoney(value) {
            return parseFloat(value || 0).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
          }

          

 

          //=========================================================== END OF Sales ORDER


          //=============Purchase Order
          if($('#datatable_po').length){
            $('#datatable_po').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url: "<?=base_url('purchasing/fetch_po_data')?>",
                  type: "POST"
                },
                columns: [
                  { data: "date_created" },
                  { data: "vehicle" },
                  { data: "customer" },
                  { data: "po_number" },
                  { data: "supplier" },
                  { data: "att_to" },
                  { data: "reference_no" },
                  { data: "user" },
                  { data: "options", orderable: false, searchable: false }
                ]
              });
          }

          if($('#datatable_po_confirmed').length){
            $('#datatable_po_confirmed').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url: "<?=base_url('purchasing/fetch_po_data/confirmed')?>",
                  type: "POST"
                },
                columns: [
                  { data: "date_created" },
                  { data: "vehicle" },
                  { data: "customer" },
                  { data: "po_number" },
                  { data: "supplier" },
                  { data: "att_to" },
                  { data: "reference_no" },
                  { data: "user" },
                  { data: "date_confirmed" },
                  { data: "confirmed_by" },
                  { data: "options", orderable: false, searchable: false }
                ]
              });
          }

          //===GRV table

          if($('#grv_datatable').length){
            $('#grv_datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                  "url": "<?= base_url('receiving/fetch_grv_data') ?>",
                  "type": "POST"
                },
                "columns": [
                  { "data": "date_created" },
                  { "data": "grv_number" },
                  { "data": "po_number" },
                  { "data": "dr_number" },
                  { "data": "invoice_number" },
                  { "data": "remarks" },
                  { "data": "user" },
                  { "data": "options", "orderable": false }
                ], 
                createdRow: function (row, data, dataIndex) {
                    // Use `data.id` from your PHP data array
                    $(row).attr('id', 'tr' + data.id);
                    $('td:last', row).css('white-space', 'nowrap');
                }
              });
          }

        if($('#grv_datatable_confirmed').length){
            $('#grv_datatable_confirmed').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                  "url": "<?= base_url('receiving/fetch_grv_data/confirmed') ?>",
                  "type": "POST"
                },
                "columns": [
                  { "data": "date_created" },
                  { "data": "grv_number" },
                  { "data": "po_number" },
                  { "data": "dr_number" },
                  { "data": "invoice_number" },
                  { "data": "remarks" },
                  { "data": "user" },
                  { "data": "date_confirmed" },
                  { "data": "confirmed_by" },
                  { "data": "options", "orderable": false }
                ] 
            });

          }



          //===Quotation Dtatable
          if($('#quotation_datatable').length){
              $('#quotation_datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: {
                      url: "<?= base_url('outgoing/quotations_ajax') ?>",
                      type: "GET"
                  },
                  columns: [
                      { data: "date_created" },
                      { data: "valid_until" },
                      { data: "quotation_no" },
                      { data: "plate_no" },
                      { data: "vin" },
                      { data: "client_name" },
                      { data: "phone" },
                      { data: "remarks" },
                      { data: "created_by" },
                      { data: "options", orderable: false, searchable: false }
                  ], 
                  createdRow: function (row, data, dataIndex) {
                      // Use `data.id` from your PHP data array
                      $(row).attr('id', 'tr' + data.id);
                      $('td:last', row).css('white-space', 'nowrap');
                  }
              });

        }


          //===Quotation Dtatable
          if($('#issuance_datatable').length){
              $('#issuance_datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: {
                      url: "<?= base_url('outgoing/issuance_ajax') ?>",
                      type: "GET"
                  },
                  columns: [
                      { data: "date_created" },
                      { data: "pay_type" },
                      { data: "sales_order_no" },
                      { data: "plate_no" },
                      { data: "vin" },
                      { data: "client_name" },
                      { data: "phone" },
                      { data: "remarks" },
                      { data: "created_by" },
                      { data: "options", orderable: false, searchable: false }
                  ], 
                  createdRow: function (row, data, dataIndex) {
                      // Use `data.id` from your PHP data array
                      $(row).attr('id', 'tr' + data.id);
                      $('td:last', row).css('white-space', 'nowrap');
                  }
              });

        }

        if($('#issuance_confirmed_datatable').length){
              $('#issuance_confirmed_datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: {
                      url: "<?= base_url('outgoing/issuance_ajax/confirmed') ?>",
                      type: "GET"
                  },
                  columns: [
                      { data: "date_created" },
                      { data: "pay_type" },
                      { data: "sales_order_no" },
                      { data: "plate_no" },
                      { data: "vin" },
                      { data: "client_name" },
                      { data: "phone" },
                      { data: "remarks" },
                      { data: "created_by" },
                      { data: "confirmed_by" },
                      { data: "confirmed_date" },
                      { data: "options", orderable: false, searchable: false }
                  ], 
                  createdRow: function (row, data, dataIndex) {
                      // Use `data.id` from your PHP data array
                      $(row).attr('id', 'tr' + data.id);
                      $('td:last', row).css('white-space', 'nowrap');
                  }
              });

        }
  
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
                  { data: 'supplier_price' }, 
                  { data: 'unit_cost_price' },
                  { data: 'retail_price' },
                  { data: 'options', orderable: false }
                ],
                columnDefs: [
                    {
                      targets: [8, 9, 10], // Column indexes for prices
                      className: 'dt-right'
                    }
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


          //================= RETURN INVENTORY
          if ($(".select2-ajax-ri").length) {

            var c = $('#row_counter').val();
            var all = 0; 
            var so_id = $('#so_id').val();
             
            $(".select2-ajax-ri").select2({
              placeholder: "Select Item",
              ajax: {
                url: "<?= base_url('outgoing/load_so_items') ?>",
                type: "post",
                dataType: 'json',
                delay: 250,
                dropdownAutoWidth: true,
                data: function (params) {
                  return {
                    searchTerm: params.term,
                    excluded_ids: $('#selected_ids').val(),
                    so_id: $('#so_id').val()
                  };
                },
                processResults: function (data) {
                  return {
                    results: $.map(data, function (obj) {
                      return {
                        id: obj.id,
                        issuance_item_id: obj.issuance_item_id,
                        text: obj.text,
                        item_code: obj.item_code,
                        item_name: obj.item_name,
                        brand: obj.brand,
                        qty: obj.qty, 
                        inv_stock: obj.inv_stock,
                        unit_cost_price: obj.unit_cost_price,
                        retail_price: obj.retail_price,
                        discount_percentage: obj.discount_percentage,
                        discount_amount: obj.discount_amount,
                        image_url: obj.image_url 
                            ? '<?=base_url("assets/uploads/inventory/")?>' + obj.image_url 
                            : '<?=base_url("assets/images/no-image.png")?>'
                      };
          

                    })
                  };
                },
                cache: true
              },

              // ✅ This formats the dropdown result
              templateResult: function (item) {
                if (!item.id) return item.text;

                var markup =
                  '<div style="display:flex; align-items:center;">' +
                    '<div style="flex:0 0 40px; margin-right:8px;">' +
                      '<img src="' + item.image_url + '" style="width:75px; height:75px; object-fit:cover; border-radius:4px;" />' +
                    '</div>' +
                    '<div style="flex:1;">' +
                      '<div><strong>Code:</strong> ' + item.item_code + '</div>' +
                      '<div><strong>Name:</strong> ' + item.item_name + '</div>' +
                      '<div><small>Brand: ' + item.brand + '</small></div>' +
                      '<div><small>Unit Cost Price: ' + formatMoney(item.unit_cost_price) + '</small></div>' +
                      '<div><small>Retail Price: ' + formatMoney(item.retail_price) + '</small></div>' +
                    '</div>' +
                    '<div style="flex:0 0 80px; text-align:right; font-weight:bold;">' +
                      'S.O. Qty: ' + item.qty +
                    '</div>' +
                  '</div>';
                return markup

              },

              // ✅ This controls how selected item appears
              templateSelection: function (item) {
                if (!item.id) return item.text;
                return `${item.item_code} - ${item.item_name}`;
              },

              // ✅ Important to allow HTML rendering
              escapeMarkup: function (markup) {
                return markup;
              }
            });

            // Select handler
            $(".select2-ajax-ri").on("select2:select", function (e) {
              var e_obj = e.params.data;
              c += 1;

              
              if ($('#added' + e_obj.id).length == 0) {
                $('#selected_ids').val($('#selected_ids').val() + '(' + e_obj.id + ')-');
                   
           

                var newRow = `
                  <tr id="tr${e_obj.id}" class="data-row">
                    <td>
                      <a href="<?=base_url('inventory/view_inventory')?>/${e_obj.id}" 
                         class="load_modal_details" 
                         data-bs-toggle="modal" 
                         data-bs-target=".bs-example-modal-lg" 
                         data-modal-size="xl">
                         ${e_obj.item_code}
                      </a>
                      <input type="hidden" name="items[${e_obj.id}]" id="added${e_obj.id}" value="${e_obj.id}"/>
                      <input type="hidden" name="issuance_item_id${e_obj.id}" value="${e_obj.issuance_item_id}"/>
                      <input type="hidden" name="inventory_id${e_obj.id}" value="${e_obj.id}"/>
                    </td>
                    <td>${e_obj.item_name}</td>
                    <td>${e_obj.brand}</td>
                    <td style="text-align:right;" 
                        id="t_qty${e_obj.id}" 
                        data-price="${e_obj.retail_price}" 
                        data-discount-percentage="${e_obj.discount_percentage}">
                        ${e_obj.qty}
                    </td>
                    <td style="text-align:right;">${formatMoney(e_obj.retail_price)} 
                        <input type="hidden" name="retail_price${e_obj.id}" value="${e_obj.retail_price}"/>
                    </td>

                    <td style="text-align:center;  width:60px;">
                      <input type="number" 
                             id="qty${e_obj.id}" 
                             name="qty${e_obj.id}" 
                             required 
                             value="${e_obj.qty}" 
                             min="1" 
                             max="${e_obj.qty}" 
                             style="border:0; background:transparent; text-align:right; width:60px;">
                      <input type="hidden" name="issued_qty${e_obj.id}" value="${e_obj.qty}"/>
                      <input type="hidden" name="old_stock_qty${e_obj.id}" value="${e_obj.inv_stock}"/>
                    </td> 
                    <td style="text-align:right;">
 
                    <font id="line_total${e_obj.id}">${formatMoney(e_obj.retail_price * e_obj.qty)}</font>
                    </td>

                    <td style="text-align:right;"> 
                        ${formatMoney(e_obj.discount_percentage)}
                        <input type="hidden" name="discount_percentage${e_obj.id}" value="${e_obj.discount_percentage}" >
                    </td>

                    <td style="text-align:right;">
                        <span id="discount_amount_total${e_obj.id}">
                        ${formatMoney(e_obj.discount_amount)}
                        </span>
                        <input type="hidden" 
                        id="discount_amount${e_obj.id}"
                        name="discount_amount${e_obj.id}" value="${e_obj.discount_amount}" >
                    </td>

                    <td style="text-align:right;">
                        <font id="line_grand_total${e_obj.id}">${formatMoney((e_obj.retail_price * e_obj.qty)-e_obj.discount_amount)}</font>
                    </td>

                    <td style="text-align:center;  width:260px;">
                      <input type="text" 
                             id="remarks${e_obj.id}" 
                             name="remarks${e_obj.id}"   
                             style="border:0; background:transparent; text-align:left; width:260px;">
                    </td>  


                    <td style="text-align:center;">
                      <a href="javascript:remove_item(${e_obj.id})">
                        <i title="remove" class="fa fa-trash" style="color:red"></i>
                      </a>
                    </td>
                  </tr>`;



                $('#item_selector').before(newRow);

                // Store price and discount in DOM for easy access later
                $(`#t_qty${e_obj.id}`).data('price', e_obj.retail_price);
                $(`#t_qty${e_obj.id}`).data('discount', e_obj.discount_amount);

                // Add listener to auto-update line and grand total on qty change
                $(`#qty${e_obj.id}`).on('input', function () {
                    recalculateLineAndGrandTotal(e_obj.id);
                });

                // Trigger initial calculation
                recalculateLineAndGrandTotal(e_obj.id);

                const newRowEl = $(`#tr${e_obj.id}`);
 
              }

              $('.add_item .select2-container .select2-selection__rendered').html('(+) add more item');
              all += 1;
              $('#row_counter').val(c);
              $(".select2-ajax-so").val('').trigger('change');
            });

        function recalculateLineAndGrandTotal(id) {
            const qty = parseFloat($(`#qty${id}`).val()) || 0;
            const price = parseFloat($(`#t_qty${id}`).data('price')) || 0;
            const discountPercentage = parseFloat($(`#t_qty${id}`).data('discount-percentage')) || 0;

            const total = qty * price;
            const discountAmount = (total * discountPercentage) / 100;
            const lineTotal = total - discountAmount;

            $(`#discount_amount_total${id}`).text(formatMoney(discountAmount));
            $(`#discount_amount${id}`).val(discountAmount);

            $(`#line_total${id}`).text(formatMoney(total)); // Before discount
            $(`#line_grand_total${id}`).text(formatMoney(lineTotal)); // After discount

            let grandTotal = 0;
            $('[id^="line_grand_total"]').each(function () {
                const amount = parseFloat($(this).text().replace(/,/g, '')) || 0;
                grandTotal += amount;
            });

            $('#grand_total').text(formatMoney(grandTotal));
            $('#grand_total_amt').val(grandTotal.toFixed(2));
        }


        function initializeExistingRows() {
            $(".data-row").each(function () {
                const row = $(this);
                const id = row.attr('id').replace('tr', '');
                const qtyInput = $(`#qty${id}`);
                const price = parseFloat(row.find(`#line_total${id}`).text().replace(/,/g, '')) / (parseFloat(qtyInput.val()) || 1);
                const discountPercentage = parseFloat($(`input[name="discount_percentage${id}"]`).val()) || 0;

                // Set data attributes
                $(`#t_qty${id}`).data('price', price);
                $(`#t_qty${id}`).data('discount-percentage', discountPercentage);

                // Bind qty change listener
                qtyInput.off('input').on('input', function () {
                    recalculateLineAndGrandTotal(id);
                });

                // Trigger initial calculation
                recalculateLineAndGrandTotal(id);
            });
        }

        if($('#item_retrun_id').length){
            initializeExistingRows(); // if edit, will re stablish the id's
        }

 
        }


        </script>

    </body>
</html>
<?php 
if(@$_SESSION["success"]){unset($_SESSION["success"]);}
if(@$_SESSION["error"]){unset($_SESSION["error"]);}
?>