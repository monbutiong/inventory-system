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
        <h2>Project<small>Add BSP Currency Rate</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('accounts/save_bsp_rate');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="date" name="date_for" value="<?php echo @$bsp_rate->date_for?>" class="form-control col-md-7 col-xs-12" required>
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">JPY to PHP Rate
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="jpy_to_php" value="<?php echo @$bsp_rate->jpy_to_php?>" class="form-control col-md-7 col-xs-12" required>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">USD to JPY Rate
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="usd_to_jpy" value="<?php echo @$bsp_rate->usd_to_jpy?>" class="form-control col-md-7 col-xs-12" required>
            </div>
          </div>            

          <!-- <?php 
          if(@$currency_type){
            foreach($currency_type as $rs){
              if(strtolower($rs->title) != 'php'){
          ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"><?=$rs->title?> Rate
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="bsp_rates[<?=$rs->id?>]" value="<?php echo @$bsp_rate->date_for?>" class="form-control col-md-7 col-xs-12" required>
            </div>
          </div> 
          <?php }}}?> -->
 
        
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
 
