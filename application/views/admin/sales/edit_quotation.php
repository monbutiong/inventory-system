<style type="text/css">
  #loadingOverlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top: 4px solid #fff;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.zform_wizard .zstepContainer {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    border: 0 solid #CCC;
    overflow-x: hidden;
    overflow-y: hidden; /* Add this line to prevent vertical scrolling */
  }

   
</style>
<div id="loadingOverlay" style="display: none;">
       <div class="spinner"></div>
</div>
<div id="load_quote_edit">
<?php 
if($lcr){
  foreach ($lcr as $rs) {
    $arr_lcr[$rs->id] = $rs;
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
        $arr_items['OTHER'][$rs->other] = $rs;
    }else{
        $arr_items[$rs->quotation_location_id][] = $rs;

        $discounted = ($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)));

        $lcr_unit = (@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)); 
         
        if(@$arr_lcr[$rs->landed_cost_rate_id]->local_purchase != 1){
           @$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier]+=round($lcr_unit * $rs->qty,2);
        }else{
           @$arr_sc2[$rs->landed_cost_rate_id.'-'.$rs->supplier]+=round($lcr_unit * $rs->qty,2);
        }

        $arr_supp_exit_in_loc[$rs->supplier][$rs->quotation_location_id] = 1;
  
    } 
    if($rs->supplier){$arr_supp_list[$rs->supplier]=@$arr_supp[$rs->supplier];}
    if($rs->landed_cost_rate_id){$arr_lc_list[$rs->landed_cost_rate_id]=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_rate;}
  }
}


if(@$arr_sc){
  foreach ($arr_sc as $key => $value) {
    list($lcr_id,$s_id) = explode('-', $key);

        $legal_fee = 0;
        if(@$legalization_fees){
          foreach ($legalization_fees as $lrs) {
            if($lrs->amount_from<=$value && $lrs->amount_to>=$value){
              if($lrs->percent_of_invoice_val == 1){
                $legal_fee = $value*$lrs->fees;
              }else{
                $legal_fee = $lrs->fees;
              }
              
            }
          }
        }
        @$arr_lf[$lcr_id.'-'.$s_id] = $legal_fee;
    }
}

if(@$packages){
  foreach ($packages as $rs) {
    $arr_pak[$rs->id] = $rs->package_name;
  }
}

?> 
<style type="text/css">
  .hidden {
      display: none !important;
      visibility: hidden;
      height: 0;
  }
  .td_curreny {
     text-align: right; /* Align content to the right */ 
  } 
</style>

<table border="0" style="width: 100%;">
  <tr>
    <td style="width: 200px;">
      <select class="form-control " onchange="filterBy(this.value)" style="width: 200px;">
        <option value="">Filter By</option>
        <option value="8">All</option>
        <option value="5">By Location</option>
        <option value="1">By Brand/Supplier</option>
        <option value="6">Expand All</option>
        <option value="7">Minimize All</option>
        <!-- <option value="2">By Part Number</option>
        <option value="3">By Description</option>
        <option value="4">L/C Rates</option> -->
      </select> 
    </td>
    <td>

      <select id="filter_lcr" class="form-control fb_ select2_dyna" onchange="filterLcrates(this.value)" style="width: 300px; <?php if($filter_by!='lcr'){?>display: none;<?php }?>">
        <option value="">Select</option>
        <?php 
        if(@$arr_lc_list){
          foreach ($arr_lc_list as $lid => $lname) { 
        ?>
        <option value="<?=$lid?>"><?=$lname?></option>
        <?php }}?>
      </select> 
      <select id="filter_supp_name" class="form-control fb_ select2_dyna" onchange="filterSupp(this.value)" style="width: 300px; <?php if($filter_by!='sup'){?>display: none;<?php }?>">
        <option value="">Select</option>
        <?php 
        if(@$arr_supp_list){ 
          asort($arr_supp_list);
        }

        if(@$arr_supp_list){
          foreach ($arr_supp_list as $sid => $sname) { 
        ?>
        <option value="<?=$sid?>" <?php if($filter_val==$sid){echo 'selected';}?>><?=$sname?></option>
        <?php }}?>
      </select> 
      <select id="filter_loc" class="form-control fb_ select2_dyna" onchange="filterLoc(this.value)" style="width: 300px; <?php if($filter_by!='loc'){?>display: none;<?php }?>">
        <option value="">Show All</option>
        <?php 
        if(@$qlocations){
          asort($qlocations);
        }
        
        if(@$qlocations){
          foreach ($qlocations as $rlo) { 
        ?>
        <option value="<?=$rlo->id?>" <?php if($filter_val==$rlo->id){echo 'selected';}?>><?=$rlo->location_name?></option>
        <?php }}?>
      </select> 
      <input type="text" id="filter_part_no" placeholder="Type Part Number" class="form-control fb_" style="width: 300px; display: none;">
      <input type="text" id="filter_desc" placeholder="Type Description" class="form-control fb_" style="width: 300px; display: none;">
       
    </td>
    <td style="text-align: right;" >

      <a href="<?=base_url('sales/quotation_packages/'.$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Packages</a> 
      
      <a href="<?=base_url('sales/set_landed_cost_rate/'.$quotation->id.'/1')?>" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >  Set L/C rates By Supplier</a>

      <a href="<?=base_url('sales/landed_cost_rate/1/'.$quotation->id)?>/1" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" > Set L/C Rates</a>  
      <a href="<?=base_url('sales/legalization_fees/1/'.$quotation->id)?>/1" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" > Set Legal Fees</a>  

      <?php if(@$view){?>
      <a href="<?=base_url('sales/add_location/'.$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Add Section/Location</a>
      <a id="edit_h" href="javascript:edit_header()" class="btn btn-primary btn-sm" >Edit Header</a>
      <a id="save_h" href="javascript:save_header()" class="btn btn-success btn-sm" style="display: none;" >Save Header</a>
      <a id="cancel_h" href="javascript:cancel_header()" class="btn btn-danger btn-sm" style="display: none;" >Cancel Edit</a>

      <a href="<?=base_url('sales/set_terms_and_cond/'.$quotation_id)?>/1" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Terms & Cond.</a>
      <?php }?> 

      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

      <?php if(@$view){?> 
      <a href="<?=base_url('sales/quotation_margin_projection/'.$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Income Projection</a> 
      <?php }?>   

      <a href="<?=base_url('sales/boq/'.@$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BOQ</a>
      <a href="<?=base_url('vendor/print_quotation/'.@$quotation_id)?>" target="_blank" class="btn btn-primary btn-sm othr_btn"  >Preview Quotation</a>
      <a href="<?=base_url('sales/cost_summary/'.@$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details othr_btn" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Imported Materials By Supplier</a>

      <?php if(@$view){?>
      <a href="<?=base_url('sales/quotations')?>" class="btn btn-danger btn-sm othr_btn" >Go Back</a>
      <?php }?> 
    </td>
  </tr>
</table>


<?php if(@$view){?>
 <hr/> <h2>EDIT QUOTATION <?php if($quotation->version){echo ' <span class="badge" style="background-color: red">Revision '.$quotation->version.'</span>';}?></h2>
<form method="post" name="header_frm" action="<?=base_url('sales/update_header/'.$quotation->id)?>"> 
 

  <div class="row">

    <div class="col-md-8 col-sm-12 col-xs-12">
      <div class="x_panel">
        
        <div class="x_content">

          <div class="row"> 
            <div class="form-group col-md-3">
              <label for="inputEmail4">Project</label>
              <input type="text" readonly class="form-control" value="<?=@$project->name?>">
            </div> 
            <div class="form-group col-md-3">
              <label for="">Quotation Number</label>
              <input type="text" name="quotation_number" readonly class="form-control hdet" value="<?=@$quotation->quotation_number;  ?>">
            </div>
            <div class="form-group col-md-3">
              <label for="">Client Name</label>
              <input type="text" readonly class="form-control" value="<?=@$client->name?>">
            </div>
            <div class="form-group col-md-3">
              <label for="inputEmail4">Quotation Date</label>
              <input type="date" name="quotation_date" readonly class="form-control hdet" value="<?=date('Y-m-d',strtotime(@$quotation->quotation_date))?>">
            </div>

            <div class="form-group col-md-3">
              <label for="inputEmail4">Start Date</label>
              <input type="date" name="start_date" readonly class="form-control hdet" value="<?=date('Y-m-d',strtotime(@$quotation->start_date))?>">
            </div>

            <div class="form-group col-md-3">
              <label for="inputEmail4">Completion Date</label>
              <input type="date" name="completion_date" readonly class="form-control hdet" value="<?=date('Y-m-d',strtotime(@$quotation->completion_date))?>">
            </div>

            <div class="form-group col-md-3">
              <label for="">Attention To</label>
              <input type="text" name="att_to" readonly class="form-control hdet" value="<?=@$quotation->att_to?>">
            </div>
            <div class="form-group col-md-3">
              <label for="inputEmail4">Validity</label>
              <input type="number" name="validity" readonly class="form-control hdet" value="<?=@$quotation->validity?>">
            </div>

            <div class="form-group col-md-12">
              <label for="inputEmail4">Description</label>
              <textarea name="description" readonly class="form-control hdet" ><?=@$quotation->description?></textarea>
            </div>

          </div>
               
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="x_panel"> 
        <div class="x_content">
          
            <div class="form-group col-md-6">
              <label for="">Project Cost</label>
              <input type="text" id="proj_cost" readonly class="form-control" value="0%" style="text-align: center">
            </div> 
            <div class="form-group col-md-6">
              <label for="" style="cursor: pointer;">
                <a href="<?=base_url('sales/applied_ave_margin_quotation/'.$quotation->id)?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Applied Avarage Margin <i class="fa fa-file-o"></i></a>
              </label>
              <input type="number" id="ave_margin" readonly class="form-control" value="0">
            </div> 
            <div class="form-group col-md-6">
              <label for="">Project Amount</label>
              <input type="text" id="proj_amt" readonly class="form-control" value="0.00" style="text-align: center">
            </div> 
            <div class="form-group col-md-6">
              <label for="">General Margin</label>
              <input type="number" name="margin" id="gmargin" onkeyup="max_margin(this.value)" readonly class="form-control hdet" value="<?=@$quotation->margin?>">
            </div>
            

          </div>
        </div>
      </div>
    </div>
 

</form>
<?php }?>

<script type="text/javascript">

  function filterLoc(v){
    location.href = "<?=base_url('sales/edit_quotation/'.$quotation->id.'/loc');?>/"+v; 
  }

  function filterSupp(v){
    location.href = "<?=base_url('sales/edit_quotation/'.$quotation->id.'/sup');?>/"+v; 
  }

  function filterLcrates(v){
    location.href = "<?=base_url('sales/edit_quotation/'.$quotation->id);?>";
  }
  

  function filterBy(v){
 
    $('.fb_').hide();

      if(v == 1){
        $('#filter_supp_name').show();
      }else if(v == 2){
        $('#filter_part_no').show();
      }else if(v == 3){
        $('#filter_desc').show();
      }else if(v == 4){
        $('#filter_lcr').show();
      }else if(v == 5){
        $('#filter_loc').show();
      }else if(v == 6){
        $('.all_loc').show();
      }else if(v == 7){
        $('.all_loc').hide();
        $('.all_loc_header').show();
      }else if(v == 8){
        location.href = "<?=base_url('sales/edit_quotation/'.$quotation->id)?>";
      }
 
  }
</script>
 
 
 <style type="text/css">
   th, td{
    font-size: 11px;
   }

   /* Style the table header */
   .table-container {
       overflow-x: auto;
   }
 

   thead {
       background-color: #f5f5f5;
   }

   .table-sticky {
     width: 100%;
     border-collapse: collapse;
   }

   .table-sticky thead {
     position: sticky;
     top: 0;
     background-color: #f1f1f1;
   }

   .table-sticky thead th {
     border: 1px solid #ccc;
     padding: 8px;
   }

   .table-sticky tbody td {
     border: 1px solid #ccc;
     padding: 8px;
   }
 </style>


  <table class="table table-bordered table-striped table-hover table-sticky">
    <thead class="main-thead">
      <tr>
        <th>#</th>
        <th width="100">Brand/Supplier</th>
        <th width="250">Part Number</th>
        <th width="250">Description</th>
        <th width="250">Package</th>
        <th>Quantity</th>
        <th>L/C Rate</th>
        <th width="100">FOB</th>
        <th>Discount</th> 
        <th>Discounted FOB</th>
        <th>Net FOB</th>
        <th>L/C Factor</th>
        <th>Legalization Fee</th>
        <!-- <th>Landed Unit Price</th>
        <th>Landed NET Price</th>
        <th>-</th> -->
        
        <th>Landed Unit Price</th>
        <th>Landed Net Price</th>
        <th>-</th> 
        <th>Margin</th>
        <th>Unit Profit </th>
        <th>Net Profit</th>
        <th>Unit Price </th>
        <th>Net Price</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!@$view){?>
      <tr>
        <td colspan="21"><center><h2><?=$project->name?></h2></center></td>
      </tr>
      <?php }?>
      <?php 
      $ttl_margin = 0;
      $count_margin = 0;

      $qty_ttl = 0;
      $counter = 0; 
      $fob_ttl = 0;
      $lcr_unit_ttl = 0;
      $landed_net_ttl = 0;
      if($qlocations){
        foreach ($qlocations as $lrs) {

          if(!$filter_by || 
            ($filter_by=='loc' && $filter_val==$lrs->id) || 
            ($filter_by=='sup' && @$arr_supp_exit_in_loc[$filter_val][$lrs->id])
          ){
      ?>
      <tr class="loc_area_<?=$lrs->id?> all_loc all_loc_header" >
        <td nowrap>
        
          <a title="edit section" href="<?=base_url('sales/edit_location/'.$lrs->id)?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-edit"></i></a>
          
           &nbsp; 

          <a title="add item to section" href="<?=base_url('sales/add_item_to_location/'.$quotation->id.'/'.$lrs->id)?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></a>

        </td>
        <td onclick="show_q_items(<?=$lrs->id?>)" colspan="12" style="background-color: #999; color: #fff; cursor: pointer;">  
          <b style="color: #fff;"><?=$lrs->location_name?></b>  
        </td>
        <td onclick="show_q_items(<?=$lrs->id?>)" nowrap class="td_curreny" style="background-color: #999; color: #fff; border-left: 0; cursor: pointer;">TOTAL LANDED NET</td>
        <td class="td_curreny" style="background-color: #999; color: #fff;"><b id="loc_ttl<?=$lrs->id?>"><?=number_format(0,2);?></b></td>
        <td onclick="show_q_items(<?=$lrs->id?>)" nowrap class="td_curreny"colspan="5" style="background-color: #999; color: #fff; cursor: pointer;">TOTAL NET</td>
        <td class="td_curreny" style="background-color: #999; color: #fff;"><b id="loc_mar_ttl<?=$lrs->id?>"><?=number_format(0,2);?></b></td>
      </tr>
      <?php
      
      $fob2_ttl = 0;
      $qty_ttl = 0;
      
      $lcr_unit2_ttl = 0;
      
      $landed_net2_ttl = 0;

      $net_mar_ttl = 0;

      $lcnet=0;

      

      if(@$arr_items[$lrs->id]){
        foreach ($arr_items[$lrs->id] as $rs) {
       
        if(!$filter_by || 
          ($filter_by=='loc') ||
          ($filter_by=='sup' && $filter_val==$rs->supplier)
        ){

      ?>
      <tr onclick="edit_item(<?=$rs->id?>)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?=$lrs->id?> all_loc supp_<?=$rs->supplier?> all_rows" style="cursor: pointer; display: none;">
        <td scope="row"><?=@$counter+=1;?></td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td>
        <td><?=@$arr_pak[$rs->package_id]?></td> 
        <td class="td_curreny"><?=number_format($rs->qty); $qty_ttl+=$rs->qty;?></td>
        <td><?=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_rate?></td>
        <td class="td_curreny" nowrap><?=@$arr_lcr[$rs->landed_cost_rate_id]->currency_symbol?> <?=number_format($rs->unit_cost,2); $fob_ttl+=$rs->unit_cost; $fob2_ttl+=$rs->unit_cost;?></td>
        <td><?=number_format($rs->discount_percentage); $dis_per=$rs->discount_percentage ? $rs->discount_percentage : 0;?>%</td> 
        <td><?=number_format($rs->unit_cost - ($rs->unit_cost*($dis_per/100)),2); $discounted = ($rs->unit_cost - ($rs->unit_cost*($dis_per/100)))?></td>

        <?php 
        $lcr_unit = round((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)),2); $lcr_unit_ttl+=$lcr_unit; $lcr_unit2_ttl+=$lcr_unit;
        ?>

        <td class="td_curreny" title="<?="($rs->unit_cost - ($rs->unit_cost*($dis_per/100)) ) * $rs->qty"?>"><?=number_format(($rs->unit_cost - ($rs->unit_cost*($dis_per/100)) ) * $rs->qty,2)?></td>
        <td><?=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_factor?></td>
        <td class="td_curreny" title="<?='((('.$lcr_unit.' * '.$rs->qty.')/'.@$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier].')*'.@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier].')/'.$rs->qty?>"><?php 
        $lf = 0;
        //===== LEGALIZATION FEES
        if(@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier]){
          $lf = round(((($lcr_unit * $rs->qty)/@$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier])*@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier])/$rs->qty,2);  
        }
        if($lf>0){
          echo number_format($lf,2); @$ttl_legal_fee+=$lf; @$ttl_legal_fee_all+=$lf;
        }
        
        ?></td>
        <!-- <td title="<?php 
        echo '('.@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor.' * '.$discounted.') + (('.@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor.' * '.$discounted.') * ('.@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent.'/100)) + (('.@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor.' * '.$discounted.') * ('.@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent.'/100))'
        ?>"><?php 
 
          echo number_format($lcr_unit,2);  
        ?></td>
        <td title="<?='('.$lcr_unit.' * '.$rs->qty.')'?>"><?=number_format($lcr_unit * $rs->qty,2); $landed_net_ttl+=($lcr_unit * $rs->qty); $landed_net2_ttl+=($lcr_unit * $rs->qty);?></td>
        <td></td> -->
        
        <td class="td_curreny" title="<?="$lcr_unit+$lf"?>"><?=number_format($lcr_unit+$lf,2); $landed_unit_price=$lcr_unit+$lf; ?></td>
        <td class="td_curreny" title="<?="($landed_unit_price * $rs->qty)"?>"><?=number_format($landed_unit_price * $rs->qty,2); $lcnet+=($landed_unit_price * $rs->qty); ?></td>
        <td></td> 
        <?php  $rs->margin = ($rs->margin>0 ? $rs->margin : 0);?>
        <td><?=$rs->margin; $ttl_margin+= $rs->margin; $count_margin+=1;?>%</td>
        <td class="td_curreny" title="<?="($landed_unit_price / (1-($rs->margin/100)))-$landed_unit_price"?>"><?=number_format(($landed_unit_price / (1-($rs->margin/100)))-($lcr_unit+$lf),2);?></td>
        <td class="td_curreny" title="<?="((($landed_unit_price / (1-($rs->margin/100)))-$landed_unit_price)*$rs->qty)"?>"><?=number_format((($landed_unit_price / (1-($rs->margin/100)))-$landed_unit_price)*$rs->qty,2);?></td>
        <td class="td_curreny" title="Formula: <?="$landed_unit_price / (1-($rs->margin/100))"?>"><?=number_format($landed_unit_price / (1-($rs->margin/100)),2); $margin_unit = round($landed_unit_price / (1-($rs->margin/100)),2)?></td>
        <td class="td_curreny" title="<?="($margin_unit * $rs->qty)"?>"><?=number_format($margin_unit*$rs->qty,2); $net_mar_ttl+=round($margin_unit*$rs->qty,2);?></td> 
      </tr>
      <?php }}}?>
      <tr class="loc_area_<?=$lrs->id?> loc_area_body_<?=$lrs->id?> all_loc all_ttl">
        <td colspan="7"></td>
        <td class="td_curreny"><b><?=number_format($fob2_ttl,2); $fob2_ttl=0;?></b></td>
        <td colspan="4"></td> 
        <td class="td_curreny"><b><?=number_format(@$ttl_legal_fee,2); $ttl_legal_fee=0;?></b></td>
        <td></td> 
        <td class="td_curreny"><b><?=number_format(@$lcnet,2); @$all_lcnet+=$lcnet;?></b></td>
        <td colspan="5"></td> 
        <td class="td_curreny">
          <b><?=number_format($net_mar_ttl,2); @$all_net_mar_ttl+=$net_mar_ttl;?></b>
          <script type="text/javascript"> 
            $('#loc_ttl<?=$lrs->id?>').html('<?=number_format(@$lcnet,2); $lcnet=0;?>');
            $('#loc_mar_ttl<?=$lrs->id?>').html('<?=number_format(@$net_mar_ttl,2); $net_mar_ttl=0;?>');
          </script>
        </td>
      </tr>
      <?php }}}?> 
      <tr style="background-color: #e6ebf2;">
         <td colspan="14"><b>TOTAL</b></td>  
         <td class="td_curreny"><b><?=number_format(@$all_lcnet,2); ?></b></td>
         <td colspan="5"></td> 
         <td class="td_curreny"><b><?=number_format(@$all_net_mar_ttl,2); ?></b></td>
      </tr>
    </tbody>
    
    <thead>
      <tr>
        <th colspan="21" ><br/><br/></th>
      </tr>
      <tr class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
        <th>
          <a title="add item to section" href="<?=base_url('sales/add_item_to_location/'.$quotation->id.'/local')?>" class="load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></a>
        </th>
        <th onclick="show_q_items('local')" colspan="20" style="background-color: #999; color: #fff;"><b>LOCAL MATERIALS</b></th>
      </tr>
      <tr class="all_loc loc_area_body_<?='local'?>">
        <th>#</th>
        <th>#</th>
        <th>Part Number</th>
        <th>Description</th>
        <th>Package</th>
        <th>Quantity</th>
        <th>Currency</th>
        <th>Unit Cost</th>
        <th colspan="6"></th> 
        <th>Total Price (Net)</th>
        <th>-</th>
        <th>Margin</th>
        <th>Unit Profit </th>
        <th>Net Profit</th>
        <th>Unit Price </th>
        <th>Net Price</th> 
      </tr>
    </thead>
    <tbody>
      <?php
      $ttl = 0;
      $counter = 0; 
      $all_local_ttl = 0;
      $local_amt_ttl=0;
      $local_cost_ttl=0;

      if(@$arr_items['LOCAL']){
        foreach ($arr_items['LOCAL'] as $rs) { 
      ?>
      <tr onclick="edit_item(<?=$rs->id?>)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"  id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?='local'?> all_loc supp_<?=$rs->supplier?> all_rows">
        <td scope="row"><?=@$counter+=1;?></td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td>
        <td><?=@$arr_pak[$rs->package_id]?></td> 
        <td class="td_curreny"><?=number_format($rs->qty)?></td>
        <td>QR</td>
        <td class="td_curreny"><?=$rs->unit_cost?></td>
        <td colspan="6"></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost * $rs->qty, 2); $ttl+=($rs->unit_cost * $rs->qty);?></td>  
        <td></td>
        <td><?=$rs->margin; $ttl_margin+=$rs->margin; $count_margin+=1;?>%</td>
        <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
        <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$all_local_ttl+=round($r_unt*$rs->qty,2);?></td> 
      </tr>
      <?php }}?> 
      <tr style="background-color: #e6ebf2;">
        <td colspan="14"><b>TOTAL</b></td>
        <td class="td_curreny"><b><?=number_format($ttl,2); $local_amt_ttl=$ttl?></b></td> 
        <td colspan="5"></td> 
        <td class="td_curreny"><b><?=number_format($all_local_ttl,2); $local_cost_ttl=$all_local_ttl;?></b></td>
      </tr>
    </tbody>
    <thead>
      <tr onclick="show_q_items('manpower')" class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
        <th colspan="21" style="background-color: #999; color: #fff;"><b>MANPOWER</b></th>
      </tr>
      <tr class="all_loc loc_area_body_<?='manpower'?>">
        <th>#</th>
        <th>#</th>
        <th>Part Number</th>
        <th colspan="2">Description</th>
        <th>Quantity</th>
        <th>Currency</th>
        <th>Unit Cost</th>
        <th colspan="6"></th> 
        <th>Total Price (Net)</th>
        <th>-</th>
        <th>Margin</th>
        <th>Unit Profit </th>
        <th>Net Profit</th>
        <th>Unit Price </th>
        <th>Net Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $ttl = 0;
      $all_local_ttl = 0;
      $counter = 0; 
      $manpower_amt_ttl=0;
      $manpower_cost_ttl=0;

      if(@$arr_items['MANPOWER']){
        foreach ($arr_items['MANPOWER'] as $rs) {
       
      ?>
      <tr id="q_items<?=$rs->id?>" onclick="edit_item(<?=$rs->id?>)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" class="loc_area_<?=$lrs->id?> loc_area_body_<?='manpower'?> all_loc supp_<?=$rs->supplier?> all_rows">
        <td scope="row"><?=@$counter+=1;?></td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td colspan="2"><?=$rs->item_name?></td> 
        <td class="td_curreny"><?=number_format($rs->qty)?></td>
        <td>QR</td>
        <td class="td_curreny"><?=$rs->unit_cost?></td>
        <td colspan="6"></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost * $rs->qty, 2); $ttl+=($rs->unit_cost * $rs->qty);?></td>  
        <td></td>
        <td><?=$rs->margin; $ttl_margin+=$rs->margin; $count_margin+=1;?>%</td>
        <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
        <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$all_local_ttl+=round($r_unt*$rs->qty,2);?></td> 
      </tr>
      <?php }}?> 
      <tr style="background-color: #e6ebf2;">
        <td colspan="14"><b>TOTAL</b></td>
        <td class="td_curreny"><b><?=number_format($ttl,2); $manpower_amt_ttl=$ttl;?></b></td> 
        <td colspan="5"></td> 
        <td class="td_curreny"><b><?=number_format($all_local_ttl,2); $manpower_cost_ttl=$all_local_ttl;?></b></td>
      </tr>
      <thead>
        <tr onclick="show_q_items('other')" class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
          <th colspan="21" style="background-color: #999; color: #fff;"><b>FINANCIAL CHARGES</b></th>
        </tr>
        <tr class="all_loc loc_area_body_<?='other'?>">
          <th>#</th>
          <th>#</th>
          <th>Part Number</th>
          <th colspan="2">Description</th>
          <th>Quantity</th>
          <th>Currency</th>
          <th>Unit Cost</th>
          <th colspan="6"></th> 
          <th>Total Price (Net)</th>
          <th>-</th>
          <th>Margin</th>
          <th>Unit Profit </th>
          <th>Net Profit</th>
          <th>Unit Price </th>
          <th>Net Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $ttl = 0;
        $all_local_ttl = 0;
        $counter = 0;  
        $ttl_other_amt = 0;
        @$ttl_other_no_margin_amt = 0;

        if(@$qothers){
          foreach ($qothers as $rs) {  
            $oid = $rs->id;
            $item_id = @$arr_items['OTHER'][$oid]->id ? $arr_items['OTHER'][$oid]->id : 0;
        ?>
        <tr onclick="edit_other('<?=$item_id?>',<?=@$oid?>)" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg"  id="q_items_other" class="loc_area_other loc_area_body_<?='other'?> all_loc supp_other all_rows">
          <td scope="row"><?=@$counter+=1;?></td>
          <td> </td>
          <td> </td>
          <td colspan="2"><?=$rs->title?></td> 
          <td class="td_curreny">1</td>
          <td>QR</td>
          <td class="td_curreny"><?=number_format(@$arr_items['OTHER'][$oid]->unit_cost,2)?></td>
          <td colspan="6"></td>
          <td class="td_curreny"><?=number_format(@$arr_items['OTHER'][$oid]->unit_cost,2); $ttl_other_no_margin_amt+=@$arr_items['OTHER'][$oid]->unit_cost?></td>  
          <td> </td>
          <?php 
          $rs->margin=@$arr_items['OTHER'][$oid]->margin;
          $rs->unit_cost=@$arr_items['OTHER'][$oid]->unit_cost;
          $rs->qty = 1;
          ?>
          <td><?=@$arr_items['OTHER'][$oid]->margin; $ttl_margin+=@$arr_items['OTHER'][$oid]->margin; $count_margin+=1;?>%</td>
          <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
          <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
          <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>  
          <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$ttl_other_amt+=round($r_unt*$rs->qty,2);?></td> 
        </tr>
        <?php }}?> 
        <tr style="background-color: #e6ebf2;">
        <td colspan="14"><b>TOTAL</b></td>
          <td class="td_curreny"><b><?=number_format($ttl_other_no_margin_amt,2);?></b></td> 
          <td colspan="5"></td>  
          <td class="td_curreny"><b><?=number_format($ttl_other_amt,2)?></b></td>
        </tr>
      </tbody>
      <thead>
        <tr onclick="show_q_items('sla')" class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
          <th colspan="21" style="background-color: #999; color: #fff;"><b>SERVICE LEVEL AGREEMENT (SLA)</b></th>
        </tr>
        <tr class="all_loc loc_area_body_<?='sla'?>">
          <th>#</th>
          <th>#</th>
          <th>Part Number</th>
          <th colspan="2">Description</th>
          <th>Quantity</th>
          <th>Currency</th>
          <th>Unit Cost</th>
          <th colspan="6"></th> 
          <th>Total Price (Net)</th>
          <th>-</th>
          <th>Margin</th>
          <th>Unit Profit </th>
          <th>Net Profit</th>
          <th>Unit Price </th>
          <th>Net Price</th>
        </tr>
      </thead>
      <?php $ttl_sla_amount=0;
      $ttl_sla_no_margin_amount=0;
      ?>
      <tbody> 
        <tr onclick="edit_sla()" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" id="q_items_sla" class="loc_area_other loc_area_body_<?='sla'?> all_loc supp_sla all_rows">
          <td scope="row">1</td>
          <td> </td>
          <td> </td>
          <td colspan="2"><?=$quotation->sla_desc?></td> 
          <td class="td_curreny">1</td>
          <td>QR</td>
          <td class="td_curreny"><?=number_format(@$quotation->sla_amount,2)?></td>
          <td colspan="6"></td>
          <td class="td_curreny"><?=number_format(@$quotation->sla_amount,2); $ttl_sla_no_margin_amount+=@$quotation->sla_amount?></td>  
          <td> </td>
          <?php 
          $rs->margin=@$quotation->sla_margin;
          $rs->unit_cost=@$quotation->sla_amount;
          $rs->qty = 1;
          ?>
          <td><?=@$quotation->sla_margin; $ttl_margin+=@$arr_items['OTHER'][$oid]->margin; $count_margin+=1;?>%</td>
          <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
          <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
          <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>  
          <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$ttl_sla_amount+=round($r_unt*$rs->qty,2);?></td>  
        </tr> 
        <tr style="background-color: #e6ebf2;">
        <td colspan="14"><b>TOTAL</b></td>
          <td class="td_curreny"><b><?=number_format($ttl_sla_no_margin_amount,2);?></b></td> 
          <td colspan="5"></td> 
          <td class="td_curreny"><b><?=number_format($ttl_sla_amount,2)?></b></td>
        </tr>
      </tbody>
    </tbody>
  </table>
  
  <input type="hidden" id="grand_total" value="<?=@$all_lcnet+$manpower_amt_ttl+$local_amt_ttl+$ttl_other_amt+$ttl_sla_amount?>">
  <input type="hidden" id="f_grand_total" value="<?=number_format( @$all_lcnet+$manpower_amt_ttl+$local_amt_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>">

  <input type="hidden" id="grand_proj_cost" value="<?=@$all_net_mar_ttl+$local_cost_ttl+$manpower_cost_ttl+$ttl_other_amt+$ttl_sla_amount?>">
  <input type="hidden" id="f_grand_proj_cost" value="<?=number_format( @$all_net_mar_ttl+$local_cost_ttl+$manpower_cost_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>">
 
<!-- end of accordion -->
<script type="text/javascript">

  var prj_amt = $('#grand_total').val();
  $('#proj_cost').val('QAR <?=number_format($m_cost = @$all_lcnet+$local_amt_ttl+$manpower_amt_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>');

  $('#proj_amt').val('QAR <?=number_format($m_amt = @$all_net_mar_ttl+$local_cost_ttl+$manpower_cost_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>');

  <?php if($ttl_margin>0){?> 
    var ave_margin = '<?=number_format((($m_amt - $m_cost)/$m_amt) * 100 ,2)?>';
    $('#ave_margin').val(ave_margin);
  <?php }?>
  
  $('.all_loc').hide();
  $('.all_loc_header').show();

  function show_q_items(v){  
      
    $('.loc_area_body_'+v).toggle();
  }

  window.onscroll = function() {
    var stickyHeader = document.querySelector('.table-sticky .main-thead');
    var scrollTop = window.pageYOffset;

    if (scrollTop > stickyHeader.offsetHeight) {
      stickyHeader.classList.add('sticky');
    } else {
      stickyHeader.classList.remove('sticky');
    }
  };

  function edit_item(id){
    $("#load_modal_fields_large").load('<?=base_url("sales/edit_item/".$quotation->id)?>/'+id, function(){
      $('.select2').select2();
    });  
  }

  function edit_other(id,other_id){
    $("#load_modal_fields_large").load('<?=base_url("sales/edit_other/".$quotation->id)?>/'+id+'/'+other_id, function(){
      $('.select2').select2();
    });  
  }

  function edit_sla(){
    $("#load_modal_fields_large").load('<?=base_url("sales/edit_sla/".$quotation->id)?>', function(){
      //$('.select2').select2();
    });  
  }

  function edit_header(){
    reset(); 

    alertify.confirm("Edit Quotation header details?.", function (e) {
          if (e) {  

            $('.othr_btn').hide();

            $('#save_h').show();
            $('#cancel_h').show();
            $('#edit_h').hide();
             
            $('.hdet').removeAttr("readonly");
              
          } else {
              alertify.log("cancelled");
          }
      }, "Confirm");
  }

  function cancel_header(){
    location.href = "<?=base_url('sales/edit_quotation/'.$quotation->id)?>";
  }

  function save_header(){
    document.header_frm.submit();
  }

  function max_margin(m){
    if(m > 100){
      $('#gmargin').val(99);
    } 
  }
 
</script>
</div>
