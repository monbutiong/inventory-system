<!DOCTYPE html>
<html>
<head>
    <title>Print P.O.</title>
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
  <center>
    <div class="a4-container">

      <table width="90%" border="0">
        <tr>
          <td colspan="2">
            <img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2"/> 
          </td> 
        </tr> 
        <tr>
          <td valign="top"> 
 
            <h2 style="color: #65aadb;">Purchase Order: <?=$po->po_number ?> <?php if($po->confirmed==0){echo '<font color="red">(Unconfirmed)</font>';}?></h2>
            <strong><?=@$supplier->name?></strong><br/>
            <strong style="color: #65aadb;">Att:</strong> <?=$po->att_to?><br/>
            <?=@$supplier->address?>


          </td>
          <td valign="top" width="10" nowrap>
            <br/>
            <?php if(@$project->name){?>
            <strong style="color: #65aadb;">Project:</strong> <?=@$project->name?><br/> 
            <?php }?>
            <strong style="color: #65aadb;">Date:</strong> <?=date('M d, Y',strtotime($po->date_created))?>. <br/>
            <strong style="color: #65aadb;">Your Ref:</strong> <?=$po->reference_no?>  <br/>
          </td> 
        </tr>
        <tr>
          <td colspan="2">
            <p style="color: #65aadb;"><b><?=nl2br($po->description)?><b></p>
          </td>
        </tr>
      </table>
     
          <?php 
          if($lcr){
            foreach ($lcr as $rs) {
              $arr_lcr[$rs->id] = $rs;
            }
          } 
          ?>  
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
                   padding: 8px; /* Add some padding for demonstration purposes */
               }
               .td_curreny {
                  text-align: right; /* Align content to the right */ 
               }
           </style>
                   
                  
                 <div class="qbody">    
                  
                  <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 90%; border: 1px solid black;">
                    <thead>
                      <tr style="color: #65aadb;"> 
                        <th nowrap>Item</th> 
                        <td>Description</td>
                        <th>Qty</th>
                        <th>Unit Price</th> 
                        <th>Total Price</th> 
                      </tr>
                    </thead>
                    <tbody> 
                      <?php
                      
               		  if(@$lcr){
               		    foreach ($lcr as $rs) {
               		      $arr_lcr[$rs->id] = $rs->currency_symbol;
               		    }
               		  }

                    if(@$rates){
                      foreach ($rates as $rs) {
                        $arr_rate[$rs->id] = $rs->currency_symbol;
                      }
                    }

               		  $ttl = 0;
 
                      if(@$po_items){
                        foreach ($po_items as $rs) { 
                      ?>
                      <tr  > 
                        <td><?=$rs->item_code?></td>
                        <td><?=$rs->item_name?></td> 
                        <td align="center"><?=$rs->qty?></td> 
                        <td align="right" nowrap><?=$cs = @$arr_lcr[$rs->landed_cost_rate_id] ?? @$arr_rate[$rs->rate_id]?> <?=number_format($rs->price,2)?></td> 
                        <td align="right" nowrap><?=@$arr_lcr[$rs->landed_cost_rate_id] ?? @$arr_rate[$rs->rate_id]?> <?=number_format($rs->price * $rs->qty,2); $ttl+=($rs->price * $rs->qty);?></td>  
                      </tr>
                      <?php }}?>
                      <tr>
                      	<td colspan="5">&nbsp;</td>
                      </tr>
                      <tr>
                      	<td colspan="3" align="right"><b style="color: #65aadb;">Total</b></td>
                      	<td colspan="2" align="center"><b style="color: #65aadb;"><?=@$cs?> <?=number_format(@$ttl,2); $gttl=$ttl;?></b></td>
                      </tr>
                      <?php if($po->less_desc){?>
                      <tr>
                      	<td colspan="3" align="right"><b style="color: #65aadb;"><?=$po->less_desc?></b></td>
                      	<td colspan="2" align="center"><b style="color: #65aadb;">-<?=@$cs?> <?=number_format(@$po->less_amount,2); $gttl-=$po->less_amount;?></td>
                      </tr>
                  	  <?php }?>
                      <tr>
                      	<td colspan="3" align="right"><b style="color: #65aadb;">Grand Total</b></td>
                      	<td colspan="2" align="center"><b style="color: #65aadb;"><?=@$cs?> <?=number_format(@$gttl,2)?></td>
                      </tr> 
                    </tbody>
                  </table>
                   
                  <div style="width: 90%; border: 0px solid white; text-align: left;"> 
                  			<strong style="color: #65aadb;">
                  				<?php  
                  				list($total_amount,$decimal) = explode('.', number_format($gttl,2));
                  				$total_amount = str_replace(',', '', $total_amount);
                  				?>
                  			  <?=str_replace('qar only', '', $converter->convert(round($total_amount,2)))?>
                  			  <?php if($decimal!='00'){ echo $decimal.'/100'; }?> qar only
                  			</strong>

                  			<br/>
                  			<br/>
                  			<?=@$po->terms_conditions?>
                  		</div>

                      <br/>
                      <i><b>**This is a system generated document which does not require any signature.</b></i>

                  <div class="footer">
                          <!-- <img class="img_logo" src="<?php echo base_url();?>assets/images/footer.png"/>  -->
                  </div>
      </div> 
    </div>
    </center>

    
</body>
</html>
<!-- end of accordion -->
<script type="text/javascript">
  self.print()
</script>