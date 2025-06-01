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

             margin-top: 0px !important;
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
          left: 450px;
          padding: 10px;
          background-color: #3498db;
          color: #fff;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        }

        body{
        	color: #000 !important;
        }

        .copy_img {
            position: absolute;
            top: 500;
            left: 500;
            width: auto; /* Adjust as needed */
            height: auto; /* Adjust as needed */
            margin-left: 150px;
        }

    </style>
</head>
<body style="background-color: #fff; margin-top: 0px !important;">
  <center>
    <div class="a4-container">
 
 	  <table border="0" width="100%">
 	  	<?php $x=0; while($x<2){$x+=1;?>
 	  	<tr>
 	  		<td style="height:560px; vertical-align: top;" valign="top">

  					  <?php if($x == 2){?>
  					  	<br/><br/>
  					  <?php }?>

				      <table width="100%" border="0">
				        <tr>
				          <td style="width: 35%" valign="top">
				          	<br/>
				          	<font style="font-weight: bold; font-size: 14px;"><?=$company->name?></font>
				          	<p style="font-size: 10px;">
				          		Al Asmakh Tower, 4th Floor, Majlis Al Taawon Street <br/>
				          		Ventum Tech Trading and Contracting <br/>
				          		T: +974 4469 4422 | F: +974 4468 3388 | CR: 165348 <br/>
				          		West Bay, PO Box 23619, Doha, Qatar <br/>
				          		info@ventumtech.com | ventumtech.com <br/>
				          		<?php if(@$copy == 1){?><img class="copy_img" src="<?=base_url('assets/images/copy.png')?>?2" style="height: 400px;"><?php }?>
				          	</p>
				          </td>
				          <td style="width:30%">
				            <img class="img_logo" src="<?php echo base_url();?>assets/images/c_logo.png?2"/> 
				            <center><font style="font-size: 18px; font-weight: bold;">Receipt Voucher</font></center>
				            <a href="Javascript:self_print();" class="element-to-hide floating-button">Print Receipt</a>

				          </td>
				          <td style="width: 35%">
				          	
				          </td> 
				        </tr>  
				      </table>


				      <table width="100%" style="border: 1px solid; border-collapse: collapse;">
				        <tr>
				          <td style="width: 20%; border: 1px solid; padding: 5px;">

				          </td>
				          <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Cash
				          </td>
				          <td style="width: 5%; border: 1px solid; padding: 5px;">
				          	<?php if($crv->payment_mode == 1){?><center><img src="<?=base_url('assets/images/chk.png?1')?>" style="height: 10px;"></center><?php }?>
				          </td>
				          <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Debit/Credit Card
				          </td>
				          <td style="width: 5%; border: 1px solid; padding: 5px;">
				          	<?php if($crv->payment_mode == 3){?><center><img src="<?=base_url('assets/images/chk.png?1')?>" style="height: 10px;"></center><?php }?>
				          </td>
				          <td style="width: 30%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Receipt Coucher # <font style="font-weight: bold; font-size: 14px;"><?=$crv->crv_code?></font>
				          </td>
				      	</tr>
				      	<tr>
				          <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Reference <font style="font-weight: bold; font-size: 14px;"><?=substr($crv->project_id ? @$project->name : $crv->reference, 0, 10)?></font>
				          </td>
				          <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Cheque
				          </td>
				          <td style="width: 5%; border: 1px solid; padding: 5px;">
				          	<?php if($crv->payment_mode == 2){?><center><img src="<?=base_url('assets/images/chk.png?1')?>" style="height: 10px;"></center><?php }?>
				          </td>
				          <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Transfer
				          </td>
				          <td style="width: 5%; border: 1px solid; padding: 5px;">
				          	<?php if($crv->payment_mode == 4){?><center><img src="<?=base_url('assets/images/chk.png?1')?>" style="height: 10px;"></center><?php }?>
				          </td>
				          <td style="width: 30%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	Date  <font style="font-weight: bold; font-size: 12px; margin-left: 20px;"><?=date('d/m/Y',strtotime($crv->date_created))?></font>
				          </td>
				      	</tr>
				 	 </table>


				 	 <center>
				 	 	<table border="0" width="50%">
				 	 		<tr>
				 	 			<td nowrap width="20%"></td>
				 	 			<td nowrap>
				 	 				
				 	 				     <table width="100%" style="border: 1px solid; border-collapse: collapse; margin: 5px;">
				 	 				       <tr> 
				 	 				         <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				 	 				         	Amount
				 	 				         </td>
				 	 				         <td style="width: 20%; border: 1px solid; padding: 5px; text-align: right;">
				 	 				         	<font style="font-weight: bold; font-size: 14px;"><?=number_format($crv->amount_received,2)?></font>
				 	 				         		
				 	 				         </td>
				 	 				         
				 	 				     	</tr>
				 	 				      
				 	 					 </table>

				 	 			</td>
				 	 			<td nowrap><font style="margin: 10px;">Qatari Riyals</font></td>
				 	 		</tr>
				 	 	</table>
				 	    </center>  
				       
				 	 	<table width="100%" style="border: 1px solid; border-collapse: collapse;">
				        <tr> 
				          <td colspan="6" style="border: 1px solid; font-size: 11px; padding: 5px;">
				          	Received From <font style="font-weight: bold; font-size: 12px; margin-left: 20px;"><?=$client->code?> - <?=strtoupper($client->name)?></font>
				          </td> 
				      	</tr>
				      	<tr>
				          <td colspan="6" style="border: 1px solid; font-size: 11px; padding: 5px;">
				          	Total Amount of <font style="font-weight: bold; font-size: 12px; margin-left: 20px;">
				          		<?php 

				          		$amount = $crv->amount_received;
				          		$currency = 'QAR';

				          		$integerPart = floor($amount);
				          		$decimalPart = round(($amount - $integerPart) * 100);  

				          		$integerWords = str_replace("&",'',$converter->convert($integerPart));
				          		$integerWords = str_replace(",",' ',$integerWords);
				          		$integerWords = str_replace("-",' ',$integerWords);
				          		$integerWords = str_replace(" and ",' ',$integerWords);
				          		$integerWords = str_replace(" only",' ',$integerWords); 
  
 											if($decimalPart>0){
 												echo $finalOutput = strtoupper($integerWords . " & " . $decimalPart . "/100 <small>QRs Only</small>");
 											}else{
 												echo $finalOutput = strtoupper($integerWords . "<small>QR's Only</small>");
 											}
				          		
				          		?>
				          		</font>
				          </td> 
				      	</tr>
				      	<tr>
				      		<td style="width: 15%; border: 1px solid; font-size: 11px; padding: 5px;">
				      			Credit/Debit Card
				      		</td>
				      		<td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				      		 	<font style="font-weight: bold; font-size: 12px;"><?=@$debit_credit_type->title;?></font>
				      		</td>
				      		<td style="width: 10%; border: 1px solid; font-size: 11px; padding: 5px;">
				      			Bank
				      		</td> 
				      		<td style="width: 20%; border: 1px solid; padding: 5px;">
				      			<font style="font-weight: bold; font-size: 12px;"><?=strtoupper($crv->bank_name)?> <?php if(@$crv->branch){?>- <?=strtoupper($crv->branch)?><?php }?></font>
				      		</td>
				      		<td style="width: 15%; border: 1px solid; font-size: 11px; padding: 5px;">
				      			 Cheque Number
				      		</td>
				      		<td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				      			 <font style="font-weight: bold; font-size: 12px;"><?=$crv->cheque_no?></font>
				      		</td>
				      	</tr>
				      	<tr>
				          <td colspan="4" style="border: 1px solid; font-size: 11px; padding: 5px;">
				          	Against <font style="font-weight: bold; font-size: 12px; margin-left: 20px;"><?=$crv->remarks?></font>
				          </td> 
				          <td style="width: 15%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	 Signature
				          </td>
				          <td style="width: 20%; border: 1px solid; font-size: 11px; padding: 5px;">
				          	 <font style="font-weight: bold; font-size: 12px; "><?=strtoupper(@$users->name)?></font>
				          </td>
				      	</tr>
				 	 </table>

				 	 <table width="100%">
				 	 	<tr>
				 	 		<td>
				 	 			<font style="font-weight: bold; font-size: 8px; ">
				 	 				* Receipt of cheque is acknowledged subject to its being honoured and if not honoured then this receipt is invalid<br/>
				 	 				* Please qoute receipt number in any query<br/>
				 	 				* Advance payment non refundable according to the contract signed between the parties<br/>
				 	 			</font>
				 	 		</td>
				 	 		<td align="right" valign="top">
				 	 			<font style="font-weight: bold; font-size: 10px; ">
				 	 				<?=date('d/m/Y h:i:s a')?> <?=@$crv->print_count>0 ? sprintf("%02d",(@$crv->print_count)) : ''?>
				 	 			</font>
				 	 			<br/>
				 	 			<br/>
				 	 			<?php if($x==1){?>
				 	 				<i>Customer's Copy</i>
				 	 			<?php }else{?>
				 	 				<i>Accounts's Copy</i>
				 	 			<?php }?>
				 	 		</td>
				 	 	</tr>
				 	 </table>

                 
     		</td>
 	  	</tr>
 	  	<?php if($x==1){?> 
 	  	<tr>
 	  		<td>
 	  			<br/>
 	  			<hr/>
 	  		</td>
 	  	</tr>
 	  	<?php }}?>
 	  </table>




    </div>
    </center>

    
</body>
</html>
<!-- end of accordion -->
<script type="text/javascript">
  function self_print(){
 
        self.print();
        
  }



  // Function to be executed before printing
  function beforePrintHandler() {
    console.log('Print button clicked. Performing actions before printing...');
     
  }

 
  function afterPrintHandler() {
    console.log('Printing completed. Performing actions after printing...');
  
    //self.close();
  }

  
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

  //window.addEventListener("beforeprint", function () {
      //alert("User is printing the page!");
      fetch("<?=base_url('receipt/save_print_counter/1/'.$crv->id.'/'.@$copy)?>", { method: "GET" });
  //});
  window.addEventListener("afterprint", function () {
      //alert("Printing completed or canceled.");
  	  fetch("<?=base_url('receipt/save_print_counter/2/'.$crv->id.'/'.@$copy)?>", { method: "GET" });
  });
</script>