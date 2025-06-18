<?php error_reporting(0) ?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Quotation - QO<?= sprintf("%06d", $quotation->id); ?></title>
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
            min-height: 297mm;
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
    </style>
</head>
<body>
    <div class="a4-container">
        <!-- Header -->
        <div class="header">
            <img src="<?= base_url(); ?>assets/images/c_logo.png?2" alt="Company Logo" class="logo">
            <div class="document-title">
                <h1>QUOTATION</h1>
                <div class="quotation-no">QO<?= sprintf("%06d", $quotation->id); ?></div>
            </div>
        </div>
        
        <!-- Customer Details -->
        <table class="details-table">
            <?php if($quotation->attention_to){?>
            <tr>
                <td>Attention To:</td>
                <td><?= $quotation->attention_to ?></td>
            </tr>
            <?php }?>
            
            <?php if($quotation->valid_until){?>
            <tr>
                <td>Valid Until:</td>
                <td><?= date('d M Y', strtotime($quotation->valid_until)) ?></td>
            </tr>
            <?php }?>

            <?php if($quotation->name){?>
            <tr>
                <td>Customer:</td>
                <td><?= $clients->name ?></td>
            </tr>
            <?php }?>
            
            <?php if($quotation->customer_qid_bus){?>
            <tr>
                <td><?= $quotation->customer_type==1 ? 'Business Reg #' : 'QID' ?>:</td>
                <td><?= $quotation->customer_qid_bus ?></td>
            </tr>
            <?php }?>
            
            <?php if($quotation->phone){?>
            <tr>
                <td>Contact No:</td>
                <td><?= $quotation->phone ?></td>
            </tr>
            <?php }?>
            
            <?php if($quotation->plate_no){?>
            <tr>
                <td>Plate No:</td>
                <td><?= $quotation->plate_no ?></td>
            </tr>
            <?php }?>

            <?php if($quotation->vin){?>
            <tr>
                <td>VIN:</td>
                <td><?= $quotation->vin ?></td>
            </tr>
            <?php }?>

            <?php 
            if(@$manufacturers){
                foreach($manufacturers as $rs){
                    $arr_manu[$rs->id] = $rs->title;
                }
            }

            if(@$models){
                foreach($models as $rs){
                    $arr_mod[$rs->id] = $rs->title.' '.$rs->model_year;
                }
            }
            if(@$arr_manu[$vehicle->manufacturer_id]){
            ?>
            <tr>
                <td>Vehicle:</td>
                <td><?= @$arr_manu[$vehicle->manufacturer_id] . ' ' . @$arr_mod[$vehicle->vehicle_model_id] ?></td>
            </tr>
            <?php }?>
        </table>

        <!-- Items Table -->
        <table class="qtable">
            <thead>
                <tr>
                    <?php if(@$_GET['with_partnumber']==1){?>
                    <th>Part No.</th>
                    <?php }?>
                    <th>Description</th>
                    <th>Qty</th>
                    <th class="td_currency">Unit Price</th>
                    <th class="td_currency">Line Total</th>
                    <th class="td_currency">Disc. %</th>
                    <th class="td_currency">Disc. Amt.</th>
                    <th class="td_currency">Net Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ttl = 0;
                if (@$inv) {
                    foreach ($inv as $rs) {
                        $arr_inv[$rs->id] = $rs;
                    }
                }

                if (@$items) {
                    foreach ($items as $rs) {
                        $lineTotal = $rs->retail_price * $rs->qty;
                        $discount = $rs->discount_amount > 0 ? $rs->discount_amount : 0;
                        $netTotal = $lineTotal - $discount;
                        $ttl += $netTotal;
                        ?>
                        <tr>
                            <?php if(@$_GET['with_partnumber']==1){?>
                            <td><?= @$rs->item_code ?></td>
                            <?php }?>
                            <td><?= @$rs->item_name ?></td>
                            <td align="center"><?= $rs->qty ?></td>
                            <td class="td_currency"><?= number_format($rs->retail_price, 2) ?></td>
                            <td class="td_currency"><?= number_format($lineTotal, 2) ?></td>
                            <td class="td_currency"><?= $rs->discount_percentage ? number_format($rs->discount_percentage, 2) : '-' ?></td>
                            <td class="td_currency"><?= $discount ? number_format($discount, 2) : '-' ?></td>
                            <td class="td_currency"><?= number_format($netTotal, 2) ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr class="total-row">
                    <td colspan="<?php if(@$_GET['with_partnumber']==1){ echo '7'; }else{echo '6';}?>" style="text-align: right;">TOTAL (QAR)</td>
                    <td class="td_currency"><?= number_format($ttl, 2) ?></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Remarks -->
        <?php if(!empty($quotation->remarks)): ?>
        <div class="remarks">
            <strong>Remarks:</strong> <?= nl2br($quotation->remarks) ?>
        </div>
        <?php endif; ?>
        
        <!-- Footer -->
        <div style="margin-top: 40px; text-align: center; font-size: 12px; color: #666;">
            <p>Thank you for your business!</p>
            <p><?= date('d M Y') ?></p>
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