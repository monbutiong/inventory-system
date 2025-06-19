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
                    <h6 class="page-title">Create Inventory Return</h6>
                   
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                       
                        <a class="btn btn-md btn-primary" href="Javascript:save_returns()"  ><i class="fa fa-save"></i> Save Inventory Return</a>
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
              <label >Return Date *</label>
              <input type="date" required name="return_date" id="return_date" class="form-control">
            </div>


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
              <th nowrap>Line Total</th>
              <th nowrap>Discount %</th>
              <th nowrap>Discount Amt</th>
              <th nowrap>Total Amount</th> 
              <th nowrap>Remarks</th>  
              <th style="width:10px;"></th>  
            </tr>
            </thead> 
            <tbody>
                   
                    <tr id="item_selector">
                      <td colspan="9" class="add_item">
                        <div class="select2-ajax-ri" style="width: 100%;"> 
                      </td> 
                     
                      <td align="right">
                        <h5 id="grand_total">0.00</h5>
                        <input type="hidden" id="grand_total_amt" name="grand_total_amt">
                      </td>
                      <td colspan="2"></td>
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

    if ($('#issuance_id').val() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Missing Information',
            text: 'Job Order is required'
        });
    } else if ($('#return_date').val() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Missing Information',
            text: 'Return date is required'
        });
    } else {
        Swal.fire({
            title: 'Confirm Save',
            text: 'Do you want to save the inventory return details?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, save it',
            cancelButtonText: 'No, cancel',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Saving...',
                    text: 'Your return details are being saved.',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                });
                document.frm_returns.submit();
            } else {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Inventory return not saved.',
                    icon: 'info',
                    timer: 1000,
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
    initializeExistingRows();
  }

    
</script>