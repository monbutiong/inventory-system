<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>BIB Inventory Per Serial Number <small>Masterlist</small></h2> 
           

            <div class="input-group-btn pull-right" style="padding-right: 100px;">
            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select Actions <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
            
            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>home/add_new_bib" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add New BIB</a>
            </li>
            
            <li class="divider"></li>
 
            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BIB Storage</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/1" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BIB Retrival</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/3" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BIB for PM</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/4" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Repair IN</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/5" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Repair OUT</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/6" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Engineering Evaluation</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/7" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Return BIB (Interval)</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/8" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Return BIB (Interval)</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/9" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Quality Alert IN</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/10" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Quality Alert OUT</a>
            </li>

            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/bib_operation/11" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Scrap</a>
            </li>
           
            <li>
              <a class="dropdown-item load_modal_details" href="<?php echo base_url();?>bib/" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Sample</a>
            </li>

   
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>
         
        <table id="datatable2" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>BIB Name</th>
              <th>BIB S/N</th>
              <th>Customer</th>
              <th>Pckage Type & Lead Count</th>
              <th>Device Number</th>
              <th>BIB Type</th>
              <th>Socket Density</th>  
              <th>Good Socket</th> 
              <th>Bad Socket</th> 
              <th>Socket Availability</th> 
              <th>Location</th>  
              <th>Status</th> 
              <th>Option</th>  
            </tr>
          </thead>  

        </table>
      </div>
    </div>
  </div> 
   
</div>

<script type="text/javascript">
function delete_bib(id){
  reset(); 

  alertify.confirm("delete bib information? this will permanently delete selected bib records.", function (e) {
        if (e) {  
            alertify.log("deleting...");
            location.href = "<?php echo base_url();?>home/delete_bib/"+id;
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}
</script>
 

