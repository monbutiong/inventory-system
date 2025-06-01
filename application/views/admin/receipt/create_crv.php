<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_crv" action="<?=base_url('receipt/save_crv/'.@$project->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Receipt <small>Create Cash Receipt Voucher</small></h2> 
 			
 		    <?php if(@$project->id || @$client->id){?>
          <div class="input-group-btn pull-right" style="padding-right: 140px;">
              <a class="btn btn-sm btn-danger" href="Javascript:cancel_crv()"  >Cancel</a>
              <a class="btn btn-sm btn-primary" href="Javascript:save_crv()"  >Save CRV</a>
          </div>
        <?php }else{?>
        	<div class="input-group-btn pull-right" style="padding-right: 120px;"> 
              <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Create New
                </button>
                <div class="dropdown-menu">
                  <lu>
                    <li><a class="btn btn-sm btn-success load_modal_details" style="margin: 10px !important;" href="<?=base_url('projects/load_project_list');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Project</a></li>
                    <li><a class="btn btn-sm btn-success load_modal_details" style="margin: 10px !important;" href="<?=base_url('projects/load_client_list');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >AR Payments</a></li>
                  </lu> 
                </div>
              </div>
          </div>
          <div class="input-group-btn pull-right" style="display: none;"> 
        	    <a class="btn btn-sm btn-success load_modal_details" href="<?=base_url('projects/load_project_list');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Create New For Project</a>
        	</div>	
          <div class="input-group-btn pull-right" style="display: none;"> 
              <a class="btn btn-sm btn-success load_modal_details" href="<?=base_url('projects/load_client_list');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Create New For Client</a>
          </div>  
        <?php }?>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> 

          <div class="row">
          	
          	<div class="col-md-3 col-sm-12 ">
          	 
          	  
              <div class="x_panel tile">
              <div class="x_title">Daily Collection</div>
 
                  <?php
                  $total_paid = 0;
                  if(@$crv){
                    foreach ($crv as $rs) {
                      @$arr_pt_count[$rs->payment_mode]+=1;
                      @$arr_pt_amt[$rs->payment_mode]+=$rs->amount_received;
                      $total_paid+=$rs->amount_received;
                    }
                  }
                  ?>
                  <table border="0" width="100%">
                    <tr>
                      <!-- <td width="20"><input type="radio" id="pt1" name="payment_mode" value="1" onchange="pt_change(1);"></td> -->
                      <td><label for="pt1">Cash</label></td>
                      <td width="50"><input readonly type="text" id="pt_coun1" class="form-control rid_only" value="<?=@$arr_pt_count[1] ?? 0?>"></td>
                      <td><input type="text" readonly id="pt_amt1" class="form-control rid_only" style="text-align: right;" value="<?=number_format(@$arr_pt_amt[1] ?? 0,2)?>"></td>
                    </tr>
                    <tr>
                      <!-- <td width="20"><input type="radio" id="pt2" name="payment_mode" value="2" onchange="pt_change(2);"></td> -->
                      <td><label for="pt2">Cheque</label></td>
                      <td width="50"><input readonly type="text" id="pt_coun1" class="form-control rid_only" value="<?=@$arr_pt_count[2] ?? 0?>"></td>
                      <td><input type="text" readonly id="pt_amt1" class="form-control rid_only" style="text-align: right;" value="<?=number_format(@$arr_pt_amt[2] ?? 0,2)?>"></td>
                    </tr>
                    <tr>
                      <!-- <td width="20"><input type="radio" id="pt3" name="payment_mode" value="3" onchange="pt_change(3);"></td> -->
                      <td><label for="pt3">Credit Card</label></td>
                      <td width="50"><input readonly type="text" id="pt_coun1" class="form-control rid_only" value="<?=@$arr_pt_count[3] ?? 0?>"></td>
                      <td><input type="text" readonly id="pt_amt1" class="form-control rid_only" style="text-align: right;" value="<?=number_format(@$arr_pt_amt[3] ?? 0,2)?>"></td>
                    </tr>
                    <tr>
                      <!-- <td width="20"><input type="radio" id="pt4" name="payment_mode" value="4" onchange="pt_change(4);"></td> -->
                      <td><label for="pt4">Transfer</label></td>
                      <td width="50"><input readonly type="text" id="pt_coun1" class="form-control rid_only" value="<?=@$arr_pt_count[4] ?? 0?>"></td>
                      <td><input type="text" readonly id="pt_amt1" class="form-control rid_only" style="text-align: right;" value="<?=number_format(@$arr_pt_amt[4] ?? 0,2)?>"></td>
                    </tr>
                    <tr>
                      <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td  align="right"><label><small>TOTAL COLLECTIONS: &nbsp; </small></label></td>
                      <td width="50"><input readonly type="text" id="pt_coun1" class="form-control rid_only" value="0"></td>
                      <td><input type="text" readonly id="pt_amt1" class="form-control rid_only" style="text-align: right;" value="<?=number_format($total_paid,2)?>"></td>
                    </tr>
                  </table>

              </div>

              <br/>
              
              <?php if(@$project->id){?>
                <a href="<?=base_url('receipt/receivables/'.@$project->id)?>" class="btn btn-primary load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" style="bottom: 0px;">Project Payment Records</a>
              <?php }elseif(@$client->id){ ?>
                <a href="<?=base_url('receipt/receivables/'.@$client->id)?>/1" class="btn btn-primary load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" style="bottom: 0px;">Client Payment Records</a>
              <?php }?>
          	</div>	
          	<div class="col-md-9 col-sm-12 ">

          		<div class="x_panel tile">
              <div class="x_title" style="font-size: 18px; font-weight: bold;">CRV Form : <font id="company_txt"></font> <?php if(@$project->id){ echo 'Project'; }elseif(@$client->id){ echo 'AR'; }?></div>


              <?php if(@$print_crv->id){?>

                <div class="clearfix"></div><div class="alert alert-success">Click <a target="_blank" href="<?=base_url('receipt_print/print_receipt/'.@$print_crv->id.'/'.@$print_crv->crv_code)?>">Here</a> to print receipt <?=@$print_crv->crv_code?> </div>

              <?php }?> 
            
				          <div class="row">
					            <div class="col-md-3 col-sm-12 ">
                        <label >Ventum Tech *</label>
                        <select name="company" id="company" class="form-control" <?php if(!@$client->id){echo 'disabled';}?> onchange="load_series(this)" >
                          <option value="">Select Company</option>
                          <?php 
                          if(@$company){
                            foreach($company as $rs){
                          ?>
                          <option value="<?=$rs->id?>" data-cname="<?=$rs->name?>"><?=str_replace('for ','',str_replace('Ventum Tech ','',$rs->name))?></option>
                          <?php }}?> 
                        </select>
                      </div>

                      <script type="text/javascript">
                        function load_series(self) {

                          var selectedOption = $(self).find('option:selected');
                          var dataCname = selectedOption.data('cname');
                          var companyId = $(self).val();

                           $('#company_txt').text(dataCname); 

                           $.get('<?=base_url("receipt/load_crv_series")?>/'+companyId, function (crv_series) { 
                            $('#crv_code').val(crv_series);
                           });
                        }
                      </script>

                      <div class="col-md-3 col-sm-12 ">
					              <label >CRV Number </label>
					              <input type="text" id="crv_code" readonly class="form-control rid_only" > 
					            </div>
					 
					            <div class="col-md-3 col-sm-12 ">
					              <label >CRV Date </label>
					              <input type="text" readonly  class="form-control rid_only" value="<?=date('d M Y')?>">
					              <input type="hidden" name="crv_date" value="<?=date('Y-m-d')?>">
					            </div>

						    </div> 
						    <br/>
						    <div class="row">  
					           
                      <?php if(@$project->id){?>
                      <div class="col-md-3 col-sm-12 ">
                        <label >Project</label>
                         <input type="text" readonly value="<?=(@$client->code && !@$project->name) ? 'None' : @$project->name?>" class="form-control rid_only" >
                      </div>
                      <?php }else{?>
                      <div class="col-md-3 col-sm-12 ">
                        <label >Reference <font color="#999"><small>(max 10 characters)</small></font></label>
                         <input type="text" name="reference" maxlength="10" class="form-control" >
                      </div>
                      <?php }?>
					            
                      <div class="col-md-3 col-sm-12 ">
					              <label >Account Code</label>
					              <input type="text" readonly value="<?=@$client->code?>" class="form-control rid_only" >
					              <input type="hidden" name="client_id" value="<?=@$client->id?>" >
					            </div>

					            <div class="col-md-4 col-sm-12 ">
					              <label >Client Name</label>
					              <input type="text" name="client_name" value="<?=@$client->name?>" readonly class="form-control rid_only">
					            </div>

					            <div class="col-md-2 col-sm-12 ">
					              <label >Date</label>
					              <input type="text" readonly value="<?=date('d M Y')?>" class="form-control rid_only" >
					            </div>

                      <div class="col-md-12 col-sm-12 ">
                        <br/>

                        <div class="row">  
                          <div class="col-md-3 col-sm-12 ">
                            <label >Payment Receipt Mode *</label>
                            <select type="text" <?php if(!@$client->id){echo 'disabled';}?> name="payment_mode" id="payment_mode" onchange="pt_change(this.value)" class="form-control">
                                <option value="0">select</option>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                                <option value="3">Debit/Credit Card</option> 
                                <option value="4">Transfer</option>
                            </select>
                          </div>
                        </div>
                        
                      </div>  
					            
					            <div class="col-md-6 col-sm-12 ">
					         

					            	<div class="row" id="ptf2" style="display: none;">  
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Bank Name *</label>
					            			<input type="text" name="bank_name" id="bank_name" class="form-control">
					            		</div>
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Branch</label>
					            			<input type="text" name="branch" class="form-control">
					            		</div>
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Cheque Number *</label>
					            			<input type="text" name="cheque_no" id="cheque_no" class="form-control">
					            		</div>
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Account Number *</label>
					            			<input type="text" name="account_no" id="account_no" class="form-control">
					            		</div>
					            	</div>

					            	<div class="row" id="ptf3" style="display: none;">  
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Debit/Credit Card</label>
					            			<select name="debit_credit_type_id" class="form-control">
					            				<option value="">Select</option>
					            				<?php 
					            				if($debit_credit_type){
					            					foreach ($debit_credit_type as $rs) { 
					            				?>
					            				<option value="<?=$rs->id?>"><?=$rs->title?></option>
					            				<?php }}?>
					            			</select>
					            		</div> 
					            	</div>

					            	<div class="row">  
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Amount Received *</label>
					            			<input type="text" id="amount_received" name="amount_received" class="form-control" style="text-align: right;">
					            		</div>
					            	</div>
                        <br/>
                        <div class="row">  
                          <div class="col-md-12 col-sm-12 ">
                            <label >Remarks (optional)</label>
                            <input type="text" id="remarks" name="remarks" class="form-control" >
                          </div>
                        </div>

					            	<!-- <hr/>

					            	<div class="row">  
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >A/R Account</label>
					            			<select name="ar_account_id" class="form-control select2_">
					            				<option value="">Select</option>
					            				<?php 
					            				if($account_receivable){
					            					foreach ($account_receivable as $rs) { 
					            				?>
					            				<option value="<?=$rs->id?>"><?=$rs->title?> | <?=$rs->ds?></option>
					            				<?php }}?>
					            			</select>
					            		</div>
					            		<div class="col-md-6 col-sm-12 ">
					            			<label >Cash Control Account</label>
					            			<select name="cash_control_account_id" class="form-control select2_">
					            				<option value="">Select</option>
					            				<?php 
					            				if($cash_control_account){
					            					foreach ($cash_control_account as $rs) { 
					            				?>
					            				<option value="<?=$rs->id?>"><?=$rs->title?> | <?=$rs->ds?></option>
					            				<?php }}?>
					            			</select>
					            		</div>
					            	</div> -->
					    </div>


	            </div>

              <br/><br/> 
            </div>

 			</div>

 		</div>
  

         
        
         
         
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">
 <?php if(!@$client->id){?> 
 var inputs = document.querySelectorAll('form input'); 
 inputs.forEach(function(input) {
     input.disabled = true;
 });	 
 <?php }?>

 function cancel_crv() {
 	reset(); 

 	alertify.confirm("Cancel CRV?", function (e) {
 	      if (e) {   
 	          location.href = '<?=base_url("receipt/create_crv");?>';
 	      } else {
 	          //alertify.log("cancelled");
 	      }
 	  }, "Confirm");
 }

 function pt_change(t) {
 	if(t == 2){
 		$('#ptf2').show();
 		$('#ptf3').hide();
 	}else if(t == 3){
 		$('#ptf3').show();
 		$('#ptf2').hide();
 	}else{
 		$('#ptf3').hide();
 		$('#ptf2').hide();
 	}
 }

 $(document).ready(function() {

   $("#amount_received").on("input keypress", function() {
     const value = $(this).val();

     // Remove any non-numeric characters except for minus sign
     const formattedValue = value.replace(/[^0-9.-]/g, "");

     // Split the value into integer and decimal parts
     const parts = formattedValue.split(".");

     // Format the integer part with thousands separators
     parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

     // Limit decimal places (optional)
     if (parts.length > 1) {
       parts[1] = parts[1].substring(0, 2); // Limit to 2 decimal places
     }

     // Combine formatted parts and set back to the input
     $(this).val(parts.join("."));
   });

    

 });

   


 function save_crv(){ 

    if($("#company").val() == ''){
      alertify.error("Please select a Ventum Tech company");
 	  }else if($("#payment_mode").val() == 0){
 	    alertify.error("Payment method is required");
    }else if($('#amount_received').val() == ''){
      alertify.error("Receiving amount is required");
    }else if($('#pt2').prop("checked") && ($('#bank_name').val()=='' || $('#cheque_no').val()=='' || $('#account_no').val()=='') ){
      alertify.error("Bank & Cheque Detals Required."); 
    }else{

      reset(); 

      alertify.confirm("Save adjustments details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                const numberInput = document.getElementById('amount_received');
                let cleanedValue = numberInput.value.replace(/,/g, ''); 
                cleanedValue = parseFloat(cleanedValue).toFixed(2); 
                numberInput.value = cleanedValue;
                document.frm_crv.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

  }


   
   

</script>