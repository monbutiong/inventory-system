<style type="text/css">
  input, textarea, select{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_po" action="<?=base_url('purchasing/update_po/'.$po->id)?>">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchasing <small><?php if($confirm==1){?>Confirm Purchase Order<?php }else{?>View Purchase Order<?php }?></small></h2> 
 
          

          <div class="input-group-btn pull-right" style="padding-right: 120px;">
            <?php if($confirm==1){?>
              <a class="btn btn-sm btn-success" href="Javascript:confirm_po();" >Confirm</a>
            <?php }?>
              <a class="btn btn-sm btn-danger" data-bs-dismiss="modal"  >Close</a>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row">
            
            <div class="col-md-2 col-sm-12 ">
              <label >P.O. Number</label>
              <input type="text" name="po_number" id="po_number" readonly value="<?=$po->po_number?>" class="form-control">
            </div>

            <div class="col-md-4 col-sm-12 ">
              <label >Quotation - Project</label>
              <select name="quotation_id" id="quotation_id" readonly class="form-control"  >
            
                <?php 
                if(@$projects){
                  foreach ($projects as $rs) {
                    $arr_prj[$rs->id] = $rs->name;
                  }
                }

                if($quotations){
                  foreach ($quotations as $rs) {if($rs->id==$po->quotation_id){
                ?>
                <option   value="<?=$rs->id?>"><?=$rs->quotation_number?> <?php if($rs->version>0){echo ' Rev'.$rs->version;}?> | <?=@$arr_prj[$rs->project_id]?></option>
              <?php }}}?>
              </select>
            </div>
             
            <div class="col-md-2 col-sm-12 ">
              <label >Supplier </label>
              <select name="supplier_id" id="supplier_id" readonly class="form-control  " onchange="update_link()">
 
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                    if($rs->id==$po->supplier_id){
                ?>
                <option value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}}?>
              </select>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Supplier Att. To  </label>
              <input type="email" name="att_to" readonly value="<?=$po->att_to?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Supplier Email </label>
              <input type="email" name="supplier_email" readonly value="<?=$po->supplier_email?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Reference Number </label>
              <input type="text" name="ref_no" readonly value="<?=$po->reference_no?>" class="form-control">
            </div>

            <div class="col-md-1 col-sm-12 ">
              <label >Rate Type</label>
              <select name="rate_id" id="rate_id" readonly class="form-control "> 
                <?php 
                if($rates){
                  foreach ($rates as $rs) {
                    if($rs->id==$po->rate_id){
                ?>
                <option value="<?=$rs->id?>"><?=$rs->title?></option>
              <?php }}}?>
              </select>
            </div>

            <div class="col-md-1 col-sm-12 ">
              <label >Rate Type</label>
              <?php 
              if($rates){
                foreach ($rates as $rs) {
                  if($rs->id==$po->rate_id){
                    $exchange_rate = $rs->ds;
                  }
                }
              }
              ?>
              <input type="text" name="exchange_rate" id="exchange_rate" readonly class="form-control" value="<?=@$exchange_rate?>">
               
              </select>
            </div>

            <div class="col-md-6 col-sm-12 ">
              <label >Description </label>
              <input type="text" readonly name="description" value="<?=$po->description?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($po->date_created))?>" class="form-control">
            </div>

          </div>

        </p> 
        
        <table id="po_table" class="table table-striped table-bordered table-hover"> 
          <thead>
            <tr style="font-size: 12px;">
              <th>Part No.</th>
              <th>Description</th>
              <th>Qty</th>
              <th>Unit Price</th>
              <th width="10%">Total Price</th> 
            </tr>
            </thead> 
            <tbody>
            <?php 

            if(@$lcr){
              foreach ($lcr as $rs) {
                $arr_lcr[$rs->id] = $rs->currency_symbol;
              }
            }

            if($po_items){
            foreach($po_items as $rs){?>  
            <tr id="irow<?=$rs->inventory_quotation_id?>">
              <td><?=$rs->item_code?> 
              </td>
              <td><?=$rs->item_name?></td>
              <td > 
                <?=$rs->qty?>
              </td>
              <td align="right">
                 <?=number_format($rs->price,2)?>
               </td>
              <td align="right">
                <span id="ttl<?=$rs->inventory_quotation_id?>"><?=number_format($rs->qty*$rs->price,2); @$ttl+=$rs->qty*$rs->price;?></span>
                <input type="hidden" class="all_ttl" id="i_ttl<?=$rs->inventory_quotation_id?>" value="<?=($rs->qty*$rs->price)?>">

              </td> 
             
            </tr>  
            <?php }}?>
            <tr id="last_row">
              <td colspan="4" align="right">Total</td>
              <td align="right"><span id="totals"><?=number_format($ttl,2)?></span></td>
               
            </tr> 
            <tr id="last_row">
              <td colspan="4" align="right">
                 <?=$po->less_desc?> 
              </td>
              <td> 
                 <?=number_format($po->less_amount,2)?> <i>(Less)</i>
              </td> 
            </tr> 
            <tr id="last_row">
              <td colspan="4" align="right"><b>Grand Total</b></td>
              <td align="right"><span id="grand_total"><?=number_format($ttl-$po->less_amount,2)?></span></td>
              
            </tr> 
           </tbody>
           <input type="hidden" id="ttl_item_amt" value="<?=($ttl-$po->less_amount)?>">
        </table> 
     
      </div> 
      <div class="form-group" >
         <!-- <label class="control-label col-md-12" for="last-name">Terms & Conditions *</label> -->

                <div class="col-md-6 col-sm-12 col-xs-12 ">  
                 <div class="form-group"> 
                        <?=$po->terms_conditions?> 
                 </div>
             </div>
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

function delete_poi(id){
  
  reset(); 

  alertify.confirm("Delete selected item?", function (e) {
        if (e) {  
            alertify.success("deleted");
            $('#irow'+id).remove();
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}


function repli() {
  var txtE = $('#editor-one').html();
  $('#terms_and_conditions').val(txtE);
}
 
function update_link(){

   $('#').load();

   var supplier_id = $('#supplier_id').val();
   var quotation_id = $('#quotation_id').val(); 
   $("#add_item_link").attr("href", "<?php echo base_url('purchasing/add_items');?>/"+supplier_id+'/'+quotation_id);

   if(supplier_id>0 && quotation_id>0){
    $('#add_item_section').show();
   }else{
    $('#add_item_section').hide();
   }
}



function comp(id){

  var total = 0;

  var qty = $('#i_qty'+id).val();
  var unit_cost = $('#i_unit_cost'+id).val();
  var ttl = qty * unit_cost;
  console.log(qty, unit_cost);
  $('#ttl'+id).html(ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  $('#i_ttl'+id).val(ttl);
 
    $(".all_ttl").each(function () {
      // Parse the value of the element as a floating-point number
      var value = parseFloat($(this).val());

      // Check if the value is a valid number (not NaN)
      if (!isNaN(value)) {
        // Add the value to the total
        total += value;
      }
    });

    $('#ttl_item_amt').val(total);
    $('#totals').html(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    comp_ttl();
}

function comp_ttl(){  
  var ttl_item_amt = Number($('#ttl_item_amt').val());
  var less = Number($('#less_amount').val());
  var grand_total = ttl_item_amt - less;
 
  $('#grand_total').html(grand_total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}

function leave_edit_po(){
  
  reset(); 

  alertify.confirm("Leave edit purchase order?", function (e) {
        if (e) {  
            alertify.log("Please wait...");
            location.href = '<?=base_url('purchasing/po_list')?>';
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function confirm_po(){
  reset(); 

  alertify.confirm("Confirm Purchae Order?", function (e) {
        if (e) {  
            alertify.log("saving...");
            location.href = "<?php echo base_url();?>purchasing/save_confirm_po/<?=$po->id?>";
        } else {
            alertify.log("cancelled");
        }
    }, "Confirm");
}

function save_po(){

    if($('#ttl_item_amt').val() <= 0){

      alertify.error("invalid total amount");

    }else if($('#po_number').val() == ''){

      alertify.error("P.O. Number required");

    }else{

      reset(); 

      alertify.confirm("Save Purchase order?", function (e) {
            if (e) {  
                alertify.log("deleting...");
                document.frm_po.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");

    }
  
} 

$('#gmodal').addClass('modal-lg-mod'); 
</script>