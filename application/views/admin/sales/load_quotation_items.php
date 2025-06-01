<style type="text/css">
  .accordion .panel-heading { 
      padding: 5px; 
  }
  .panel-heading {
      padding: 4px 7px;
      font-size: 12px !important;
  }
</style>

<form method="post" id="frm_q_item" name="frm_q_item" data-bs-toggle="validator" class="form-horizontal form-label-left"> 
<input type="hidden" name="quotation_id" value="<?=@$quotation_id?>">
<input type="hidden" name="project_id" value="<?=@$project_id?>">
<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
<?php 
if($lcr){
  foreach ($lcr as $rs) {
    $arr_lcr[$rs->id] = $rs;
  }
}

if($qlcr){
  foreach ($qlcr as $rs) {
    $arr_qlcr[$rs->id] = $rs;
  }
}

if($suppliers){
  foreach ($suppliers as $rs) {
    $arr_supp[$rs->id] = $rs->name;
  }
}

if($qitems){
  foreach ($qitems as $rs) {
    if($rs->is_local){
      $arr_items['LOCAL'][] = $rs;
    }elseif($rs->is_manpower){
      $arr_items['MANPOWER'][] = $rs;
    }elseif($rs->other){
      $arr_items['OTHER-'.$rs->other] = $rs; 
    }else{ 
      $arr_items[$rs->quotation_location_id][] = $rs;
    } 
  }
}

if($qlocations){
  foreach ($qlocations as $rs) {
?>  
  <div class="panel">
    <a class="panel-heading" role="tab" id="headingOne<?=$rs->id?>" data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$rs->id?>" aria-expanded="<?=(!@$counter ? 'true' : 'false')?>" aria-controls="collapseOne">
      <h4 class="panel-title"><?=$rs->location_name?></h4>
    </a>
    <div id="collapseOne<?=$rs->id?>" class="panel-collapse collapse <?=(!@$counter ? 'in' : '')?>" role="tabpanel" aria-labelledby="headingOne<?=$rs->id?>">
      <div class="panel-body">
        <table id="location_table<?=$rs->id?>" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Brand/Supplier</th>
              <th>Part Number</th>
              <th>Description</th>
              <th>Package</th>
              <th>Quantity</th>
              <th>L/C Rate</th>
              <th>Unit Cost</th>
              <th>Discount</th> 
              <th>Margin</th> 
              <th>Option</th> 
            </tr>
          </thead>
          <tbody>
            <?php

            if(@$packages){
              foreach ($packages as $rsp) {
                $arr_packages[$rsp->id] = $rsp;
              }
            }

            $counter = 0; 
            if(@$arr_items[$rs->id]){
              foreach ($arr_items[$rs->id] as $rs) { 
            ?>
            <tr id="irow<?=@$counter+=1;?>">
              <td scope="row"><?=@$counter;?></td>
              <td><?=@$arr_supp[$rs->supplier]?></td>
              <td> 
                 
                <input type="text" id="item_code<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->item_code?>" style="border: 0; width: 100%;"> 

              </td>
              <td> 
                <input type="text" id="item_name<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->item_name?>" style="border: 0; width: 100%;"> 
              </td> 
              <td> 
                <select id="package<?=$rs->id?>" onchange="update_item(<?=$rs->id?>)" style="border: 0; width: 100%;">
                  <option value=""></option>
                  <?php if(@$packages){
                    foreach($packages as $prs){?>
                  <option <?php if(@$prs->id==@$rs->package_id){echo 'selected';}?> value="<?=$prs->id?>"><?=$prs->package_name?></option>
                  <?php }}?>
                </select>

                </td>
              <td align="center">
                <input type="number" id="qty<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->qty?>" style="border: 0; width: 70px;"> 
              </td>
              <td title="LC ID:<?=$rs->landed_cost_rate_id?>"><?=@$arr_qlcr[$rs->landed_cost_rate_id]->landed_cost_rate?></td>
              <td align="right"> 
                <input type="number" id="unit_price<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->unit_cost?>" style="border: 0; width: 140px;"> 
              </td>
              <td nowrap> 
                <input type="number" maxlength="2" id="discount<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->discount_percentage?>" style="border: 0; width: 50px;"> 
              %</td> 

              <td nowrap> 
                <input type="number" maxlength="2" id="margin<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->margin?>" style="border: 0; width: 50px;">  %
              </td> 

              <td nowrap> <a href="Javascript:idel('ITEM',<?=$rs->id?>,<?=$counter?>)" ><i class="fa fa-trash"></i> delete</a> </td>
            </tr>
            <?php }}?>
            </tbody>
        </table>
        <table class="table">
          <tfoot>
            <tr id="add_item_row<?=@$rs->quotation_location_id?>">
              <td colspan="9">
                <a href="<?=base_url('sales/add_new_item_to_location/'.$quotation_id.'/'.@$rs->quotation_location_id.'/'.@$counter)?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add New Item</a>
              </td> 
            </tr>
            </tfoot>
        </table>
      </div>
    </div>
  </div>
<?php }}?>   

  <div class="panel">
    <a class="panel-heading" role="tab" id="headingOne<?=$rs->id?>" data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$rs->id?>" aria-expanded="<?=(!@$counter ? 'true' : 'false')?>" aria-controls="collapseOne">
      <h4 class="panel-title">LOCAL MATERIALS</h4>
    </a>
    <div id="collapseOne<?=$rs->id?>" class="panel-collapse collapse <?=(!@$counter ? 'in' : '')?>" role="tabpanel" aria-labelledby="headingOne<?=$rs->id?>">
      <div class="panel-body">
        <table id="location_table_local" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Brand/Supplier</th>
              <th>Part Number</th>
              <th>Description</th>
              <th>Package</th>
              <th>Quantity</th>
              <th>L/C Rate</th>
              <th>Unit Cost</th>
              <th>Discount</th>
              <th>Margin</th> 
              <th>Option</th> 
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 0; 
            if(@$arr_items['LOCAL']){
              foreach ($arr_items['LOCAL'] as $rs) {
             
            ?>
            <tr id="local_row<?=@$counter+=1;?>">
              <td scope="row"><?=@$counter;?></td>
              <td><?=@$arr_supp[$rs->supplier]?></td>
              <td> 
                 
                <input type="text" id="item_code<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->item_code?>" style="border: 0; width: 100%;"> 

              </td>
              <td> 
                <input type="text" id="item_name<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->item_name?>" style="border: 0; width: 100%;"> 
              </td> 
              <td><?=$rs->package_id?></td>
              <td align="center">
                <input type="number" id="qty<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->qty?>" style="border: 0; width: 70px;"> 
              </td>
              <td><?=@$arr_lcr[7]->landed_cost_rate?></td>
              <td align="right"> 
                <input type="number" id="unit_price<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->unit_cost?>" style="border: 0; width: 140px;"> 
              </td>
              <td nowrap> 
                <input type="number" maxlength="2" id="discount<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->discount_percentage?>" style="border: 0; width: 50px;"> 
              %</td> 
              <td nowrap> 
                <input type="number" maxlength="2" id="margin<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->margin?>" style="border: 0; width: 50px;"> %
              </td> 
              <td nowrap> <a href="Javascript:idel('LOCAL',<?=$rs->id?>,<?=$counter?>)"  ><i class="fa fa-trash"></i> delete</a> </td>
            </tr>
            <?php }}?> 
            <tr id="add_item_row<?=$rs->quotation_location_id?>">
              <td colspan="9"><a href="Javascript:add_item_row('LOCAL',<?=@$counter;?>)"><i class="fa fa-plus"></i> Add New Item</a></td> 
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="panel">
    <a class="panel-heading" role="tab" id="headingOne<?=$rs->id?>" data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$rs->id?>" aria-expanded="<?=(!@$counter ? 'true' : 'false')?>" aria-controls="collapseOne">
      <h4 class="panel-title">MANPOWER</h4>
    </a>
    <div id="collapseOne<?=$rs->id?>" class="panel-collapse collapse <?=(!@$counter ? 'in' : '')?>" role="tabpanel" aria-labelledby="headingOne<?=$rs->id?>">
      <div class="panel-body">
        <table id="location_table_manpower" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Brand/Supplier</th>
              <th>Part Number</th>
              <th>Description</th>
              <th>Quantity</th>
              <th>L/C Rate</th>
              <th>Unit Cost</th>
              <th>Discount</th>
              <th>Margin</th> 
              <th>Option</th> 
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 0; 
            if(@$arr_items['MANPOWER']){
              foreach ($arr_items['MANPOWER'] as $rs) {
             
            ?>
            <tr id="manpower_row<?=@$counter+=1;?>">
              <td scope="row"><?=@$counter;?></td>
              <td><?=@$arr_supp[$rs->supplier]?></td>
              <td> 
                 
                <input type="text" id="item_code<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->item_code?>" style="border: 0; width: 100%;"> 

              </td>
              <td> 
                <input type="text" id="item_name<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->item_name?>" style="border: 0; width: 100%;"> 
              </td> 
              <td align="center">
                <input type="number" id="qty<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->qty?>" style="border: 0; width: 70px;"> 
              </td>
              <td><?=@$arr_lcr[7]->landed_cost_rate?></td>
              <td align="right"> 
                <input type="number" id="unit_price<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->unit_cost?>" style="border: 0; width: 140px;"> 
              </td>
              <td nowrap> 
                <input type="number" maxlength="2" id="discount<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->discount_percentage?>" style="border: 0; width: 50px;"> 
              %</td> 
              <td nowrap> 
                <input type="number" maxlength="2" id="margin<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>)" value="<?=$rs->margin?>" style="border: 0; width: 50px;"> %
              </td> 
              <td nowrap> <a href="Javascript:idel('MANPOWER',<?=$rs->id?>,<?=$counter?>)"  ><i class="fa fa-trash"></i> delete</a> </td>
            </tr>
            <?php }}?> 
            <tr id="add_item_row_manpower">
              <td colspan="9">
                <!-- <a href="Javascript:add_item_row('MANPOWER',<?=@$counter;?>)"><i class="fa fa-plus"></i> Add New Item</a> -->
                <a href="<?=base_url('sales/add_new_item_to_location/'.$quotation_id.'/'.@$rs->quotation_location_id.'/'.@$counter)?>/manpower" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add New Item</a>
              </td> 
            </tr>
          </tbody>
        </table>
 

      </div>
    </div>
  </div>

  <div class="panel">
    <a class="panel-heading" role="tab" id="headingOneFC" data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOneFC" aria-expanded="<?=(!@$counter ? 'true' : 'false')?>" aria-controls="collapseOne">
      <h4 class="panel-title">FINANCIAL CHARGES</h4>
    </a>
    <div id="collapseOneFC" class="panel-collapse collapse <?=(!@$counter ? 'in' : '')?>" role="tabpanel" aria-labelledby="headingOneFC">
      <div class="panel-body">
        <table id="location_table_manpower" class="table table-bordered table-striped table-hover">
          
          <tbody>
            <?php  
            @$counter = 0;
            if(@$qothers){
              foreach ($qothers as $rs) { 
            ?>
            <tr id="other_row_other<?=@$counter+=1;?>">
              <td scope="row"><?=@$counter;?></td> 
              <td> 
                <?=@$rs->title?>
              </td>  
              <td align="right" width="10"> 
                <input type="number" id="unit_price<?=$rs->id?>" onkeyup="update_item(<?=$rs->id?>,1)" value="<?=@$arr_items['OTHER-'.$rs->id]->unit_price?>" style="border: 0; width: 140px;"> 
              </td> 
            </tr>
            <?php }}?>
         
          </tbody>
        </table>
 

      </div>
    </div>
  </div>


  <div class="panel">
    <a class="panel-heading" role="tab" id="headingOneSLA" data-bs-toggle="collapse" data-parent="#accordion" href="#collapseOneSLA" aria-expanded="<?=(!@$counter ? 'true' : 'false')?>" aria-controls="collapseOne">
      <h4 class="panel-title">SERVICE LEVEL AGREEMENT</h4>
    </a>
    <div id="collapseOneSLA" class="panel-collapse collapse <?=(!@$counter ? 'in' : '')?>" role="tabpanel" aria-labelledby="headingOne<?=$rs->id?>">
      <div class="panel-body">

        <table id="location_table_manpower" class="table table-bordered table-striped table-hover">
          
          <tbody> 
            <tr id="other_row_sla"> 
              <td><input type="text" id="sla_desc" onkeyup="update_item('sla')" value="<?=@$quotation->sla_desc?>" style="border: 0; width: 100%;"> </td>
              <td align="right" width="10%"> 
                <input type="number" id="sla_amount" onkeyup="update_item('sla')" value="<?=@$quotation->sla_amount?>" style="border: 0; width: 140px;"> 
              </td> 
            </tr>  
          </tbody>
        </table>
  
      </div>
    </div>
  </div>
  
</div>
</form>
<!-- end of accordion -->
<script type="text/javascript">
  function update_item(id,other=''){

    if(id == 'sla'){ 
      var postData = {  
           sla_desc: $('#sla_desc').val(), 
           sla_amount: $('#sla_amount').val() 
       };

    }else if(other){
      var postData = {  
           qty: 1,
           price: $('#unit_price'+id).val(), 
           other: other
       };
    }else{
      var postData = {
           item_code: $('#item_code'+id).val(),
           item_name: $('#item_name'+id).val(),
           package: $('#package'+id).val(),
           qty: $('#qty'+id).val(),
           price: $('#unit_price'+id).val(),
           discount: $('#discount'+id).val(),
           margin: $('#margin'+id).val(),
           other: other
       };
    }

    

     $.ajax({
         type: "POST",
         url: "<?=base_url('sales/quote_save_item/'.$quotation_id)?>/"+id, // Replace with your API endpoint URL
         data: postData,
         success: function(response) {
             console.log("POST request successful:", response);
         },
         error: function(error) {
             console.error("POST request failed:", error);
         }
     });
  }
</script>