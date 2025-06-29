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
                    <h6 class="page-title">Create Stock Adjustments</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                         <a class="btn btn-md btn-primary" href="Javascript:save_adj()"  ><i class="fa fa-save"></i> Save Adjustments</a>
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
              <input type="date" required name="covered_date" id="covered_date" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Adjustment Type *</label>
              <select required name="adjustment_type_id" id="adjustment_type_id" class="form-control" onchange="load_jo(this.value)">
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
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" class="form-control">
            </div>

            <div class="col-md-6 col-sm-12 ">
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
              <tr id="item_selector">
                <td colspan="9" class="add_item">
                  <div class="select2-ajax-adj" style="width: 100%;"></div>
                </td>
              </tr>
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
    
 

  function save_adj() {
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
        text: 'Do you want to save this adjustment?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Save it',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Saving...',
            text: 'Please wait while we save the details.',
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



  function remove_item(c,id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

   

</script>