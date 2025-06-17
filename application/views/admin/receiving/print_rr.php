<!DOCTYPE html>
<html>
<head>
    <title>Print Receiving Report</title>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/i.ico" />
    <link href="<?php echo base_url();?>assets/themes/build/css/custom_print.css" rel="stylesheet">
    <style>
        /* Define the container with A4 dimensions in pixels */
        .a4-container {
            width: 800px; /* Approximately 210mm converted to pixels */
             
            background-color: #fff;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0; 
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body style="background-color: #fff;">
  <center style="page-break-after: always;">
    <div class="a4-container">

      <table width="95%" border="0">
        <tr>
          <td colspan="4">
            <img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2"/> 
          </td> 
        </tr>
        <tr>
          <td colspan="4"><h2 style="color: #65aadb;">Goods Receipt Voucher <?php if($rr->confirmed==0){echo '<font color="red">(Unconfirmed)</font>';}?></h2></td>
        </tr> 
        <tr>
          <td valign="top"> 

            <strong style="color: #65aadb;">GRV Number:</strong> GV<?=sprintf("%06d",$rr->id)?><br/>
            <strong style="color: #65aadb;">Supplier Code:</strong> S<?=sprintf("%06d",$supplier->id)?><br/>
            <strong style="color: #65aadb;">Supplier:</strong> <?=$supplier->name?><br/>
            <strong style="color: #65aadb;">Invoice Number:</strong> <?=$rr->invoice_number?><br/>
            <strong style="color: #65aadb;">DR Number:</strong> <?=$rr->dr_number?> 

          </td>
          <td width="40%" valign="top"> 

            <strong style="color: #65aadb;">Transport:</strong> <?php 
                if(@$grv_transport){
                  foreach ($grv_transport as $rs) { if($rr->grv_transport_id==$rs->id){
                echo $rs->title;  }}}?><br/>
            <strong style="color: #65aadb;">Currency:</strong> <?=$rr->currency?><br/>
            <strong style="color: #65aadb;">LC Factor:</strong> <?=$rr->lc_factor?><br/>
            <strong style="color: #65aadb;">Item Total:</strong> <font id="itm_ttl"></font> <br/>
            <strong style="color: #65aadb;">C&F Total:</strong> <font id="cf_ttl"></font> 

          </td>
          <td width="10%" valign="top" nowrap>
            
            <strong style="color: #65aadb;">Exchane Rate:</strong> <?=number_format($xrate=$rr->exchange_rate,6)?> <br/>

            <strong style="color: #65aadb;">Project:</strong> <?php 
            $show_prj_id = '';
            if(@$projects){
              foreach ($projects as $rs) {
                if(!$show_prj_id){
                  $show_prj_id = 1;
                  echo  @$rs->name;
                }else{
                  echo  ', '.@$rs->name;
                }
              }
            }
            ?><br/> 
            <strong style="color: #65aadb;">P.O. Number:</strong> <?php 
            $show_po_id = '';
            if(@$pos){
              foreach ($pos as $rs) {
                if(!$show_po_id){
                  $show_po_id = 1;
                  echo  @$rs->po_number;
                }else{
                  echo  ', '.@$rs->po_number;
                }
              }
            }
            ?>  <br/>
            <strong style="color: #65aadb;">Date:</strong> <?=date('M d, Y',strtotime($rr->date_created))?> <br/>
            <strong style="color: #65aadb;">Received By:</strong> <?=$user->name?>  <br/>
            
          </td> 
        </tr>
       
      </table>

      
           <style type="text/css">
             .qbody table {
                   border-collapse: collapse; /* Remove spacing between table cells */
                   width: 100%; /* Set the table width to 100% */
                   border: 1px solid black;
                   page-break-after: avoid;
               }

               .qbody th, .qbody  td {
                   padding: 0; /* Remove padding inside table cells */
                   border: 0; /* Remove borders around table cells */
               }

               /* Optional: Add some styling for demonstration */
               .qbody th, .qbody  td {
                   border: 1px solid black;
                   padding: 3px; /* Add some padding for demonstration purposes */
               }
               .td_curreny {
                  text-align: right; /* Align content to the right */ 
               }
           </style>
                 
                 <br/>  
                  
                 <div class="qbody">    
                  
                  <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 95%; border: 1px solid black;">
                    <thead>
                      <tr style="color: #65aadb;"> 
                        <th rowspan="2">Part No.</th>
                        <th rowspan="2">Description</th>
                        <th colspan="3">Quantity</th> 
                        <th rowspan="2">Unit Price</th> 
                        <th rowspan="2">Total Price</th> 
                        <th rowspan="2">Item L. Cost</th> 
                        <th rowspan="2">Total L. Cost</th> 
                        <th rowspan="2">Remarks</th>  
                      </tr>
                      <tr style="color: #65aadb;"> 
                        <th>Ordered</th>
                        <th>Good</th>
                        <th>Bad</th>    
                      </tr>
                    </thead>
                    <tbody> 
                      <?php 
                      if(@$poi){
                        foreach ($poi as $rs) {
                          $arr_poi[$rs->id] = $rs;
                        }
                      }
                      
                      $itm_ttl = 0;
                      $cf_ttl = 0;
                      
                      if(@$rri){
                        foreach ($rri as $rs) { 
                      ?>
                      <tr  > 
                        <td><?=@$arr_poi[$rs->po_item_id]->item_code?></td>
                        <td><?=@$arr_poi[$rs->po_item_id]->item_name?></td> 

                        <td align="right"><?=@$arr_poi[$rs->po_item_id]->qty?></td>
                        <td align="right"><?=$rs->qty?></td>
                        <td align="right"><?=$rs->bad_qty?></td>   
                        
                        <td align="right"><?=number_format($rs->price,2)?></td>
                        <td align="right"><?=number_format($rs->qty * $rs->price,2); $itm_ttl+=round($rs->qty * $rs->price,2);?></td>
                        <td align="right"><?=number_format(($rs->price * $xrate),2)?></td>
                        <td align="right"><?=number_format(($rs->qty * $xrate) * $rs->price,2); $cf_ttl+=round(($rs->qty * $xrate) * $rs->price,2);?></td>
                        <td><?=$rs->remarks?></td>    
                      </tr>
                      <?php }}?>
                     
                    </tbody>
                  </table>

                  <script type="text/javascript">
                    document.getElementById('itm_ttl').innerHTML = '<?=number_format($itm_ttl,2)?>';
                    document.getElementById('cf_ttl').innerHTML = '<?=number_format($cf_ttl,2)?>';
                  </script>
                   
                  <br/>

                 <strong style="color: #65aadb;"> <?=$rr->remarks?> </strong>.

                  <!-- <div class="footer">
                          <img class="img_logo" src="<?php echo base_url();?>assets/images/footer.png?1"/> 
                  </div> -->
      </div> 
    </div>
    </center>















    <center>
    <div class="a4-container">

      <table width="95%" border="0">
        <tr>
          <td colspan="4">
            <img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2"/> 
          </td> 
        </tr>
        <tr>
          <td colspan="4"><h2 style="color: #65aadb;">Goods Receipt Voucher <?php if($rr->confirmed==0){echo '<font color="red">(Unconfirmed)</font>';}?></h2></td>
        </tr> 
        <tr>
          <td valign="top"> 

            <strong style="color: #65aadb;">GRV Number:</strong> GV<?=sprintf("%06d",$rr->id)?><br/>
            <strong style="color: #65aadb;">Supplier Code:</strong> S<?=sprintf("%06d",$supplier->id)?><br/>
            <strong style="color: #65aadb;">Supplier:</strong> <?=$supplier->name?><br/>
            <strong style="color: #65aadb;">Invoice Number:</strong> <?=$rr->invoice_number?><br/>
            <strong style="color: #65aadb;">DR Number:</strong> <?=$rr->dr_number?> 

          </td>
          <td width="40%" valign="top"> 

            <strong style="color: #65aadb;">Transport:</strong> <?php 
                if(@$grv_transport){
                  foreach ($grv_transport as $rs) { if($rr->grv_transport_id==$rs->id){
                echo $rs->title;  }}}?><br/>
            <strong style="color: #65aadb;">Currency:</strong> <?=$rr->currency?><br/>
            <strong style="color: #65aadb;">LC Factor:</strong> <?=$rr->lc_factor?><br/>
            <strong style="color: #65aadb;">Item Total:</strong> <?=number_format($itm_ttl,2)?> <br/>
            <strong style="color: #65aadb;">C&F Total:</strong> <?=number_format($cf_ttl,2)?> </font> 

          </td>
          <td width="10%" valign="top" nowrap>
            
            <strong style="color: #65aadb;">Exchane Rate:</strong> <?=number_format($xrate=$rr->exchange_rate,6)?> <br/>

            <strong style="color: #65aadb;">Project:</strong> <?php 
            $show_prj_id = '';
            if(@$projects){
              foreach ($projects as $rs) {
                if(!$show_prj_id){
                  $show_prj_id = 1;
                  echo  @$rs->name;
                }else{
                  echo  ', '.@$rs->name;
                }
              }
            }
            ?><br/> 
            <strong style="color: #65aadb;">P.O. Number:</strong> <?php 
            $show_po_id = '';
            if(@$pos){
              foreach ($pos as $rs) {
                if(!$show_po_id){
                  $show_po_id = 1;
                  echo  @$rs->po_number;
                }else{
                  echo  ', '.@$rs->po_number;
                }
              }
            }
            ?>  <br/>
            <strong style="color: #65aadb;">Date:</strong> <?=date('M d, Y',strtotime($rr->date_created))?> <br/>
            <strong style="color: #65aadb;">Received By:</strong> <?=$user->name?>  <br/>
            
          </td> 
        </tr>
       
      </table>

      
           <style type="text/css">
             .qbody table {
                   border-collapse: collapse; /* Remove spacing between table cells */
                   width: 100%; /* Set the table width to 100% */
                   border: 1px solid black;
                   page-break-after: avoid;
               }

               .qbody th, .qbody  td {
                   padding: 0; /* Remove padding inside table cells */
                   border: 0; /* Remove borders around table cells */
               }

               /* Optional: Add some styling for demonstration */
               .qbody th, .qbody  td {
                   border: 1px solid black;
                   padding: 3px; /* Add some padding for demonstration purposes */
               }
               .td_curreny {
                  text-align: right; /* Align content to the right */ 
               }
           </style>
                 
                 <br/>  
                  
                 <div class="qbody">    
                  
                   

                 <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 95%; border: 1px solid black;">
                  <tr>
                    <th colspan="3">Foreign Charges</th>
                  </tr> 
                  <?php 
                  if(@$fc){
                    foreach ($fc as $rs) {
                      $arr_fc[$rs->id] = $rs->title;
                    }
                  }

                  $fc_ttl = 0;

                  if(@$fc_used){
                    foreach($fc_used as $rs){?>
                  <tr>
                    <td width="40%"><?=@$arr_fc[$rs->fc_id]?></td>
                    <td width="40%" align="right"><?=number_format($rs->amt,2); $fc_ttl+=$rs->amt?></td>
                    <td width="20%"><?=$rs->remarks?></td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td colspan="3"><center><i>no data</i></center></td>
                  </tr>
                  <?php }?> 
                  <tr>
                    <td>Total (In Qatari Riyals)</td> 
                    <td align="right"><?=number_format($fc_ttl,2)?></td>
                    <td></td>
                  </tr>
                 </table>

                 <br/>

                 <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 95%; border: 1px solid black;">
                  <tr>
                    <th colspan="3">Local Charges</th>
                  </tr> 
                  <?php 
                  if(@$lc){
                    foreach ($lc as $rs) {
                      $arr_lc[$rs->id] = $rs->title;
                    }
                  }

                  $lc_ttl = 0;

                  if(@$lc_used){
                    foreach($lc_used as $rs){?>
                  <tr>
                    <td width="40%"><?=@$arr_lc[$rs->lc_id]?></td>
                    <td width="40%" align="right"><?=number_format($rs->amt,2); $lc_ttl+=$rs->amt?></td>
                    <td width="20%"><?=$rs->remarks?></td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td colspan="3"><center><i>no data</i></center></td>
                  </tr>
                  <?php }?>   
                  <tr>
                    <td>Total (In Qatari Riyals)</td> 
                    <td align="right"><?=number_format($lc_ttl,2)?></td>
                    <td></td>
                  </tr>
                 </table>

                 <br/>

                 <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 95%; border: 1px solid black;">
                  <tr>
                    <th colspan="2">Summary</th>
                  </tr>  
                  <?php $ttl_final = 0 ;?>
                  <tr>
                    <td width="80%">Total Foreign & Local Charges</td>
                    <td width="20%" align="right"><?=number_format( $fc_ttl +  $lc_ttl,2); ?></td> 
                  </tr>  
                  <tr>
                    <td width="80%">Invoice Item Value (<?=$rr->currency?>)</td>
                    <td width="20%" align="right"><?=number_format( $itm_ttl,2); ?></td> 
                  </tr>  
                  <tr>
                    <td width="80%">Equivalent Value (QAR)</td>
                    <td width="20%" align="right"><?=number_format( $cf_ttl,2); ?></td> 
                  </tr>  
                  <tr>
                    <td width="80%">Total Landed Cost  (QAR)</td>
                    <td width="20%" align="right"><?=number_format( $cf_ttl+$fc_ttl+$lc_ttl,2);  ?></td> 
                  </tr>  
                 </table>
                  

                   
                 </div> 
    </div>
    </center>

    
</body>
</html>
<!-- end of accordion -->
<script type="text/javascript">
  self.print()
</script>