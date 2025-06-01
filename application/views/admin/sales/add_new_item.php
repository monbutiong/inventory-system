<style>
.datepicker{z-index:1151 !important;}
#datatable 
{    
  overflow-y:hidden; 
}
select, .text_input {
    border: 1px solid #fff;
    background-color: transparent;
} 
.vcc{
  border-bottom-color: #999;
}
</style>
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Quotation<small>Add Item to <?=@$local_manpower ? strtoupper($local_manpower) : $quotations_locations->location_name?></small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_new_item" data-bs-toggle="validator" class="form-horizontal form-label-left">

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Brand/Supplier
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="supplier" id="supp_name" class="form-control col-md-7 col-xs-12 select2_" onchange="load_new_supp(this.value)">
                <option value="">select</option>
                <option value="new">Enter New Supplier</option>
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                ?>
                <option value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}?>
              </select>
            </div>
          </div>  

          <div class="form-group" id="new_supp" style="display: none;">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Supplier Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="supplier_name"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <script type="text/javascript">
            function load_new_supp(v){
              if(v=='new'){
                $('#new_supp').show();
              }else{
                $('#new_supp').hide();
              }
            }
          </script>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Part Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="item_code" id="item_code" value="<?php echo @$i->item_code?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="item_name" id="item_name" required value="<?php echo @$i->item_name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="qty" id="qty" required value="<?php echo @$i->qty?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit Price
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="unit_cost" id="unit_cost" value="<?php echo @$i->unit_cost?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Discount %
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="discount_percentage" id="discount" value="<?php echo @$i->discount_percentage?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">L/C Rate
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="landed_cost_rate_id" id="landed_rate" required class="form-control col-md-7 col-xs-12">
                <option value="">select</option>
                <?php 
                if($lcr){
                  foreach ($lcr as $rs) {
                ?>
                <option  value="<?=$rs->id?>"><?=$rs->landed_cost_rate?></option>
                <?php }}?>
                <option <?php if(@$local_manpower=='local'){echo 'selected';}?> value="LOCAL">( Location: LOCAL )</option>
                <option <?php if(@$local_manpower=='manpower'){echo 'selected';}?> value="MANPOWER">( Location: MANPOWER )</option>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Margin %
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="margin" id="margin" value="<?php echo @$quotation->margin?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="button" onclick="save_new_item()" class="btn btn-success">Save New Item</button>
 
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
<script type="text/javascript">
  $('.select2_').select2();
  
  function save_new_item(){

    // Create a FormData object
    var formData = new FormData($("#frm_new_item")[0]);

    // Perform the POST request using $.ajax()
    $.ajax({
        url: base_url + 'sales/save_item/<?=$qid?>/<?=$quotations_locations->id?>/1',
        type: "POST",
        data: formData,
        contentType: false, // Set to false for FormData
        processData: false, // Set to false for FormData
        success: function(item_id) {

          var supp_name = $('#supp_name option:selected').text();
          var item_code = $('#item_code').val();
          var item_name = $('#item_name').val();
          var qty = $('#qty').val();
          var landed_rate = $('#landed_rate option:selected').text();
          var unit_cost = $('#unit_cost').val();
          var discount = $('#discount').val(); 
          var margin = $('#margin').val(); 
            
            <?php if(@$local_manpower){?>
              $('#add_item_row_manpower').before(' <tr id="irow<?=$counter?>"><td scope="row"><?=@$counter;?></td> <td>'+supp_name+'</td> <td><input type="text" id="item_code'+item_id+'" onkeyup="update_item('+item_id+')" value="'+item_code+'" style="border: 0; width: 100%;"></td> <td><input type="text" id="item_name'+item_id+'" onkeyup="update_item('+item_id+')" value="'+item_name+'" style="border: 0; width: 100%;"> </td> <td></td> <td><input type="number" id="qty'+item_id+'" onkeyup="update_item('+item_id+')" value="'+qty+'" style="border: 0; width: 70px;"></td> <td>LOCAL PURCHASE</td> <td><input type="number" id="unit_price'+item_id+'" onkeyup="update_item('+item_id+')" value="'+unit_cost+'" style="border: 0; width: 140px;"> </td> <td nowrap><input type="number" maxlength="2" id="discount'+item_id+'" onkeyup="update_item('+item_id+')" value="'+discount+'" style="border: 0; width: 50px;"> %</td> <td nowrap> <a href="Javascript:idel("<?=$local_manpower?>",'+item_id+',<?=$counter?>)" ><i class="fa fa-trash"></i> delete</a> </td> </tr>');
            <?php }else{?>
              $('#location_table<?=$quotations_locations->id?> tr:last').after(' <tr id="irow<?=$counter?>"><td scope="row"><?=@$counter;?></td> <td>'+supp_name+'</td> <td>'+item_code+'</td> <td>'+item_name+'</td> <td>'+qty+'</td> <td>'+landed_rate+'</td> <td>'+unit_cost+'</td> <td>'+discount+'%</td> <td nowrap> <a href="Javascript:idel(1,'+item_id+',<?=$counter?>)" ><i class="fa fa-trash"></i> delete</a> </td> </tr>');
            <?php }?>

              $('#global_modal').modal('hide');
        }
    });

  }
</script>