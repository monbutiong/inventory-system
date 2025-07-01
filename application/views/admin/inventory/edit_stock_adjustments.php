<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_adj" action="<?=base_url('inventory/update_adjustments/'.$ia->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
         
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Edit Stock Adjustments #SA<?=sprintf("%06d",$ia->id)?></h6>
                    Date: <?=date('M d, Y', strtotime($ia->date_created))?><br/>
                    Filed by: <?=$user->name?> 
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
 
                         <a class="btn btn-md btn-primary" href="Javascript:update_adj()"  ><i class="fa fa-save"></i> Update Adjustments</a>

                         <a class="btn btn-md btn-warning" href="<?=base_url('inventory/view_adjustments/'.$ia->id)?>"  >Go Back </a>

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
                    <input type="date" required name="covered_date" id="covered_date" class="form-control" value="<?=$ia->covered_date?>">
                  </div>

                  <div class="col-md-2 col-sm-12 ">
                    <label >Adjustment Type </label>
                    <select name="adjustment_type_id" id="adjustment_type_id" class="form-control" onchange="load_jo(this.value)">
                      <option value="">select</option> 
                      <?php  
                      if($adj_types){
                        foreach ($adj_types as $rs) {
                      ?>
                      <option <?php if($rs->id = $ia->adjustment_type_id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->title?></option>
                    <?php }}?>
                    </select> 
                  </div>
        
                  <div class="col-md-2 col-sm-12 ">
                    <label >Reference Number</label>
                    <input type="text" name="ref_no" id="ref_no" class="form-control" value="<?=$ia->ref_no?>">
                  </div>

                  <div class="col-md-2 col-sm-12 ">
                    <label >Attach Documents</label>
                    <input type="file" name="attach[]" multiple="" class="form-control">
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
                    <textarea name="remarks" id="remarks" class="form-control"><?=$ia->remarks?></textarea>
                  </div>
          
                </div>

              </p>
       
              
              <table id="adj_table" class="table table-striped table-bordered table-hover">
                 
                <thead>
                  <tr style="font-size: 12px;"> 
                    <th>Part No.</th>
                    <th>Description</th>
                    <th>Brand</th>  
                    <th>Unit Cost Price</th> 
                    <th>Stock Qty</th>
                    <th nowrap>Adjustment (+/-)</th>
                    <th>New Qty</th> 
                    <th>Remarks</th>
                    <th></th>  
                  </tr>
                  </thead> 
                  <tbody>
                    <?php 
                    $excluded_ids = '';
                    if(@$ia_items){
                      foreach($ia_items as $rs){

                        $excluded_ids.='('.$rs->id.')-';
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
                        <input type="hidden" name="existing<?=$rs->id?>" value="<?=$rs->adj_item_id?>"/>
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
                        <select id="type<?=$rs->id?>" 
                               name="type<?=$rs->id?>"   
                               style="border:0; background:transparent; text-align:left; width:40px;">
                              <?php if($rs->adjustment_type == 'addition'){?>
                                <option value="addition">+</option>
                                <option value="deduction">-</option>
                              <?php }else{?>
                                <option value="deduction">-</option>
                                <option value="addition">+</option>
                              <?php }?>
                        </select>

                        <input type="number" 
                               id="qty<?=$rs->id?>" 
                               name="qty<?=$rs->id?>" 
                               required 
                               value="<?=$rs->adj_qty?>" 
                               min="1" 
                               class="itemclass"  
                               style="border:0; background:transparent; text-align:right; width:40px;">
                        <input type="hidden" name="issued_qty<?=$rs->id?>" />
                       
                      </td> 
                      <td style="text-align:right;">
                    
                      <font id="new_qty<?=$rs->id?>"><?= $rs->adjustment_type=='addition' ? ((int)$rs->qty + (int)$rs->adj_qty) : ((int)$rs->qty - (int)$rs->adj_qty)?></font>
                      </td>

                      <td style="text-align:center;  width:260px;"> 
                        <input type="text" 
                               id="remarks<?=$rs->id?>" 
                               name="remarks<?=$rs->id?>"value="<?=$rs->remarks?>"   
                               style="border:0; background:transparent; text-align:left; width:260px;">
                      </td>  

                      <td style="text-align:center;">
                        <a href="javascript:remove_item(<?=$rs->id?>)">
                          <i title="remove" class="fa fa-trash" style="color:red"></i>
                        </a>
                      </td>
                    </tr>
                    <?php @$countah+=1; }}?>
                    <tr id="item_selector">
                      <td colspan="9" class="add_item">
                        <div class="select2-ajax-adj" style="width: 100%;"></div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                
                <input type="hidden" name="row_counter" id="row_counter" value="<?=@$countah?>">

                <input type="hidden" id="selected_ids" value="<?=$excluded_ids?>">
          
            
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

 // 201919
 // 198991

 

 function update_adj() {
   if ($('.itemclass').length == 0){
     Swal.fire({
       icon: 'warning',
       title: 'Missing Items',
       text: 'Please add an item to the list before submitting.',
     });
   } else if ($('#adjustment_type_id').val() === '') {
     Swal.fire({
       icon: 'warning',
       title: 'Missing Adjustment Type',
       text: 'Please select an adjustment type before submitting.',
     });
   } else if ($('#issued_date').val() === '') {
     Swal.fire({
       icon: 'warning',
       title: 'Missing Issue Date',
       text: 'Please enter the issue date before proceeding.',
     });
   } else {
     Swal.fire({
       title: 'Confirm Save',
       text: 'Do you want to update this adjustment?',
       icon: 'question',
       showCancelButton: true,
       confirmButtonText: 'Yes, Update it',
       cancelButtonText: 'Cancel'
     }).then((result) => {
       if (result.isConfirmed) {
         Swal.fire({
           title: 'Saving...',
           text: 'Please wait while we update the details.',
           icon: 'info',
           showConfirmButton: false,
           allowOutsideClick: false,
           timer: 1500
         });
         document.frm_adj.submit();
       } else {
         Swal.fire({
           title: 'Cancelled',
           text: 'Adjustment was not saved.',
           icon: 'info',
           timer: 1200,
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
  }

   

</script>