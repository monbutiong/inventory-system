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
        <h2>Project<small>Add Project</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('projects/save_project/'.@$client_id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
 
        
          <?php if(!@$quotation){?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client *
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="client_id"  required  class="form-control col-md-7 col-xs-12">
                <?php if(!@$client_id){?>
                <option value="">Select</option>
                <?php }
                if(@$clients){
                  foreach ($clients as $rs) { 
                    if(!@$client_id || (@$client_id && @$client_id==$rs->id)){
                ?>
                <option value="<?=$rs->id?>"><?=$rs->name?></option>
                <?php }}}?>
              </select>
            </div>
          </div>  
          <?php  }?>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Name *
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="name"  required  class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Person
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_person"   class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="contact_number"   class="form-control col-md-7 col-xs-12">
            </div>
          </div>    

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="email"   class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Manager
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="project_manager"   class="form-control col-md-7 col-xs-12 select2_">
                <option value="0">Select</option>
                <?php 
                if($emp){
                  foreach ($emp as $rs) {
                ?>
                <option value="<?=$rs->id?>"><?=$rs->first_name.' '.$rs->last_name?></option>
                <?php }}?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea type="text" name="description"   class="form-control col-md-7 col-xs-12"></textarea>
            </div>
          </div>   

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Notes
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea type="text" name="notes"   class="form-control col-md-7 col-xs-12"></textarea>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Location
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="location"   class="form-control col-md-7 col-xs-12">
            </div>
          </div>    

          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
                <?php if(@$quotation == 1){?>
                  <a href="Javascript:save_project()" class="btn btn-success">Submit</a>
                <?php }else{?>  
                  <button type="submit" class="btn btn-success">Submit</button>
                <?php }?>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div> 
 
<script type="text/javascript">
  function save_project(){
    if(){
    }
  }
</script>