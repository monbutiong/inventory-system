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
        <h2>Quotation<small>Edit SLA </small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <?php 
        $i_id = @$i->id ? $i->id : 0; 
        ?>
        <form method="post" id="frm_validation" action="<?php echo base_url('sales/update_sla/'.$q->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text"  name="sla_desc" value="<?php echo @$q->sla_desc?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  
 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Margin
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="sla_margin" value="<?php echo @$q->sla_margin?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Amount
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="sla_amount" value="<?php echo @$q->sla_amount?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

        
           
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Save</button>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
                <a href="Javascript:del_this_item()" class="btn btn-danger" >Delete Item</a> 
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 