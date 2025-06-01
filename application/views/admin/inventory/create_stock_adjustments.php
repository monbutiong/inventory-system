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
        <h2>Inventory <small>Create Stock Adjustments</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 110px;">
                  <a class="btn btn-sm btn-primary" href="Javascript:save_adj()"  >Save Adjustments</a>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            
          <div class="row">

            <div class="col-md-2 col-sm-12 ">
              <label >Inventory Return Number</label>
              <input type="text" readonly class="form-control ridonly" value="AJ<?=sprintf("%06d",count($this->db->select('id')->get_where('inventory_adjustments',['deleted'=>0])->result())+1);?>">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Adjustment Type </label>
              <select name="adjustment_type_id" id="adjustment_type_id" class="form-control select2_" onchange="load_jo(this.value)">
                <option value="">select</option> 
                <?php  
                if($adj_types){
                  foreach ($adj_types as $rs) {
                ?>
                <option  value="<?=$rs->id?>"><?=$rs->title?></option>
              <?php }}?>
              </select>
              
            </div>
 
            <div class="col-md-2 col-sm-12 ">
              <label >Covered Date *</label>
              <input type="date" required name="covered_date" id="covered_date" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" class="form-control">
            </div>

            <div class="col-md-4 col-sm-12 ">
              <label >Attach Documents</label>
              <input type="file" name="attach[]" multiple="" class="form-control">
            </div>
 
            <div class="col-md-12 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" id="remarks" class="form-control"></textarea>
            </div>
   
 
          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
               
              <th>Part No.</th>
              <th>Description</th>  
              <th>Unit Cost Price</th> 
              <th>Stock Qty</th>
              <th>Adjustment</th>
              <th>New Qty</th> 
              <th>Remarks</th>
              <th></th>  
            </tr>
            </thead> 
            <tbody>
              <tr id="item_selector">
                <td colspan="9" class="add_item">
                  <div class="select2-ajax" style="width: 100%;"> 
                </td>
              </tr>
            </tbody>
          </table>
          
          <input type="hidden" name="row_counter" id="row_counter">

          <input type="hidden" id="selected_ids">
          
          <!-- <table class="table" id="add_item_section" >
            <tr>
              <td colspan="7" id="add_row">
                <a id="add_item_link" class="btn btn-info load_modal_details" href="<?php echo base_url('outgoing/issue_batch');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add By Batch</a> 
              </td>
            </tr>
          </table>   -->    
         
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

 // 201919
 // 198991

 function update_adj(v,id,qty){ 
    // Convert v and qty to numbers (assuming they are strings or other types)
    v = Number(v);
    qty = Number(qty);

    // Check if v is negative or non-negative
    if (v < 0) {
      // If v is negative, deduct its absolute value from the quantity
      var updatedQty = qty - Math.abs(v);
    } else {
      // If v is non-negative, add it to the quantity
      var updatedQty = qty + v;
    }

    // Update the #adj_qty element with the new quantity
    $('#new_qty' + id).val(updatedQty);
 }

 function update_new_qty(v,id,qty){

  v = Number(v);
  qty = Number(qty);

  if(v>=qty){
    $('#adj_qty'+id).val(v-qty);
  }else{
    $('#adj_qty'+id).val('-'+(qty-v));
  }
  
 }

  var c = 0;
  var all = 0; 
    
 

  function save_adj(){ 

    if($('#adjustment_type_id').val() == ''){
      alertify.error("Adjustment type id is required");
    }else if($('#issued_date').val() == ''){
      alertify.error("Issue date is required"); 
    }else{

      reset(); 

      alertify.confirm("Save adjustments details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_adj.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

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