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
           @$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier]+=($lcr_unit * $rs->qty);
        }else{
           @$arr_sc2[$rs->landed_cost_rate_id.'-'.$rs->supplier]+=($lcr_unit * $rs->qty);
        }
  
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

if(@$rri){
  foreach ($rri as $rs) {
    @$arr_rri[$rs->inventory_id]+=$rs->qty;
  }
}

if(@$iii){
  foreach ($iii as $rs) {
    @$arr_iii[$rs->inventory_id]+=$rs->qty;
  }
}

if(@$packages){
  foreach ($packages as $rsp) {
    $arr_packages[$rsp->id] = $rsp->package_name;
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
 
<div id="load_quote_final" <?php if($confirm_save_amount == 'confirm_save_amount'){echo "style='display: none;'";}?>>
<table border="0" style="width: 100%;">
  <tr>
    <td style="width: 200px;">
      <select class="form-control " onchange="filterBy(this.value)" style="width: 200px;">
        <option value="">Filter By</option>
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

      <select id="filter_lcr" class="form-control fb_ select2_dyna" onchange="filterLcrates(this.value)" style="width: 300px; display: none;">
        <option value="">Select</option>
        <?php 
        if(@$arr_lc_list){
          foreach ($arr_lc_list as $lid => $lname) { 
        ?>
        <option value="<?=$lid?>"><?=$lname?></option>
        <?php }}?>
      </select> 
      <select id="filter_supp_name" class="form-control fb_ select2_dyna" onchange="filterSupp(this.value)" style="width: 300px; display: none;">
        <option value="">Select</option>
        <?php 
        if(@$arr_supp_list){
          foreach ($arr_supp_list as $sid => $sname) { 
        ?>
        <option value="<?=$sid?>"><?=$sname?></option>
        <?php }}?>
      </select> 
      <select id="filter_loc" class="form-control fb_ select2_dyna" onchange="filterLoc(this.value)" style="width: 300px; display: none;">
        <option value="">Show All</option>
        <?php 
        if(@$qlocations){
          foreach ($qlocations as $rlo) { 
        ?>
        <option value="<?=$rlo->id?>"><?=$rlo->location_name?></option>
        <?php }}?>
      </select> 
      <input type="text" id="filter_part_no" placeholder="Type Part Number" class="form-control fb_" style="width: 300px; display: none;">
      <input type="text" id="filter_desc" placeholder="Type Description" class="form-control fb_" style="width: 300px; display: none;">
      

    </td>
    <td style="text-align: right;">
      
       <a href="<?=base_url('sales/quotation_packages/'.$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Packages</a> 

       <?php if(@$view){?>
       <a href="<?=base_url('sales/quotation_margin_projection/'.$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Income Projection</a> 
       <?php }?>

       <a href="<?=base_url('sales/landed_cost_rate/1/'.$quotation->id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >  L/C Rates</a>  
       <a href="<?=base_url('sales/legalization_fees/1/'.$quotation->id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >  Legal Fees</a>

       <?php if(!@$view){?>
       <a href="<?=base_url('sales/set_landed_cost_rate/'.$quotation->id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >  Set L/C rates</a>
       <?php }?>

      <a href="<?=base_url('sales/boq/'.@$quotation_id)?>"  class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BOQ</a>
      <a href="<?=base_url('vendor/print_quotation/'.@$quotation_id)?>" target="_blank" class="btn btn-primary btn-sm"  >Preview Quotation</a>
      <a href="<?=base_url('sales/cost_summary/'.@$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Imported Materials By Supplier</a>

      <a href="<?=base_url('sales/set_terms_and_cond/'.$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >Terms & Cond.</a>

      <?php if(@$view){?>
      <a href="<?php if(@$from_history){ echo base_url('sales/quotation_history/'.$from_history); }elseif($quotation->confirmed == 1){ echo base_url('sales/confirmed_quotation'); }else{ echo base_url('sales/quotations'); }?>" class="btn btn-danger btn-sm" >Go Back</a>
      <?php }?>  
    </td>
  </tr>
</table>

<?php if(@$view){?>
 <hr/> 
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
             <label for="inputPassword4">Quotation Number</label>
             <input type="text" name="quotation_number" readonly class="form-control hdet" value="<?=@$quotation->quotation_number;  ?>">
           </div>
           <div class="form-group col-md-3">
             <label for="inputPassword4">Client Name</label>
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
             <label for="inputPassword4">Attention To</label>
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
             <label for="inputPassword4">Project Cost</label>
             <input type="text" id="proj_amt" readonly class="form-control" value="0%" style="text-align: center">
           </div> 
           <div class="form-group col-md-6">
             <label for="inputPassword4">Avarage Margin</label>
             <input type="text" id="ave_margin" readonly class="form-control" value="0">
           </div> 
           <div class="form-group col-md-6">
             <label for="inputPassword4">Project Amount</label>
             <input type="text" id="proj_cost" readonly class="form-control" value="0.00" style="text-align: center">
           </div> 
           <div class="form-group col-md-6">
             <label for="inputPassword4">General Margin</label>
             <input type="number" name="margin" readonly class="form-control hdet" value="<?=@$quotation->margin?>">
           </div> 
           

         </div>
       </div>
     </div>
   </div>

<?php }?>

<script type="text/javascript">

  function filterLoc(v){
    if(v){
      console.log('loc',v);
      $('.all_loc').hide();
      $('.loc_area_'+v).show();
    }else{ 
      $('.all_loc').hide(); 
      $('.all_loc_header').show();
    }
    
  }

  function filterSupp(v){
    console.log('loc',v);
    $('.all_loc').show();
    $('.all_ttl').hide();
    $('.all_rows').hide();
    $('.supp_'+v).show();
  }

  function filterLcrates(v){
    console.log('loc',v);
    $('.all_loc').hide();
    $('.loc_area_'+v).show();
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
      }
 
  }
</script>
 
 
 <style type="text/css">
   th, td{
    font-size: 12px;
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
        <td colspan="<?=@$quotation->confirmed==1 ? '23' : '21'?>"><center><h2><?=$project->name?></h2></center></td>
      </tr>
      <?php }?>
      <?php 
      $qty_ttl = 0;
      $counter = 0; 
      $fob_ttl = 0;
      $lcr_unit_ttl = 0;
      $landed_net_ttl = 0;

      $ttl_margin = 0;
      $count_margin = 0;

      if($qlocations){
        foreach ($qlocations as $lrs) {
      ?>
      <tr onclick="show_q_items(<?=$lrs->id?>)" class="loc_area_<?=$lrs->id?> all_loc all_loc_header" style="cursor: pointer;">
        <td colspan="13" style="background-color: #999; color: #fff;">  
          <b style="color: #fff;"><?=$lrs->location_name?></b>  
        </td>
        <td nowrap class="td_curreny" style="background-color: #999; color: #fff; border-left: 0;">TOTAL LANDED NET</td>
        <td class="td_curreny" style="background-color: #999; color: #fff;"><b id="loc_ttl<?=$lrs->id?>"><?=number_format(0,2);?></b></td>
        <td nowrap class="td_curreny"colspan="5" style="background-color: #999; color: #fff;">TOTAL NET</td>
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
       
      

      ?>
      <tr id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?=$lrs->id?> all_loc supp_<?=$rs->supplier?> all_rows">
        <td scope="row"><?=@$counter+=1;?></td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td>
        <td><?=@$arr_packages[$rs->package_id]?></td> 
        <td class="td_curreny"><?=number_format($rs->qty); $qty_ttl+=$rs->qty;?></td>

      

        <td><?=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_rate?></td>
        <td class="td_curreny" nowrap><?=@$arr_lcr[$rs->landed_cost_rate_id]->currency_symbol?> <?=number_format($rs->unit_cost,2); $fob_ttl+=$rs->unit_cost; $fob2_ttl+=$rs->unit_cost;?></td>
        <td><?=number_format($rs->discount_percentage)?>%</td> 
        <td><?=number_format($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)),2); $discounted = ($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)))?></td>

        <?php 
        $lcr_unit = round((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)),2); $lcr_unit_ttl+=$lcr_unit; $lcr_unit2_ttl+=$lcr_unit;
        ?>

        <td class="td_curreny"><?=number_format(($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)) ) * $rs->qty,2)?></td>
        <td title="LC ID:<?=@$rs->landed_cost_rate_id?>"><?=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_factor?></td>
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
        
        <td class="td_curreny" title="<?='('.$lcr_unit.' * '.$lf.')'?>"><?=number_format($lcr_unit+$lf,2); ?></td>
        <td class="td_curreny" title="<?='('.($lcr_unit*$lf).' * '.$rs->qty.')'?>"><?=number_format(($lcr_unit+$lf) * $rs->qty,2); $lcnet+=(($lcr_unit+$lf) * $rs->qty); ?></td>
        <td></td>
        <?php $rs->margin = floatval($rs->margin);?>
        <td class="td_curreny"><?=@$rs->margin; @$ttl_margin+=$rs->margin; @$count_margin+=1;?>%</td>
        <td class="td_curreny"><?=number_format((($lcr_unit+$lf) / (1-($rs->margin/100)))-($lcr_unit+$lf),2);?></td>
        <td class="td_curreny"><?=number_format(((($lcr_unit+$lf) / (1-($rs->margin/100)))-($lcr_unit+$lf))*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format(($lcr_unit+$lf) / (1-($rs->margin/100)),2); $margin_unit = round((($lcr_unit+$lf) / (1-($rs->margin/100))),2)?></td>
        <td class="td_curreny"><?=number_format($margin_unit*$rs->qty,2); $net_mar_ttl+=round($margin_unit*$rs->qty,2);?></td> 
      </tr>
      <?php }}?>
      <tr class="loc_area_<?=$lrs->id?> loc_area_body_<?=$lrs->id?> all_loc all_ttl">
        <td colspan="6"></td>
        <td class="td_curreny"><b><?=number_format($fob2_ttl,2); $fob2_ttl=0;?></b></td>
        <td colspan="4"></td> 
        <td class="td_curreny"><b><?=number_format(@$ttl_legal_fee,2); $ttl_legal_fee=0;?></b></td>
        <td></td> 
        <td class="td_curreny"><b><?=number_format(@$lcnet,2); @$all_lcnet+=$lcnet;?></b></td>
        <td colspan="5"></td> 
        <td class="td_curreny">
          <b><?=number_format($net_mar_ttl,2); @$all_net_mar_ttl+=$net_mar_ttl;?></b>
          <script type="text/javascript"> 
            $('#loc_ttl<?=$lrs->id?>').html('<?=number_format(@$lcnet,2); $landed_net2_ttl=0;?>');
            $('#loc_mar_ttl<?=$lrs->id?>').html('<?=number_format(@$net_mar_ttl,2); $net_mar_ttl=0;?>');
          </script>
        </td>
      </tr>
      <?php }}?> 
      <tr style="background-color: #e6ebf2;">
         <td colspan="14"><b>TOTAL</b></td>  
         <td class="td_curreny"><b><?=number_format(@$all_lcnet,2); ?></b></td>
         <td colspan="5"></td> 
         <td class="td_curreny"><b><?=number_format(@$all_net_mar_ttl,2); ?></b></td>
      </tr>
    </tbody>
  
    <thead>
      <tr>
        <th colspan="21" ><br/><br/></td>
      </tr>
      <tr onclick="show_q_items('local')" class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
        <th colspan="21" style="background-color: #999; color: #fff;"><b>LOCAL MATERIALS</b></td>
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
      $local_amt_ttl = 0;
      $local_cost_ttl=0;

      if(@$arr_items['LOCAL']){
        foreach ($arr_items['LOCAL'] as $rs) { 
      ?>
      <tr id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?='local'?> all_loc supp_<?=$rs->supplier?> all_rows">
        <td scope="row"><?=@$counter+=1;?></td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td> 
        <td><?=@$arr_packages[$rs->package_id]?></td> 
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
        <td class="td_curreny"><b><?=number_format($ttl,2); $local_amt_ttl=$ttl;?></b></td>  
        <td colspan="5"></td> 
        <td class="td_curreny"><b><?=number_format($all_local_ttl,2); $local_cost_ttl+=$all_local_ttl;?></b></td>
      </tr>
    </tbody>
    <thead>
      <tr onclick="show_q_items('manpower')" class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
        <th colspan="<?=@$quotation->confirmed==1 ? '23' : '21'?>" style="background-color: #999; color: #fff;"><b>MANPOWER</b></td>
      </tr>
      <tr class="all_loc loc_area_body_<?='manpower'?>">
        <th>#</th>
        <th>#</th>
        <th>Part Number</th>
        <th colspan="2">Description</th> 
        <th >Quantity</th>
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
      $all_manpower_ttl = 0;
      $counter = 0; 
      $manpower_amt_ttl = 0;
      
      $manpower_cost_ttl=0;

      if(@$arr_items['MANPOWER']){
        foreach ($arr_items['MANPOWER'] as $rs) {
       
      ?>
      <tr id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?='manpower'?> all_loc supp_<?=$rs->supplier?> all_rows">
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
        <td class="td_curreny"><?=$rs->margin; $ttl_margin+=$rs->margin; $count_margin+=1;?>%</td>
        <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
        <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$all_manpower_ttl+=round($r_unt*$rs->qty);?></td> 
      </tr>
      <?php }}?> 
      <tr style="background-color: #e6ebf2;">
        <td colspan="14"><b>TOTAL</b></td>
        <td class="td_curreny"><b><?=number_format($ttl,2); $manpower_amt_ttl=$ttl;?></b></td> 
        <td colspan="5"></td> 
        <td class="td_curreny"><b><?=number_format($all_manpower_ttl,2); $manpower_cost_ttl+=$all_manpower_ttl;?></b></td>
      </tr>
    </tbody>
    <thead>
      <tr onclick="show_q_items('other')" class="loc_area_local all_loc all_loc_header" style="cursor: pointer;">
        <th colspan="<?=@$quotation->confirmed==1 ? '23' : '21'?>" style="background-color: #999; color: #fff;"><b>FINANCIAL CHARGES</b></td>
      </tr>
      <tr class="all_loc loc_area_body_<?='other'?>">
        <th>#</th>
        <th>#</th>
        <th>Part Number</th>
        <th colspan="2">Description</th> 
        <th >Quantity</th>
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
      $ttl_other_amt = 0;
      $ttl_other_no_margin_amt = 0;

      if(@$qothers){
        foreach ($qothers as $oid => $rs) {
      ?>
      <tr id="q_items_other" class="loc_area_other loc_area_body_<?='other'?> all_loc supp_other all_rows">
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
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$ttl_other_amt+=$r_unt*$rs->qty;?></td> 
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
        <th colspan="<?=@$quotation->confirmed==1 ? '23' : '21'?>" style="background-color: #999; color: #fff;"><b>SERVICE LEVEL AGREEMENT (SLA)</b></td>
      </tr>
      <tr class="all_loc loc_area_body_<?='sla'?>">
        <th>#</th>
        <th>#</th>
        <th>Part Number</th>
        <th colspan="2">Description</th>
        <th >Quantity</th>
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
    $ttl_sla_no_margin_amount=0;?>
    <tbody> 
      <tr id="q_items_sla" class="loc_area_other loc_area_body_<?='sla'?> all_loc supp_sla all_rows">
        <td scope="row">1</td>
        <td> </td>
        <td> </td>
        <td colspan="2"><?=$quotation->sla_desc?></td> 
        <td class="td_curreny"><?=@$quotation->sla_amount ? 1 : 0?></td>
        <td>QR</td>
        <td class="td_curreny"><?=number_format(@$quotation->sla_amount,2)?></td>
        <td colspan="6"></td>
        <td class="td_curreny"><?=number_format(@$quotation->sla_amount,2); $ttl_sla_no_margin_amount+=@@$quotation->sla_amount?></td>   
        <td></td>
        <?php 
        $rs->margin=@$quotation->sla_margin;
        $rs->unit_cost=@$quotation->sla_amount;
        $rs->qty = 1;
        ?>
        <td><?=@$quotation->sla_margin; $ttl_margin+=@$arr_items['OTHER'][$oid]->margin; $count_margin+=1;?>%</td>
        <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
        <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>  
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$ttl_sla_amount+=$r_unt*$rs->qty;?></td> 
      </tr> 
      <tr style="background-color: #e6ebf2;">
        <td colspan="14"><b>TOTAL</b></td>
        <td class="td_curreny"><b><?=number_format($ttl_sla_no_margin_amount,2);?></b></td>  
        <td colspan="5"></td> 
        <td class="td_curreny"><b><?=number_format($ttl_sla_amount,2)?></b></td>
      </tr>
    </tbody>
  </table> 
 
  <input type="hidden" id="grand_total" value="<?=@$all_lcnet+$manpower_amt_ttl+$local_amt_ttl+$ttl_other_amt?>">
  <input type="hidden" id="f_grand_total" value="<?=number_format( @$all_lcnet+$manpower_amt_ttl+$local_amt_ttl+$ttl_other_amt,2)?>">

  <input type="hidden" id="grand_proj_cost" value="<?=@$all_net_mar_ttl+$manpower_cost_ttl+$local_cost_ttl+$ttl_other_amt+$ttl_sla_amount?>">
  <input type="hidden" id="f_grand_proj_cost" value="<?=number_format( @$all_net_mar_ttl+$manpower_cost_ttl+$local_cost_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>">

</div> 
<!-- end of accordion -->
<script type="text/javascript">

  var prj_amt = $('#grand_total').val();
  $('#proj_amt').val('QAR <?=number_format($m_cost = @$all_lcnet+$local_amt_ttl+$manpower_amt_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>');

  $('#proj_cost').val('QAR <?=number_format($m_amt = @$all_net_mar_ttl+$local_cost_ttl+$manpower_cost_ttl+$ttl_other_amt+$ttl_sla_amount,2)?>');
  
  <?php if($confirm_save_amount == 'confirm_save_amount'){

    $this->db->where('id',$quotation->id)->update('quotations',['quotation_amount'=>round($m_amt,2)]);
    redirect("sales/confirmed_quotation","refresh");

  }?>

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
 
</script>