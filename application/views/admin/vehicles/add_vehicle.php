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
 
<form method="post" id="frm_validation" action="<?php echo base_url('vehicles/save_vehicle');?>" data-bs-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Create New Vehicle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <br />
        
 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Car Picture
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="picture_1" class="form-control col-md-7 col-xs-12">
              <input type="file" name="picture_2" class="form-control col-md-7 col-xs-12">
              <input type="file" name="picture_3" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Plate Number *
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="plate_no" onblur="check_plate(this.value)" value="<?php echo @$vehicle->plate_no?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">VIN *
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" required name="vin" onblur="check_vin(this.value)" value="<?php echo @$vehicle->vin?>" class="form-control col-md-7 col-xs-12">
            </div>
          </div>  

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Manufacturer *
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select required onchange="load_only_selected_manu(this.value)" name="manufacturer_id" class="form-control col-md-7 col-xs-12 select2">
            	<option value=""></option>
            	<?php 
            	if(@$manufacturers){
            		foreach($manufacturers as $rs){
            	?>
            	<option value="<?=$rs->id?>"><?=$rs->title?></option>
            	<?php }}?>
             </select>
            </div>
          </div> 

          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Model * 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12" id="load_models">
              <select required id="vehicle_model_id" name="vehicle_model_id" class="form-control col-md-7 col-xs-12 select2">
              	<option value=""></option>
              	<?php 
              	if(@$models){
              		foreach($models as $rs){
              	?>
              	<option data-manufacturer="<?=$rs->manufacturer_id?>" value="<?=$rs->id?>"><?=$rs->title?> - <?=$rs->model_year?></option>
              	<?php }}?>
               </select>
            </div>
          </div>  
 
          <div class="row mb-3">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="customer_id" class="form-control col-md-7 col-xs-12 select2">
              	<option value="">Select</option>
              	<?php 
              	if(@$customers){
              		foreach($customers as $rs){
              	?>
              	<option value="<?=$rs->id?>"><?=$rs->qid ? $rs->qid.' | ' : ''?> <?=$rs->name?></option>
              	<?php }}?>
              </select>
            </div>
          </div>  

           
          
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-success">Submit</button>
        </div>

      </form>
    </div>
  </div>
</div> 
<script type="text/javascript">
	function load_only_selected_manu(manufacturer_id) {
	     $('#load_models').load('<?=base_url("vehicles/load_model")?>/' + manufacturer_id);

	     
	}
 
	function check_plate(v) {
		$.post("<?=base_url('vehicles/check_plate_no')?>", 
		{
		    plate_no: v 
		}, 
		function(res) {
		    if(res == 1){
		    	Swal.fire({
		    	title: "Error!",
		    	text: "Plate Number " + v + " already exist!",
		    	icon: "error",
		    	confirmButtonColor: "#556ee6", // OK button color
		    	showCancelButton: false // No Cancel button
		    	});
		    } 
		});
	}

	function check_vin(v) {
		$.post("<?=base_url('vehicles/check_vin')?>", 
		{
		    vin: v 
		}, 
		function(res) {
		    if(res == 1){
		    	Swal.fire({
		    	title: "Error!",
		    	text: "VIN " + v + " already exist!",
		    	icon: "error",
		    	confirmButtonColor: "#556ee6", // OK button color
		    	showCancelButton: false // No Cancel button
		    	});
		    } 
		});
	}
</script>