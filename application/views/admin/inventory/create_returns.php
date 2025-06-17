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
 

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Create Return Inventory</h6>
                   
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                       
                        <a class="btn btn-md btn-primary" href="Javascript:save_returns()"  ><i class="fa fa-save"></i> Save Return Inventory</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <div class="card">
            <div class="card-body">
            
              <p class="text-muted font-13 m-b-30">
          <div class="row">

            <div class="col-md-2 col-sm-12 ">
              <label >Inventory Return Number</label>
              <input type="text" readonly class="form-control ridonly" value="RT<?=sprintf("%06d",count($this->db->select('id')->get_where('inventory_returns',['deleted'=>0])->result())+1);?>">
            </div>
            
            <div class="col-md-2 col-sm-12 ">
              <label >Sales Order </label>
              <select name="issuance_id" id="so_id" class="form-control select2_" onchange="load_so(this.value)">
                <option value="">select</option> 
                <?php  
                if($so){
                  foreach ($so as $rs) { 
                ?>
                <option value="<?=$rs->id?>">SO<?=sprintf("%06d",($rs->id))?></option>
              <?php }}?>
              </select>
              
            </div>
   
            <div class="col-md-2 col-sm-12 ">
              <label >Customer</label>
              <input type="text" id="customer" name="customer"  readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Conatact Number</label>
              <input type="text" id="phone" name="phone" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Purchase Date</label>
              <input type="text" required readonly name="puchase_date" id="puchase_date" class="form-control ridonly">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Return Date *</label>
              <input type="date" required name="return_date" id="return_date" class="form-control">
            </div>

             

            
 
            <div class="col-md-10 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" id="remarks" class="form-control"></textarea>
            </div>
   
 
          </div>

        
        </p>
        
        <table id="ri_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
               
              <th>Part No.</th>
              <th>Description</th>   
              <th>Brand</th>
              <th>S.O. Quantity</th> 
              <th>Retail Price</th>  
              <th nowrap>Return Quantity</th> 
              <th nowrap>Remarks</th>  
              <th style="width:10px;"></th>  
            </tr>
            </thead> 
            <tbody>
                   
                    <tr id="item_selector">
                      <td colspan="6" class="add_item">
                        <div class="select2-ajax-ri" style="width: 100%;"> 
                      </td> 
                      <td></td>
                    </tr> 
                  </tbody>
                </table>

              <input type="hidden" name="row_counter" id="row_counter" value="<?=@$counter?>">
              <input type="hidden" id="selected_ids" value="<?=@$selected_ids?>">   
         
      </div>
 
    </div>
  </div> 

  </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function load_so(id){
    $.ajax({
        url: '<?=base_url("outgoing/load_so")?>/'+id, // Replace with your API endpoint
        type: 'GET', 
        success: function(response) { 
            console.log('GGG',JSON.parse(response));  
            var data = JSON.parse(response);
            $('#customer').val(data.customer);
            $('#phone').val(data.phone);
            $('#puchase_date').val(data.confirmed_date); 
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


  function remove_item(id){ 
    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );
  }

    
</script>