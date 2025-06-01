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
        <h2>Quotation<small>Edit Item</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('sales/update_item/'.$qid.'/'.$i->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Brand/Supplier
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="supplier"  class="form-control col-md-7 col-xs-12 select2" onchange="load_new_supp(this.value)">
                <option value="">select</option>
                <option value="new">Enter New Supplier</option>
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                ?>
                <option <?php if($rs->id==$i->supplier){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->name?></option>
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
              <input type="text" name="item_code" value="<?php echo @$i->item_code?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="item_name" value="<?php echo @$i->item_name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantity
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="qty" value="<?php echo @$i->qty?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit Price
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="unit_cost" value="<?php echo @$i->unit_cost?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Discount %
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="discount_percentage" value="<?php echo @$i->discount_percentage?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">L/C Rate
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> 
              <select name="landed_cost_rate_id"  class="form-control col-md-7 col-xs-12">
                <option value="0">Select</option>
                <option value="LOCAL" <?php if($i->is_local==1){echo 'selected';}?> >LOCAL MATERIALS</option>
                <option <?php if($i->is_manpower==1){echo 'selected';}?>>MANPOWER</option>
                <?php 
                if($lcr){
                  foreach ($lcr as $rs) {
                ?>
                <option <?php if($rs->id==$i->landed_cost_rate_id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->landed_cost_rate?></option>
                <?php }}?>

              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Package
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="package_id" class="form-control col-md-7 col-xs-12" onchange="ifNew(this.value)">
                <option value="">select</option>
                <option value="new">New Package</option>
                <?php 
                if($packages){
                  foreach ($packages as $rs) {
                ?>
                <option  value="<?=$rs->id?>"><?=$rs->package_name?></option>
                <?php }}?>

              </select>
            </div>
          </div> 

          <div class="form-group" id="new_pak" style="display: none;">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Package Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="package_name" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <script type="text/javascript">
            function ifNew(v){
              if(v=='new'){
                $('#new_pak').show();
              }else{
                $('#new_pak').hide();
              }
            }
          </script>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Margin %
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" name="margin" id="margin" onkeyup="max_margin(this.value)" value="<?php echo @$i->margin?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Save Item</button>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
                <a href="Javascript:del_this_item()" class="btn btn-danger" >Delete Item</a> 
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">

  function max_margin(m){
    if(m > 100){
      $('#margin').val(99);
    } 
  }

  function del_this_item(){
    reset(); 

    alertify.confirm("delete item?", function (e) {
          if (e) {  
              alertify.log("deleting...");
              location.href = "<?php echo base_url();?>sales/delete_item/<?=$qid?>/<?=$i->id?>/";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }
</script>