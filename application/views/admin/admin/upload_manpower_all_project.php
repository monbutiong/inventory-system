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
        <h2>Project<small>Upload Manpower</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" target="_blank" id="frm_validation" action="<?php echo base_url('admin/upload_project_manpower_all');?>"  class="form-horizontal form-label-left" enctype="multipart/form-data">

          

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Attach Template
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="file_template" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Upload Type
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="uplaod_type" class="form-control col-md-7 col-xs-12">
                <option value="0">Upload and review</option>
                <option value="1">Upload and save</option>
              </select>
            </div>
          </div>  
 
        
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                
                <a download class="btn btn-sm btn-info" href="<?php echo base_url('assets/downloadables/project_manpower_all_project.csv');?>" style="margin-right: 40px;" >Download Template (.csv)</a>

                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <button type="submit" class="btn btn-success">Submit</button>
               
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
