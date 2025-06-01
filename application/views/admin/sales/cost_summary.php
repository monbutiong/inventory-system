<style>
.datepicker{z-index:1151 !important;}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Imported Materials By Supplier  <small></small></h2>
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

                $disc_per = $rs->discount_percentage>0 ? $rs->discount_percentage : 0;
                
                $discounted = ($rs->unit_cost - $rs->unit_cost*($disc_per/100));

                  $lcr_unit = (@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->freight_percent/100)) + ((@$arr_lcr[$rs->landed_cost_rate_id]->conversion_factor * $discounted) * (@$arr_lcr[$rs->landed_cost_rate_id]->custom_percent/100)); 
                 
                if(@$arr_lcr[$rs->landed_cost_rate_id]->local_purchase != 1){
                  @$arr_sc_fob[$arr_supp[$rs->supplier].'-x-'.$rs->landed_cost_rate_id.'-x-'.$rs->supplier]+=$discounted;
                  @$arr_sc[$arr_supp[$rs->supplier].'-x-'.$rs->landed_cost_rate_id.'-x-'.$rs->supplier]+=($lcr_unit * $rs->qty);
                }else{
                  @$arr_sc_fob[$arr_supp[$rs->supplier].'-x-'.$rs->landed_cost_rate_id.'-x-'.$rs->supplier]+=$discounted;
                  @$arr_sc2[$arr_supp[$rs->supplier].'-x-'.$rs->landed_cost_rate_id.'-x-'.$rs->supplier]+=($lcr_unit * $rs->qty);
                }
              } 
            }
          }


          ?>  
           <style type="text/css">
             td{
              xfont-size: 10px;
             }
           </style>
                    
                  <table id="datatable_modal2" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr> 
                        <th>Brand/Supplier</th>
                        <th>L/C Rates</th>
                        <th></th>
                        <td align="right">FOB (Foreign Currency)</td>
                        <td align="right">FOB (QAR)</td>
                        <td align="right">Legalization Fees</td> 
                      </tr>
                    </thead>
                    <tbody>
                      <?php 

                      ksort($arr_sc);
                      $fob_ttl = 0;
                      $legal_fee_ttl = 0;

                      if(@$arr_sc){
                        foreach ($arr_sc as $key => $value) {
                          list($supp_name,$lcr_id,$s_id) = explode('-x-', $key);
                          if(@$arr_supp[$s_id]){
                      ?>
                      <tr>
                        <td data-order="<?=@$arr_supp[$s_id]?>"><?=@$arr_supp[$s_id]?></td>
                        <td><?=@$arr_lcr[$lcr_id]->landed_cost_rate?></td>
                        <td align="right"><?=@$arr_lcr[$lcr_id]->landed_cost_factor?></td>
                        <td align="right"><?=@$arr_lcr[$lcr_id]->currency_symbol?> <?=number_format(@$arr_sc_fob[$key],2)?></td>
                        <td align="right"><?=number_format($value,2); $fob_ttl+=round($value,2);?></td>
                        <td align="right"><?php 
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
                          echo number_format($legal_fee,2); @$legal_fee_ttl+=$legal_fee;
                        ?></td>
                      </tr>
                    <?php }}}?>

                    <?php 
                    if(@$arr_sc2){
                      ksort($arr_sc2);
                    }
                    

                      if(@$arr_sc2){
                        foreach ($arr_sc2 as $key => $value) {
                          list($supp_name,$lcr_id,$s_id) = explode('-x-', $key);
                      ?>
                      <tr>
                        <td><?=$arr_supp[$s_id]?></td>
                        <td><?=@$arr_lcr[$lcr_id]->landed_cost_rate?></td>
                        <td align="right"><?=number_format(@$arr_lcr[$lcr_id]->conversion_factor,5)?></td>
                        <td align="right"><?=@$arr_lcr[$lcr_id]->currency_symbol?> <?=number_format(@$arr_sc_fob[$key],2)?></td>
                        <td align="right"><?=number_format($value,2); $fob_ttl+=round($value,2); ?></td>
                        <td></td>
                      </tr>
                    <?php }}?>
                    
                    </tbody>
                  </table>
                  <table class="table table-bordered table-striped table-hover">
                  <tr> 
                      <td align="right"><h2>Total FOB: <?=number_format($fob_ttl,2)?></h2></td>
                      <td align="right"><h2>Total Legalization Fee: <?=number_format($legal_fee_ttl,2)?></h2></td>
                    </tr>
                  </table>
    </div>
  </div>
</div> 

<!-- end of accordion -->
