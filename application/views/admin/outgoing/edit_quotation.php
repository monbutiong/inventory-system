<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
  .select2-container--open .select2-dropdown {
    min-width: 400px !important; 
  }
  .select2-container--default .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: 4px;
    top: 16%;
    transform: translateY(-50%);
    z-index: 2;
    cursor: pointer;
  }
</style>
<form method="post" name="quotation_form" id="quotation_form" action="<?=base_url('outgoing/update_quotation/'.$quotation->id)?>" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="page-title-box">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h6 class="page-title">Edit Quotation</h6>
                Date: <?=date('M d, Y', strtotime($quotation->date_created))?>
                <input type="hidden" id="customer_type" name="customer_type" class="form-control ridonly" value="<?=$quotation->customer_type?>">
              </div>
              <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                  <a class="btn btn-md btn-success" href="Javascript:update_quotation()">Update Quotation</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="x_content">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2 mb-3">

                  <label>Valid Until</label>
                  <input type="date" name="valid_until" id="valid_until" class="form-control" value="<?=$quotation->valid_until?>">
                </div>

                <div class="col-md-4 col-sm-12 mb-3 select2">
                  <label >Vehicle Records <a class="load_modal_details" href="<?php echo base_url('outgoing/add_vehicle');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                      (<i class="fa fa-plus"></i>)
                    </a></label>  
                   <?php 
                   if(@$manufacturers){
                   	foreach($manufacturers as $rs){
                   		$arr_manu[$rs->id] = $rs->title;
                   	}
                   }

                   if(@$models){
                   	foreach($models as $rs){
                   		$arr_mod[$rs->id] = $rs->title.' '.$rs->model_year;
                   	}
                   }
                   ?> 
                   <input type="hidden" id="default_vehicle_id" value="<?=$quotation->vehicle_id?>">
                   <input type="hidden" id="default_vehicle_val" value="<?=@$arr_manu[$vehicle->manufacturer_id].' '.$arr_mod[$vehicle->vehicle_model_id]?>"> 
                  <select id="vehicle_select" name="vehicle_id" class="form-control select2-ajax-vehicle">
                  	<option value="<?=@$quotation->vehicle_id?>" selected="selected"><?=@$arr_manu[$vehicle->manufacturer_id].' '.$arr_mod[$vehicle->vehicle_model_id]?></option> 
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                  <label>Plate No.</label>
                  <input type="text" readonly name="plate_no" id="plate_no" class="form-control ridonly" value="<?=$quotation->plate_no?>">
                </div>

                <div class="col-md-3 mb-3">
                  <label>VIN</label>
                  <input type="text" readonly name="vin" id="vin" class="form-control ridonly" value="<?=$quotation->vin?>">
                </div>

                <div class="col-md-2 mb-3">
                  <label>QID</label>
                  <input type="text" name="customer_qid_bus" id="customer_qid_bus" readonly class="form-control ridonly" value="<?=$quotation->customer_qid_bus?>">
                </div>

                <div id="customer_fixed" class="col-md-4 col-sm-12 mb-3" style="display: none;">
                  <label >Customer </label>
                  <input type="text" name="customer" id="customer" readonly class="form-control ridonly">
                </div>

                <div id="customer_selection" class="col-md-4 col-sm-12 mb-3">
                  <label >Customer <a class="load_modal_details" href="<?php echo base_url('outgoing/add_customer');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                      (<i class="fa fa-plus"></i>)
                    </a></label>
                  <select name="customer_id" id="customer_id" class="form-control select2_so_customer">
                     <option value="<?=@$quotation->customer_id?>" selected="selected"><?=$clients->name?></option> 
                  </select>
                </div>

                <div class="col-md-2 mb-3">
                  <label>Contact Number</label>
                  <input type="text" name="phone" id="phone" value="<?=$quotation->phone?>" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                  <label>Remarks</label>
                  <input type="text" name="remarks" id="remarks" value="<?=$quotation->remarks?>" class="form-control">
                </div>
              </div>

              <table id="so_table" class="table table-striped table-bordered table-hover">
                         
                        <thead>
                          <tr style="font-size: 12px;">
                             
                            <th>Part No.</th>
                            <th>Description</th>   
                            <th>Brand</th>
                            <th>Quantity on Hand</th> 
                            <th>Unit Cost Price</th>  
                            <th nowrap>Quantity</th> 
                            <th>Unit Price</th>
                            <th>Line Total</th>
                            <th nowrap>Discount. %</th>
                            <th nowrap>Discount. Amt.</th>
                            <th>Net Total</th>  
                            <th style="width:10px;"></th>  
                          </tr>
                          </thead> 
                          <tbody>
                            <tr id="item_selector">
                              <td colspan="9" class="add_item">
                                <div class="select2-ajax-so" style="width: 100%;"> 
                              </td>
                              <td align="right"><b style="font-size: 15px;">Total</b></td>
                              <td colspan="2" align="right">
                              	QAR <b id="grand_total" style="font-size: 15px;"></b>
                              	<input type="hidden" id="quotation_grand_total" name="quotation_grand_total">
                              </td>
                            </tr> 
                          </tbody>
                        </table>

              <input type="hidden" name="row_counter" id="row_counter" value="<?=@$counter?>">
              <input type="hidden" id="selected_ids">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
 
  var c = 0;
  var all = 0; 
    
  function load_client(id){
    
    $.get("<?=base_url('outgoing/load_client')?>/"+id, function(data) {
        // Handle the response data here
        console.log(data);

        var cli = data.split('-');

        $('#client_id').val(cli[0]);
        $('#client').val(cli[1]);
    })
  }

  function update_quotation(){ 

  	if($('#grand_total').html().trim()=='0.00' || $('#grand_total').html().trim()==''){

  		Swal.fire({
  		    title: "Invalid",
  		    text: "Quotation total amount invalid",
  		    icon: "error",
  		    timer: 1500,
  		    showConfirmButton: false
  		});

  	}else{

	    Swal.fire({
	        title: "Update Quotation?",
	        text: "Do you want to update this quotation now?",
	        icon: "question",
	        showCancelButton: true,
	        confirmButtonText: "Yes, save it",
	        cancelButtonText: "No, cancel",
	        reverseButtons: true
	    }).then((result) => {
	        if (result.isConfirmed) {
	            Swal.fire({
	                title: "Saving...",
	                icon: "info",
	                timer: 1000,
	                showConfirmButton: false
	            });
	            document.quotation_form.submit();
	        } else {
	            Swal.fire({
	                title: "Cancelled",
	                text: "The quotation was not saved.",
	                icon: "error",
	                timer: 1500,
	                showConfirmButton: false
	            });
	        }
	    });

	}


  }
 
  function remove_item(id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

   
</script>