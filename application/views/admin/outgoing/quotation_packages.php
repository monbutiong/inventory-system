<style type="text/css">
  input {
    border: 0;
  }
</style>
<form method="post" id="frm_lc" name="frm_lc">
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Quotation <small>Packages</small></h2> 

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          
        </p>

        <style type="text/css">
          input {
            border: 0;
          }
        </style>
        
        <table id="datatable" class="table table-striped table-bordered table-hover">
           
          <?php 

          if($suppliers){
            foreach ($suppliers as $rs) {
              $arr_supp[$rs->id] = $rs->name;
            }
          }

          if(@$qitems){
            foreach ($qitems as $rs) {
              $items[$rs->package_id][] = $rs;
            }
          }

          if($qlocations){
            foreach ($qlocations as $lrs) {
              $arr_loc[$lrs->id] = $lrs;
          }}

          if(@$packages){
            foreach ($packages as $rs) {
              if(@$items[$rs->id]){
          ?>
            <tr style="font-size: 12px; background: #ccc;"> 
              <th colspan="5"><?=$rs->package_name?></th>   
            </tr>

            <tr> 
              <td><input style="transform : scale(1.5);" type="checkbox" onchange="chk_all_pkg(this.checked,<?=$rs->id?>)"></td>
              <td>Part Number</td>
              <td>Description</td>
              <td>Stock</td>
              <td>Unit Price</td>
            </tr>

            <?php 

            if(@$items[$rs->id]){
              foreach ($items[$rs->id] as $rsi) { 
            ?>
            <tr> 
              <td><input class="pkg_item<?=$rs->id?>" id="pkg_item_id<?=$rsi->id?>" style="transform : scale(1.5);"  onchange="add_to_issue(this.checked,<?=$rsi->id?>,'<?=$rsi->item_code?>','<?=$rsi->item_name?>','<?=$rsi->qty?>','<?=$rsi->unit_cost_price?>','<?=number_format($rsi->unit_cost_price,2)?>')" type="checkbox"></td>
              <td><?=$rsi->item_code?></td>
              <td><?=$rsi->item_name?></td>
              <td align="right"><?=$rsi->qty?></td>
              <td align="right"><?=number_format($rsi->unit_cost_price,2)?></td>
            </tr>
            <?php 

            @$click_all_add.=' add_to_issue(true,'.$rsi->id.',"'.$rsi->item_code.'","'.$rsi->item_name.'","'.$rsi->qty.'","'.$rsi->unit_cost_price.'","'.number_format($rsi->unit_cost_price,2).'");
            ';
            

            @$click_all_remove.=' add_to_issue(false,'.$rsi->id.',"'.$rsi->item_code.'","'.$rsi->item_name.'","'.$rsi->qty.'","'.$rsi->unit_cost_price.'","'.number_format($rsi->unit_cost_price,2).'");
            ';

            }}}?> 
            <?php }}?> 

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
</form>

<script type="text/javascript">

$('.all_added_item_list').each(function() {    

    var id = $(this).val(); 

    $('#pkg_item_id'+id).prop('checked', true); 
});

function chk_all_pkg(v,id){
  if(v){  
    $('.pkg_item'+id).prop('checked', true);
    <?=@$click_all_add?>
  }else{
    $('.pkg_item'+id).prop('checked', false);
    <?=@$click_all_remove?> 
  } 
}

function add_to_issue(v,id,code,name,qty,amt,amt_f){

  if(v){

    if($('#added'+id).length == 0) {

      $('#selected_ids').val($('#selected_ids').val() + '(' + id + ')-');
      
      $('#item_selector').before('<tr id="tr' + id + '"><td>'+code+'<input type="hidden" name="items['+id+']" id="added'+id+'" value="'+id+'"/><input type="hidden" class="all_added_item_list" name="inventory_id'+id+'" value="'+id+'"/></td><td>'+name+'</td><td align="right">'+amt_f+'<input type="hidden" name="unit_cost_price'+id+'" id="unit_cost_price'+id+'" value="'+amt+'"/></td><td align="center" id="t_qty'+id+'">'+qty+'</td><td align="center"><input type="number" id="qty'+id+'" name="qty'+id+'" required style="border: 0px; text-align: center; width: 75px;" value="'+qty+'" min="1" max="'+qty+'"> </td><td><input type="text" name="remarks'+id+'" style="border: 0px; width: 100%;" > </td><td align="center"><a href="Javascript:remove_item('+id+')"><i title="remove" class="fa fa-close"></i></a></td></tr>');
    }

  }else{

    $('#tr'+id).fadeOut();
    $('#tr'+id).remove();
    $('#added'+id).remove();
    all-=1;
    var excluded_ids = $('#selected_ids').val();
    $('#selected_ids').val( excluded_ids.replace("("+id+")-", "") );

  }

}
</script>
 

