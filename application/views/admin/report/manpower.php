 <div class="row">
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Report <small>Manpower</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> 
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <form method="post" id="frm_gen_report" name="frm_gen_report" target="_blank" action="<?php echo base_url();?>reports/generate_manpower" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <p class="text-muted font-13 m-b-30">
       
        <div class="container">
        
        <label>Project : </label> 

        <select name="projects[]" id="projects" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($projects){
              foreach($projects as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->control_number.' '.$rs->name;?></option> 
            <?php  }}?>
        </select>  
          
        <br/> 

        <label>Employee : </label> 

        <select name="employees[]" id="employees" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($employees){
              foreach($employees as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->employee_number.' '.$rs->first_name.' '.$rs->last_name;?></option> 
            <?php  }}?>
        </select>  
          
        <br/>

        <label>Date From : </label> 

        <input type="date" name="date_from" id="date_from" class="form-control"> 

        <br/>

        <label>Date To : </label> 

        <input type="date" name="date_from" id="date_from" class="form-control"> 

        <br/>

        <label>Export To Excel : </label>

        <select name="export_to_excel" id="export_to_excel" class="form-control">
            <option value="">no</option> 
            <option value="1">yes</option> 
        </select>  

        <br/>

         

        </div>  

        <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> 
              <button type="submit" class="btn btn-success">Generate</button>
            </div>
          </div>
    </form>
      </div>
    </div>
  </div> 
 
   
</div> 
 