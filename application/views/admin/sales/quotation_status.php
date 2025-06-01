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

if(@$po){
  foreach ($po as $rs) {
    $arr_po[$rs->id] = $rs;
  }
}

if(@$po_items){
  foreach ($po_items as $rs) {
    $rs->po_id = @$arr_po[$rs->po_id];
    $arr_poi[@$rs->inventory_quotation_id][] = $rs;
  }
}

if(@$rr){
  foreach ($rr as $rs) {
    $arr_rr[$rs->id] = $rs;
  }
}

if(@$rr_items){
  foreach ($rr_items as $rs) {
    $rs->receiving_id = @$arr_rr[$rs->receiving_id];
    $arr_rri[@$rs->inventory_quotation_id][] = $rs;
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
      <h2> QUOTATION STATUS</h2>
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
        
      <?php if(@$quotation->confirmed==1){?>
       <a href="<?=base_url('sales/legalization_fees/1/'.$quotation->id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >  Legal Fees</a>
       <a href="<?=base_url('sales/landed_cost_rate/1/'.$quotation->id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" >  L/C Rates</a>  
      <?php }?>

      <a href="<?=base_url('sales/boq/'.@$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">BOQ</a>
      <a href="<?=base_url('vendor/print_quotation/'.@$quotation_id)?>" target="_blank" class="btn btn-primary btn-sm"  >Preview Quotation</a>
      <a href="<?=base_url('sales/cost_summary/'.@$quotation_id)?>" class="btn btn-primary btn-sm load_modal_details" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Cost Summary</a>

      <?php if(@$view){?>
      <a href="<?php if($quotation->confirmed == 1){ echo base_url('sales/confirmed_quotation'); }else{ echo base_url('sales/quotations'); }?>" class="btn btn-danger btn-sm" >Go Back</a>
      <?php }?> 
    </td>
  </tr>
</table>

 

<?php if(@$view){?>
 <hr/> 
<div class="row"> 
      <div class="form-group col-md-3">
        <label for="inputEmail4">Project</label>
        <input type="text" readonly class="form-control" value="<?=@$project->name?>">
      </div>
      <div class="form-group col-md-3">
        <label for="inputPassword4">Client</label>
        <input type="text" readonly class="form-control" value="<?=@$client->name?>">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Description</label>
        <input type="text" readonly class="form-control" value="<?=@$quotation->description?>">
      </div>
      <div class="form-group col-md-3">
        <label for="inputPassword4">Attention To</label>
        <input type="text" readonly class="form-control" value="<?=@$quotation->att_to?>">
      </div> 
      <div class="form-group col-md-3">
        <label for="inputEmail4">Validity</label>
        <input type="text" readonly class="form-control" value="<?=@$quotation->validity?> Days">
      </div>
      <div class="form-group col-md-2">
        <label for="inputPassword4">Quotation Number</label>
        <input type="text" readonly class="form-control" value="<?=@$quotation->quotation_number; if($quotation->version){echo ' (rev'.$quotation->version.')';} ?>">
      </div>
      <div class="form-group col-md-2">
        <label for="inputEmail4">Date</label>
        <input type="text" readonly class="form-control" value="<?=date('M d, Y',strtotime(@$quotation->quotation_date))?>">
      </div>
      <div class="form-group col-md-2">
        <label for="inputPassword4">Margin</label>
        <input type="text" readonly class="form-control" value="<?=@$quotation->margin?>%">
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
    font-size: 10px;
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
 
  <table id="datatableShowAll" class="table table-bordered table-striped table-hover table-sticky">
    <thead class="main-thead">
      <tr>
        <th>#</th>
        <th>PO#</th> 
        <th>PO Date</th>
        <th>PO Confirmed Date</th>
        <th>DR #</th>
        <th>Invoice #</th>
        <th>Date Received</th>
        <th>Receive Qty</th>
        <th>Location</th>
        <th>Brand/Supplier</th>
        <th>Part Number</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>L/C Rate</th>
        <th>FOB</th>
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
        <td colspan="20"><center><h2><?=$project->name?></h2></center></td>
      </tr>
      <?php }?>
      <?php 
      $qty_ttl = 0;
      $counter = 0; 
      $fob_ttl = 0;
      $lcr_unit_ttl = 0;
      $landed_net_ttl = 0;
      if($qlocations){
        foreach ($qlocations as $lrs) {
       
      
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
        <td><?php 
        if(@$arr_poi[$rs->id]){
          foreach (@$arr_poi[$rs->id] as $po_arr) {
            echo $po_arr->po_id->po_number.'<br/>';
          }}
          ?></td> 
        <td><?php 
        if(@$arr_poi[$rs->id]){
          foreach (@$arr_poi[$rs->id] as $po_arr) {
            if(@$po_arr->po_id->date_created){
              echo date('d/m/Y',strtotime($po_arr->po_id->date_created)).'<br/>';
          }}}
          ?></td>
        <td><?php 
        if(@$arr_poi[$rs->id]){
          foreach (@$arr_poi[$rs->id] as $po_arr) {
            if(@$po_arr->po_id->date_confirmed){
              echo date('d/m/Y',strtotime($po_arr->po_id->date_confirmed)).'<br/>';
          }}}
          ?></td> 

        
        <td><?php 
        if(@$arr_rri[$rs->id]){
          foreach (@$arr_rri[$rs->id] as $rr_arr) {
            if(@$rr_arr->receiving_id->dr_number){
              echo $rr_arr->receiving_id->dr_number.'<br/>';
          }}}
          ?></td>
        <td><?php 
        if(@$arr_rri[$rs->id]){
          foreach (@$arr_rri[$rs->id] as $rr_arr) {
            if(@$rr_arr->receiving_id->invoice_number){
              echo $rr_arr->receiving_id->invoice_number.'<br/>';
          }}}
          ?></td>
        <td><?php   
        if(@$arr_rri[$rs->id]){
          foreach (@$arr_rri[$rs->id] as $rr_arr) {
            if(@$rr_arr->receiving_id->date_created){
              echo date('d/m/Y',strtotime($rr_arr->receiving_id->date_created)).'<br/>';
          }}}
          ?></td>
        <td align="right"><?php 
        if(@$arr_rri[$rs->id]){
          foreach (@$arr_rri[$rs->id] as $rr_arr) {
            if(@$rr_arr->qty){
              echo $rr_arr->qty.'<br/>';
          }}}
          ?></td> 
        <td><?=$lrs->location_name?></td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td> 
        <td class="td_curreny"><?=number_format($rs->qty); $qty_ttl+=$rs->qty;?></td>
        <td><?=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_rate?></td>
        <td class="td_curreny" nowrap><?=@$arr_lcr[$rs->landed_cost_rate_id]->currency_symbol?> <?=number_format($rs->unit_cost,2); $fob_ttl+=$rs->unit_cost; $fob2_ttl+=$rs->unit_cost;?></td>
        <td><?=number_format($rs->discount_percentage)?>%</td> 
        <td><?=number_format($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)),2); $discounted = ($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)))?></td>

        <?php 
        $lcr_unit = (@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)); $lcr_unit_ttl+=$lcr_unit; $lcr_unit2_ttl+=$lcr_unit;
        ?>

        <td class="td_curreny"><?=number_format(($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)) ) * $rs->qty,2)?></td>
        <td><?=@$arr_lcr[$rs->landed_cost_rate_id]->landed_cost_factor?></td>
        <td class="td_curreny" title="<?='((('.$lcr_unit.' * '.$rs->qty.')/'.@$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier].')*'.@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier].')/'.$rs->qty?>"><?php 
        $lf = 0;
        //===== LEGALIZATION FEES
        if(@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier]){
          $lf = ((($lcr_unit * $rs->qty)/@$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier])*@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier])/$rs->qty;  
        }
        if($lf>0){
          echo number_format($lf,2); @$ttl_legal_fee+=$lf; @$ttl_legal_fee_all+=$lf;
        }
        
        ?></td>
        
        
        <td class="td_curreny" title="<?='('.$lcr_unit.' * '.$lf.')'?>"><?=number_format($lcr_unit+$lf,2); ?></td>
        <td class="td_curreny" title="<?='('.($lcr_unit*$lf).' * '.$rs->qty.')'?>"><?=number_format(($lcr_unit+$lf) * $rs->qty,2); $lcnet+=(($lcr_unit+$lf) * $rs->qty); ?></td>
        <td></td>
        <td><?=$rs->margin?>%</td>
        <td class="td_curreny"><?=number_format((($lcr_unit+$lf) / (1-($rs->margin/100)))-($lcr_unit+$lf),2);?></td>
        <td class="td_curreny"><?=number_format(((($lcr_unit+$lf) / (1-($rs->margin/100)))-($lcr_unit+$lf))*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format(($lcr_unit+$lf) / (1-($rs->margin/100)),2); $margin_unit = (($lcr_unit+$lf) / (1-($rs->margin/100)))?></td>
        <td class="td_curreny"><?=number_format($margin_unit*$rs->qty,2); $net_mar_ttl+=$margin_unit*$rs->qty;?></td> 
      </tr>
      <?php }}?> 
      <?php }}?> 
      
     
      <?php
      $ttl = 0; 
      $all_local_ttl = 0;
      if(@$arr_items['LOCAL']){
        foreach ($arr_items['LOCAL'] as $rs) { 
      ?>
      <tr id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?='local'?> all_loc supp_<?=$rs->supplier?> all_rows">
        <td scope="row"><?=@$counter+=1;?></td> 
        <td></td> 
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>LOCAL MATERIALS</td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td> 
        <td class="td_curreny"><?=number_format($rs->qty)?></td>
        <td>QR</td>
        <td class="td_curreny"><?=$rs->unit_cost?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost * $rs->qty, 2); $ttl+=($rs->unit_cost * $rs->qty);?></td>  
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td><?=$rs->margin?>%</td>
        <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
        <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$all_local_ttl+=$r_unt*$rs->qty;?></td> 
      </tr>
      <?php }}?> 
      
      <?php
      $ttl = 0;
      $all_local_ttl = 0; 
      if(@$arr_items['MANPOWER']){
        foreach ($arr_items['MANPOWER'] as $rs) {
       
      ?>
      <tr id="q_items<?=$rs->id?>" class="loc_area_<?=$lrs->id?> loc_area_body_<?='manpower'?> all_loc supp_<?=$rs->supplier?> all_rows">
        <td scope="row"><?=@$counter+=1;?></td>
        <td></td>
        <td></td> 
        <td></td>
        <td></td>
        <td></td> 
        <td></td>
        <td></td>
        <td>MANPOWER</td>
        <td><?=@$arr_supp[$rs->supplier]?></td>
        <td><?=$rs->item_code?></td>
        <td><?=$rs->item_name?></td> 
        <td class="td_curreny"><?=number_format($rs->qty)?></td>
        <td>QR</td>
        <td class="td_curreny"><?=$rs->unit_cost?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost * $rs->qty, 2); $ttl+=($rs->unit_cost * $rs->qty);?></td>  
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td><?=$rs->margin?>%</td>
        <td class="td_curreny"><?=number_format(($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost,2);?></td>
        <td class="td_curreny"><?=number_format((($rs->unit_cost/(1-($rs->margin/100)))-$rs->unit_cost)*$rs->qty,2);?></td>
        <td class="td_curreny"><?=number_format($rs->unit_cost/(1-($rs->margin/100)),2); $r_unt=($rs->unit_cost/(1-($rs->margin/100)))?></td>
        <td class="td_curreny"><?=number_format($r_unt*$rs->qty,2); @$all_local_ttl+=$r_unt*$rs->qty;?></td> 
      </tr>
      <?php }}?> 
      
    </tbody>
  </table>
 
 
<!-- end of accordion -->
<script type="text/javascript">
   

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