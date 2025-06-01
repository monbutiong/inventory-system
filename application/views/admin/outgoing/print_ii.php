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
          <td colspan="2">
            <h2 style="color: #65aadb;">Sales Order Number: SO<?=sprintf("%06d",$ii->id);?> <?php if($ii->confirmed==0){echo '<font color="red">(Unconfirmed)</font>';}?></h2>
          </td>
        </tr> 
        <tr>
          <td valign="top"> 
 
            
            <strong style="color: #65aadb;">Job Order No.:</strong> <?=$jo->job_order_number?><br/>  
            <strong style="color: #65aadb;">Quoitation:</strong> <?=$quotation->quotation_number?>. <br/>
            <strong style="color: #65aadb;">Customer:</strong> <?=$client->name?>. <br/>

    
          </td>
          <td valign="top" width="10" nowrap> 
            <strong style="color: #65aadb;">Project:</strong> <?=$project->name?><br/>  
            <strong style="color: #65aadb;">Date:</strong> <?=date('M d, Y',strtotime($ii->date_created))?>. <br/>
            <strong style="color: #65aadb;">Issued By:</strong> <?=$user->name?>  <br/>
            
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
                   padding: 8px; /* Add some padding for demonstration purposes */
               }
               
               .td_curreny {
                  text-align: right; /* Align content to the right */ 
               }
           </style>
                 
           <br/>  
            
           <div class="qbody">    
            
            <table id="datatable" class="table table-bordered table-striped table-hover" style="width: 90%; border: 1px solid black;">
              <thead>
                <tr style="color: #65aadb;"> 
                  <th>Part No.</th>
                  <th>Description</th>
                  <th>Issued Qty</th>
                  <th>Unit Cost</th> 
                  <th>Total Cost</th> 
                  <th>Remarks</th>  
                </tr>
              </thead>
              <tbody> 
                <?php 

                if(@$inv){
                    foreach ($inv as $rs) {
                      $arr_inv[$rs->id] = $rs;
                    }
                }

                $ttl = 0;

                if(@$iii){
                  foreach ($iii as $rs) { 
                ?>
                <tr> 
                  <td><?=@$arr_inv[$rs->inventory_id]->item_code?></td>
                  <td><?=@$arr_inv[$rs->inventory_id]->item_name?></td> 
                  <td align="center"><?=$rs->qty?></td> 
                  <td align="right"><?=number_format($rs->unit_cost_price,2)?></td>   
                  <td align="right"><?=number_format($rs->qty * $rs->unit_cost_price,2); $ttl+=round($rs->qty * $rs->unit_cost_price,2)?></td> 
                  <td align="center"><?=$rs->remarks?></td>    
                </tr>
                <?php }}?>
                <tr>
                  <td colspan="4" align="right"><b>Total: </b></td>
                  <td align="right"><b><?=number_format($ttl,2)?></b></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
             
            <br/>

           <strong style="color: #65aadb;"> <?=$ii->remarks?> </strong>.

            <div class="footer">
                    <img class="img_logo" src="<?php echo base_url();?>assets/images/footer.png"/> 
            </div>
      </div> 
    </div>
    </center>

    
</body>
</html>
<!-- end of accordion -->
<script type="text/javascript">
  self.print();
  //window.close();
</script>