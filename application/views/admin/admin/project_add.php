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
        <h2>Project<small>Add New Project</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('admin/save_project');?>" data-bs-toggle="validator" class="form-horizontal form-label-left">

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Name
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="name" value="<?php echo @$project->name?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Control Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="control_number" value="<?php echo @$project->control_number?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="project_status_id" id="project_status_id" required="required" class="select2_ form-control">
                   <option value="">select</option>
                   <?php 
                   if(@$project_status){
                     foreach($project_status as $rs){?>
                   <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option>
                   <?php }}?>
               </select> 
            </div>
          </div>  

 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Selling Price
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="selling_price" value="<?php echo @$rs->selling_price?>" class="form-control col-md-7 col-xs-12">
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
 
