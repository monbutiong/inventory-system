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
<form method="post" name="quotation_form" id="quotation_form" action="#" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="page-title-box">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h6 class="page-title">Quotation #<?='QO' . sprintf("%06d", $quotation->id)?></h6>
                Date: <?=date('M d, Y', strtotime($quotation->date_created))?><br/>
                Filed by: <?=$user->name?>
                <input type="hidden" id="customer_type" name="customer_type" class="form-control ridonly" value="<?=$quotation->customer_type?>">
              </div>
              <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                   

                  <a class="btn btn-md btn-success" href="Javascript:print_quo(<?=$quotation->id?>)"><i class="fa fa-print"></i></a>
                  
                  <a class="btn btn-md btn-success" href="Javascript:edit_quotation()"><i class="fa fa-edit"></i> Edit Quotation</a>
                  
                  <a class="btn btn-md btn-warning" href="<?=base_url("outgoing/quotation_list")?>">Go Back</a>
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

                  <label>Valid Until</label>
                  <input readonly type="date" name="valid_until" id="valid_until" class="form-control ridonly" value="<?=$quotation->valid_until?>">
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

                <div class="col-md-2 mb-3">
                  <label>Plate No.</label>
                  <input type="text" readonly name="plate_no" id="plate_no" class="form-control ridonly" value="<?=$quotation->plate_no?>">
                </div>

                <div class="col-md-2 mb-3">
                  <label>VIN</label>
                  <input type="text" readonly name="vin" id="vin" class="form-control ridonly" value="<?=$quotation->vin?>">
                </div>

                <div class="col-md-2 col-sm-12 mb-3">
                  <label >Attention To</label>
                  <input type="text" readonly value="<?=$quotation->attention_to?>" name="attention_to" id="attention_to" class="form-control ridonly">
                </div> 

                <div class="col-md-2 mb-3">
                  <label>QID</label>
                  <input type="text" name="customer_qid_bus" id="customer_qid_bus" readonly class="form-control ridonly" value="<?=$quotation->customer_qid_bus?>">
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
                  <input readonly type="text" name="phone" id="phone" value="<?=$quotation->phone?>" class="form-control ridonly">
                </div>

                <div class="col-md-4 mb-3">
                  <label>Remarks</label>
                  <input readonly type="text" name="remarks" id="remarks" value="<?=$quotation->remarks?>" class="form-control ridonly">
                </div>
              </div>

              <table id="view" class="table table-striped table-bordered table-hover">
                         
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
                                <?=number_format($rs->retail_price * $rs->qty,2)?>
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
                                 <?=@$quotation->discount_percentage_total?> 
                              </td>
                              <td align="right"> 
                                 <?=@$quotation->discount_amount_total?> 
                              </td>
                              <td  align="right">
                                QAR <?=@$quotation->quotation_grand_total ? number_format($quotation->quotation_grand_total) : '0.00'?> 
                                 
                              </td>
                            
                            </tr> 
                          </tbody>
                        </table>

              <input type="hidden" name="row_counter" id="row_counter" value="<?=@$counter?>">
              <input type="hidden" id="selected_ids" value="<?=@$selected_ids?>">

              <div id="load_template">
                <div class="row">
              
                  <div class="col-md-6 mb-12">
                     
                   <?=@$quotation->terms_and_conditions?> 
                  </div>

                  <div class="col-md-6 mb-12">
                   
                    <?=@$quotation->terms_and_conditions_arabic?> 
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  
  function print_quo(id) {
      Swal.fire({
          title: 'Print Quotation',
          text: "Print quotation with part number included?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#d33',          // Red confirm button
          cancelButtonColor: '#3085d6',        // Blue cancel button
          confirmButtonText: 'Yes',
          cancelButtonText: 'No'
      }).then((result) => {
          if (result.isConfirmed) {
              // If Yes is clicked
              window.open("<?php echo base_url('outgoing/print_quotation') ?>/"+id+'?with_partnumber=1', '_blank');
          } else {
              // If No is clicked
              window.open("<?php echo base_url('outgoing/print_quotation') ?>/"+id, '_blank');
          }
      });
  }

  var c = 0;
  var all = 0; 
  
  function edit_quotation(){ 
 
	    Swal.fire({
	        title: "Edit Quotation?",
	        text: "Do you want to edit this quotation now?",
	        icon: "question",
	        showCancelButton: true,
	        confirmButtonText: "Continue",
	        cancelButtonText: "No, cancel",
	        reverseButtons: true
	    }).then((result) => {
	        if (result.isConfirmed) {
	           
	            location.href = "<?=base_url('outgoing/edit_quotation/'.$quotation->id);?>";
	        }  
	    });
 
 
  }
  

   
</script>