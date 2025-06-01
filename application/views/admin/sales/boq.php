<style>
.datepicker{z-index:1151 !important;}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>BOQ <small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
           
           
          <li><a data-bs-dismiss="modal"><i class="fa fa-close"></i> close</a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

     
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

                  $lcr_unit = round((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)),2); 
                   
                  if(@$arr_lcr[$rs->landed_cost_rate_id]->local_purchase != 1){
                     @$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier]+=($lcr_unit * $rs->qty);
                  }else{
                     @$arr_sc2[$rs->landed_cost_rate_id.'-'.$rs->supplier]+=($lcr_unit * $rs->qty);
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


          ?>  
           <style type="text/css">
             td{
              xfont-size: 10px;
             }
           </style>
                    
                  
                  <table id="datatable" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr> 
                        <th>S No.</th>
                        <th>Brand/Supplier</th>
                        <th>Part</th>
                        <td>Description</td>
                        <th>Quantity</th>
                        <th>Unit Price</th> 
                        <th>Net Price</th> 
                      </tr>
                    </thead>
                    <tbody>
                                           
                        <tr>
                          <td colspan="7" style="background-color: #999; color: #fff;"><center><b><?=$project->name?></b></center></td>
                        </tr>
                        <?php 
                        $qty_ttl = 0;
                        $counter = 0; 
                        $fob_ttl = 0;
                        $lcr_unit_ttl = 0;
                        $landed_net_ttl = 0;
                        $net_mar_ttl = 0;
                        if($qlocations){
                          foreach ($qlocations as $lrs) {
                        ?>
                        <tr>
                          <td colspan="7" style="background-color: #999; color: #fff;">  
                            <b style="color: #fff;"><?=$lrs->location_name?></b>  
                          </td> 
                        </tr>
                        <?php
                        
                        $fob2_ttl = 0;
                        $qty_ttl = 0; 
                        $lcr_unit2_ttl = 0; 
                        $landed_net2_ttl = 0; 
                        $lcnet=0;

                        if(@$arr_items[$lrs->id]){
                          foreach ($arr_items[$lrs->id] as $rs) {
                           
                        ?>
                        <tr  >
                          <td scope="row"><?=@$counter+=1;?></td>
                          <td><?=@$arr_supp[$rs->supplier]?></td>
                          <td><?=$rs->item_code?></td>
                          <td><?=$rs->item_name?></td> 
                          <td class="td_curreny"><?=number_format($rs->qty); $qty_ttl+=$rs->qty;?></td>
                         
                            
                          <?php 
                          $discounted = ($rs->unit_cost - ($rs->unit_cost*($rs->discount_percentage/100)));

                          $lcr_unit = round((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)),2);  
                           
                          $lf = 0;
                          //===== LEGALIZATION FEES
                          if(@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier]){
                            $lf = round(((($lcr_unit * $rs->qty)/@$arr_sc[$rs->landed_cost_rate_id.'-'.$rs->supplier])*@$arr_lf[$rs->landed_cost_rate_id.'-'.$rs->supplier])/$rs->qty,2);  
                          }
                          if($lf>0){
                             @$ttl_legal_fee+=$lf; @$ttl_legal_fee_all+=$lf;
                          }
                          
                          ?>  
                          <td class="td_curreny"><?=number_format(($lcr_unit+$lf) / (1-($rs->margin/100)),2); $margin_unit = round((($lcr_unit+$lf) / (1-($rs->margin/100))),2)?></td>
                          <td class="td_curreny" title="<?=number_format($net_mar_ttl+($margin_unit*$rs->qty),2)?>"><?=number_format($margin_unit*$rs->qty,2); $net_mar_ttl+=round($margin_unit*$rs->qty,2);?></td> 
                        </tr>
                        <?php }}?>
                         
                        <?php }}?> 

                        <tr>
                          <td colspan="7" style="background-color: #999; color: #fff;">  
                            <b style="color: #fff;">Miscellaneous</b>  
                          </td> 
                        </tr>
                        <?php
                        $ttl = 0; 
                        $all_local_ttl = 0;
                        $r_unt_ttl = 0;
                        if(@$arr_items['LOCAL']){
                          foreach ($arr_items['LOCAL'] as $rs) { 
                             $r_unt_ttl+=($rs->unit_cost/(1-($rs->margin/100)));
                             @$all_local_ttl+=round(($rs->unit_cost/(1-($rs->margin/100)))*$rs->qty,2);
                        }}
                        ?>
                        <tr> 
                          <td scope="row"><?=@$counter+=1;?></td>
                          <td colspan="3">Cable, Connectors and accessories.</td>  
                          <td class="td_curreny">1</td>
                          <td class="td_curreny"><?=number_format($r_unt_ttl,2);?></td>
                          <td class="td_curreny"><?=number_format($all_local_ttl,2); $net_mar_ttl+=$all_local_ttl; ?></td> 
                        </tr>

                        <?php
                        $ttl = 0; 
                        $all_local_ttl = 0;
                        $r_unt_ttl = 0;
                        if(@$arr_items['MANPOWER']){
                          foreach ($arr_items['MANPOWER'] as $rs) { 
                             if($rs->qty){ $r_unt_ttl+=($rs->unit_cost/(1-($rs->margin/100))); }
                             @$all_local_ttl+=round(($rs->unit_cost/(1-($rs->margin/100)))*$rs->qty,2);
                        }}
                        ?>
                        <tr> 
                          <td scope="row"><?=@$counter+=1;?></td>
                          <td colspan="3">Installation, Testing and Commissioning</td>  
                          <td class="td_curreny">1</td>
                          <td class="td_curreny"><?=number_format($r_unt_ttl,2);?></td>
                          <td class="td_curreny"><?=number_format($all_local_ttl,2); $net_mar_ttl+=$all_local_ttl; ?></td> 
                        </tr>

                        <?php 
                        $fin_charges = 0;
                        if(@$qothers){
                          foreach ($qothers as $ors) { 
                            if(@$arr_items['OTHER'][$ors->id]->unit_cost>0){
                                
                              $rs->margin=@$arr_items['OTHER'][$ors->id]->margin;
                              $rs->unit_cost=@$arr_items['OTHER'][$ors->id]->unit_cost;
                              $rs->qty = 1;

                              $r_unt=($rs->unit_cost/(1-($rs->margin/100)));
                              @$fin_charges+=$r_unt*$rs->qty; 

                        ?>
                        <!-- <tr> 
                          <td scope="row"> </td>
                          <td colspan="3"><?=@$ors->title?></td>  
                          <td class="td_curreny">1</td>
                          <td class="td_curreny"><?=number_format(@$arr_items['OTHER'][$ors->id]->unit_cost,2);?></td>
                          <td class="td_curreny"><?=number_format(@$arr_items['OTHER'][$ors->id]->unit_cost,2);?></td> 
                        </tr> -->
                        <?php }}}?>

                        <tr>
                          <td scope="row"><?=@$counter+=1;?></td>
                          <td colspan="3">Financial Charges</td>  
                          <td class="td_curreny">1</td>
                          <td class="td_curreny"><?=number_format(@$fin_charges,2);?></td>
                          <td class="td_curreny"><?=number_format(@$fin_charges,2); $net_mar_ttl+=round(@$fin_charges,2); ?></td>
                        </tr>

                        <?php 
                          $ttl_sla_amount = 0;
                          if(@$quotation->sla_amount){

                          $rs->margin=@$quotation->sla_margin;
                          $rs->unit_cost=@$quotation->sla_amount;
                          $rs->qty = 1;

                          $r_unt=($rs->unit_cost/(1-($rs->margin/100)));
                          @$ttl_sla_amount+=$r_unt*$rs->qty;
                        ?>
                        <tr>
                          <td scope="row"><?=@$counter+=1;?></td>
                          <td colspan="3"><?=@$quotation->sla_desc?></td>  
                          <td class="td_curreny">1</td>
                          <td class="td_curreny"><?=number_format(@$ttl_sla_amount,2);?></td>
                          <td class="td_curreny" title="<?="($rs->unit_cost/(1-($rs->margin/100)))"?>"><?=number_format(@$ttl_sla_amount,2); $net_mar_ttl+=round(@$ttl_sla_amount,2); ?></td>
                        </tr>
                        <?php }?>
                      
                      <tr>
                        <td colspan="6" style="background-color: #000; color: #fff;">  
                          <b style="color: #fff;">TOTAL QAR:</b>  
                        </td> 
                        <td class="td_curreny" style="background-color: #000; color: #fff;"><?=number_format($net_mar_ttl,2);?></td>
                      </tr>
                    </tbody>
                  </table>
      
    </div>
  </div>
</div> 

<!-- end of accordion -->
