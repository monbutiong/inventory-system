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
        <h2>Project<small>Add Activity</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('projects/save_progress/'.$pid.'/'.$client_id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
 
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Title
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" required name="title" value="<?php echo @$progress->title?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Activity Type
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="activity_type_id" required class="form-control col-md-7 col-xs-12" rows="10">
                <option value="">Select</option>
                <?php 
                if(@$activity_type){
                  foreach ($activity_type as $rs) {
                ?>
                <option value="<?=$rs->id?>"><?=$rs->title?></option>
                <?php }}?>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="date" name="date_cover" value="<?php echo @$progress->date?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="description"   class="form-control col-md-7 col-xs-12" rows="10"><?php echo @$progress->description?></textarea>
            </div>
          </div>  

          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">File Attachements
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="attachments[]" multiple class="form-control col-md-7 col-xs-12">
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
 
