<style type="text/css">
  .searchContainer {
    position: absolute; 
    z-index: 9999!important;
  }

  .searchResults {
    position: absolute;
    top: 100%; /* Position results below the input */
    left: 0;
    width: 100%; /* Make the results cover the entire width */
    max-height: 200px; /* Set a maximum height for the results */
    overflow-y: auto; /* Enable vertical scrolling if needed */
    background-color: #fff; /* Set background color */
    border: 1px solid #ccc; /* Add a border for visualization */
    z-index: 1; /* Ensure the results appear on top of other content */
    display: none; /* Initially, hide the results */
  }

  .result-item { 
    padding: 10px;
    background-color: #f0f0f0;
    border: 1px solid #ccc; 
  }

  .ridonly{
    background-color: #fff !important;
    border-style: dashed !important;
  }
</style>
<form method="post" name="frm_po" action="<?=base_url('purchasing/save_po')?>">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
       
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title">Create Purchase Order</h6>
                </div>
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a class="btn btn-md btn-primary" href="Javascript:save_po()" >Create New Record</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
            

          <div class="row"> 
            <div class="col-md-3 col-sm-12 ">
              <label >P.O. Number</label>
              <input type="text" readonly name="po_number" id="po_number" value="PO<?=sprintf("%06d",($po->po_number+1))?>" class="form-control ridonly">
            </div>

            <div class="col-md-3 col-sm-12 ">
              <label >Vehicle / Customer <font color="red"></font></label>
              <select name="quotation_id" id="quotation_id" class="form-control select2_" onchange="update_link(0)" >
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
                <option  value="<?=$rs->id?>"><?=$rs->quotation_number?> <?php if($rs->version>0){echo ' Rev'.$rs->version;}?> | <?=@$arr_prj[$rs->project_id]?></option>
              <?php }}?>
              </select>
            </div>
             
            <div class="col-md-3 col-sm-12 ">
              <label >Supplier <font color="red">*</font> </label>
              <select name="supplier_id" id="supplier_id" class="form-control select2_" onchange="update_link(this.value)">
                <option value="0">select</option> 
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) {
                ?>
                <option  value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}?>
              </select>
            </div>

            <div id="select_currency" class="col-md-1 col-sm-12 ">
              <label >Currency <font color="red">*</font></label>
              <select id="curr_val" required class="form-control" onchange="update_curr(this)"> 
                <option value="">Select</option>
                <?php 
                if($rates){
                  foreach ($rates as $rs) {
                ?>
                <option value="<?=$rs->id?>" data-xrate="<?=$rs->ds?>"><?=$rs->title?></option>
              <?php }}?>
              </select>
            </div>

            <div id="fix_currency" class="col-md-1 col-sm-12 "  style="display: none;">
              <label >Currency</label>
              <input type="text" readonly id="rate_type" class="form-control ridonly"> 
              <input type="hidden" name="rate_id" id="rate_id" > 
              </select>
            </div>

            <div id="fix_currency" class="col-md-2 col-sm-12 "  >
              <label >Exchange Rate</label>
              <input type="text" readonly id="exchange_rate" name="exchange_rate" class="form-control ridonly">  
              </select>
            </div>

            <div class="col-md-3 col-sm-12 ">
              <label >Reference Number </label>
              <input type="text" name="ref_no" class="form-control">
            </div>

            <div class="col-md-3 col-sm-12 ">
              <label >Supplier Att. To  </label>
              <input type="email" name="att_to" id="att_to" class="form-control">
            </div>

            <div class="col-md-3 col-sm-12 ">
              <label >Supplier Email </label>
              <input type="email" name="supplier_email" id="supplier_email" class="form-control">
            </div>
 
            <div class="col-md-3 col-sm-12 ">
              <label >Description </label>
              <textarea name="description" class="form-control"></textarea>
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
            <tr id="last_row">
              <td colspan="4">
                
                <table width="100%">
                  <tr>
                    <td class="add_item">
                       
                       <div class="select2-ajax" style="width: 100%;"> 
                       </div>

                    </td>
                    <td align="right">Total</td>
                  </tr>
                </table>

              </td>
              <td align="right"><span id="totals">0.00</span></td>
              <td></td>
            </tr> 
            <tr >
              <td colspan="4" align="right">
                <input type="text" name="less_desc" class="form-control" style="border: 0; text-align: right;">
              </td>
              <td>
                <input type="hidden" id="ttl_item_amt">
                <input type="number" name="less_amount" id="less_amount" onkeyup="comp_ttl()" class="form-control" value="0" style="border: 0; text-align: right;"></td>
              <td><i>(Less)</i></td>
            </tr> 
            <tr  >
              <td colspan="4" align="right"><b>Grand Total</b></td>
              <td align="right"><span id="grand_total">0.00</span></td>
              <td></td>
            </tr> 
           </tbody>

        </table> 
        <table class="table" id="add_item_section" style="display: none;">
          <tr>
            <td colspan="6" id="add_row">

              
              <a id="add_item_link" class="btn btn-info load_modal_details" href="<?php echo base_url('purchasing/add_items');?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add Item(s) From Quotation</a>

              <a href="<?=base_url('purchasing/add_new_item')?>" class="load_modal_details" id="openNewItemModal" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"  style="display: none;" >new item</a>
            
            </td>
          </tr>
        </table>

        <input type="hidden" name="row_counter" id="row_counter">

        <input type="hidden" id="selected_ids">

        <input type="hidden" id="selected_symbol"> 
        
      </div>

      <div class="form-group" >
         <label class="control-label col-md-12" for="last-name">Terms & Conditions *<br/> 
        <select onchange="load_template(this.value)">
          <option value="">select tempalate</option>
          <?php 
          if(@$tnc){
            foreach ($tnc as $rs) {
          ?>
          <option value="<?=$rs->id?>"><?=$rs->title?></option>
          <?php }}?>
          </select> </label>

                <div class="col-md-6 col-sm-12 col-xs-12 ">  
                 <div class="form-group" onclick="repli()">
                    
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


                       <div id="editor-one" class="editor-wrapper" onkeyup="repli()"></div>

                       <textarea name="terms_and_conditions" id="terms_and_conditions" style="display:none;"></textarea>
        
                     </div>
                 </div>
             </div>
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">
function repli() {
  var txtE = $('#editor-one').html();
  $('#terms_and_conditions').val(txtE);
}

function update_name_desc(id,poi_id=0){ 

  var quotation_id = $('#quotation_id').val();

  var formData = new FormData();  
  formData.append("item_code", $('#item_code'+id).val());
  formData.append("item_name", $('#item_name'+id).val());

  $.ajax({
    url: "<?=base_url('purchasing/update_item_code_name')?>/"+quotation_id+"/"+id+"/"+poi_id, // Replace with your actual API endpoint URL
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
 
function update_link(sid){

   $.get("<?=base_url('purchasing/load_po_att_to')?>/"+sid, function(data) {
    
    var dta = data.split('-x-');

    $('#att_to').val(dta[0]);
    $('#supplier_email').val(dta[1]);

    $('.all_po_itm').remove();

    $('#totals').html('0.00');
    $('#grand_total').html('0.00');

    var supplier_id = $('#supplier_id').val();
    var quotation_id = $('#quotation_id').val(); 
    $("#add_item_link").attr("href", "<?php echo base_url('purchasing/add_items');?>/"+supplier_id+'/'+quotation_id);

    if(supplier_id>0 && quotation_id>0){
     $('#add_item_section').show();
    }else{
     $('#add_item_section').hide();
    }

     console.log("Data received:", data);
   }).fail(function() {
     alert('error supplier');
     console.log("Request failed.");
   });
  
}



function comp(id){

  var total = 0;

  var qty = $('#i_qty'+id).val();
  var unit_cost = $('#i_unit_cost'+id).val();
  var ttl = qty * unit_cost;
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

  console.log('compute all!');
  var ttl_item_amt = Number($('#ttl_item_amt').val());
  var less = Number($('#less_amount').val());
  var grand_total = ttl_item_amt - less;
 
  $('#grand_total').html(grand_total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
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

function idel(id){
  $('#irow'+id).remove(); 

  var totalx = 0;

  $(".all_ttl").each(function () {
    // Parse the value of the element as a floating-point number
    var valuex = parseFloat($(this).val());

    // Check if the value is a valid number (not NaN)
    if (!isNaN(valuex)) {
      // Add the value to the total
      totalx += valuex;
    }
  });

  if(totalx==0){
    $('#selected_symbol').val('');
    $('#select_currency').show();
    $('#fix_currency').hide();
  }

  $('#ttl_item_amt').val(totalx);
  $('#totals').html(totalx.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  
  comp_ttl(); 
}

function load_template(id){
   
  $.ajax({
      url: '<?=base_url("sales/load_template")?>/'+id, // Replace with your API endpoint
      type: 'GET', 
      success: function(response) { 
          // Handle the successful response here
          $('#editor-one').html(response);
          $('#terms_and_conditions').val(response);
      } 
  });
 
}
</script>