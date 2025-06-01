<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
 
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
        <h2>Project<small>Edit Job Order</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form method="post" id="frm_validation" action="<?php echo base_url('projects/update_job_order/'.$jo->id);?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Job Order No
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" readonly value="<?=$jo->job_order_number?>" class="form-control col-md-7 col-xs-12 ridonly">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 select2_">Quotation
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select type="text" name="quotation_id" onchange="load_quote(this.value)" class="form-control col-md-7 col-xs-12 select2">
                <option value="">select</option>
                <?php 
                if($quotations){
                  foreach ($quotations as $rs) { 
                ?>
                <option <?php if($jo->quotation_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->quotation_number?></option>
                <?php }}?>
              </select>
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  >Project
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="project" readonly class="form-control col-md-7 col-xs-12 ridonly">
            </div>
          </div>  

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Client
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="client" readonly class="form-control col-md-7 col-xs-12 ridonly">
            </div>
          </div>    

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Project Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea type="text" id="project_description" rows="5" readonly class="form-control col-md-7 col-xs-12 ridonly"></textarea>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Job Order Description
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea type="text" name="description" rows="5" class="form-control col-md-7 col-xs-12"></textarea>
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
 <script type="text/javascript">
    $('.select2').select2();

    function load_quote(id){
      $.ajax({
          url: '<?=base_url("projects/load_quote")?>/'+id, // Replace with your API endpoint
          type: 'GET', 
          success: function(response) { 
              console.log('GGG',JSON.parse(response)); 

              var data = JSON.parse(response);

              $('#project').val(data.project.name);
              $('#client').val(data.client.name);
              $('#project_description').val(data.quotation.description);
          } 
      });
    }

    load_quote(<?=$jo->quotation_id?>);

 </script>