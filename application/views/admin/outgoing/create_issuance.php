<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_issuance" action="<?=base_url('outgoing/save_issuance')?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      

        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Create Sales Order</h6>
                    Date: <?=date('M d, Y')?> 
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-md btn-primary" href="Javascript:save_issuance()"  >Save Sales Order</a>
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
            
            <div class="col-md-4 col-sm-12 mb-3">
              <label >Customer * </label>
              <a href="" style="float: right;"><small>(create new customer)</small></a>
              <select name="customer_id" id="customer_id" class="form-control select2_so_customer" onchange="update_so_price(this.value)">
                <option value=""></option>
                <?php  
                $arr_type[0] = 'individual';
                $arr_type[1] = 'business';

                if(@$clients){
                  foreach ($clients as $rs) {

                    if(file_exists('./assets/images/clients/logo-'.$rs->id.'.png')){
                      $img = base_url('assets/images/clients/logo-'.$rs->id.'.png?'.time());
                    }else{
                      $img = base_url('assets/images/img.png');
                    }
                ?>
                <option data-customer-type-id="<?=$rs->customer_type?>" data-customer-type="<?=$arr_type[$rs->customer_type]?>" data-phone="<?=$rs->phone?>" data-qid="<?=$rs->qid?>" data-bis="<?=$rs->business_registration_no?>" data-img="<?=$img?>" value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}?>
              </select>
              
            </div>

            <div class="col-md-2 col-sm-12 mb-3">
              <label >Customer Type</label>
              <input type="text" id="customer_type" name="customer_type" readonly class="form-control ridonly"> 
            </div>

            <div class="col-md-2 col-sm-12 mb-3">
              <label >Contact #</label>
              <input type="text" name="issued_date" id="issued_date" value="" class="form-control ridonly">
            </div>

            <div class="col-md-2 col-sm-12 mb-3">
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" class="form-control">
            </div>
 
            <div class="col-md-2 col-sm-12 mb-3">
              <label >Reference Number</label>
              <input type="text" name="ref_no" id="ref_no" class="form-control">
            </div>

            <div class="col-md-4 col-sm-12 mb-3">
              <label >Vehicles</label>
              <input type="text" id="quotation" readonly class="form-control ridonly"> 
            </div>  
  
 
          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
               
              <th>Part No.</th>
              <th>Description</th>   
              <th>Quantity on Hand</th> 
              <th>Unit Cost Price</th> 
              <th>Selling Price</th>
              <th>Quantity</th> 
              <th>Unit Price</th>
              <th>Total Price</th> 
              <th>Remarks</th> 
              <th></th>  
            </tr>
            </thead> 
            <tbody>
              <tr id="item_selector">
                <td colspan="7" class="add_item">
                  <div class="select2-ajax-so" style="width: 100%;"> 
                </td>
                <td align="right"><b style="font-size: 15px;">Total</b></td>
                <td colspan="2"></td>
              </tr> 
            </tbody>
          </table>
          
          <input type="hidden" name="row_counter" id="row_counter">

          <input type="hidden" id="selected_ids">
          
         
          

          <div class="row">
        <div class="col-md-10 col-sm-12 mb-3">
          <label >Notes </label>
          <textarea name="remarks" id="remarks" class="form-control"></textarea>
        </div>
      </div>

      </div>

      
 
    </div>
  </div> 

  </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function update_so_price(){
     var customerType = $('#customer_id option:selected').data('customer-type');
     
     $('.default_price').hide();

     if(customerType == 1){
        $('.b2c_price').show();
        $('.b2b_price').hide();
     }else{
        $('.b2c_price').hide();
        $('.b2b_price').show();
     }
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

  function save_issuance(){ 

    if($('#project_id').val() == ''){
      alertify.error("Project is required");
    }else if($('#issued_date').val() == ''){
      alertify.error("Issue date is required"); 
    }else{

      reset(); 

      alertify.confirm("Save receiving details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_issuance.submit();
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