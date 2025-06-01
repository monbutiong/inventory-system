<style type="text/css">
  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_po" action="<?=base_url('purchasing/update_po/'.$po->id)?>">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Purchasing <small>Edit Purchase Order</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 110px;">
                  <a class="btn btn-sm btn-primary" href="Javascript:save_po()"  >Update P.O.</a>
              </div>
 

          <div class="input-group-btn pull-right" style="padding-right: 80px;">
                  <a class="btn btn-sm btn-danger" href="Javascript:leave_edit_po();"  >Go Back</a>
              </div>
           
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row">
            
            <div class="col-md-2 col-sm-12 ">
              <label >P.O. Number</label>
              <input type="text" readonly name="po_number" id="po_number" value="<?=$po->po_number?>" class="form-control ridonly">
            </div>

            <div class="col-md-4 col-sm-12 ">
              <label >Quotation - Project</label>
              <select name="quotation_id" id="quotation_id" class="form-control select2_" onchange="update_link()" >
                <option value="0">N/A</option> 
                <?php 
                if(@$projects){
                  foreach ($projects as $rs) {
                    $arr_prj[$rs->id] = $rs->name;
                  }
                }

                if($quotations){
                  foreach ($quotations as $rs) {
                ?>
                <option <?php if($rs->id==$po->quotation_id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->quotation_number?> <?php if($rs->version>0){echo ' Rev'.$rs->version;}?> | <?=@$arr_prj[$rs->project_id]?></option>
              <?php }}?>
              </select>
            </div>
             
            <div class="col-md-2 col-sm-12 ">
              <label >Supplier </label>
              <select name="supplier_id" id="supplier_id" class="form-control select2_" onchange="update_link()">
                <option value="0">select</option> 
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                ?>
                <option <?php if($rs->id==$po->supplier_id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}?>
              </select>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Supplier Att. To  </label>
              <input type="email" name="att_to" value="<?=$po->att_to?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Supplier Email </label>
              <input type="email" name="supplier_email" value="<?=$po->supplier_email?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Reference Number </label>
              <input type="text" name="ref_no" value="<?=$po->reference_no?>" class="form-control">
            </div>

            <div id="select_currency" class="col-md-1 col-sm-12 ">
              <label >Currency <font color="red">*</font></label>
              <select id="curr_val" required onchange="update_curr(this)" class="form-control ">
                <option value="0">select</option> 
                <?php 
                if($rates){
                  foreach ($rates as $rs) {
                ?>
                <option <?php if($rs->id==$po->rate_id){echo 'selected'; $default_curreny=$rs->title; $exchange_rate=$rs->ds; }?> data-xrate="<?=$rs->ds?>" value="<?=$rs->id?>"><?=$rs->title;?></option>
              <?php }}?>
              </select>
            </div>

            <div id="fix_currency" class="col-md-1 col-sm-12 "  style="display: none;">
              <label >Currency</label>
              <input type="text" readonly id="rate_type" value="<?=@$default_curreny?>" class="form-control ridonly"> 
              <input type="hidden" name="rate_id" id="rate_id" value="<?=@$po->rate_id?>" > 
              </select>
            </div>

            <div id="fix_currency" class="col-md-1 col-sm-12 "  >
              <label >Exchange Rate</label>
              <input type="text" readonly id="exchange_rate" name="exchange_rate" value="<?=@$exchange_rate?>" class="form-control ridonly">  
              </select>
            </div>
            
            <div class="col-md-6 col-sm-12 ">
              <label >Description </label>
              <input type="text" name="description" value="<?=$po->description?>" class="form-control">
            </div>


            <div class="col-md-2 col-sm-12 ">
              <label >Logged By</label>
              <input type="text" readonly value="<?=$user->name.' - '.date('M d, Y',strtotime($po->date_created))?>" class="form-control ridonly">
            </div>

          </div>

        </p>
 
        
        <table id="po_table" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th width="10%">Part No.</th>
              <th>Description</th>
              <th width="10%">Qty</th>
              <th width="10%">Unit Price</th>
              <th width="10%">Total Price</th>
              <th width="5%">Option</th>  
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
              <td> 
                <input type="text" id="item_code<?=$rs->inventory_quotation_id?>" name="item_code<?=$rs->inventory_quotation_id?>" onblur="update_name_desc(<?=$rs->inventory_quotation_id?>,<?=$rs->id?>)" value="<?=$rs->item_code?>" style="border: 0; width: 100%;">
                <input type="hidden" name="items[<?=$rs->inventory_quotation_id?>]" value="e-<?=$rs->id?>"> 
                <input type="hidden" id="inv_id<?=$rs->inventory_quotation_id?>" name="inv_id<?=$rs->inventory_quotation_id?>" value="<?=$rs->inventory_id?>">
              </td>
              <td> 
                <input type="text" id="item_name<?=$rs->inventory_quotation_id?>" name="item_name<?=$rs->inventory_quotation_id?>" onblur="update_name_desc(<?=$rs->inventory_quotation_id?>,<?=$rs->id?>)" value="<?=$rs->item_name?>" style="border: 0; width: 100%;">
              </td>
              <td > <input type="number" id="i_qty<?=$rs->inventory_quotation_id?>" name="i_qty<?=$rs->inventory_quotation_id?>" onkeyup="comp(<?=$rs->inventory_quotation_id?>)" value="<?=$rs->qty?>" style="border: 0; width: 70px;"></td>
              <td align="right" nowrap="">
               <small class="rater"><?=@$default_curreny?></small>
                <input type="number" id="i_unit_cost<?=$rs->inventory_quotation_id?>" name="i_unit_cost<?=$rs->inventory_quotation_id?>" onkeyup="comp(<?=$rs->inventory_quotation_id?>)" value="<?=round($rs->price,2)?>" style="border: 0; text-align: right; width: 100px;"></td>
              <td align="right">
                <span id="ttl<?=$rs->inventory_quotation_id?>"><?=number_format($rs->qty*$rs->price,2); @$ttl+=$rs->qty*$rs->price;?></span>
                <input type="hidden" class="all_ttl" id="i_ttl<?=$rs->inventory_quotation_id?>" value="<?=round($rs->qty*$rs->price,2)?>">

              </td> 
              <td nowrap> 
                <a href="Javascript:delete_poi(<?=$rs->inventory_quotation_id?>)" class="load_modal_details"><i class="fa fa-remove"></i> </a>
              </td>
            </tr>  
            <?php }}?>
            <tr id="last_row">
              <td colspan="4" align="right">Total</td>
              <td align="right"><span id="totals"><?=number_format($ttl,2)?></span></td>
              <td></td>
            </tr> 
            <tr id="last_row">
              <td colspan="4" align="right">
                <input type="text" name="less_desc" class="form-control" value="<?=$po->less_desc?>" style="border: 0; text-align: right;">
              </td>
              <td>
                
                <input type="number" name="less_amount" id="less_amount" value="<?=$po->less_amount?>" onkeyup="comp_ttl()" class="form-control" value="0" style="border: 0; text-align: right;"></td>
              <td><i>(Less)</i></td>
            </tr> 
            <tr id="last_row">
              <td colspan="4" align="right"><b>Grand Total</b></td>
              <td align="right"><span id="grand_total"><?=number_format($ttl-$po->less_amount,2)?></span></td>
              <td></td>
            </tr> 
           </tbody>
           <input type="hidden" id="ttl_item_amt" value="<?=($ttl-$po->less_amount)?>">
        </table> 
        <table class="table" id="add_item_section"  >
          <tr>
            <td colspan="6" id="add_row"><a id="add_item_link" class="btn btn-info load_modal_details" href="<?php echo base_url('purchasing/add_items/'.$po->supplier_id.'/'.$po->quotation_id);?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add Item(s) From Quotation </a></td>
          </tr>
        </table>
 
        <input type="hidden" name="row_counter" id="row_counter">

        <input type="hidden" id="selected_ids">

        <input type="hidden" id="selected_symbol" value="<?=@$po->rate_id?>"> 
                 
      </div>

      <div class="form-group" >
         <label class="control-label col-md-12" for="last-name">Terms & Conditions *</label>

                <div class="col-md-6 col-sm-12 col-xs-12 ">  
                 <div class="form-group">
                    
                       <div id="alerts"></div>
                       <div class="btn-toolbar editor" data-role="editor-toolbar" data-bs-target="#editor-one">
                         <div class="btn-group">
                           <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                           <ul class="dropdown-menu">
                           </ul>
                         </div>

                         <div class="btn-group">
                           <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                           <ul class="dropdown-menu">
                             <li>
                               <a data-edit="fontSize 5">
                                 <p style="font-size:17px">Huge</p>
                               </a>
                             </li>
                             <li>
                               <a data-edit="fontSize 3">
                                 <p style="font-size:14px">Normal</p>
                               </a>
                             </li>
                             <li>
                               <a data-edit="fontSize 1">
                                 <p style="font-size:11px">Small</p>
                               </a>
                             </li>
                           </ul>
                         </div>

                         <div class="btn-group">
                           <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                           <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                           <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                           <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                         </div>

                         <div class="btn-group">
                           <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                           <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                           <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                           <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                         </div>

                         <div class="btn-group">
                           <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                           <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                           <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                           <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                         </div>

                         <div class="btn-group">
                           <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                           <div class="dropdown-menu input-append">
                             <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                             <button class="btn" type="button">Add</button>
                           </div>
                           <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                         </div>

                         <div class="btn-group">
                             <a class="btn dropdown-toggle" data-bs-toggle="dropdown" title="Font Color"><i class="fa fa-paint-brush"></i></a>
                             <ul class="dropdown-menu">
                                 <li>
                                     <a data-edit="foreColor #000000" style="color: #000000;">Black</a>
                                 </li>
                                 <li>
                                     <a data-edit="foreColor #FF0000" style="color: #FF0000;">Red</a>
                                 </li>
                                 <li>
                                     <a data-edit="foreColor #2697de" style="color: #2697de;">Blue</a>
                                 </li>
                                 <!-- Add more color options as needed -->
                             </ul>
                         </div>

                         <!-- <div class="btn-group">
                           <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                           <input type="file" data-role="magic-overlay" data-bs-target="#pictureBtn" data-edit="insertImage" />
                         </div>
        -->
                         <div class="btn-group">
                           <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                           <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                         </div>
                       </div>


                       <div id="editor-one" class="editor-wrapper" onkeyup="repli()"><?=$po->terms_conditions?></div>

                       <textarea name="terms_and_conditions" id="terms_and_conditions" style="display:none;"></textarea>
        
                     </div>
                 </div>
             </div>
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

function update_name_desc(id,poi_id=0){ 

  var formData = new FormData();  
  formData.append("item_code", $('#item_code'+id).val());
  formData.append("item_name", $('#item_name'+id).val());

  $.ajax({
    url: "<?=base_url('purchasing/update_item_code_name/'.$po->quotation_id)?>/"+id+"/"+poi_id, // Replace with your actual API endpoint URL
    type: "POST",
    data: formData,
    contentType: false, // Set to false for FormData
    processData: false, // Set to false for FormData
    success: function(response) {
      if(response==1){
        alertify.success("item details updated successfuly");
      }else if(response==2){
        alertify.error("item code already exist");
      }else if(response==3){
        //same same
      }else{
        alertify.error("error saving.");
      }
      
      console.log(response); // Optional: Log the response data
    },
    error: function(jqXHR, textStatus, errorThrown) {
      alertify.error("error saving");
    }
  });
}

function update_curr(selectElement){

  var selectedOption = selectElement.options[selectElement.selectedIndex];

  var selectedValue = selectedOption.value;
  var selectedText = selectedOption.text

  $('.rater').html(selectedText);
 
  $('#selected_symbol').val(selectedValue);
  $('#rate_type').val(selectedText);
  $('#rate_id').val(selectedValue);
  $('#exchange_rate').val(selectedOption.getAttribute('data-xrate'));
}  

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

function save_po(){

    if($('#ttl_item_amt').val() <= 0){

      alertify.error("invalid total amount");

    }else if($('#rate_type').val() == ''){

      alertify.error("Currency required");

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
</script>