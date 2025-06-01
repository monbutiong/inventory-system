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
      <div class="x_title">
        <h2>Quotation<small>Item List</small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        
        <table id="datatable_modal" class="table table-striped table-bordered table-hover">
           
          <thead>
            <tr style="font-size: 12px;">
              <th>
                <!-- <center><input type="checkbox" onchange="chk_all(this.checked)" style="transform : scale(1.5);"></center> -->
              </th> 
              <th>Part No.</th>
              <th>Description</th>
              <th>Location(s)</th>
              <th>Supplier/Brand/Manufacturer</th> 
              <th>Package(s)</th> 
              <th>Quotation Qty</th>
              <th>P.O.(ed) Qty</th>
              <th>Qty</th>
              <th>Unit Price</th> 
          
            </tr>
            </thead> 
            <tbody>
              <?php

              if($ql){
                foreach ($ql as $rs) {
                  $arr_loc[$rs->id] = $rs->location_name;
                }
              }

              if($lcr){
                foreach ($lcr as $rs) {
                  $arr_lcr[$rs->id] = $rs;
                  if($rs->local_purchase == 1){
                    $local_purchase_id = $rs->id;
                  }
                }
              }

              if(@$suppliers){
                foreach ($suppliers as $rs) {
                  $arr_supp[$rs->id] =$rs->name;
                }
              }

              if(@$poi){
                foreach($poi as $rs){
                  @$arr_xpo[$rs->item_code]+=$rs->qty;
                  @$arr_xpo_id[$rs->item_code]=$rs->po_id;
                }
              }  

              if(@$rates){
                foreach ($rates as $rs) {
                  $arr_rates[$rs->currency_symbol] = $rs->id;
                  $arr_exchange_rates[$rs->currency_symbol] = $rs->ds;
                  $acb[$rs->currency_symbol] = $rs->id;
                  $arr_rates_to_letter[$rs->currency_symbol] = $rs->title;
                }
              }  

              if($qlocations){
                foreach ($qlocations as $rs) { 
                    $arr_qlocations[$rs->id] = $rs; 
                }
              }

              if($packages){
                foreach ($packages as $rs) { 
                    $arr_packages[$rs->id] = $rs; 
                }
              }

              if($suppliers){
                foreach ($suppliers as $rs) {
                  $arr_supp[$rs->id] = $rs;
                }
              }
               
              if(@$inv_quo){
                foreach ($inv_quo as $rs) { 

                  if($rs->is_local == 1 && @$local_purchase_id){
                    $rs->landed_cost_rate_id = $local_purchase_id;
                  }  

                  if(!@$rs->item_code){
                    $rs->item_code = 0;
                  }
              ?>
              <tr> 
                <td><center>
                  <input class="<?php if(@$arr_xpo[$rs->item_code]!=$rs->qty){?>itm_chk<?php }?>" id="add_item_<?=$rs->id?>" type="checkbox" value="<?=$rs->id?>" style="transform : scale(1.5);" onchange="update_list(this.checked, this.value,'<?=$rs->item_code?>','<?=$rs->item_name?>','<?=number_format($rs->unit_cost,2)?>','<?=$rs->item_code?>')" <?php if(@$arr_xpo[$rs->item_code]==$rs->qty){echo 'disabled';}?> />
                  </center>
                </td> 
                <td><?=$rs->item_code?></td>
                <td><?=$rs->item_name?></td>
                <td><small><?php 
                $second_and='';
                $loc_id='';
                foreach (json_decode($rs->quotation_location_ids) as $loc_id) {
                  if(@$second_and){echo ', ';}
                  echo @$arr_qlocations[$loc_id]->location_name;
                  $second_and = 1;
                } 

                if(!@$loc_id){echo 'LOCAL PURCHASE';}
                ?></small></td>
                <td><small><?php 
                $second_and='';
                foreach (json_decode($rs->suppliers) as $sup_id) {
                  if(@$second_and){echo ', ';}
                  echo @$arr_supp[$sup_id]->name;
                  $second_and = 1;
                } 
                ?></small></td>
                <td><small><?php 
                $second_and='';
                foreach (json_decode($rs->package_ids) as $pak_id) {
                  
                  if(!@$pak_exist[@$arr_packages[$pak_id]->package_name]){
                    if(@$second_and){echo ', ';}
                    echo @$arr_packages[$pak_id]->package_name;
                    @$pak_exist[@$arr_packages[$pak_id]->package_name] = 1;
                    $second_and = 1;
                  }
                  
                } 
                ?></small></td> 
                <td align="right"><?=$rs->qty?></td>
                <td align="right"><?=@$arr_xpo[$rs->item_code]?></td>
                <td align="center"><input type="number" id="qty<?=$rs->id?>" value="<?=$rs->qty?>" onkeyup="update_data(<?=$rs->id?>)" <?php if(@$arr_xpo[$rs->item_code]==$rs->qty){echo 'disabled';}?> disabled style="border: 0; text-align:center; width: 70px;"></td>  
                <td align="right"> 
                  <input type="number" id="unit_cost<?=$rs->id?>" value="<?=$rs->unit_cost?>" onkeyup="update_data(<?=$rs->id?>)" <?php if(@$arr_xpo[$rs->item_code]==$rs->qty){echo 'disabled';}?> disabled style="border: 0; text-align: right; width: 100px;">
                  <script type="text/javascript">
                    if ($('#irow<?=$rs->id?>').length > 0) {
                      $('#add_item_<?=$rs->id?>').prop('checked', true);
                      $('#qty<?=$rs->id?>').attr('disabled', false);
                      $('#unit_cost<?=$rs->id?>').attr('disabled', false);

                      $('#qty<?=$rs->id?>').val($('#i_qty<?=$rs->id?>').val());
                      $('#unit_cost<?=$rs->id?>').val($('#i_unit_cost<?=$rs->id?>').val());
                    }
                  </script>
                </td>  
              </tr>
              <?php }}?>
            </tbody>
          </table> 
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>  
               
            </div>
          </div>

        
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">

 
  function update_data(id){
      $('#i_qty'+id).val($('#qty'+id).val());
      $('#i_unit_cost'+id).val($('#unit_cost'+id).val());
      comp(id);
  }

  function update_list(c,id,part_no,desc,cost,item_code){
    if(c){

      $('#qty'+id).attr('disabled',false);
      $('#unit_cost'+id).attr('disabled',false);

      var cur_val = $('#curr_val option:selected').text();

      if(cur_val == 'Select'){cur_val = '';}
 
      $('#irow'+id).remove();

      console.log('enable all');

      var qty = $('#qty'+id).val();
      var unit_cost = $('#unit_cost'+id).val();
      var ttl = qty * unit_cost;
      var ttl_nf = ttl.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      
      var newRowHtml = '<tr id="irow' + id + '" class="all_po_itm"><td><input type="hidden" name="items[' + id + ']" value="' + id + '"><input type="text" id="item_code' + id + '" name="item_code' + id + '" onblur="update_name_desc(' + id + ')" value="'+part_no+'" style="border: 0; width: 100%;"><input type="hidden" name="item_code' + id + '" value="' + item_code + '"></td><td><input type="text" id="item_name' + id + '" name="item_name' + id + '" onblur="update_name_desc(' + id + ')" value="'+desc+'" style="border: 0; width: 100%;"><input type="hidden" name="quotation_id' + id + '" value="<?=$quotation->id?>"></td><td><input type="number" id="i_qty' + id + '" name="i_qty' + id + '" onkeyup="comp(' + id + ')" value="'+qty+'" style="border: 0; width: 70px;"></td><td align="right" nowrap><small class="rater">'+cur_val+'</small> <input type="number" name="i_unit_cost' + id + '" id="i_unit_cost' + id + '" onkeyup="comp(' + id + ')" value="'+unit_cost+'" style="border: 0; text-align: right; width: 100px;"></td><td align="right"><input type="hidden" class="all_ttl" id="i_ttl' + id + '" value="'+ttl+'"><span id="ttl' + id + '">'+ttl_nf+'</span></td><td><a href="javascript:idel(' + id + ')"><i class="fa fa-remove"></i></a></td></tr>';
       
      $('#last_row').before(newRowHtml);

    }else{  
      $('#unit_cost'+id).attr('disabled',true);
      $('#qty'+id).attr('disabled',true);
      $('#irow'+id).remove();
    }

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

    $('#ttl_item_amt').val(totalx);
    $('#totals').html(totalx.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    comp_ttl();
  }

  function chk_all(v){
    if(v){ 
      $('.itm_chk').prop('checked', true);
    }else{
      $('.itm_chk').prop('checked', false);
    }
    
    $('.itm_chk').each(function() {  
        $('#add_item_'+$(this).val()).click();
        $('#add_item_'+$(this).val()).click();
    });

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