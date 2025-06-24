<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_returns" action="<?=base_url('inventory/update_inventory_return/'.$ir->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
 

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Inventory Return #<?='IR' . sprintf("%06d", $ir->id)?> <?php if($ir->confirmed == 1){?><span class="badge rounded-pill bg-success">Confimed</span><?php }?></h6>
                    Date: <?=date('M d, Y', strtotime($ir->date_created))?><br/>
                    Filed by: <?=$user->name?>
                    <?php if($ir->confirmed == 1){?>
                     Confirmed By: <?=$confirm_user->name.' - '.date('M d, Y H:i',strtotime($ir->confirmed_date))?> 
                    <?php }?> 
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                       
                        <a target="_blank" class="btn btn-md btn-success" href="<?=base_url('inventory/print_returns/'.$ir->id)?>"><i class="fa fa-print"></i> </a>

                        <?php if($ir->confirmed == 0){?>
                        <a class="btn btn-md btn-success" href="Javascript:confirm_returns()"><i class="fa fa-check"></i> Confirm</a>

                        <a class="btn btn-md btn-success" href="Javascript:edit_returns()"><i class="fa fa-edit"></i> Edit</a>
                        <?php }?>

                        <?php if($ir->confirmed == 1){?>
                        <a class="btn btn-md btn-warning" href="<?=base_url("inventory/confirmed_return_inventory")?>">Go Back</a>  
                        <?php }else{?>
                        <a class="btn btn-md btn-warning" href="<?=base_url("inventory/return_inventory")?>">Go Back</a> 
                        <?php }?> 
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

             
            <div class="col-md-2 col-sm-12 ">
              <label >Return Date *</label>
              <input type="date" required readonly name="return_date" id="return_date" value="<?=$ir->return_date?>" class="form-control ridonly">
            </div>
            
            <div class="col-md-2 col-sm-12 ">
              <label >Sales Order </label>
              <input type="text" id="customer" name="customer"  readonly value="<?php  
                if($so){
                  foreach ($so as $rs) { if(@$ir->issuance_id == $rs->id){
                echo 'SO'.sprintf("%06d",($rs->id)) ; }}}?>" class="form-control ridonly">
              
            </div>
   
            <div class="col-md-2 col-sm-12 ">
              <label >Customer</label>
              <input type="text" id="customer" name="customer"  readonly value="<?=$client->name?>" class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Conatact Number</label>
              <input type="text" id="phone" name="phone" readonly value="<?=$ir->phone?>" class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Purchase Date</label>
              <input type="text" required readonly name="puchase_date" id="puchase_date" class="form-control ridonly"  value="<?=$ir->puchase_date?>">
            </div>

             
 
            <div class="col-md-10 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" readonly id="remarks" class="form-control ridonly"><?=$ir->remarks?></textarea>
            </div>
   
 
          </div>

        
        </p>
        
        <table id="ri_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
               
              <th>Part No.</th>
              <th>Description</th>   
              <th>Brand</th>
              <th>S.O. Quantity</th> 
              <th>Retail Price</th>  
              <th nowrap>Return Qty</th> 
              <th nowrap>Line Total</th>
              <th nowrap>Discount %</th>
              <th nowrap>Discount Amt</th>
              <th nowrap>Total Amount</th> 
              <th nowrap>Remarks</th>   
            </tr>
            </thead> 
            <tbody>
                   <?php 
                   if(@$return_items){
                    foreach($return_items as $rs){
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
                       <input type="hidden" class="item_exist" name="items[<?=$rs->inventory_id?>]" id="added<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                       <input type="hidden" name="inventory_id<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                       <input type="hidden" name="ii_id<?=$rs->inventory_id?>" value="<?=$rs->issuance_item_id?>"/>
                       <input type="hidden" name="exist<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                     </td>
                     <td><?=$rs->item_name?></td>
                     <td><?=$rs->item_brand?></td>
                     <td style="text-align:right;" id="t_qty<?=$rs->inventory_id?>" data-price="<?=$rs->retail_price?>" 
                        data-discount-percentage="<?=$rs->discount_percentage?>"><?=$rs->so_qty?> 
                     </td>
                     <td style="text-align:right;"> 
                      <?=$rs->retail_price ? number_format($rs->retail_price,2) : '0.00'?>
                      <input type="hidden" name="retail_price<?=$rs->inventory_id?>" value="<?=$rs->retail_price ? round($rs->retail_price,2) : '0.00'?>">
                     </td>

                     <td style="text-align:right;  width:60px;">
                       <?=$rs->qty?> 
                       <input type="hidden" name="issued_qty<?=$rs->inventory_id?>" value="<?=$rs->qty?>"/>
                       <input type="hidden" name="old_stock_qty<?=$rs->inventory_id?>" value="<?=$rs->inv_stock?> "/>
                     </td> 

                     <td style="text-align:right;"><font id="line_total<?=$rs->inventory_id?>"><?=number_format($rs->retail_price * $rs->qty,2)?></font>
                     </td>

                     <td style="text-align:right;"> 
                         <?=$rs->discount_percentage?>
                         <input type="hidden" name="discount_percentage<?=$rs->inventory_id?>" value="<?=$rs->discount_percentage?>" >
                     </td>

                     <td style="text-align:right;">
                         <span id="discount_amount_total<?=$rs->inventory_id?>">
                         <?=number_format($rs->discount_amount,2)?>
                         </span>
                         <input type="hidden" 
                         id="discount_amount<?=$rs->inventory_id?>"
                         name="discount_amount<?=$rs->inventory_id?>" value="<?=round($rs->discount_amount,2)?>" >
                     </td>

                     <td style="text-align:right;"><font id="line_grand_total<?=$rs->inventory_id?>"><?=number_format(($rs->retail_price * $rs->qty)-$rs->discount_amount,2)?></font>
                     </td>


                     <td style="text-align:left;  width:260px;">
                       <?=$rs->remarks?> 
                     </td>  

                     

                      
                   </tr>
                   <?php }}?>
                    <tr id="item_selector">
                      <td colspan="9" class="add_item" align="right">
                         <h5>Grand Total</h5>
                      </td> 
                     
                      <td align="right">
                        <h5 id="grand_totalz"><?=number_format($ir->grand_total_amt,2)?></h5>
                        <input type="hidden" id="grand_total_amt" name="grand_total_amt" value="<?=$ir->grand_total_amt?>">
                      </td>
                      <td colspan="2"></td>
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

  function load_so(id){
    $.ajax({
        url: '<?=base_url("inventory/load_so")?>/'+id, // Replace with your API endpoint
        type: 'GET', 
        success: function(response) { 
            console.log('GGG',JSON.parse(response));  
            var data = JSON.parse(response);
            $('#customer').val(data.customer);
            $('#phone').val(data.phone);
            $('#puchase_date').val(data.confirmed_date); 
        } 
    });
  }

  var c = 0;
  var all = 0; 
    
  function load_client(id){
    
    $.get("<?=base_url('inventory/load_client')?>/"+id, function(data) {
        // Handle the response data here
        console.log(data);

        var cli = data.split('-');

        $('#client_id').val(cli[0]);
        $('#client').val(cli[1]);
    })
  } 

  function edit_returns(){ 

   
        Swal.fire({
            title: 'Edit Item Returns',
            text: 'Do you want to edit the item return details?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No, cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
            
                location.href = "<?=base_url('inventory/edit_returns/'.$ir->id)?>";
            } 
        });
    

  }

  function confirm_returns(){ 

   
        Swal.fire({
            title: 'Confirm Item Returns',
            text: 'Do you want to confirm the item return details?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No, cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
            
                location.href = "<?=base_url('inventory/confirm_returns/'.$ir->id)?>";
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

    initializeExistingRows();
  }



    
</script>