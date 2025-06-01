<input type="hidden" name="project_id" value="<?=$po->project_id?>">
<input type="hidden" name="quotation_id" value="<?=$po->quotation_id?>">
<table id="po_table" class="table table-striped table-bordered table-hover">
 
  <thead>
    <tr style="font-size: 12px;">
      <th align="center">
        <center><input type="checkbox" onchange="chk_all(this.checked)" style="transform : scale(1.5);"></center></th>
      <th>Part No.</th>
      <th>Description</th>
      <th>Qty</th>
      <th>Unit Price</th>
      <th width="10%">Total Price</th>
      <th>Prev. Received Qty</th>  
      <th>Receive Qty</th>
      <th>Receive Total Amount</th>
      <th>Remarks</th>  
    </tr>
    </thead> 
    <tbody>
    <?php 
    if(@$rri){
      foreach ($rri as $rs) {
        $rr[$rs->po_item_id] = $rs->id;
        @$rr_received[$rs->po_item_id]+=$rs->qty;
      }
    }

    if(@$e_rri){
      foreach ($e_rri as $rs) { 
        @$e_rr_received[$rs->po_item_id]=$rs;
      }
    }

    if(@$lcr){
      foreach ($lcr as $rs) {
        $arr_lcr[$rs->id] = $rs->currency_symbol;
        $arr_lcr_all[$rs->id] = $rs;
      }
    }

    if(@$cr){
      foreach ($cr as $rs) {
        $arr_cr[$rs->currency_symbol] = $rs->title;
        $arr_cr_rate[$rs->currency_symbol] = $rs->ds; 
      }
    }

    if(@$po_items){
      foreach ($po_items as $rs) {

        $disabled = '';

        if(@$rr_received[$rs->id]>=$rs->qty){
          $disabled = 1;
        }
    ?> 
    <tr>
      <td align="center">
        <?php if(@$disabled){?>
          <input disabled type="checkbox" checked style="transform : scale(1.5);">
        <?php }else{?>  
          <input name="add_item_<?=$rs->id?>" <?php if(@$e_rr_received[$rs->id]){echo 'checked';}?> class="itm_chk" type="checkbox" onchange="update_total()" value="<?=$rs->id?>" style="transform : scale(1.5);">
          <input type="hidden" name="items[<?=$rs->id?>]" value="<?=$rs->id?>">
        <?php }?>
      </td>
      <td><?=$rs->item_code?>
        
        <input type="hidden" name="inv_id<?=$rs->id?>" value="<?=$rs->inventory_id?>"> 
        <input type="hidden" name="quotation_item_id<?=$rs->id?>" value="<?=@$rs->quotation_item_id?>"> 
        <input type="hidden" name="inventory_quotation_id<?=$rs->id?>" value="<?=@$rs->inventory_quotation_id?>">  

      </td>
      <td><?=$rs->item_name?></td>
      <td align="center"><?=$rs->qty?></td>
      <td align="right"><?=number_format($rs->price,2); ?>
          
          <input type="hidden" name="price<?=$rs->id?>" id="price<?=$rs->id?>" value="<?=$rs->price?>">
          <input type="hidden" name="landed_cost_rate_id<?=$rs->id?>"  value="<?=$rs->landed_cost_rate_id?>">

      </td>
      <td align="right"><?=number_format($rs->price * $rs->qty,2)?></td>
      <td align="center"><?=$prev_rec = @$rr_received[$rs->id] ? $rr_received[$rs->id] : 0?></td>
      <td>
        <?php if(@$disabled){?>
          <i><font color="green">Fully Received</font></i>
        <?php }else{?>
          <input type="number" name="rec_qty<?=$rs->id?>" onkeyup="update_total()" id="qty<?=$rs->id?>" value="<?=@$e_rr_received[$rs->id]->qty ? @$e_rr_received[$rs->id]->qty : ($rs->qty-$prev_rec)?>" style="border: 0; text-align: center">
        <?php }?>
      </td>
      <td align="right">
        <!-- <?=@$arr_lcr[$rs->landed_cost_rate_id]?>  --><span id="rttl<?=$rs->id?>"><?=number_format($prev_rec*$rs->price,2)?></span>
      </td>
      <td><input <?php if(@$disabled){echo 'disabled';}?> type="text" value="<?=@$e_rr_received[$rs->id]->remarks?>" name="remarks<?=$rs->id?>" style="border: 0; width: 100%; "></td>
    </tr> 
    <?php $lcr_selected = $rs->landed_cost_rate_id; }}?>
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
        if(@$e_fc){
          foreach ($e_fc as $rse) {
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
        if(@$e_lc){
          foreach ($e_lc as $rse) {
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
          <th style="text-align: right;"><?=@$arr_cr[@$arr_lcr_all[$lcr_selected]->currency_symbol]?></th>  
          <th style="text-align: right;">QAR</th> 
        </tr>
        <tr style="font-size: 12px;"> 
          <td>Total FOB  </td> 
          <td align="right"><?=@$arr_lcr_all[$lcr_selected]->currency_symbol?> <span id="fob_grand_ttl">0.00</span></td>
          <td align="right">QAR <span id="qar_fob_grand_ttl">0.00</span></td>
        </tr>
        <tr style="font-size: 12px;"> 
          <td> Foreign Charges 
            <input type="hidden" id="fc_amt_ttl" value="<?=$fc_ttl?>">
            <input type="hidden" id="fc_count" name="fc_count" value="<?=$fc_count?>">
          </td> 
          <td align="right"><?=@$arr_lcr_all[$lcr_selected]->currency_symbol?> <font id="fc_txt_ttl"><?=number_format($fc_ttl,2)?></font></td>
          <td align="right">QAR <font id="fc_txt_ttl2"><?=number_format($fc_ttl,2)?></font></td>
        </tr>
        <tr style="font-size: 12px;"> 
          <td>  Local Charges
            <input type="hidden" id="lc_amt_ttl" value="<?=$lc_ttl?>">
            <input type="hidden" id="lc_count" name="lc_count" value="<?=$lc_count?>">
          </td> 
          <td align="right" id="lc_ttl"><?=@$arr_lcr_all[$lcr_selected]->currency_symbol?> <font id="lc_txt_ttl2"><?=number_format($lc_ttl,2)?></font></td>
          <td align="right" id="lc_ttl">QAR <font id="lc_txt_ttl"><?=number_format($lc_ttl,2)?></font></td>
        </tr>
        <tr>
          <td colspan="2"><b>Grand Total</b></td> 
          <td align="right"><b>QAR <span id="grand_ttl">0.00</span></b></td>
        </tr>
      </table>
  </div>

</div>

<script type="text/javascript">
  function chk_all(v){
    if(v){ 
      $('.itm_chk').prop('checked', true);
    }else{
      $('.itm_chk').prop('checked', false);
    }
    update_total();
  }

  function del_fc(id){
    $('#fc_tr'+id).remove();
  }

  function del_lc(id){
    $('#lc_tr'+id).remove();
  }

  var fc_count = <?=$fc_count?>;

  function add_fc(){
    fc_count+=1;
    $('#fc_section tr:last').before('<tr id="fc_tr9999999999'+fc_count+'"> <td style="width: 50%"> <select name="fc'+fc_count+'" style="width: 100%; border: 0;"> <option value="">select</option> <?php foreach($fc as $rs){?> <option value="<?=$rs->id?>"><?=$rs->title?></option> <?php }?> </select> </td> <td><input type="number" class="all_fc" onkeyup="compute_fc()" name="fc_amt'+fc_count+'" style="width: 100%; border: 0;"></td> <td><input type="text" name="fc_remarks'+fc_count+'" style="width: 100%; border: 0;"></td><td><a href="Javascript:del_fc(9999999999'+fc_count+')"><i class="fa fa-remove"></i></a></td> </tr>');
  }

  function compute_fc(){

    var rate = $('#rate_id').val();

    var rate_number = rate.split('-');

    var fc_ttl = 0;
    $('.all_fc').each(function() {
        fc_ttl+=Number($(this).val());
    });

    var fc_conv = fc_ttl * Number(rate_number[1]);

    $('#fc_amt_ttl').val(fc_ttl);
    $('#fc_txt_ttl').html(fc_ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#fc_txt_ttl2').html(fc_conv.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#fc_count').val(fc_ttl);
    update_total();
  }

  var lc_count = <?=$lc_count?>;

  function add_lc(){
    lc_count+=1;
    $('#lc_section tr:last').before('<tr id="lc_tr9999999999'+lc_count+'"> <td style="width: 50%"> <select name="lc'+lc_count+'" style="width: 100%; border: 0;"> <option value="">select</option> <?php foreach($lc as $rs){?> <option value="<?=$rs->id?>"><?=$rs->title?></option> <?php }?> </select> </td> <td><input type="number" class="all_lc" onkeyup="compute_lc()" name="lc_amt'+lc_count+'" style="width: 100%; border: 0;"></td> <td><input type="text" name="lc_remarks'+lc_count+'" style="width: 100%; border: 0;"></td><td><a href="Javascript:del_lc(9999999999'+lc_count+')"><i class="fa fa-remove"></i></a></td> </tr>');
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