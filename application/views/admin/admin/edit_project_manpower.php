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
        <h2>Project<small>Edit Project Manpower</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('admin/update_project_manpower/'.$project_id.'/'.$pm->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

         

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Employee
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" disabled value="<?php echo @$emp->first_name.' '.@$emp->last_name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="date" name="work_date" value="<?php echo @$pm->work_date?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Time In
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="time_in" value="<?php echo @$pm->time_in?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Time Out
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="time_out" value="<?php echo @$pm->time_out?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Workload
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="workload" value="<?php echo @$pm->workload?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

 
 
        
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
 
