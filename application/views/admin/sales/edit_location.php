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
        <h2>Quotation<small>Edit Location</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('sales/update_location/'.$q->quotation_id.'/'.$q->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">
 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="location_name" value="<?php echo @$q->location_name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  
  
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Save Location</button>

                <a href="Javascript:del_this_loc();" class="btn btn-danger" >Delete Location </a> 
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  function del_this_loc(){
    reset(); 

    alertify.confirm("delete location and all items under this location?", function (e) {
          if (e) {  
              alertify.log("deleting...");
              location.href = "<?php echo base_url();?>sales/delete_loc/<?=$q->quotation_id?>/<?=$q->id?>/";
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }
</script>
