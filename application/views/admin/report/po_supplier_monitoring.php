 <div class="row">
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Report <small>Purchase Order from Supplier Monitoring</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> 
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <form method="post" id="frm_gen_report" name="frm_gen_report" target="_blank" action="<?php echo base_url();?>reports/generate_po_supplier_monitoring" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <p class="text-muted font-13 m-b-30">
       
        <div class="container">
        
        <label>Project : </label> 

        <select name="projects_control_number[]" id="projects_control_number" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($projects_control_number){
              foreach($projects_control_number as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->control_number;?></option> 
            <?php  }}?>
        </select>  
          
        <br/> 

        <label>Supplier : </label> 

        <select name="supplier[]" id="supplier" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($suppliers){
              foreach($suppliers as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option> 
            <?php  }}?>
        </select>  
          
        <br/>

        <label>Filter By Payment Status : </label> 
        <select name="pay_status" id="date_by" class="form-control" >
            <option value="0">All</option>
            <option value="1">Paid</option>
            <option value="2">Unpaid</option>
        </select>  

        <br/>

        <label>Filter By Date : </label> 
        <select name="date_by" id="date_by" class="form-control" >
            <option value="1">P.O. Date</option>
            <option value="2">Recieving Date</option>
        </select>  
          
        <br/>
 

        <label>Date From : </label> 

        <input type="date" name="date_from" id="date_from" class="form-control"> 

        <br/>

        <label>Date To : </label> 

        <input type="date" name="date_to" id="date_to" class="form-control"> 

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
 