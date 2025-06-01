 <div class="row">
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Report <small>CRV Report</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li> 
           
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <form method="post" id="frm_gen_report" name="frm_gen_report" target="_blank" action="<?php echo base_url();?>receipt/generate_report" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <p class="text-muted font-13 m-b-30">
       
        <div class="container">
 

        <label>Payment Type : </label> 

        <select name="payment_type[]" id="payment_type" class="multiselect-ui form-control" multiple="multiple">
            <option value="1">Cash</option>
            <option value="2">Cheque</option>
            <option value="3">Debit/Credit Card</option> 
            <option value="4">Transfer</option>
        </select>  
          
        <br/>  
        
        <label>Project : </label> 

        <select name="projects[]" id="projects" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($projects){
              foreach($projects as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option> 
            <?php  }}?>
        </select>  
          
        <br/> 

        <label>Ventum Tech Branches: </label> 

        <select name="company[]" id="company" class="multiselect-ui form-control" multiple="multiple">
            <?php 
            if(@$company){
              foreach($company as $rs){
            ?>
            <option value="<?=$rs->id?>"><?=$rs->name?></option>
            <?php }}?> 
        </select>  
          
        <br/>

        <label>Client : </label> 

        <select name="client[]" id="client" class="multiselect-ui form-control" multiple="multiple">
            <?php  

            if($client){
              foreach($client as $rs){   ?>
            <option value="<?php echo $rs->id;?>"><?php echo $rs->name;?></option> 
            <?php  }}?>
        </select>

       
        <br/>

        <label>Transaction Date From : </label> 

        <input type="date" name="date_from" id="date_from" class="form-control"> 

        <br/>

        <label>Transaction Date To : </label> 

        <input type="date" name="date_to" id="date_to" class="form-control"> 

        <br/>

        <label>Export To Excel : </label>

        <select name="export_to_excel" id="export_to_excel" class="form-control">
            <option value="0">no</option> 
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
 