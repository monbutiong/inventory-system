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
<form method="post" name="so_form" id="so_form" action="<?=base_url('outgoing/save_issuance/'.@$quotation->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Create Sales Order</h6>
                    Date: <?=date('M d, Y')?> 
                    <?php if(@$quotation->id){?>
                      <br/>
                    From Quotation <a target="_blank" href="<?=base_url('outgoing/print_quotation/' . $quotation->id)?>">#<?='QO' . sprintf("%06d", $quotation->id)?></a>
                    <?php }?>
                    <input type="hidden" id="customer_type" name="customer_type" readonly class="form-control ridonly"> 
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        
                        <a href="<?=base_url('outgoing/load_quotation_list')?>" class="btn btn-md btn-success load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" data-modal-size="xl" ><i class="fa fa-file"></i> Load Records From Quotation</a>

                        <a class="btn btn-md btn-primary" href="Javascript:save_issuance()"  ><i class="fa fa-save"></i> Save Sales Order</a>
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

            <div class="col-md-2 col-sm-12 mb-3">
              <label >Payment Type</label>
              <select name="pay_type_id" id="pay_type_id" class="form-control">
                <?php if(@$payment_type){
                  foreach($payment_type as $rs){?>
                <option value="<?=$rs->id?>"><?=$rs->title?></option>
                <?php }}  ?>
              </select>
            </div>

            <div class="col-md-4 col-sm-12 mb-3 select2">
              <label >Vehicle Records <a class="load_modal_details" href="<?php echo base_url('outgoing/add_vehicle');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                  (<i class="fa fa-plus"></i>)
                </a></label>  
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
               <input type="hidden" id="default_vehicle_id" value="<?=@$quotation->vehicle_id?>">
               <input type="hidden" id="default_vehicle_val" value="<?=@$arr_manu[$vehicle->manufacturer_id].' '.@$arr_mod[$vehicle->vehicle_model_id]?>"> 
              <select id="vehicle_select" name="vehicle_id" class="form-control select2-ajax-vehicle">
                <option value="<?=@$quotation->vehicle_id?>" selected="selected"><?=@$arr_manu[$vehicle->manufacturer_id].' '.@$arr_mod[$vehicle->vehicle_model_id]?></option> 
                </select>
            </div>

            <div class="col-md-3 mb-3">
              <label>Plate No.</label>
              <input type="text" readonly name="plate_no" id="plate_no" class="form-control ridonly" value="<?=@$quotation->plate_no?>">
            </div>

            <div class="col-md-3 mb-3">
              <label>VIN</label>
              <input type="text" readonly name="vin" id="vin" class="form-control ridonly" value="<?=@$quotation->vin?>">
            </div>
  
            <div class="col-md-2 mb-3">
              <label>QID</label>
              <input type="text" name="customer_qid_bus" id="customer_qid_bus" readonly class="form-control ridonly" value="<?=@$quotation->customer_qid_bus?>">
            </div>

            <div id="customer_fixed" class="col-md-4 col-sm-12 mb-3" style="display: none;">
              <label >Customer </label>
              <input type="text" name="customer" id="customer" readonly class="form-control ridonly">
            </div>

            <div id="customer_selection" class="col-md-4 col-sm-12 mb-3">
              <label >Customer <a class="load_modal_details" href="<?php echo base_url('outgoing/add_customer');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                  (<i class="fa fa-plus"></i>)
                </a></label>
              <select name="customer_id" id="customer_id" class="form-control select2_so_customer">
                 <option value="<?=@$quotation->customer_id?>" selected="selected"><?=$clients->name?></option> 
              </select>
            </div>

            <div class="col-md-2 mb-3">
              <label>Contact Number</label>
              <input type="text" name="phone" id="phone" value="<?=@$quotation->phone?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
              <label>Remarks</label>
              <input type="text" name="remarks" id="remarks" value="<?=@$quotation->remarks?>" class="form-control">
            </div>
            
  
          </div>

        </p>
 
        
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
              <th style="width:10px;"></th>  
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
                        <input type="hidden" name="items[<?=$rs->inventory_id?>]" id="added<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                        <input type="hidden" name="inventory_id<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                        <input type="hidden" name="ex_inventory_id<?=$rs->inventory_id?>" value="<?=$rs->id?>"/>
                      </td>
                      <td><?=$rs->item_name?></td>
                      <td><?=$rs->brand?></td>
                      <td style="text-align:right;" id="t_qty<?=$rs->inventory_id?>"><?=$rs->qoh?>
                          <input type="hidden" name="qoh<?=$rs->inventory_id?>" id="qoh<?=$rs->inventory_id?>" value="<?=$rs->qoh?>"/>
                      </td>
                      <td style="text-align:right;"><?=$rs->qoh?>
                          <input type="hidden" name="unit_cost_price<?=$rs->inventory_id?>" id="unit_cost_price<?=$rs->inventory_id?>" value="<?=$rs->unit_cost_price?>"/>
                      </td>

                      <td style="text-align:center;  width:60px;">
                        <input type="number" 
                               id="qty<?=$rs->inventory_id?>" 
                               name="qty<?=$rs->inventory_id?>" 
                               required 
                               value="<?=$rs->qty?>" 
                               min="1" 
                               max="<?=$rs->qty?>" 
                               style="border:0; background:transparent; text-align:right; width:60px;">
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
                        <input type="number" 
                               name="discount_percentage<?=$rs->inventory_id?>" 
                               style="border:0; background:transparent; text-align:right; width:60px;" maxlength="5" value="<?=$rs->discount_percentage?>">
                      </td>

                      <td style="text-align:right; width:90px;">
                        <input type="number" 
                               name="discount_amount<?=$rs->inventory_id?>" 
                               maxlength="7" 
                               style="border:0; background:transparent; text-align:right; width:80px;" value="<?=$rs->discount_amount?>">
                      </td>

                      <td style="text-align:right;">
                        <span id="row_grand_total"><?=number_format(($rs->retail_price * $rs->qty)-($rs->discount_amount>0 ?  $rs->discount_amount : 0),2)?></span>
                      </td> 

                      <td style="text-align:center;">
                        <a href="javascript:remove_item(<?=$rs->inventory_id?>)">
                          <i title="remove" class="fa fa-trash" style="color:red"></i>
                        </a>
                      </td>
                    </tr>

                  <?php }}?>
 
                    <tr id="item_selector">
                      <td colspan="8" class="add_item">
                        <div class="select2-ajax-so" style="width: 100%;"> 
                      </td>
                      <td align="right"> 
                        <input type="number" id="discount_percentage_total" name="discount_percentage_total" value="<?=@$issuance->discount_percentage_total?>" class="form-control" style="width: 100px; text-align: right;" step="any">
                      </td>
                      <td align="right"> 
                        <input type="text" readonly id="discount_amount_total" name="discount_amount_total" value="<?=@$issuance->discount_amount_total?>" class="form-control ridonly" style="width: 100px; text-align: right;" step="any">
                      </td>
                      <td  align="right">
                        QAR <b id="grand_total" style="font-size: 15px;"><?=@$issuance->issuance_grand_total ? number_format(@$issuance->issuance_grand_total) : '0.00'?></b>
                        <input type="hidden" id="issuance_grand_total" name="issuance_grand_total" value="<?=@$issuance->issuance_grand_total ? round(@$issuance->issuance_grand_total) : 0?>">
                      </td>
                      <td></td>
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
 
  var c = 0;
  var all = 0; 
    
  function load_client(id){
    
    $.get("<?=base_url('outgoing/load_client')?>/"+id, function(data) {
        // Handle the response data here
        console.log(data);

        var cli = data.split('-');

        $('#client_id').val(cli[0]);
        $('#client').val(cli[1]);
    })
  }

  

  function save_issuance(){ 

        if($('#grand_total').html().trim()=='0.00' || $('#grand_total').html().trim()==''){

          Swal.fire({
              title: "Invalid",
              text: "Quotation total amount invalid",
              icon: "error",
              timer: 1500,
              showConfirmButton: false
          });

        }else{

          Swal.fire({
              title: "Save Sales Order?",
              text: "Do you want to save this sales order now?",
              icon: "question",
              showCancelButton: true,
              confirmButtonText: "Yes, save it",
              cancelButtonText: "No, cancel",
              reverseButtons: true
          }).then((result) => {
              if (result.isConfirmed) {
                  Swal.fire({
                      title: "Saving...",
                      icon: "info",
                      timer: 1000,
                      showConfirmButton: false
                  });
                  document.so_form.submit();
              } else {
                  Swal.fire({
                      title: "Cancelled",
                      text: "The quotation was not saved.",
                      icon: "error",
                      timer: 1500,
                      showConfirmButton: false
                  });
              }
          });

      }

  }


  function remove_item(id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
    computeGrandTotal();
  }

   

</script>