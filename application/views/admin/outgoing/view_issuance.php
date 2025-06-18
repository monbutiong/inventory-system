<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
  .select2-container--open .select2-dropdown {
    min-width: 400px !important; 
  }
  .select2-container--default .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: 4px;
    top: 16%;
    transform: translateY(-50%);
    z-index: 2;
    cursor: pointer;
  }
</style>
<form method="post" name="issuance_form" id="issuance_form" action="#" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="page-title-box">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h6 class="page-title">Sales Order #<?='SO' . sprintf("%06d", $issuance->id)?></h6>
                Date: <?=date('M d, Y', strtotime($issuance->date_created))?><br/>
                Filed by: <?=$user->name?>
                <?php if(@$issuance->quotation_id){?>
                  <br/>
                From Quotation <a target="_blank" href="<?=base_url('outgoing/print_quotation/' . $issuance->quotation_id)?>">#<?='QO' . sprintf("%06d", $issuance->quotation_id)?></a>
                <?php }?>
                <input type="hidden" id="customer_type" name="customer_type" class="form-control ridonly" value="<?=$issuance->customer_type?>">
              </div>
              <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                   

                  <a class="btn btn-md btn-success" href="Javascript:print_so(<?=$issuance->id?>)"><i class="fa fa-print"></i></a>
                  
                  <?php if($issuance->confirmed == 0){?>
                  <a class="btn btn-md btn-success" href="Javascript:confirm_issuance()"><i class="fa fa-check"></i> Confirm Sales Order</a>

                  <a class="btn btn-md btn-success" href="Javascript:edit_issuance()"><i class="fa fa-edit"></i> Edit Sales Order</a>
                  
                  <a class="btn btn-md btn-warning" href="<?=base_url("outgoing/issuance_records")?>">Go Back</a>
                  <?php }else{?>
                  <a class="btn btn-md btn-warning" href="<?=base_url("outgoing/confirm_issuance_records")?>">Go Back</a>  
                  <?php }?>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="x_content">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2 mb-3">

                  <?php 
                  if(@$payment_type){
                  foreach($payment_type as $rs){
                    $arr_pt[$rs->id] = $rs->title;
                  }}
                  ?>
                  <label>Payment Type</label>
                  <input readonly type="text" name="valid_until" id="valid_until" class="form-control ridonly" value="<?=@$arr_pt[$issuance->pay_type_id]?>">
                </div>

                <div class="col-md-4 col-sm-12 mb-3 select2">
                  <label >Vehicle Records </label>  
                   <?php 
                   if(@$manufacturers){
                   	foreach($manufacturers as $rs){
                   		$arr_manu[$rs->id] = $rs->title;
                   	}
                   }

                   if(@$models){
                   	foreach($models as $rs){
                   		$arr_mod[$rs->id] = $rs->title.' '.$rs->model_year;
                   	}
                   }
                   ?> 
                    
                    <input type="text" readonly name="plate_no" id="plate_no" class="form-control ridonly" value="<?=@$arr_manu[$vehicle->manufacturer_id].' '.@$arr_mod[$vehicle->vehicle_model_id]?>">
                </div>

                <div class="col-md-3 mb-3">
                  <label>Plate No.</label>
                  <input type="text" readonly name="plate_no" id="plate_no" class="form-control ridonly" value="<?=$issuance->plate_no?>">
                </div>

                <div class="col-md-3 mb-3">
                  <label>VIN</label>
                  <input type="text" readonly name="vin" id="vin" class="form-control ridonly" value="<?=$issuance->vin?>">
                </div>
 

                <div class="col-md-2 mb-3">
                  <label>QID</label>
                  <input type="text" name="customer_qid_bus" id="customer_qid_bus" readonly class="form-control ridonly" value="<?=$issuance->customer_qid_bus?>">
                </div>

                <div id="customer_fixed" class="col-md-4 col-sm-12 mb-3" style="display: none;">
                  <label >Customer </label>
                  <input type="text" name="customer" id="customer" readonly class="form-control ridonly">
                </div>

                <div id="customer_selection" class="col-md-4 col-sm-12 mb-3">
                  <label >Customer </label>
                   
                  <input type="text" name="customer" id="customer" readonly class="form-control ridonly" value="<?=$clients->name?>">
                </div>

                <div class="col-md-2 mb-3">
                  <label>Contact Number</label>
                  <input readonly type="text" name="phone" id="phone" value="<?=$issuance->phone?>" class="form-control ridonly">
                </div>

                <div class="col-md-4 mb-3">
                  <label>Remarks</label>
                  <input readonly type="text" name="remarks" id="remarks" value="<?=$issuance->remarks?>" class="form-control ridonly">
                </div>
              </div>

              <table id="so_table" class="table table-striped table-bordered table-hover">
                         
                        <thead>
                          <tr style="font-size: 12px;">
                             
                            <th>Part No.</th>
                            <th>Description</th>   
                            <th>Brand</th>
                            <th>Quantity on Hand</th> 
                            <th>Unit Cost Price</th>  
                            <th nowrap>Quantity</th> 
                            <th>Unit Price</th>
                            <th>Line Total</th>
                            <th nowrap>Discount. %</th>
                            <th nowrap>Discount. Amt.</th>
                            <th>Net Total</th>    
                          </tr>
                          </thead> 
                          <tbody>
                          <?php 
                          if(@$items){
                            foreach($items as $rs){
                              @$counter+=1;
                              @$selected_ids.='('.$rs->inventory_id.')-';
                          ?>
                            <tr id="tr<?=$rs->inventory_id?>" class="data-row">
                              <td>
                                <a href="<?=base_url('inventory/view_inventory')?>/<?=$rs->inventory_id?>" 
                                   class="load_modal_details" 
                                   data-bs-toggle="modal" 
                                   data-bs-target=".bs-example-modal-lg" 
                                   data-modal-size="xl">
                                   <?=$rs->item_code?>
                                </a>
                                 
                              </td>
                              <td><?=$rs->item_name?></td>
                              <td><?=$rs->brand?></td>
                              <td style="text-align:right;" id="t_qty<?=$rs->inventory_id?>"><?=$rs->qoh?>
                                   
                              </td>
                              <td style="text-align:right;"><?=$rs->qoh?>
                                   
                              </td>

                              <td style="text-align:center;  width:60px;">
                                 <?=$rs->qty?> 
                              </td>  

                              <td style="text-align:right;">
                                 
                                <span class="retail_price_text">
                                  <?=number_format($rs->retail_price,2)?>
                                </span> 

                                <input type="hidden" name="retail_price<?=$rs->inventory_id?>" value="<?=$rs->retail_price?>"> 
                              </td>

                              <td style="text-align:right;">
                                <span id="row_total"><?=number_format($rs->retail_price * $rs->qty,2)?></span>
                              </td> 

                              <td style="text-align:right; width:80px;">
                                <?=$rs->discount_percentage?>
                              </td>

                              <td style="text-align:right; width:90px;">
                                <?=$rs->discount_amount ? number_format($rs->discount_amount,2) : ''?> 
                              </td>

                              <td style="text-align:right;">
                                <?=number_format(($rs->retail_price * $rs->qty)-($rs->discount_amount>0 ?  $rs->discount_amount : 0),2)?>
                              </td> 

                              
                            </tr>

                          <?php }}?>

                            <tr id="item_selector">
                              <td colspan="8" class="add_item">
                                  
                              </td>
                              <td align="right"> 
                                 <?=@$issuance->discount_percentage_total?> 
                              </td>
                              <td align="right"> 
                                 <?=@$issuance->discount_amount_total?> 
                              </td>
                              <td  align="right">
                                QAR <?=@$issuance->issuance_grand_total ? number_format($issuance->issuance_grand_total, 2) : '0.00'?> 
                                 
                              </td>
                            
                            </tr> 
                          </tbody>
                        </table>

              <input type="hidden" name="row_counter" id="row_counter" value="<?=@$counter?>">
              <input type="hidden" id="selected_ids" value="<?=@$selected_ids?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">

  function print_so(id) {
        Swal.fire({
            title: 'Print Sales Order',
            text: "Print sales order with part number included?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',          // Red confirm button
            cancelButtonColor: '#3085d6',        // Blue cancel button
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // If Yes is clicked
                window.open("<?php echo base_url('outgoing/print_issuance') ?>/"+id+'?with_partnumber=1', '_blank');
            } else {
                // If No is clicked
                window.open("<?php echo base_url('outgoing/print_issuance') ?>/"+id, '_blank');
            }
        });
  }
 
  var c = 0;
  var all = 0; 
    
  function confirm_issuance() {
    
    Swal.fire({
        title: "Confirm Sales Order?",
        text: "Do you want to confirm this sales order now?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, save it",
        cancelButtonText: "No, cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
           
            location.href = "<?=base_url('outgoing/confirm_issuance/'.$issuance->id);?>";
        }  
    });

  }

  function edit_issuance(){ 
 
	    Swal.fire({
	        title: "Edit Sales Order?",
	        text: "Do you want to edit this sales order now?",
	        icon: "question",
	        showCancelButton: true,
	        confirmButtonText: "Yes, save it",
	        cancelButtonText: "No, cancel",
	        reverseButtons: true
	    }).then((result) => {
	        if (result.isConfirmed) {
	           
	            location.href = "<?=base_url('outgoing/edit_issuance/'.$issuance->id);?>";
	        }  
	    });
 
 
  }
 
  function remove_item(id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

   
</script>