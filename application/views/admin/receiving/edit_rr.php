<style type="text/css">
  .select2-search-choice-close:hover::before {
      color: darkred;
  }
</style>
<form method="post" name="frm_receiving" action="<?=base_url('receiving/update_receiving/'.$rr->id)?>" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Receiving <small>Edit GRV</small></h2> 
 
          <div class="input-group-btn pull-right" style="padding-right: 110px;">
            <a class="btn btn-sm btn-primary" href="Javascript:save_receiving()"> <i class="fa fa-save"></i> Save Changes</a>
          </div>
          
          <div class="input-group-btn pull-right" style="padding-right: 90px;">
            <a class="btn btn-sm btn-warning" href="Javascript:cancel_edit()"> <i class="fa fa-close"></i> Cancel </a>
          </div>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
             
          <div class="row">
            
            <div class="col-md-2 col-sm-12 ">
              <label >Supplier</label>
              <select name="supplier_id" id="supplier_id" class="form-control " onchange="load_supplier_po(this.value)">
                <option value="">select</option> 
                <?php 
                if($suppliers){
                  foreach ($suppliers as $rs) { 
                ?>
                <option <?php if($rs->id == $rr->supplier_id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->name?></option>
              <?php }}?>
              </select>
              
            </div>

            <div class="col-md-10 col-sm-12 ">
              <label >P.O. Details</label>
              <div id="pos">
                <select name="po_ids" id="pos_id" multiple class="form-control select2_" onchange="load_items()"> 
                  <?php   

                  if(json_decode($rr->po_ids)){
                    foreach (json_decode($rr->po_ids) as $po_id) {
                      $arr_po_id[$po_id] = $po_id;
                    }
                  }

                  if($po){
                    foreach ($po as $rs) {
                      $arr_po[$rs->id] = $rs->po_number;
                  ?>
                  <option <?php if(@$arr_po_id[$rs->id]){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->po_number?></option>
                  <?php }}?>
                </select>
              </div>
              
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >DR Number <font color="red">*</font></label>
              <input type="text" required name="dr_number" id="dr_number" value="<?=$rr->dr_number?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Delivery <font color="red">*</font></label>
              <input type="date" required name="delivery_date" id="delivery_date" value="<?=$rr->delivery_date?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Invoice Number <font color="red">*</font></label>
              <input type="text" required name="invoice_number" id="invoice_number" value="<?=$rr->invoice_number?>" class="form-control">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Invoice Date <font color="red">*</font></label>
              <input type="date" required name="invoice_date" id="invoice_date" value="<?=$rr->invoice_date?>" class="form-control">
            </div>

            <div class="col-md-4 col-sm-12 ">
              <label >Attachments</label>
              <input type="file" name="attach[]" multiple="" class="form-control">
            </div>
             
            <div class="col-md-4 col-sm-12 ">
              <label >Remarks </label>
              <textarea name="remarks" id="remarks" class="form-control"><?=$rr->remarks?></textarea>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Transport</label>
              <select required id="grv_transport_id" name="grv_transport_id" class="form-control">
                <option value="0">select</option>
                <?php 
                if(@$grv_transport){
                  foreach ($grv_transport as $rs) { 
                ?>
                <option <?php if($rr->grv_transport_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->title?></option>
                <?php }}?>
              </select>
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Exchange Rate</label>
              <input type="text" readonly id="exchange_rate" name="exchange_rate" class="form-control" value="<?=$rr->exchange_rate?>">
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >Currency</label>
              <input type="text" readonly id="currency" name="currency" class="form-control"  value="<?=$rr->currency?>">  
            </div>

            <div class="col-md-2 col-sm-12 ">
              <label >L/C Factor</label>
              <input type="text" readonly id="lc_factor" name="lc_factor" class="form-control"  value="<?=$rr->lc_factor?>">  
            </div>
                
            <?php 
            if(@$rr->attachments){
            ?>
            <div class="col-md-12 col-sm-12" style="text-align: right;"> 
                    <?php 
                    foreach (json_decode($rr->attachments) as $f_name) {
                     list($n,$i,$fname) = explode('_',$f_name);
                    ?>
                     <span id="attch<?=$n.$i?>" class="badge bg-success">
                      <input type="hidden" name="fname[]" value="<?=$fname?>">
                      <a download="<?=$fname?>" title="download file" style="color: white;" href="<?=base_url('assets/uploads/receiving')?>"><?=$fname?> <i class="fa fa-download"></i> </a> | <a style="color: white;" href="Javascript:dela('<?=$n.$i?>')" title="delete file"><i class="fa fa-remove"></i></a>
                    </span>
                   <?php }?>
            </div>
            <?php }?>
 
          </div>

        </p>
 
        
        <table id="pos_table" class="table table-striped table-bordered table-hover">
         
          <thead>
            <tr style="font-size: 12px;"> 
              <th>P.O. No.</th>
              <th>Part No.</th>
              <th>Description</th>
              <th>Qty in P.O.</th>
              <th>Unit Price</th>
              <th width="10%">Total Price</th>
              <th>Prev. Received Qty</th>  
              <th>Receive Qty</th>
              <th>Bad Qty</th>
              <th>Receive Total <span class="fob_symbol">QAR</span></th>
              <th colspan="2">Remarks</th>  
            </tr>
            </thead> 
            <tbody>
            
            <?php
            $counter = 0;

            if(@$poi){
              foreach ($poi as $rs) {
                $arr_poi[$rs->id] = $rs;
              }
            }

            if(@$rri){
              foreach ($rri as $rs) {
                $arr_rri_self[$rs->id] = 1;
            }}

            if(@$prev_rri){
              foreach ($prev_rri as $rs) { 
                if(!@$arr_rri_self[$rs->id]){
                  @$rr_received[$rs->po_item_id]+=$rs->qty;
                } 
              }
            }

            $ttl1 = 0;
            $ttl2 = 0;

            if(@$rri){
              foreach ($rri as $rs) {
                $counter=$rs->po_item_id;
                $prev_rec = @$rr_received[$rs->po_item_id] ? $rr_received[$rs->po_item_id] : 0;
            ?> 
            <tr id="irow<?=$counter?>" class="all_po_itm">
              <td><?=@$arr_po[$rs->po_id]?></td>
              <td><input type="hidden" name="items[<?=$counter?>]" class="all_added_item_list" value="<?=$counter?>">
                <?=@$arr_poi[$rs->po_item_id]->item_code?>
                <input type="hidden" name="item_code<?=$counter?>" value="<?=@$arr_poi[$rs->po_item_id]->item_code?>">
                <input type="hidden" name="inv_id<?=$counter?>" value="<?=@$rs->inventory_id?>">
                <input type="hidden" name="project_id<?=$counter?>" value="<?=@$rs->project_id?>">
                <input type="hidden" name="quotation_id<?=$counter?>" value="<?=@$rs->quotation_id?>">
                <input type="hidden" name="inventory_quotation_id<?=$counter?>" value="<?=@$rs->inventory_quotation_id?>">
                <input type="hidden" name="po_id<?=$counter?>" value="<?=@$rs->po_id?>"></td>
              <td><?=@$arr_poi[$rs->po_item_id]->item_name?><input type="hidden" name="item_name<?=$counter?>" value="' + desc + '"></td>
              <td><?=@$arr_poi[$rs->po_item_id]->qty?></td>
              <td align="right">
                <?=number_format($rs->price,2)?>
                <input type="hidden" id="price<?=$counter?>" name="price<?=$counter?>" value="<?=$rs->price?>">
              </td>
              <td align="right"><?=number_format($rs->price * @$arr_poi[$rs->po_item_id]->qty,2)?></td>
              <td><?=$prev_rec?></td>
              <td align="right" nowrap>  
                <input type="number" name="qty<?=$counter?>" id="qty<?=$counter?>" onkeyup="update_total()" value="<?=$rs->qty?>" style="border: 0; text-align: right; width: 100px;">
              </td>
              <td align="right" nowrap>  
                <input type="number" name="bad_qty<?=$counter?>" id="bad_qty<?=$counter?>"  value="<?=$rs->bad_qty?>" style="border: 0; text-align: right; width: 100px;">
              </td>
              <td align="right">
                <input type="hidden" class="all_ttl" id="i_ttl<?=$counter?>" value="<?=round($rs->price * $rs->qty,2)?>">
                <span id="ttl<?=$counter?>"><?=number_format($rs->price * $rs->qty,2); 
                $ttl1+=$rs->price * $rs->qty;?></span>
              </td>
              <td>
                <span id="remrks_txt<?=$counter?>"><?=$rs->remarks?></span>
                <input type="hidden" id="remrks<?=$counter?>" name="remrks<?=$counter?>" value="<?=$rs->remarks?>">
              </td>
              <td width="5"><a href="javascript:idel(<?=$counter?>)"><i class="fa fa-remove"></i></a></td>
            </tr>
            <?php }}?>

            <tr id="recieve_section">
              
              <td colspan="12">
                <a id="add_items_btn" class="btn btn-sm btn-primary load_modal_details" href="<?php echo base_url('receiving/load_supplier_po_items/'.$rr->supplier_id);?>/<?=$rr->id?>" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" > Add Receive Items </a>
              </td>

            </tr>

           </tbody>

        </table> 


        <div class="row">
           
          <div class="col-md-4 col-sm-12 ">
            <label >Foreign Charges</label>
            <table id="fc_section" class="table table-striped table-bordered table-hover">  
                <tr style="font-size: 12px;"> 
                  <th>Description</th>
                  <th>Amount</th>
                  <th colspan="2">Remarks</th> 
                </tr>
                <?php  
                $fc_count = 0;
                $fc_ttl = 0;
                if(@$fc_used){
                  foreach ($fc_used as $rse) {
                    $fc_count+=1;
                ?>
                <tr id="fc_tr<?=$fc_count?>"> 
                  <td>
                    <select name="fc<?=$fc_count?>" style="width: 100%; border: 0;"> 
                      <option value="">select</option> 
                      <?php foreach($fc as $rs){?> 
                        <option <?php if($rse->fc_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->title?></option> 
                        <?php }?> 
                    </select>
                  </td>
                  <td><input type="number" class="all_fc" value="<?=$rse->amt; $fc_ttl+=$rse->amt?>" onkeyup="compute_fc()" name="fc_amt<?=$fc_count?>" style="width: 100%; border: 0;"></td>
                  <td><input type="text" name="fc_remarks<?=$fc_count?>" value="<?=$rse->remarks?>" style="width: 100%; border: 0;"></td>
                  <td><a href="Javascript:del_fc(<?=$fc_count?>)"><i class="fa fa-remove"></i></a></td>
                </tr>
                <?php }}?>
                <tr>
                  <td colspan="4"><a href="Javascript:add_fc()"><i class="fa fa-plus"></i> Add Charges</a></td>
                </tr>
              </table>
          </div>

          <div class="col-md-4 col-sm-12 ">
            <label >Local Charges</label>
            <table id="lc_section" class="table table-striped table-bordered table-hover">  
                <tr style="font-size: 12px;"> 
                  <th>Description</th>
                  <th>Amount</th>
                  <th colspan="2">Remarks</th> 
                </tr>
                <?php  
                $lc_ttl = 0;
                $lc_count = 0;
                if(@$lc_used){
                  foreach ($lc_used as $rse) {
                    $lc_count+=1;
                ?>
                <tr id="lc_tr<?=$lc_count?>"> 
                  <td>
                    <select name="lc<?=$lc_count?>" style="width: 100%; border: 0;"> 
                      <option value="">select</option> 
                      <?php foreach($lc as $rs){?> 
                        <option <?php if($rse->lc_id==$rs->id){echo 'selected';}?> value="<?=$rs->id?>"><?=$rs->title?></option> 
                        <?php }?> 
                    </select>
                  </td>
                  <td><input type="number" class="all_lc" value="<?=$rse->amt; $lc_ttl+=$rse->amt;?>" onkeyup="compute_lc()" name="lc_amt<?=$lc_count?>" style="width: 100%; border: 0;"></td>
                  <td><input type="text" name="lc_remarks<?=$lc_count?>" value="<?=$rse->remarks?>" style="width: 100%; border: 0;"></td>
                  <td><a href="Javascript:del_lc(<?=$lc_count?>)"><i class="fa fa-remove"></i></a></td>
                </tr>
                <?php }}?>
                <tr>
                  <td colspan="4"><a href="Javascript:add_lc()"><i class="fa fa-plus"></i> Add Charges</a></td>
                </tr>
              </table>
          </div>

          <div class="col-md-4 col-sm-12 ">
            <label >Totals</label>
            <table id="lc_section" class="table table-bordered table-hover">  
                <tr style="font-size: 12px;"> 
                  <th></th> 
                  <th style="text-align: right;"><span class="fob_symbol"><?=$rr->currency?></span></th>  
                  <th style="text-align: right;">QAR</th> 
                </tr>
                <tr style="font-size: 12px;"> 
                  <td>Total FOB  </td> 
                  <td align="right"><span class="fob_symbol"><?=$rr->currency?></span> <span id="fob_grand_ttl"><?=number_format($ttl1,2)?></span></td>
                  <td align="right">QAR <span id="qar_fob_grand_ttl"><?=number_format($ttl1 * $rr->exchange_rate,2)?></span></td>
                </tr>
                <tr style="font-size: 12px;"> 
                  <td> Foreign Charges 
                    <input type="hidden" id="fc_amt_ttl" value="<?=$fc_ttl?>">
                    <input type="hidden" id="fc_count" name="fc_count" value="<?=$fc_count?>">
                  </td> 
                  <td align="right"><span class="fob_symbol"><?=$rr->currency?></span> <font id="fc_txt_ttl"><?=number_format($fc_ttl,2)?></font></td>
                  <td align="right">QAR <font id="fc_txt_ttl2"><?=number_format($fc_ttl * $rr->exchange_rate,2)?></font></td>
                </tr>
                <tr style="font-size: 12px;"> 
                  <td>  Local Charges
                    <input type="hidden" id="lc_amt_ttl" value="<?=$lc_ttl?>">
                    <input type="hidden" id="lc_count" name="lc_count" value="<?=$lc_count?>">
                  </td> 
                  <td align="right" id="lc_ttl"><?=@$arr_lcr_all[$lcr_selected]->currency_symbol?> <font id="lc_txt_ttl2">0.00</font></td>
                  <td align="right" id="lc_ttl">QAR <font id="lc_txt_ttl"><?=number_format($lc_ttl,2)?></font></td>
                </tr>
                <tr>
                  <td colspan="2"><b>Grand Total</b></td> 
                  <td align="right"><b>QAR <span id="grand_ttl"><?=number_format(($ttl1 * $rr->exchange_rate)+($fc_ttl * $rr->exchange_rate)+$lc_ttl,2)?></span></b></td>
                </tr>
              </table>
          </div>

        </div>

        <script type="text/javascript">
       
          function del_fc(id){
            $('#fc_tr'+id).remove();
            compute_fc();
          }

          function del_lc(id){
            $('#lc_tr'+id).remove();
            compute_lc();
          }

          var fc_count = <?=$fc_count?>;

          function add_fc(){
            fc_count+=1;
            $('#fc_section tr:last').before('<tr id="fc_tr9999999999'+fc_count+'"> <td style="width: 50%"> <select name="fc'+fc_count+'" onchange="enable_fc(this.value,'+fc_count+')" style="width: 100%; border: 0;"> <option value="">select</option> <?php foreach($fc as $rs){?> <option value="<?=$rs->id?>"><?=$rs->title?></option> <?php }?> </select> </td> <td><input type="number" class="all_fc" onkeyup="compute_fc()" id="fc_amt'+fc_count+'" name="fc_amt'+fc_count+'" style="width: 100%; border: 0;" disabled></td> <td><input type="text" id="fc_remarks'+fc_count+'" name="fc_remarks'+fc_count+'" style="width: 100%; border: 0;" disabled></td><td><a href="Javascript:del_fc(9999999999'+fc_count+')"><i class="fa fa-remove"></i></a></td></tr>');
          }

          function enable_fc(v,id){
            if(v){
              $('#fc_amt'+id).prop('disabled', false);
              $('#fc_remarks'+id).prop('disabled', false);
            }else{
              $('#fc_amt'+id).prop('disabled', true);
              $('#fc_remarks'+id).prop('disabled', true);
            } 
          }

          function compute_fc(){

            var exchange_rate = $('#exchange_rate').val(); 

            var fc_ttl = 0;
            $('.all_fc').each(function() {
                fc_ttl+=Number($(this).val());
            });

            var fc_conv = fc_ttl * Number(exchange_rate);

            $('#fc_amt_ttl').val(fc_ttl);
            $('#fc_txt_ttl').html(fc_ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#fc_txt_ttl2').html(fc_conv.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#fc_count').val(fc_ttl);
            update_total();
          }

          var lc_count = <?=$lc_count?>;

          function add_lc(){
            lc_count+=1;
            $('#lc_section tr:last').before('<tr id="lc_tr9999999999'+lc_count+'"> <td style="width: 50%"> <select name="lc'+lc_count+'" onchange="enable_lc(this.value,'+lc_count+')" style="width: 100%; border: 0;"> <option value="">select</option> <?php foreach($lc as $rs){?> <option value="<?=$rs->id?>"><?=$rs->title?></option> <?php }?> </select> </td> <td><input type="number" class="all_lc" onkeyup="compute_lc()" id="lc_amt'+lc_count+'" name="lc_amt'+lc_count+'" style="width: 100%; border: 0;" disabled></td> <td><input type="text" id="lc_remarks'+lc_count+'" name="lc_remarks'+lc_count+'" style="width: 100%; border: 0;" disabled></td><td><a href="Javascript:del_lc(9999999999'+lc_count+')"><i class="fa fa-remove"></i></a></td> </tr>');
          }

          function enable_lc(v,id){
            if(v){
              $('#lc_amt'+id).prop('disabled', false);
              $('#lc_remarks'+id).prop('disabled', false);
            }else{
              $('#lc_amt'+id).prop('disabled', true);
              $('#lc_remarks'+id).prop('disabled', true);
            } 
          }

          function compute_lc(){
            var lc_ttl = 0;
            $('.all_lc').each(function() {
                lc_ttl+=Number($(this).val());
            });
            $('#lc_amt_ttl').val(lc_ttl);
            $('#lc_txt_ttl').html(lc_ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $('#lc_txt_ttl2').html('0.00');
            $('#lc_count').val(lc_ttl);
            update_total();
          }

          <?php if(@$lcr_selected){?>
            $('#rate_id').val('<?=$lcr_selected?>-<?=@$arr_cr_rate[@$arr_lcr_all[$lcr_selected]->currency_symbol]?>');
            $('#rate').val('<?=@$arr_lcr_all[$lcr_selected]->landed_cost_rate?>');
            $('#lc_rates').val('<?=@$arr_cr_rate[@$arr_lcr_all[$lcr_selected]->currency_symbol]?>');
          <?php }?>

          <?php if(@$rr_id){?>
            update_total();
          <?php }?>

        </script>
         
      </div>

      
    </div>
  </div> 
   
</div>
</form>
<script type="text/javascript">

  function load_supplier_po(supplier_id){
    $('#pos').load('<?=base_url("receiving/load_supplier_po")?>/'+supplier_id, function(){

      $('.select2_').select2(); 

    });
  }

  function load_items(){
    console.log('PO',$('#pos_id').val());

    var poList = $('#pos_id').val();
    var resultString = poList.join('-');

    var myLink = document.getElementById('add_items_btn');
 
    myLink.href = '<?=base_url("receiving/load_supplier_po_items")?>/' + resultString;

    //$('#load_items').load('<?=base_url("receiving/load_items")?>/');
  }

  function idel(id){
    $('#irow' + id).remove();

    update_total();

  }

  function save_receiving(){ 

    if($('#pos_id').val() == ''){
      alertify.error("PO Number is required");
    }else if($('#dr_number').val() == ''){
      alertify.error("DR Number is required");
    }else if($('#invoice_number').val() == ''){
      alertify.error("Invoice Number is required");
    }else if($('.all_added_item_list').length == 0){
      alertify.error("Received atleast one item from the selected P.O.");
    }else{

      reset(); 

      alertify.confirm("Save receiving details?", function (e) {
            if (e) {  
                alertify.log("saving...");
                document.frm_receiving.submit();
            } else {
                alertify.log("cancelled");
            }
        }, "Confirm");
    
    }

  }

  
  function update_total(){

    var grand = 0;
    var qar_grand = 0;

    $('.all_added_item_list').each(function() {

        var id = $(this).val();  

          var ttl = Number($('#price'+id).val())*Number($('#qty'+id).val()); 

          qar_grand+=ttl;
  
    });
 

    var fob_grand = qar_grand; 

    $('#fob_grand_ttl').html(fob_grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    var exchange_rate = $('#exchange_rate').val(); 

    qar_grand = qar_grand * Number(exchange_rate);

    $('#qar_fob_grand_ttl').html(qar_grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    qar_grand+=Number($('#fc_amt_ttl').val()) * Number(exchange_rate);
    qar_grand+=Number($('#lc_amt_ttl').val());

    var lc_factor = qar_grand/fob_grand;

    $('#lc_factor').val(lc_factor.toFixed(6).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#grand_ttl').html(qar_grand.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

  }

  function cancel_edit() {
    
    reset(); 

    alertify.confirm("Leave edit receiving details?", function (e) {
          if (e) {  
              alertify.log("please wait...");
              location.href = '<?=base_url("receiving/receiving_records")?>';
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");

  }

</script>