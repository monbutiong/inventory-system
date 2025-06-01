 <div class="row">
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Report <small>Barcode Sticker</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> 
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <form method="post" id="frm_gen_report" name="frm_gen_report" target="_blank" action="<?php echo base_url();?>report/generate_barcode_report" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <p class="text-muted font-13 m-b-30">
       
        <div class="container">
         
         
          
        <br/>

        <label>Asset Group : </label> 

        <select name="group[]" id="group" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($group){
              foreach($group as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option> 
            <?php  }}?>
        </select> 

        <br/>


        <label>Category : </label>  

        <select name="category[]" id="category" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($category){
              foreach($category as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option> 
            <?php  }}?>
        </select> 
         
        <br/>


        <label>Brand : </label>  

        <select name="brand[]" id="brand" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($brand){
              foreach($brand as $rs){   ?>
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

        <label>Location : </label>  

        <select name="location[]" id="location" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($location){
              foreach($location as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->title;?></option> 
            <?php  }}?>
        </select> 
        

        <!-- 
        <br/>

        <label>Report Type : </label>

        <select name="report_type" id="report_type" class="form-control">
            <option value="">show all fixed asset by group</option> 
            <option value="1">only group grand total</option> 
        </select> 

        --> 

        <br/>

        <label>Asset Status : </label>

        <select name="asset_status" id="asset_status" class="form-control">
            <option value="">All</option> 
            <option value="1">active</option> 
            <option value="2">deleted</option> 
            <option value="3">lost</option> 
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
 