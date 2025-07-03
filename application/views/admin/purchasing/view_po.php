<style type="text/css">
  .ridonly {
    background-color: #fff !important;
    border-style: dashed !important;
  }
  #frm_po input,
  #frm_po textarea {
      background-color: #fff !important;
      border-style: dashed !important;
    }
</style>

<form method="post" id="frm_po">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="page-title-box">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h6 class="page-title">Purchase Order #: <?=@$po->po_number?> <?php if($po->confirmed == 1){?><span class="badge rounded-pill bg-success">Confimed</span><?php }?></h6> 
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item active" aria-current="page">Filed By: <?= $user->name . ' - ' . date('M d, Y H:i', strtotime($po->date_created)) ?></li>
                </ol>
                <?php if($po->confirmed == 1){?>
                <ol class="breadcrumb m-0"> 
                    <li class="breadcrumb-item active" aria-current="page">Confirmed By: <?=$user_confirmed->name.' - '.date('M d, Y H:i',strtotime($po->date_confirmed))?></li>
                </ol>
                <?php }?>
              </div>
              <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                  <?php if($po->confirmed == 0){?>

                    <?php if (in_array('print', $access_features)){ ?>
                      <a class="btn btn-md btn-success" target="_blank" href="<?=base_url('vendor/print_po/'.$po->id)?>" title="print P.O." ><i class="fa fa-print"></i> </a>
                    <?php }?>

                    <?php if (in_array('confirm', $access_features)){ ?>
                      <a class="btn btn-md btn-success" href="Javascript:confirm_po()"  ><i class="fa fa-check"></i> Confirm P.O.</a>
                    <?php }?>
                    <?php if (in_array('edit', $access_features)){ ?>
                      <a class="btn btn-md btn-primary" href="Javascript:edit_po()"  ><i class="fa fa-edit"></i> Edit P.O.</a>
                    <?php }?>
                  <?php }else{?>

                    <?php if (in_array('print', $access_features)){ ?>
                      <a class="btn btn-md btn-success" target="_blank" href="<?=base_url('vendor/print_po/'.$po->id)?>"  ><i class="fa fa-print"></i> Print P.O.</a>
                    <?php }?>

                  <?php }?>  
                  <a class="btn btn-md btn-warning" href="<?=($po->confirmed == 0) ? base_url('purchasing/po_list') : base_url('purchasing/confirmed_po') ?>">Go Back</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="x_content">
          <div class="card">
            <div class="card-body">

              <div class="row">
                <div class="col-md-2 col-sm-12 mb-3">
                  <label>P.O. Number</label>
                  <input type="text" readonly name="po_number" value="<?= $po->po_number ?>" class="form-control ridonly">
                </div>

                <div class="col-md-4 col-sm-12 mb-3">
                  <label>Vehicle / Customer</label>
                  <input type="text" readonly class="form-control ridonly" value="<?php
                  if($customers){
                    foreach ($customers as $rs) {
                      $cust[$rs->id] = $rs->name;
                  }}

                  if($manufacturers){
                    foreach ($manufacturers as $rs) {
                      $manu[$rs->id] = $rs->title;
                  }}

                    foreach ($vehicles as $rs) {
                      if ($rs->id == $po->vehicle_id) {
                        echo @$manu[$rs->manufacturer_id] . ' ' . $rs->plate_no . ' - ' . @$cust[$rs->customer_id];
                        break;
                      }
                    }
                  ?>">
                </div>

                <div class="col-md-3 col-sm-12 mb-3">
                  <label>Supplier</label>
                  <input type="text" readonly class="form-control ridonly" value="<?php
                    foreach ($suppliers as $rs) {
                      if ($rs->id == $po->supplier_id) {
                        echo $rs->name;
                        break;
                      }
                    }
                  ?>">
                </div>

                <div class="col-md-1 col-sm-12 mb-3">
                  <?php 
                  if($rates){
                  foreach ($rates as $rs) {
                   $arr_rt[$rs->id] = $rs->title;
                 }}
                  ?>
                  <label>Currency</label>
                  <input type="text" readonly class="form-control ridonly" value="<?=$cr = @$arr_rt[$po->rate_id] ?>">
                </div>

                <div class="col-md-2 col-sm-12 mb-3">
                  <label>Exchange Rate</label>
                  <input type="text" readonly class="form-control ridonly" value="<?= @$po->exchange_rate ?>">
                </div>

                <div class="col-md-3 col-sm-12 mb-3">
                  <label>Reference Number</label>
                  <input type="text" readonly class="form-control ridonly" value="<?= $po->reference_no ?>">
                </div>

                <div class="col-md-3 col-sm-12 mb-3">
                  <label>Supplier Att. To</label>
                  <input type="text" readonly class="form-control ridonly" value="<?= $po->att_to ?>">
                </div>

                <div class="col-md-3 col-sm-12 mb-3">
                  <label>Supplier Email</label>
                  <input type="email" readonly class="form-control ridonly" value="<?= $po->supplier_email ?>">
                </div>

                <div class="col-md-3 col-sm-12 mb-3">
                  <label>Description</label>
                  <input type="text" readonly class="form-control ridonly" value="<?= $po->description ?>">
                </div>
              </div>

              <table id="po_table" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr style="font-size: 12px;">
                    <th width="10%">Part No.</th>
                    <th>Description</th>
                    <th width="10%" style="text-align: right;">Qty</th>
                    <th width="10%" style="text-align: right;">Unit Price</th>
                    <th width="10%" style="text-align: right;">Total Price</th>
                
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($po_items) {
                    foreach ($po_items as $rs) {
                      $total = $rs->qty * $rs->price;
                      @$ttl += $total;
                  ?>
                      <tr>
                        <td><a href="<?=base_url('inventory/view_inventory/' . @$rs->inventory_id)?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><?= $rs->item_code ?></a></td>
                        <td><?= $rs->item_name ?></td>
                        <td style="text-align: right;"> <?= $rs->qty ?></td>
                        <td style="text-align: right;"><?= number_format($rs->price, 2) ?></td>
                        <td align="right"><?= number_format($total, 2) ?></td>
                        
                      </tr>
                  <?php }
                  } ?>

                  <tr>
                    <td colspan="4" align="right">Total</td>
                    <td align="right"><?= number_format($ttl, 2) ?></td>
                
                  </tr>

                  <tr>
                    <td colspan="4" align="right">
                      <input type="text" readonly class="form-control ridonly" value="<?= $po->less_desc ?>" style="text-align: right;">
                    </td>
                    <td><input type="text" readonly value="<?= $po->less_amount ? '-'.number_format($po->less_amount, 2) : '0.00' ?>" class="form-control ridonly" style="text-align: right;"></td>
               
                  </tr>

                  <tr>
                    <td colspan="4" align="right"><b>Grand Total</b></td>
                    <td align="right" nowrap><b><?= $cr.' '.number_format($ttl - $po->less_amount, 2) ?></b></td>
                   
                  </tr>
                </tbody>
              </table>

              <input type="hidden" id="ttl_item_amt" value="<?= ($ttl - $po->less_amount) ?>">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">

  function edit_po() {
    Swal.fire({
      title: 'Edit Purchase Order?',
      text: "Are you sure you want to edit this purchase order?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#aaa',
      confirmButtonText: 'Continue',
      cancelButtonText: 'No, cancel'
    }).then((result) => {
      if (result.isConfirmed) {
         
        location.href = "<?=base_url('purchasing/edit_po/'.$po->id)?>";
      }  
    });
  }

  function confirm_po() {

       
        Swal.fire({
          title: 'Confirm Purchase Order?',
          text: "Are you sure you want to confirm this purchase order?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#aaa',
          confirmButtonText: 'Yes, save it',
          cancelButtonText: 'No, cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            // Swal.fire({
            //   icon: 'success',
            //   title: 'Saving...',
            //   text: 'Your purchase order is being saved.',
            //   showConfirmButton: false,
            //   timer: 1000
            // });
            location.href = "<?=base_url('purchasing/save_confirm_po/'.$po->id)?>";
          }  
        });
 

  }

function update_name_desc(id,poi_id=0){ 

  var formData = new FormData();  
  formData.append("item_code", $('#item_code'+id).val());
  formData.append("item_name", $('#item_name'+id).val());

  $.ajax({
    url: "<?=base_url('purchasing/update_item_code_name/'.$po->quotation_id)?>/"+id+"/"+poi_id, // Replace with your actual API endpoint URL
    type: "POST",
    data: formData,
    contentType: false, // Set to false for FormData
    processData: false, // Set to false for FormData
    success: function(response) {
      if(response==1){
        alertify.success("item details updated successfuly");
      }else if(response==2){
        alertify.error("item code already exist");
      }else if(response==3){
        //same same
      }else{
        alertify.error("error saving.");
      }
      
      console.log(response); // Optional: Log the response data
    },
    error: function(jqXHR, textStatus, errorThrown) {
      alertify.error("error saving");
    }
  });
}

function update_curr(selectElement){

  var selectedOption = selectElement.options[selectElement.selectedIndex];

  var selectedValue = selectedOption.value;
  var selectedText = selectedOption.text

  $('.rater').html(selectedText);
 
  $('#selected_symbol').val(selectedValue);
  $('#rate_type').val(selectedText);
  $('#rate_id').val(selectedValue);
  $('#exchange_rate').val(selectedOption.getAttribute('data-xrate'));
}  

function idel(id){
  $('#irow'+id).remove(); 

  var totalx = 0;

  $(".all_ttl").each(function () {
    // Parse the value of the element as a floating-point number
    var valuex = parseFloat($(this).val());

    // Check if the value is a valid number (not NaN)
    if (!isNaN(valuex)) {
      // Add the value to the total
      totalx += valuex;
    }
  });

  if(totalx==0){
    $('#selected_symbol').val('');
    $('#select_currency').show();
    $('#fix_currency').hide();
  }

  $('#ttl_item_amt').val(totalx);
  $('#totals').html(totalx.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  
  comp_ttl(); 
}


function repli() {
  var txtE = $('#editor-one').html();
  $('#terms_and_conditions').val(txtE);
}
 
function update_link(){

   $('#').load();

   var supplier_id = $('#supplier_id').val();
   var quotation_id = $('#quotation_id').val(); 
   $("#add_item_link").attr("href", "<?php echo base_url('purchasing/add_items');?>/"+supplier_id+'/'+quotation_id);

   if(supplier_id>0 && quotation_id>0){
    $('#add_item_section').show();
   }else{
    $('#add_item_section').hide();
   }
}



function comp(id){
 
  var qty = $('#i_qty'+id).val();
  var unit_cost = $('#i_unit_cost'+id).val();
  var ttl = qty * unit_cost;
  console.log(qty, unit_cost);
  $('#ttl'+id).html(ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  $('#i_ttl'+id).val(ttl);
 
    

    comp_ttl();
}

function comp_ttl(){  

  var total = 0;

  $(".all_ttl").each(function () {
    // Parse the value of the element as a floating-point number
    var value = parseFloat($(this).val());

    // Check if the value is a valid number (not NaN)
    if (!isNaN(value)) {
      // Add the value to the total
      total += value;
    }
  });

  $('#ttl_item_amt').val(total);
  $('#totals').html(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

  var ttl_item_amt = Number($('#ttl_item_amt').val());
  var less = Number($('#less_amount').val());
  var grand_total = ttl_item_amt - less;
 
  $('#grand_total').html(grand_total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}

function leave_edit_po(){
  
  reset(); 

  alertify.confirm("Leave edit purchase order?", function (e) {
        if (e) {  
            alertify.log("Please wait...");
            location.href = '<?=base_url('purchasing/po_list')?>';
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function update_po(){

  var allValid = true;

  $('.require_val').each(function() {
      var val = parseFloat($(this).val());
      if (isNaN(val) || val <= 0) {
          allValid = false;
          return false; // break the loop
      }
  });

    if ($('#ttl_item_amt').val() <= 0) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid Amount',
        text: 'The total amount must be greater than zero.'
      });
    } else if ($('#rate_type').val() == '') {
      Swal.fire({
        icon: 'warning',
        title: 'Missing Currency',
        text: 'Please select a currency before saving.'
      });
    } else if ($('#po_number').val() == '') {
      Swal.fire({
        icon: 'warning',
        title: 'Missing P.O. Number',
        text: 'Please enter the Purchase Order number.'
      });
    } else if(!allValid){

      Swal.fire({
        icon: 'error',
        title: 'Invalid',
        text: 'Cannot input 0 quantity or 0 amount.'
      });

    } else { 

      Swal.fire({
        title: 'Update Purchase Order?',
        text: "Are you sure you want to save this purchase order?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, save it',
        cancelButtonText: 'No, cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            icon: 'success',
            title: 'Saving...',
            text: 'Your purchase order is being saved.',
            showConfirmButton: false,
            timer: 1000
          });
          document.frm_po.submit();
        } else {
          Swal.fire({
            icon: 'info',
            title: 'Cancelled',
            text: 'The purchase order was not saved.'
          });
        }
      });

    }
  
} 
</script>