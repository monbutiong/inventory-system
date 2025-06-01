<!DOCTYPE html>
<html>
<head>
    <title>Print Quotation</title>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/i.ico" />
    <link href="<?php echo base_url();?>assets/themes/build/css/custom.css?34" rel="stylesheet">
    <style>
        /* Define the container with A4 dimensions in pixels */
        .a4-container {
            width: 800px; /* Approximately 210mm converted to pixels */
             
            background-color: #fff;
        }

        /* Define styles for the footer */
        @media print {
             
            .qbody table {
              page-break-after: always; /* Create a page break after the table */
              margin-bottom: 220px !important;  
            }

            .element-to-hide {
              display: none;
            } 
        }

        .floating-button {
          position: fixed;
          top: 20px;
          left: 500px;
          padding: 10px;
          background-color: #3498db;
          color: #fff;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        }

    </style>
</head>
<body style="background-color: #fff;">
  <center>
    <div class="a4-container">
  
      <table width="90%" border="0">
        <tr>
          <td colspan="2">
            <img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2"/> 

            <a href="Javascript:self_print();" class="element-to-hide floating-button">Print</a>

          </td> 
        </tr> 
        <tr>
          <td valign="top"> 
 
            <h2 style="color: #65aadb;">Quote No.: <?=$quotation->quotation_number ?></h2>
            <strong><?=@$client->name?></strong><br/>
            <strong style="color: #65aadb;">Att:</strong> <?=$quotation->att_to?><br/>
            <?=@$client->address?>

          </td>
          <td valign="top" width="10" nowrap>
            <br/>
            <strong style="color: #65aadb;">Project Ref.:</strong> <?=$project->project_ref?><br/>
            <strong style="color: #65aadb;">Validity:</strong> <?=$quotation->validity?> days  <br/>
            <strong style="color: #65aadb;">Dated:</strong> <?=date('M d, Y',strtotime($quotation->quotation_date))?>. <br/>

          </td> 
        </tr>
        <tr>
          <td colspan="2">
            <p style="color: #65aadb;"><b><?=$quotation->description?><b></p>
          </td>
        </tr>
      </table>
 
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


          ?>  
           <style type="text/css">
             .qbody table {
                   border-collapse: collapse; /* Remove spacing between table cells */
                   width: 100%; /* Set the table width to 100% */
                   border: 1px solid black;
               }

               .qbody th, .qbody  td {
                   padding: 0; /* Remove padding inside table cells */
                   border: 0; /* Remove borders around table cells */
               }

               /* Optional: Add some styling for demonstration */
               .qbody th, .qbody  td {
                   border: 1px solid black;
                   padding: 8px; /* Add some padding for demonstration purposes */
               }
               .td_curreny {
                  text-align: right; /* Align content to the right */ 
               }
           </style>
                   
                  
                 <div class="qbody">    
                  
                  <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 90%; border: 1px solid black; z-index: 1000; background-color: #ffffff;">
                    <thead>
                      <tr style="color: #65aadb;"> 
                        <th nowrap>Item</th>
                        <th>Brand</th>
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
                        <td class="td_curreny"><?=number_format(@$ttl_sla_amount,2); $net_mar_ttl+=round(@$ttl_sla_amount,2); ?></td>
                      </tr>
                      <?php }?>
                      <tr>
                        <td colspan="6" style="background-color: #000; color: #fff;">  
                          <b style="color: #fff;">TOTAL QAR:</b>  
                        </td> 
                        <td class="td_curreny" style="background-color: #000; color: #fff;"><?=number_format($net_mar_ttl,2);?></td>
                      </tr>
                      <tr>
                        <td colspan="7" style=" border: 1px solid white !important;">  
                          
                          <?php  
                          list($total_amount,$decimal) = explode('.', number_format($net_mar_ttl,2));
                          $total_amount = str_replace(',', '', $total_amount);
                          ?>
                          <p>
                            <strong style="color: #65aadb;">
                              <?=str_replace('qar only', '', $converter->convert(round($total_amount,2)))?>
                              <?php if($decimal!='00'){ echo $decimal.'/100'; }?> qar only
                            </strong>
                          </p>

                        </td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 90%; border: 1px solid white !important;">
                    <thead>
                      <tr > 
                        <td style=" border: 1px solid white !important;">

                            <p style="text-align: left; margin: 45px;">
                              <?=$quotation->terms_and_conditions?>
                            </p>

                          </td>
                        </tr>  
                      </thead>
                    </table>

                    <img style="bottom: 0; left: 0; position: fixed;" src="<?php echo base_url();?>assets/images/footer.png"/> 

                  <!-- <div class="footer">
                          <img class="img_logo" src="<?php echo base_url();?>assets/images/footer.png"/> 
                  </div> -->
      </div> 
    </div>
    </center>

    
</body>
</html>
<!-- end of accordion -->
<script type="text/javascript">
  function self_print(){

    // Replace 'https://api.example.com/endpoint' with the actual API endpoint you want to call
    const apiUrl = '<?=base_url("sales/log_print_quotation/".$quotation->id)?>';

    // Make a GET request
    fetch(apiUrl)
      .then(response => {
        // Check if the request was successful (status code 200)
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        //alert('API Error: printing logs error.');
        // Parse the JSON in the response
        return response.json();
      })
      .then(data => {
        // Handle the data from the API
        self.print();
      })
      .catch(error => {
        // Handle errors
        console.log(error);
        //alert('Logs Error: printing logs error.');
      });

  }



  // Function to be executed before printing
  function beforePrintHandler() {
    console.log('Print button clicked. Performing actions before printing...');
    // Add your custom logic here
  }

  // Function to be executed after printing
  function afterPrintHandler() {
    console.log('Printing completed. Performing actions after printing...');
    // Add your custom logic here
    self.close();
  }

  // Add event listeners for beforeprint and afterprint events
  if (window.matchMedia) {
    const mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(mql => {
      if (mql.matches) {
        beforePrintHandler();
      } else {
        afterPrintHandler();
      }
    });
  }

  // For browsers that don't support matchMedia
  window.onbeforeprint = beforePrintHandler;
  window.onafterprint = afterPrintHandler;

</script>