<?php 
 

if($suppliers){
  foreach ($suppliers as $rs) {
    $arr_supp[$rs->id] = $rs;
  }
}
 


if(@$packages){
  foreach ($packages as $rsp) {
    $arr_packages[$rsp->id] = $rsp->package_name;
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
       <h4>Quotation Status</h4>
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

       
      <a href="<?php if(@$from_history){ echo base_url('sales/quotation_history/'.$from_history); }elseif($quotation->confirmed == 1){ echo base_url('sales/confirmed_quotation'); }else{ echo base_url('sales/quotations'); }?>" class="btn btn-danger btn-sm" >Go Back</a>
   
    </td>
  </tr>
</table>
 
 <hr/> 
 <div class="row">

   <div class="col-md-12 col-sm-12 col-xs-12">
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
 
   </div>

 
 
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
        <th>Part Number</th>
        <th width="250">Description</th> 
        <th>Location(s)</th>
        <th>Supplier(s)</th>
        <th>Package(s)</th>
        <th>Quantity</th>
        <th>P.O.</th>
        <th>Received</th>
        <th>Issued</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if(@$inv){
        foreach ($inv as $rs) {
          $arr_inv[$rs->id] = $rs->item_code;
        }
      }

      if(@$poi){
        foreach ($poi as $rs) {
          @$arr_poi[$rs->item_code]+=$rs->qty;
        }
      }

      if(@$rri){
        foreach ($rri as $rs) {
          @$arr_rri[@$arr_inv[$rs->inventory_id]]+=$rs->qty;
        }
      }
     
      if(@$iii){
        foreach ($iii as $rs) {
          @$arr_iii[@$arr_inv[$rs->inventory_id]]+=$rs->qty;
        }
      }

      if(@$inv_quo){
        foreach ($inv_quo as $rs) { 
      ?>
      <tr>
        <td><?=@$counter_Strike+=1;?></td>
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
          }
          $second_and = 1;
        } 
        ?></small></td>
        <td align="right"><?=$rs->qty?></td>
        <td><?=@$arr_poi[$rs->item_code] ?? ''?></td>
        <td><?=@$arr_rri[$rs->item_code] ?? ''?></td>
        <td><?=@$arr_iii[$rs->item_code] ?? ''?></td>
        <td><?=$rs->qty-(@$arr_iii[$rs->item_code] ?? 0)?></td>
      </tr>
      <?php }}?>
    </tbody>
  </table> 
 
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