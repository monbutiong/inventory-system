<?php error_reporting(0) ?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Inventory Returns - IR<?= sprintf("%06d", $ir->id); ?></title>
    <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/gai.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Base Styles */
        @page {
            size: A4;
            margin: 15mm;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.5;
            color: #333;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        
        /* Container */
        .a4-container {
            width: 210mm;
            margin: 0 auto;
            padding: 5mm;
            box-sizing: border-box;
        }
        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #65aadb;
            padding-bottom: 15px;
        }
        
        .logo {
            height: 80px;
        }
        
        .document-title {
            text-align: right;
        }
        
        .document-title h1 {
            color: #65aadb;
            margin: 0;
            font-size: 24px;
        }
        
        .document-title .quotation-no {
            font-weight: bold;
            font-size: 18px;
        }
        
        /* Customer Details */
        .details-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        
        .details-table td {
            padding: 5px 0;
            vertical-align: top;
        }
        
        .details-table tr td:first-child {
            width: 30%;
            font-weight: bold;
        }
        
        /* Items Table */
        .qtable {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }
        
        .qtable th {
            background-color: #65aadb;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        
        .qtable td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        
        .qtable tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .qtable tr:hover {
            background-color: #f1f1f1;
        }
        
        .td_currency {
            text-align: right;
        }
        
        /* Totals Row */
        .total-row {
            font-weight: bold;
            background-color: #e6f2ff !important;
        }
        
        /* Footer */
        .remarks {
            margin-top: 30px;
            padding: 15px;
            background-color: #f5f5f5;
            border-left: 4px solid #65aadb;
        }
        
        /* Print Specific Styles */
        @media print {
            body {
                background: none;
                -webkit-print-color-adjust: exact;
            }
            
            .a4-container {
                width: auto;
                margin: 0;
                padding: 0;
            }
            
            .no-print {
                display: none !important;
            }
            
            .qtable {
                page-break-inside: avoid;
            }
        }

        .footer {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          height: 25mm;
          text-align: center;
          font-size: 11px;
          color: #666;
          border-top: 1px solid #ccc;
        }

        .badge {
          display: inline-block;
          padding: 0.35em 0.65em;
          font-size: 0.75rem;
          font-weight: 600;
          line-height: 1;
          color: #fff;
          text-align: center;
          white-space: nowrap;
          vertical-align: baseline;
          border-radius: 0.375rem;
        }

        .badge-danger {
          background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="page">
      <div class="content">

        <div class="a4-container">
            <!-- Header -->
            <div class="header">
                <img src="<?= base_url(); ?>assets/images/c_logo.png?2" alt="Company Logo" class="logo">
                <div class="document-title">
                    <h1>Inventory Returns 
                    	<?php if ($ir->confirmed == 0): ?>
                    	    <span class="badge badge-danger">Unconfimed</span>
                    	<?php endif; ?>
                    </h1>
                    <div class="quotation-no">#IR<?= sprintf("%06d", $ir->id); ?></div>
                </div>
            </div>
            
            <!-- Customer Details -->
            <table class="details-table">
                
                <tr>
                    <td>Return Date:</td>
                    <td><?=date('d M Y',strtotime($ir->return_date))?></td>
                    <td><b>Customer:</b></td>
                    <td><?=$client->name?></td>
                </tr>
                
                
                <tr>
                    <td>Conatact Number:</td>
                    <td><?=$ir->phone?></td>
                    <td><b>Purchase Date:</b></td>
                    <td><?=date('M d, Y H:i',strtotime($ir->puchase_date))?></td>
                </tr> 
                <tr>
                    <td>Filed by:</td>
                    <td><?=$user->name?></td>
                    <td><b>Date Filed:</b></td>
                    <td><?=date('M d, Y H:i',strtotime($ir->date_created))?></td>
                </tr>
               
                <?php if($ir->confirmed){?>
                <tr>
                    <td>Confirmed By:</td>
                    <td><?=$confirm_user->name?></td> 
                    <td><b>Date Confirmed:</b></td>
                    <td><?=date('M d, Y H:i',strtotime($ir->confirmed_date))?></td>
                </tr>
                <?php }?> 
            </table>

            <!-- Items Table -->
            <table class="qtable">
                       
                      <thead>
                        <tr style="font-size: 12px;">
                           
                          <th>Part No.</th>
                          <th>Description</th>   
                          <th>Brand</th>
                          <th>S.O. Quantity</th> 
                          <th>Retail Price</th>  
                          <th nowrap>Return Qty</th> 
                          <th nowrap>Line Total</th>
                          <th nowrap>Discount %</th>
                          <th nowrap>Discount Amt</th>
                          <th nowrap>Total Amount</th> 
                          <th nowrap>Remarks</th>   
                        </tr>
                        </thead> 
                        <tbody>
                               <?php 
                               if(@$return_items){
                                foreach($return_items as $rs){
                                  @$counter+=1;
                                  @$selected_ids.='('.$rs->inventory_id.')-';
                               ?>
                               <tr id="tr<?=$rs->inventory_id?>" class="data-row">
                                 <td> 
                                   
                                      <?=$rs->item_code?>
                                    
                                   <input type="hidden" class="item_exist" name="items[<?=$rs->inventory_id?>]" id="added<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                                   <input type="hidden" name="inventory_id<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                                   <input type="hidden" name="ii_id<?=$rs->inventory_id?>" value="<?=$rs->issuance_item_id?>"/>
                                   <input type="hidden" name="exist<?=$rs->inventory_id?>" value="<?=$rs->inventory_id?>"/>
                                 </td>
                                 <td><?=$rs->item_name?></td>
                                 <td><?=$rs->item_brand?></td>
                                 <td style="text-align:right;" id="t_qty<?=$rs->inventory_id?>" data-price="<?=$rs->retail_price?>" 
                                    data-discount-percentage="<?=$rs->discount_percentage?>"><?=$rs->so_qty?> 
                                 </td>
                                 <td style="text-align:right;"> 
                                  <?=$rs->retail_price ? number_format($rs->retail_price,2) : '0.00'?>
                                  <input type="hidden" name="retail_price<?=$rs->inventory_id?>" value="<?=$rs->retail_price ? round($rs->retail_price,2) : '0.00'?>">
                                 </td>

                                 <td style="text-align:right;  width:60px;">
                                   <?=$rs->qty?> 
                                   <input type="hidden" name="issued_qty<?=$rs->inventory_id?>" value="<?=$rs->qty?>"/>
                                   <input type="hidden" name="old_stock_qty<?=$rs->inventory_id?>" value="<?=$rs->inv_stock?> "/>
                                 </td> 

                                 <td style="text-align:right;"><font id="line_total<?=$rs->inventory_id?>"><?=number_format($rs->retail_price * $rs->qty,2)?></font>
                                 </td>

                                 <td style="text-align:right;"> 
                                     <?=$rs->discount_percentage?>
                                     <input type="hidden" name="discount_percentage<?=$rs->inventory_id?>" value="<?=$rs->discount_percentage?>" >
                                 </td>

                                 <td style="text-align:right;">
                                     <span id="discount_amount_total<?=$rs->inventory_id?>">
                                     <?=number_format($rs->discount_amount,2)?>
                                     </span>
                                     <input type="hidden" 
                                     id="discount_amount<?=$rs->inventory_id?>"
                                     name="discount_amount<?=$rs->inventory_id?>" value="<?=round($rs->discount_amount,2)?>" >
                                 </td>

                                 <td style="text-align:right;"><font id="line_grand_total<?=$rs->inventory_id?>"><?=number_format(($rs->retail_price * $rs->qty)-$rs->discount_amount,2)?></font>
                                 </td>


                                 <td style="text-align:left;  width:260px;">
                                   <?=$rs->remarks?> 
                                 </td>  

                                 

                                  
                               </tr>
                               <?php }}?>
                                <tr id="item_selector">
                                  <td colspan="9" class="add_item" align="right">
                                     <h5>Grand Total</h5>
                                  </td> 
                                 
                                  <td align="right">
                                    <h5 id="grand_totalz"><?=number_format($ir->grand_total_amt,2)?></h5>
                                    <input type="hidden" id="grand_total_amt" name="grand_total_amt" value="<?=$ir->grand_total_amt?>">
                                  </td>
                                  <td colspan="2"></td>
                                </tr> 
                              </tbody>
                            </table>
            
            <!-- Remarks -->
            <?php if(!empty($ir->remarks)): ?>
            <div class="remarks">
                <strong>Remarks:</strong> <?= nl2br($ir->remarks) ?>
            </div>
            <?php endif; ?>

             
                <table border="0">
                    <tr>
                        <td style="font-size: 9px;"><?=@$ir->terms_and_conditions?> </td>
                        <td align="right" style="font-size: 9px;"><?=@$ir->terms_and_conditions_arabic?> </td>
                    </tr>
                </table> 
           
            
            <!-- Footer -->
            
        </div>
 
    </div>
      <div class="footer">
        <table style="border: 0; width:100%;">
            <tr>
                <td style="background-color: #999;">
                    <img src="<?=base_url('assets/images/footer.png')?>"  style="border: 0; width:100%;">
                </td>
            </tr>
        </table>
      </div>
    </div>

    <script>
        // Auto print when loaded (uncomment if needed) 
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
                window.close();
            }, 500);
        });
    </script>
</body>
</html>