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
        <h2>Project<small>Add Overhead Cost for <?=@$pcn->control_number?></small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('admin/project_overhead_cost_save/'.$cid);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          <input type="hidden" name="project_id" value="<?=$id?>">
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Overhead Cost
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">

                <input type="hidden" name="control_number_id" value="<?=$pcn->id?>">
                <input type="hidden" name="project_id" value="<?=$pcn->project_id?>">
                
                <select name="overhead_cost_id" id="overhead_cost_id" required="required" class="select2_ form-control">
                   <option value="">select</option>
                   <?php 
                   if(@$overhead_cost){
                     foreach($overhead_cost as $rs){?>
                   <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                   <?php }}?>
               </select> 
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="date" name="overhead_cost_date" value="<?php echo @$oc->overhead_cost_date?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>   

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Amount
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="amount" value="<?php echo @$oc->amount?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <?php 
          if(@$currency_type){
            foreach ($currency_type as $rs) { 
              if(strtolower($rs->title) != 'php'){
          ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?=$rs->title?> Rate
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="bsp_rates[<?=$rs->id?>]" value="<?=$rs->vs_peso_rate?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>   
          <?php }}}?>
        
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Submit</button>
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
