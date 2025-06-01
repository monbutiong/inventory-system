<table id="po_table" class="table table-striped table-bordered table-hover">
   
  <thead>
    <tr style="font-size: 12px;">
      <th align="center">
        <center><input type="checkbox" onchange="chk_all(this.checked)" style="transform : scale(1.5);"></center></th>
      <th>Part No.</th>
      <th>Description</th>
      <th>P.O. Number</th>
      <th>Project</th>
      <th>Supplier</th>  
      <th>Issued Qty</th>
      <th>Stock Qty</th>
      <th>Issue Qty</th>
      <th>Unit Price</th> 
      <th>Remarks</th>  
    </tr>
    </thead> 
    <tbody>
    <?php 

    if(@$ex_ids){
      $x = explode('-', $ex_ids);
      foreach ($x as $v) {
        if(@$v){
          $arr_v[$v] = 1;
        }
      }
    }

    if(@$iii){
      foreach ($iii as $rs) {
        $arr_iii[$rs->receiving_item_id] = $rs;
        @$arr_iii_qty[$rs->receiving_item_id]+=$rs->qty;
      }
    }
 
    if(@$items){
      foreach ($items as $rs) {
 		   $has_item = 1;

       $available = $rs->qty-@$arr_iii_qty[$rs->id]
    
    ?> 
    <tr>
      <td align="center">
        <?php if(@$disabled || $available<=0){?>
          <input disabled type="checkbox" checked style="transform : scale(1.5);">
        <?php }else{?>  
          <input id="add_item_<?=$rs->id?>" <?php if(@$arr_v[$rs->id]){echo 'checked';}?> class="add_itm_chk" type="checkbox" onchange="add_update_total()" value="<?=$rs->id?>" style="transform : scale(1.5);">
          <input type="hidden" name="items[<?=$rs->id?>]" value="<?=$rs->id?>">
        <?php }?>
      </td>
      <td><?=$rs->item_code?>
        
        <input type="hidden" name="inv_id<?=$rs->id?>" value="<?=$rs->inventory_id?>"> 
        <input type="hidden" name="quotation_item_id<?=$rs->id?>" value="<?=@$rs->quotation_item_id?>"> 
        <input type="hidden" name="inventory_quotation_id<?=$rs->id?>" value="<?=@$rs->inventory_quotation_id?>">  

      </td>
      <td><?=$rs->item_name?></td>
      <td><?=$rs->po_number?></td>
      <td><?=$rs->project_name?></td>
      <td><?=$rs->supplier_name?></td>
      <td align="center"><?=@$arr_iii_qty[$rs->id] ? @$arr_iii_qty[$rs->id] : 0?></td>
      <td align="center"><?=$available?></td>
      <td align="center">
        
        <?php if($available<=0){ ?>
          <input type="number" disabled style="border: 0; text-align: center" >
        <?php }else{?>
          <input type="number" id="issue_qty<?=$rs->id?>" onkeyup="add_update_total()" id="qty<?=$rs->id?>" value="<?=$available?>" style="border: 0; text-align: center" max="<?=$available?>">
        <?php }?>
        
      </td>
      <td align="right">

      	<?=number_format($rs->cost_price,2)?>
          
          <input type="hidden" id="s_name<?=$rs->id?>" value="<?=$rs->item_code?>">
          <input type="hidden" id="s_code<?=$rs->id?>" value="<?=$rs->item_name?>">
          <input type="hidden" id="s_price<?=$rs->id?>" value="<?=number_format($rs->cost_price,2)?>">
          <input type="hidden" id="s_cost_price<?=$rs->id?>" value="<?=$rs->cost_price?>">
          <input type="hidden" id="s_po_number<?=$rs->id?>"  value="<?=$rs->po_number?>">

        <?php if($available<=0){?>
        <script type="text/javascript">
            $('#add_item_<?=$rs->id?>').prop('disabled',true);
        </script>
        <?php }?>
      </td> 
       
      <td><input <?php if($available<=0){ echo 'disabled'; }?> <?php if(@$disabled){echo 'disabled';}?> type="text" value="<?=@$e_rr_received[$rs->id]->remarks?>" onkeyup="update_remarks(<?=$rs->id?>,this.value)"  style="border: 0; width: 100%; "></td>
    </tr> 
    <?php }}
    if(!@$has_item){
    ?>
    <tr>
      <td colspan="9"><center><i>no item found</i></center></td>
    </tr>
    <?php }?>
   </tbody>

</table> 

<script type="text/javascript">
  <?php 
  if(@$x){
    foreach ($x as $k) {
        if(@$k){ ?> 
          var q = $('#qty<?=$k?>').val();  
          $('#issue_qty<?=$k?>').val(q); 
        <?php }
      }
  }
  ?>

	function chk_all(v){
	  if(v){ 
	    $('.add_itm_chk').prop('checked', true);
	  }else{
	    $('.add_itm_chk').prop('checked', false);
	  }

    add_update_total();

	}

  function update_remarks(id,v){
    $('#remarks'+id).val(v);
  } 

  function add_update_total(){

    $(".add_itm_chk").each(function () {
        
      var s_id = parseFloat($(this).val());
      var s_name = $('#s_name'+s_id).val();
      var s_code = $('#s_code'+s_id).val();
      var s_qty = $('#issue_qty'+s_id).val();
      var s_price = $('#s_price'+s_id).val();
      var s_cost_price = $('#s_cost_price'+s_id).val();
      var s_po_number = $('#s_po_number'+s_id).val();

      if ($(this).is(':checked')) {
        console.log('add to list ',s_id);

        $('#qty'+s_id).val(s_qty); 

        if($('#tr'+s_id).length == 0){

          $('#selected_ids').val($('#selected_ids').val() + '(' + s_id + ')-');
           
          $('#item_selector').before('<tr id="tr' + s_id + '"><td>'+s_code+'<input type="hidden" name="items['+s_id+']" id="added'+s_id+'" value="'+s_id+'"/></td><td>'+s_name+'</td><td>'+s_po_number+'</td><td align="right">'+s_price+'<input type="hidden" name="unit_cost_price'+s_id+'" id="unit_cost_price'+s_id+'" value="'+s_cost_price+'"/></td><td align="center" id="t_qty'+s_id+'">'+s_qty+'</td><td align="center"><input type="number" id="qty'+s_id+'" name="qty'+s_id+'" required style="border: 0px; text-align: center; width: 75px;" value="'+s_qty+'" min="1" max="'+s_qty+'"> </td><td><input type="text" id="remarks'+s_id+'" name="remarks'+s_id+'" style="border: 0px; width: 100%;" > </td><td align="center"><a href="Javascript:remove_item('+c+','+s_id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');

        }

      }else{

        $('#tr'+s_id).remove();

      }
       
    });

   
  }


</script>