<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_po" action="<?=base_url('purchasing/update_po/'.$po->id)?>">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
         
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Edit Purchase Order</h6>
                    <ol class="breadcrumb m-0"> 
                        <li class="breadcrumb-item active" aria-current="page"><?=$user->name.' - '.date('M d, Y H:i',strtotime($po->date_created))?></li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-md btn-success" href="Javascript:confirm_po()"  >Confirm P.O.</a>
                        <a class="btn btn-md btn-primary" href="Javascript:update_po()"  >Update P.O.</a>
                        <a class="btn btn-md btn-warning" href="<?=base_url('purchasing/po_list')?>"  >Go Back</a>
                    </div>
                </div>
            </div>
        </div>


      </div>
      <div class="x_content">

        <div class="card">
            <div class="card-body">

        <p class="text-muted font-13 m-b-30">
            

          <div class="row">
            
            <div class="col-md-3 col-sm-12 mb-3">
              <label >P.O. Number</label>
              <input type="text" readonly name="po_number" id="po_number" value="<?=$po->po_number?>" class="form-control ridonly">
            </div>

            <div class="col-md-3 col-sm-12 mb-3">
              <label >Vehicle / Customer <font color="red"></font></label>
              <select name="vehicle_id" id="vehicle_id" class="form-control select2_" >
                <option value="0">N/A</option> 
                <?php 
                if($customers){
                  foreach ($customers as $rs) {
                    $cust[$rs->id] = $rs->name;
                }}

                if($manufacturers){
                  foreach ($manufacturers as $rs) {
                    $manu[$rs->id] = $rs->title;
                }}

                if($vehicles){
                  foreach ($vehicles as $rs) {
                ?>
                <option <?php if($rs->id==$po->vehicle_id){echo 'selected';}?> value="<?=$rs->id?>"><?=@$manu[$rs->manufacturer_id].' '.$rs->plate_no.' - '.@$cust[$rs->customer_id]?></option>
              <?php }}?>
              </select>
            </div>
             
            <div class="col-md-3 col-sm-12 mb-3">
              <label >Supplier </label>
              <select name="supplier_id" id="supplier_id" class="form-control select2_" onchange="update_link()">
                <option value="0">select</option> 
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                ?>
                <option <?php if($rs->id==$po->supplier_id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}?>
              </select>
            </div>

            <div id="select_currency" class="col-md-1 col-sm-12 mb-3">
              <label >Currency <font color="red">*</font></label>
              <select id="curr_val" required class="form-control" onchange="update_curr(this)"> 
                <option value="">Select</option>
                <?php 
                if($rates){
                  foreach ($rates as $rs) {

                   $arr_rt[$rs->id] = $rs->title;
                ?>
                <option <?php if($rs->id==$po->rate_id){echo 'selected';}?> value="<?=$rs->id?>" data-xrate="<?=$rs->ds?>"><?=$rs->title?></option>
              <?php }}?>
              </select>
            </div>

            <div id="fix_currency" class="col-md-1 col-sm-12 mb-3"  style="display: none;">
              <label >Currency</label>
              <input type="text" readonly id="rate_type" class="form-control ridonly" value="<?=@$arr_rt[$po->rate_id]?>"> 
              <input type="hidden" name="rate_id" id="rate_id" value="<?=$po->rate_id?>" > 
              </select>
            </div>

            <div id="fix_currency" class="col-md-2 col-sm-12 mb-3"  >
              <label >Exchange Rate</label>
              <input type="text" readonly id="exchange_rate" name="exchange_rate" value="<?=@$po->exchange_rate?>" class="form-control ridonly">  
              </select>
            </div>
 

            <div class="col-md-3 col-sm-12 mb-3">
              <label >Reference Number </label>
              <input type="text" name="reference_no" value="<?=$po->reference_no?>" class="form-control">
            </div>

            <div class="col-md-3 col-sm-12 mb-3">
              <label >Supplier Att. To  </label>
              <input type="text" name="att_to" id="att_to" value="<?=$po->att_to?>" class="form-control">
            </div>

            <div class="col-md-3 col-sm-12 mb-3">
              <label >Supplier Email </label>
              <input type="email" name="supplier_email" id="supplier_email" value="<?=$po->supplier_email?>" class="form-control">
            </div>
 
            <div class="col-md-3 col-sm-12 mb-3">
              <label >Description </label>
              <input type="text" name="description" value="<?=$po->description?>" class="form-control">
            </div>
 

          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th width="10%">Part No.</th>
              <th>Description</th>
              <th width="10%">Qty</th>
              <th width="10%">Unit Price</th>
              <th width="10%">Total Price</th>
              <th width="5%">Option</th>  
            </tr>
            </thead> 
            <tbody>
            <?php 

            if(@$lcr){
              foreach ($lcr as $rs) {
                $arr_lcr[$rs->id] = $rs->currency_symbol;
              }
            }

            $excluded_ids = '';

            if($po_items){
            foreach($po_items as $rs){ $excluded_ids.='('.$rs->inventory_id.')-';?>  
            <tr id="irow<?=$rs->inventory_id?>">
              <td> 
                <a href="<?=base_url('inventory/view_inventory/'.$rs->inventory_id)?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl"><?=$rs->item_code?></a>
              </td>
              <td> 
                <?=$rs->item_name?>
                <input type="hidden" name="items[<?=$rs->inventory_id?>]" value="<?=$rs->inventory_id?>">
                <input type="hidden" name="poi<?=$rs->inventory_id?>" value="<?=$rs->id?>">
                <input type="hidden" name="item_code<?=$rs->inventory_id?>" value="<?=$rs->item_name?>">
                <input type="hidden" name="item_name<?=$rs->inventory_id?>" value="<?=$rs->item_name?>">
              </td>
              <td > <input type="number" class="require_val" id="i_qty<?=$rs->inventory_id?>" name="i_qty<?=$rs->inventory_id?>" onkeyup="comp(<?=$rs->inventory_id?>)" onclick="comp(<?=$rs->inventory_id?>)" value="<?=$rs->qty?>" style="border: 0; width: 100%; text-align: right;"></td>
              <td align="right" nowrap="">
               <font class="rater"><?=@$arr_rt[$po->rate_id]?></font>
                <input type="number" class="require_val" id="i_unit_cost<?=$rs->inventory_id?>" name="i_unit_cost<?=$rs->inventory_id?>" onkeyup="comp(<?=$rs->inventory_id?>)" onclick="comp(<?=$rs->inventory_id?>)" value="<?=round($rs->price,2)?>" style="border: 0; text-align: right;"></td>
              <td align="right">
                <span id="ttl<?=$rs->inventory_id?>"><?=number_format($rs->qty*$rs->price,2); @$ttl+=$rs->qty*$rs->price;?></span>
                <input type="hidden" class="all_ttl" id="i_ttl<?=$rs->inventory_id?>" value="<?=round($rs->qty*$rs->price,2)?>">

              </td> 
              <td nowrap> 
                <a href="Javascript:idel(<?=$rs->inventory_id?>)" ><i style="color: red;" class="fa fa-trash"></i> </a>
              </td>
            </tr>  
            <?php }}?>
            <tr id="last_row">
              <td colspan="3">
                
                <table width="100%" style="border: 0 !important;">
                  <tr>
                    <td class="add_item">
                       
                       <div class="select2-ajax" style="width: 100%;"> 
                       </div>

                    </td> 
                  </tr>
                </table>

              </td>
              <td align="right">Total</td>
              <td align="right"><span id="totals"><?=number_format($ttl,2)?></span></td>
              <td></td>
            </tr> 
            <tr id="last_row">
              <td colspan="4" align="right">
                <input type="text" name="less_desc" class="form-control" value="<?=$po->less_desc?>" style="border: 0; text-align: right;">
              </td>
              <td>
                
                <input type="number" name="less_amount" id="less_amount" value="<?=round($po->less_amount,2)?>" onkeyup="comp_ttl()" onclick="comp_ttl()" class="form-control" value="0" style="border: 0; text-align: right;"></td>
              <td><i>(Less)</i></td>
            </tr> 
            <tr id="last_row">
              <td colspan="4" align="right"><b>Grand Total</b></td>
              <td align="right"><span id="grand_total"><?=number_format($ttl-$po->less_amount,2)?></span></td>
              <td></td>
            </tr> 
           </tbody>
           <input type="hidden" id="ttl_item_amt" value="<?=($ttl-$po->less_amount)?>">
        </table> 
       
 
        <input type="hidden" name="row_counter" id="row_counter">

        <input type="hidden" id="selected_ids" value="<?=$excluded_ids?>">

        <input type="hidden" id="selected_symbol" value="<?=@$po->rate_id?>"> 
                 
      </div>

       
  </div> 
   
</div>
</form>
<script type="text/javascript">

function confirm_po() {

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
    } else if(!allValid){
      Swal.fire({
        icon: 'error',
        title: 'Invalid',
        text: 'Cannot input 0 quantity or 0 amount.'
      });
    } else { 

      Swal.fire({
        title: 'Confirm Purchase Order?',
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