<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_adj" action="<?=base_url('inventory/save_adjustment')?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
         
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Stock Adjustments #SA<?=sprintf("%06d",$ia->id)?></h6>
                    Date: <?=date('M d, Y', strtotime($ia->date_created))?><br/>
                    Filed by: <?=$user->name?> 
                    <?php if($ia->confirmed == 1){?><br/>
                     Confirmed By: <?=$confirm_user->name.' - '.date('M d, Y H:i',strtotime($ia->confirmed_date))?> 
                    <?php }?> 
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                          
                         <a target="_blank" class="btn btn-md btn-primary" href="<?=base_url('inventory/print_adjustments/'.$ia->id)?>"  ><i class="fa fa-print"></i> </a> 
                         
                         <?php if($ia->confirmed == 0){?>
                           <a class="btn btn-md btn-primary" href="Javascript:confirm_adj()"  ><i class="fa fa-check"></i> Confirm Adjustments</a>

                           <a class="btn btn-md btn-primary" href="Javascript:edit_adj()"  ><i class="fa fa-edit"></i> Edit Adjustments</a>

                           <a class="btn btn-md btn-warning" href="<?=base_url('inventory/stock_adjustments')?>"  >Go Back </a>
                         <?php }else{?>
                           <a class="btn btn-md btn-warning" href="<?=base_url('inventory/confirmed_stock_adjustments')?>"  >Go Back </a>
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
                    <label >Covered Date *</label>
                    <input type="text" class="form-control ridonly" readonly value="<?=date('d M, Y',strtotime($ia->covered_date))?>">
                  </div>

                  <div class="col-md-2 col-sm-12 ">
                    <label >Adjustment Type </label>
                     
                    <input type="text" class="form-control ridonly" readonly value=" <?php  
                      if($adj_types){
                        foreach ($adj_types as $rs) { if($rs->id = $ia->adjustment_type_id){echo $rs->title; }}}?>">
                  </div>
        
                  <div class="col-md-2 col-sm-12 ">
                    <label >Reference Number</label>
                    <input readonly type="text" name="ref_no" id="ref_no" class="form-control ridonly" value="<?=$ia->ref_no?>">
                  </div>

                   

                    <?php 
                    if(@$ia->attachments){
                      ?>
                      <div class="col-md-4 col-sm-12"> 
                        <label >Attacments</label>
                        <br/>
                        <div  >
                          <?php 
                          foreach (json_decode($ia->attachments) as $f_name) {
                           list($n,$i,$fname) = explode('_',$f_name);
                           ?>
                           <span id="attch<?=$n.$i?>" class="badge bg-success">
                            <input type="hidden" name="fname[]" value="<?=$fname?>">
                            <a download="<?=$fname?>" title="download file" style="color: white;" href="<?=base_url('assets/uploads/receiving')?>"><?=$fname?> <i class="fa fa-download"></i> </a>  | <a style="color: white;" href="Javascript:dela('<?=$n.$i?>')" title="delete file"><i class="fa fa-remove"></i></a> 
                          </span>
                        <?php }?>
                      </div>
                    </div>
                  <?php }?>
       
                  <div class="col-md-12 col-sm-12 ">
                    <label >Remarks </label>
                    <textarea readonly name="remarks" id="remarks" class="form-control ridonly"><?=$ia->remarks?></textarea>
                  </div>
          
                </div>

              </p>
       
              
              <table id="po_table" class="table table-striped table-bordered table-hover">
                 
                <thead>
                  <tr style="font-size: 12px;"> 
                    <th>Part No.</th>
                    <th>Description</th>
                    <th>Brand</th>  
                    <th>Unit Cost Price</th> 
                    <th>Stock Qty</th>
                    <th nowrap>Adjustment </th>
                    <th>New Qty</th> 
                    <th>Remarks</th>  
                  </tr>
                  </thead> 
                  <tbody>
                    <?php 
                    if(@$ia_items){
                      foreach($ia_items as $rs){
                    ?>
                    <tr id="tr<?=$rs->id?>" class="data-row">
                      <td>
                        <a href="<?=base_url('inventory/view_inventory')?>/<?=$rs->id?>" 
                           class="load_modal_details" 
                           data-bs-toggle="modal" 
                           data-bs-target=".bs-example-modal-lg" 
                           data-modal-size="xl"> 
                           <?=$rs->item_code?>
                        </a>
                        <input type="hidden" name="items[<?=$rs->id?>]" id="added<?=$rs->id?>" value="<?=$rs->id?>"/> 
                        <input type="hidden" name="inventory_id<?=$rs->id?>" value="<?=$rs->id?>"/>
                        <input type="hidden" name="old_qty<?=$rs->id?>" value="<?=$rs->qty?>"/>
                      </td>
                      <td><?=$rs->item_name?></td>
                      <td><?=$rs->brand?></td>
                      <td style="text-align:right;"> 
                        <?=number_format($rs->unit_cost_price,2)?>
                          <input type="hidden" name="unit_cost_price<?=$rs->id?>" value="<?=round($rs->unit_cost_price,2)?>"/>  
                      </td>
                      <td style="text-align:right;"  >
                          <?=number_format($rs->qty,2)?>
                      </td> 
                      <td nowrap style="text-align:center;  width:60px;">
                        
                              <?php if($rs->adjustment_type == 'addition'){?>
                                +
                              <?php }else{?>
                                -
                              <?php }?>
                          <?=$rs->adj_qty?> 
                       
                      </td> 
                      <td style="text-align:right;">
                    
                      <font id="new_qty<?=$rs->id?>"><?= number_format($rs->adjustment_type=='addition' ? ($rs->qty + $rs->adj_qty) : ($rs->qty - $rs->adj_qty),2)?></font>
                      </td>

                      <td style="width:260px;"> 
                        <?=$rs->remarks?> 
                      </td>  

                       
                    </tr>
                    <?php }}?>
                     
                  </tbody>
                </table>
                
                <input type="hidden" name="row_counter" id="row_counter">

                <input type="hidden" id="selected_ids">
          
            
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

 

  var c = 0;
  var all = 0; 
    
 

  function edit_adj(){ 

     Swal.fire({
       title: 'Edit Adjustment',
       text: 'Do you want to edit this adjustment?',
       icon: 'question',
       showCancelButton: true,
       confirmButtonText: 'Continue',
       cancelButtonText: 'Cancel'
     }).then((result) => {
       if (result.isConfirmed) {
         location.href = "<?=base_url('inventory/edit_adjustments/'.$ia->id)?>";
       }  
     });

  }

  function confirm_adj(){ 

     Swal.fire({
       title: 'Confirm Adjustment',
       text: 'Do you want to confirm this adjustment?',
       icon: 'question',
       showCancelButton: true,
       confirmButtonText: 'Continue',
       cancelButtonText: 'Cancel'
     }).then((result) => {
       if (result.isConfirmed) {
         location.href = "<?=base_url('inventory/confirm_adjustments/'.$ia->id)?>";
       }  
     });

  }


  function remove_item(c,id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

   

</script>