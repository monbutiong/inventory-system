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
 
            <h2 style="color: #65aadb;">DR Number: <?=$rr->dr_number ?> <?php if($rr->confirmed==0){echo '<font color="red">(Unconfirmed)</font>';}?></h2>
 
            <strong style="color: #65aadb;">Invoice Number:</strong> <?=$rr->invoice_number?><br/>
            <strong style="color: #65aadb;">Supplier:</strong> <?=$supplier->name?><br/>


          </td>
          <td valign="top" width="10" nowrap>
            <br/>
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
                        <th>Qty</th> 
                        <th>Remarks</th>  
                      </tr>
                    </thead>
                    <tbody> 
                      <?php 
                      if(@$poi){
                        foreach ($poi as $rs) {
                          $arr_poi[$rs->id] = $rs;
                        }
                      }
                      if(@$rri){
                        foreach ($rri as $rs) { 
                      ?>
                      <tr  > 
                        <td><?=@$arr_poi[$rs->po_item_id]->item_code?></td>
                        <td><?=@$arr_poi[$rs->po_item_id]->item_name?></td> 
                        <td align="center"><?=$rs->qty?></td>   
                        <td align="center"><?=$rs->remarks?></td>    
                      </tr>
                      <?php }}?>
                     
                    </tbody>
                  </table>
                   
                  <br/>

                 <strong style="color: #65aadb;"> <?=$rr->remarks?> </strong>.

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
  self.print()
</script>