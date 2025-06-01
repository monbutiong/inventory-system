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
        <h2>Inventory<small>Add New Item</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?=base_url('inventory/update_item/'.$i->id)?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Part Number <font id="exist" style="display: none;" color="red">(exist)</font> 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" value="<?=$i->item_code?>" id="item_code" name="item_code" required onkeyup="chk_item_code(this.value)" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" value="<?=$i->item_name?>" id="item_name" name="item_name" required class="form-control col-md-7 col-xs-12">
            </div>
          </div>
   
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Manufacturer Price
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="number" step="any" min="0" value="<?=$i->manufacturer_price?>" id="manufacturer_price" name="manufacturer_price" required class="form-control col-md-7 col-xs-12">
            </div>
          </div>
   

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               
                <button id="close_new" class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit"  class="btn btn-success">Save</button>
  
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
 <script type="text/javascript">
   
  function chk_item_code(val){

      $.post("<?=base_url('inventory/check_item_code')?>", {item_code: val, e_code:'<?=$i->item_code?>'}, function(result){
        if(result==1){
          $('#exist').show();
        }else{
          $('#exist').hide();
        }
      });

  }

 


 </script>
