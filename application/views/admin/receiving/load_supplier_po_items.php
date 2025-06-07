<style>
.datepicker{z-index:1151 !important;}
#datatable 
{    
  overflow-y:hidden; 
}
select, .text_input {
    border: 1px solid #fff;
    background-color: transparent;
} 
.vcc{
  border-bottom-color: #999;
}

</style>

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="modal-header">
          <h5 class="modal-title" id="mySmallModalLabel">Items From Purchase Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <table id="datatable_modal" class="table table-striped table-bordered table-hover"> 
          <thead>
            <tr style="font-size: 12px;">
              <th align="center">
                <center><input type="checkbox" onchange="chk_all(this.checked)" style="transform : scale(1.5);"></center></th>
              
              <th>P.O. No.</th>
              <th>Part No.</th>
              <th>Description</th>
              <th>Qty in P.O.</th>
              <th>Unit Price</th>
              <th width="10%">Total Price</th>
              <th>Prev. Received Qty</th>  
              <th>Receive Qty</th>
              <th>Bad Qty</th>
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
                $arr_cr[$rs->id] = $rs->title;
                $arr_cr_rate[$rs->id] = $rs->ds; 
                $arr_cr[$rs->currency_symbol] = $rs->title;
                $arr_cr_rate[$rs->currency_symbol] = $rs->ds; 
              }
            }

            if(@$po){
              foreach ($po as $rs) {
                $arr_po[$rs->id] = $rs->po_number; 
                $arr_po_proj[$rs->id] = $rs->project_id; 
                $arr_po_quote[$rs->id] = $rs->vehicle_id; 
              }
            }

            $click_all_add = '';
            $click_all_remove = '';

            if(@$po_items){
              foreach ($po_items as $rs) {

                $disabled = '';

                if(@$rr_received[$rs->id]>=$rs->qty){
                  $disabled = 1;
                }

                $prev_rec = @$rr_received[$rs->id] ? $rr_received[$rs->id] : 0;
            ?> 
            <tr>
              <td align="center">
                <?php if(@$disabled){?>
                  <input disabled type="checkbox" checked style="transform : scale(1.5);">
                <?php }else{?>  
                  <input id="add_item_<?=$rs->id?>" name="add_item_<?=$rs->id?>" <?php if(@$e_rr_received[$rs->id]){echo 'checked';}?> class="itm_chk" type="checkbox" onchange="add_to_receive(this.checked,<?=$rs->id?>,'<?=$rs->item_code?>','<?=@$arr_po[@$rs->po_id]?>','<?=$rs->item_name?>','<?=$rs->qty?>','<?=$rs->price; ?>','<?=number_format($rs->price * $rs->qty,2)?>',<?=@$rs->inventory_id?>,<?=$prev_rec?>,'<?=@$arr_cr[$rs->rate_id]?>',<?=@$arr_cr_rate[$rs->rate_id]?>,<?=@$arr_po_proj[$rs->po_id] ?? 0?>,<?=@$rs->vehicle_id ?? 0?>,<?=@$rs->po_id?>,0)" value="<?=$rs->id?>" style="transform : scale(1.5);">
                <?php }?>

              </td>
              <td><?=@$arr_po[$rs->po_id]?></td>
              <td><?=$rs->item_code?>
                
                <input type="hidden" id="inv_id<?=$rs->id?>" value="<?=$rs->inventory_id?>"> 
                <input type="hidden" id="inventory_vehicle_id<?=$rs->id?>" value="<?=$rs->inventory_vehicle_id?>">  

              </td>
              
              <td><?=$rs->item_name?></td>
              <td align="center"><?=$rs->qty?></td>
              <td nowrap align="right">

                <small><?=(@$arr_cr[$rs->rate_id])?></small> <!-- <?=number_format($rs->price,2); ?> -->
                
                <input type="number" class="item_row<?=$rs->id?>" id="rec_price<?=$rs->id?>" name="rec_bad_qty<?=$rs->id?>" onkeyup="update_list(<?=$rs->id?>)"  value="<?=round($rs->price,2)?>" step="any" min="0" style="border: 0; text-align: right;   width: 60px;" disabled>

                  <input type="hidden" id="rec_price_orig<?=$rs->id?>" value="<?=$rs->price?>"> 

              </td>
              <td nowrap align="right">
                <?=(@$arr_lcr_all[$rs->landed_cost_rate_id]->currency_symbol ?? @$arr_cr[$rs->rate_id])?> 
                <font id="price_po<?=$rs->id?>"><?=number_format($rs->price * $rs->qty,2)?></font>
              </td>
              <td align="center"><?=$prev_rec?></td>
              <td>
                <?php if(@$disabled){?>
                  <i><font color="green">Fully Received</font></i>
                <?php }else{?>
                  <input type="number" class="item_row<?=$rs->id?>" id="rec_qty<?=$rs->id?>" name="rec_qty<?=$rs->id?>" onkeyup="update_list(<?=$rs->id?>)"  value="<?=@$e_rr_received[$rs->id]->qty ? @$e_rr_received[$rs->id]->qty : ($rs->qty-$prev_rec)?>" style="border: 0; text-align: center;  width: 60px;" disabled> 
                <?php }?>
              </td>
              <td>
                <?php if(@$disabled){?> 
                <?php }else{?> 
                  <input type="number" class="item_row<?=$rs->id?>" id="rec_bad_qty<?=$rs->id?>" name="rec_bad_qty<?=$rs->id?>" onkeyup="update_bad_qty(<?=$rs->id?>,this.value)"  value="<?=@$e_rr_received[$rs->id]->bad_qty ? @$e_rr_received[$rs->id]->bad_qty : 0?>" style="border: 0; text-align: center;   width: 60px;" disabled>
                <?php }?>
              </td>
              <td align="right" nowrap>
                <small><?=@$arr_cr[$rs->rate_id]?></small> 
                <span id="rttl<?=$rs->id?>"><?=number_format($prev_rec*$rs->price,2)?></span>
              </td>
              <td><input <?php if(@$disabled){echo 'disabled';}?>  class="item_row<?=$rs->id?>" type="text" value="<?=@$e_rr_received[$rs->id]->remarks?>" onkeyup="update_rmks(<?=$rs->id?>,this.value)" id="remarks<?=$rs->id?>" style="border: 0; width: 100%; " disabled></td>
            </tr> 
            <?php 
            if(!@$disabled){

            $click_all_add.=' add_to_receive(true,'.$rs->id.',"'.$rs->item_code.'","'.@$arr_po[$rs->po_id].'","'.$rs->item_name.'",'.$rs->qty.',"'.$rs->price.'","'.number_format($rs->price * $rs->qty,2).'",'.$rs->inventory_id.','.$prev_rec.',"'.(@$arr_cr[$rs->rate_id]).'","'.(@$arr_cr_rate[$rs->rate_id]).'",'.(@$arr_po_proj[$rs->po_id] ?? 0).','.$rs->vehicle_id.','.$rs->po_id.',1);
            ';
 

            $click_all_remove.=' add_to_receive(false,'.$rs->id.',"'.$rs->item_code.'","'.@$arr_po[$rs->po_id].'","'.$rs->item_name.'",'.$rs->qty.',"'.$rs->price.'","'.number_format($rs->price * $rs->qty,2).'",'.$rs->inventory_id.','.$prev_rec.',"'.(@$arr_cr[$rs->rate_id]).'","'.(@$arr_cr_rate[$rs->rate_id]).'",'.(@$arr_po_proj[$rs->po_id] ?? 0).','.$rs->vehicle_id.','.$rs->po_id.',0);
            ';
            }
            }}?>
           </tbody>
          </table> 
        
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>  
          </div>
          
        
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  $('.all_added_item_list').each(function() {    

      var id = $(this).val();

      $('.item_row'+id).prop('disabled', false);

      $('#add_item_'+id).prop('checked', true);
      $('#rec_qty'+id).val($('#qty'+id).val()); 
      $('#rec_bad_qty'+id).val($('#bad_qty'+id).val());
      $('#rttl'+id).html($('#ttl'+id).html()); 
      $('#remarks'+id).val($('#remrks'+id).val()); 
      $('#price_po'+id).html($('#ttl'+id).html()); 

      $('#rec_price'+id).val($('#price'+id).val());

  });

  function update_list(id){
    
    var qty = $('#rec_qty'+id).val();
    var unit_cost = $('#rec_price'+id).val();
    var rmrks = $('#remarks'+id).val();
    var ttl = qty * unit_cost;
    var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    var unit_cost_formatted = Number(unit_cost).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

    $('#o_unit_price'+id).html(unit_cost_formatted);
    $('#o_ttl_price'+id).html(ttl_nf);

    $('#price'+id).val(unit_cost);

    $('#qty'+id).val(qty);
    
    $('#price_po'+id).html(ttl_nf);

    $('#ttl'+id).html(ttl_nf);

    $('#rttl'+id).html(ttl_nf);

    update_total();

  }

  function update_bad_qty(id,qty){ 

    $('#bad_qty'+id).val(qty); 

  }

  function update_rmks(id,rmks){
       
    $('#remrks_txt'+id).html(rmks);
    $('#remrks'+id).val(rmks);

  }

  

  function add_to_receive(check_add_to_line, id, part_no, po_no, desc, po_qty, unit_price, total_price, inv_id, prev_rec, cr, cr_rate, project_id, vehicle_id,po_id,select_all){
    
    if(check_add_to_line && $('#irow' + id).length == 0){

      $('.item_row'+id).prop('disabled', false);

      $('#exchange_rate').val(cr_rate);
      $('#currency').val(cr);
      $('.fob_symbol').html(cr);

      var qty = $('#rec_qty'+id).val();
      var unit_cost = $('#rec_price'+id).val();
      var rmrks = $('#remarks'+id).val();
      var ttl = qty * unit_cost;
      var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      unit_cost = Number(unit_cost);
      var unit_price_nf = unit_cost.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      var bad_qty = 0;
      total_price = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

      $('#rttl'+id).html(ttl_nf);

      var newRowHtml = '<tr id="irow' + id + '" class="all_po_itm"><td>'+po_no+'</td><td><input type="hidden" name="items[' + id + ']" class="all_added_item_list" value="' + id + '">'+part_no+'<input type="hidden" name="item_code' + id + '" value="' + part_no + '"><input type="hidden" name="inv_id' + id + '" value="' + inv_id + '"><input type="hidden" name="project_id' + id + '" value="' + project_id + '"><input type="hidden" name="vehicle_id' + id + '" value="' + vehicle_id + '"><input type="hidden" name="po_id' + id + '" value="' + po_id + '"></td><td>'+desc+'<input type="hidden" name="item_name' + id + '" value="' + desc + '"></td><td>'+po_qty+'</td><td align="right"><font id="o_unit_price' + id + '">'+unit_price_nf+'</font><input type="hidden" id="price'+id+'" name="price'+id+'" value="'+unit_cost+'"></td><td align="right"><font id="o_ttl_price' + id + '">'+total_price+'</font></td><td>'+prev_rec+'</td><td align="right" nowrap>  <input type="number" name="qty' + id + '" id="qty' + id + '" onkeyup="comp(' + id + ')" value="'+qty+'" style="border: 0; text-align: right; width: 100px;"></td><td align="right" nowrap>  <input type="number" name="bad_qty' + id + '" id="bad_qty' + id + '" value="'+bad_qty+'" style="border: 0; text-align: right; width: 100px;"></td><td align="right"><input type="hidden" class="all_ttl" id="i_ttl' + id + '" value="'+ttl+'"><span id="ttl' + id + '">'+ttl_nf+'</span></td><td><span id="remrks_txt'+id+'">'+rmrks+'</span><input type="hidden" id="remrks'+id+'" name="remrks'+id+'"></td><td width="5"><a href="javascript:idel(' + id + ')"><i style="color:red;" class="fa fa-trash"></i></a></td></tr>';
       
      $('#recieve_section').before(newRowHtml);

    }else if(select_all==0){

      $('#irow' + id).remove();

      $('.item_row'+id).prop('disabled', true);

    }

    update_total();

  }
  
  function chk_all(v){
    if(v){  
      $('.itm_chk').prop('checked', true);
      <?=$click_all_add?>
    }else{
      $('.itm_chk').prop('checked', false);
      <?=$click_all_remove?>
    }
      
  }

  $('#gmodal').addClass('modal-lg-mod');

  $('#datatable_modal').DataTable({
    "bPaginate": false,
    "scrollX": true,
    "scrollY": "500px", 
    initComplete: function () {  
      console.log('datatable id done loading');
    }
  });
</script>