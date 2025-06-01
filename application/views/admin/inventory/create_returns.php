<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_returns" action="<?=base_url('inventory/save_return_inventory')?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventory <small>Create Inventory Returns</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 135px;">
                  <a class="btn btn-sm btn-primary" href="Javascript:save_returns()"  >Save Inventory Returns</a>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row">

            <div class="col-md-2 col-sm-12 ">
              <label >Inventory Return Number</label>
              <input type="text" readonly class="form-control ridonly" value="RT<?=sprintf("%06d",count($this->db->select('id')->get_where('inventory_returns',['deleted'=>0])->result())+1);?>">
            </div>
            
            <div class="col-md-2 col-sm-12 ">
              <label >Job Order </label>
              <select name="job_order_id" id="job_order_id" class="form-control select2_" onchange="load_jo(this.value)">
                <option value="">select</option> 
                <?php  
                if($jo){
                  foreach ($jo as $rs) { 
                ?>
                <option value="<?=$rs->id?>"><?=$rs->job_order_number?></option>
              <?php }}?>
              </select>
              
            </div>
 

            <div class="col-md-2 col-sm-12 ">
              <label >Project</label>
              <input type="text" id="project" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Client</label>
              <input type="text" id="client" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Return Date *</label>
              <input type="date" required name="return_date" id="return_date" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" class="form-control">
            </div>

            
 
            <div class="col-md-10 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" id="remarks" class="form-control"></textarea>
            </div>
   
 
          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
               
              <th>Sales Order No.</th>
              <th>Date Issued</th>
              <th>Part No.</th>
              <th>Description</th>   
              <th>Issue Qty</th> 
              <th>Return Qty</th>
              <th>Remarks</th>
              <th></th>  
            </tr>
            </thead> 
            <tbody>
              <tr id="item_selector">
                <td colspan="8" class="add_item">
                  <div class="select2-ajax" style="width: 100%;"> 
                </td>
              </tr>
            </tbody>
          </table>
          
          <input type="hidden" name="row_counter" id="row_counter">

          <input type="hidden" id="selected_ids">
          
          <!-- <table class="table" id="add_item_section" >
            <tr>
              <td colspan="7" id="add_row">
                <a id="add_item_link" class="btn btn-info load_modal_details" href="<?php echo base_url('outgoing/issue_batch');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add By Batch</a> 
              </td>
            </tr>
          </table>   -->    
         
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
        } 
    });
  }

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

  function save_returns(){ 

    if($('#issue_id').val() == ''){
      alertify.error("Job Order is required");
    }else if($('#return_date').val() == ''){
      alertify.error("Return date is required"); 
    }else{

      reset(); 

      alertify.confirm("Save inventory return details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_returns.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

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