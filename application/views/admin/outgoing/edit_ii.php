<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_issuance" action="<?=base_url('outgoing/update_issuance/'.$ii->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Issuance <small>Edit Issuance</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 190px;">
                  <!-- <a class="btn btn-sm btn-info" href="Javascript:update_cost()"  >Update Cost Price</a> -->

                  <a class="btn btn-sm btn-primary" href="Javascript:save_issuance()"  >Save Issuance</a>
 
                  <a class="btn btn-sm btn-danger" href="Javascript:go_back()"  >Go Back</a>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row">
            
            <div class="col-md-2 col-sm-12 ">
              <label >Job Order </label>
              <input type="text" value="<?=@$jo->job_order_number?>" readonly class="form-control ridonly"> 
              
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Quotation</label>
              <input type="text" id="quotation" value="<?=@$quotation->quotation_number?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Project</label>
              <input type="text" id="project" value="<?=@$project->name?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Client</label>
              <input type="text" id="client" value="<?=@$client->name?>" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Issued Date</label>
              <input type="date" name="issued_date" readonly value="<?=$ii->issued_date?>" id="issued_date" class="form-control ridonly">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" value="<?=$ii->ref_no?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Sales Order Number</label>
              <input type="text" readonly class="form-control ridonly" value="SO<?=sprintf("%06d",$ii->id);?>">
            </div>
 
            <div class="col-md-6 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" id="remarks" class="form-control"><?=$ii->remarks?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($ii->date_created))?>" class="form-control ridonly">
            </div>
            <?php if(@$confirm_user->name){?>
            <div class="col-md-2 col-sm-12 ">
              <label >Confirmed By</label>
              <input type="text" readonly value="<?=@$confirm_user->name.' - '.date('M d, Y',strtotime($ii->confirmed_date))?>" class="form-control">
            </div>
            <?php }?> 
          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;"> 
              <th>Part No.</th>
              <th>Description</th>
              <th>Unit Cost Price</th>
              <th>Stock Qty</th>
              <th>Issue Qty</th> 
              <th>Remarks</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              <?php 

              if(@$inv){
                foreach ($inv as $rs) {
                  $arr_inv[$rs->id] = $rs->qty;
                }
              }

              $row_count=0;
              $selected_ids='';
              if(@$iii){
                foreach ($iii as $rs) { 
                  $row_count+=1;
                  $selected_ids.='('.$rs->inventory_id.')-';
              ?>
              <tr id="tr<?=$rs->inventory_id?>">
                <td><?=$rs->item_code?>
                <input type="hidden" name="iii_id<?=$rs->inventory_id?>" value="<?=$rs->id?>"/>
                <input type="hidden" class="all_added_item_list" name="items[<?=$rs->inventory_id?>]" id="added<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/> 
              </td>
                <td><?=$rs->item_name?></td>
                <td align="right"> 
                  <?=number_format($rs->unit_cost_price,2)?>
                  <input type="hidden" name="unit_cost_price<?=$rs->inventory_id?>" value="<?=$rs->unit_cost_price?>">    
                </td>
                <td align="center" id="t_qty<?=$rs->inventory_id?>"><?=@$arr_inv[$rs->inventory_id] ? $arr_inv[$rs->inventory_id] : 0?></td>
                <td align="center"><input type="number" id="qty<?=$rs->inventory_id?>" name="qty<?=$rs->inventory_id?>" required style="border: 0px; text-align: center; width: 75px;" value="<?=$rs->qty?>" min="1" max="<?=$rs->qty?>"> </td>
                <td><input type="text" name="remarks<?=$rs->inventory_id?>" value="<?=$rs->remarks?>" style="border: 0px; width: 100%;" > </td>
                <td align="center"><a href="Javascript:remove_item('<?=$rs->inventory_id?>',<?=$rs->inventory_id?>)"><i title="remove" class="fa fa-close"></i></a></td>
              </tr>
              <?php 
              }}
              ?>
              <tr id="item_selector">
                <td colspan="7" class="add_item">
                  <div class="select2-ajax" style="width: 100%;"> 
                </td>
              </tr>
            </tbody>
          </table>
          
          <input type="hidden" name="row_counter" id="row_counter" value="<?=$row_count?>">

          <input type="hidden" id="selected_ids" value="<?=$selected_ids?>">
          
          <!-- <table class="table" id="add_item_section" >

            <tr>
              <td colspan="7" id="add_row">
                <a id="add_item_link" class="btn btn-info load_modal_details" href="<?php echo base_url('outgoing/issue_batch');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add By Batch</a> 
              </td>
            </tr>
          </table>   -->   

          <a href="<?=base_url('outgoing/load_quotation_package/'.$quotation->id)?>" class="btn btn-primary load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" id="package_btn">Select Package Items From Quotation</a> 
         
      </div>
 
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function load_jo(id){
    $.ajax({
        url: '<?=base_url("outgoing/load_jo")?>/'+id, // Replace with your API endpoint
        type: 'GET', 
        success: function(response) { 
            console.log('GGG',JSON.parse(response)); 

            var data = JSON.parse(response);

            $('#project').val(data.project.name);
            $('#client').val(data.client.name);
            $('#quotation').val(data.quotation.quotation_number);
        } 
    });
  }

  load_jo(<?=$ii->id?>);

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

  function go_back(){
    reset(); 

    alertify.confirm("Leave edit issuance?", function (e) {
          if (e) {  
              location.href = '<?=base_url("outgoing/issuance_records")?>';
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function save_issuance(){ 

    if($('#project_id').val() == ''){
      alertify.error("Project is required");
    }else if($('#issued_date').val() == ''){
      alertify.error("Issue date is required"); 
    }else{

      reset(); 

      alertify.confirm("Update receiving details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_issuance.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

  }

  function update_cost(){

      reset(); 

      alertify.confirm("Update cost price?", function (e) {
            if (e) {  
                alertify.log("updating...");
                
                alertify.success("updated"); 
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");

  }


  function remove_item(c,id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  } 
</script>