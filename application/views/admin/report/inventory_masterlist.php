 <div class="row">
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Report <small>Inventory Masterlist</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> 
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <form method="post" id="frm_gen_report" name="frm_gen_report" target="_blank" action="<?php echo base_url();?>reports/generate_inventory_masterlist" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <p class="text-muted font-13 m-b-30">
       
        <div class="container">
         

        <label>Category : </label> 

        <select name="category[]" id="category" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($category){
              foreach($category as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option> 
            <?php  }}?>
        </select>  
          
        <br/>

        <label>Type : </label> 

        <select name="type[]" id="type" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($type){
              foreach($type as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option> 
            <?php  }}?>
        </select>   

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
 