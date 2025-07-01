<?php error_reporting(0);

if(@$eta){
    foreach($eta as $rs){
        $arr_eta[strtolower($rs->title)] = $rs->ds;
        $arr_etab[strtolower($rs->title)] = '<br/>'.$rs->ds;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Quotation - QO<?= sprintf("%06d", $quotation->id); ?></title>
    <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/gai.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Print Page Setup */
        @page {
            size: A4;
            margin: 15mm;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #fff;
        }

        .page {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            padding: 0;
        }

        .a4-container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 0;
        }

        /* Header */
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

        /* Tables and Content */
        .details-table, .qtable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .details-table td {
            padding: 4px 2px;
            vertical-align: top;
        }

        .qtable th {
            background-color: #65aadb;
            color: white;
            padding: 8px;
            text-align: left;
        }

        .qtable td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .td_currency {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #e6f2ff;
        }

        .remarks {
            margin-top: 30px;
            padding: 15px;
            background-color: #f5f5f5;
            border-left: 4px solid #65aadb;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 11px;
            color: #fff;
            padding: 10px 0;
            border-top: 1px solid #fff;
            margin-top: auto;
            background-color: #fff;
            page-break-after: always;
        }

        .footer img {
            height: 40px;
            margin: 5px;
        }

        /* Print Specific */
        @media print {
            html, body {
                height: 100%;
                -webkit-print-color-adjust: exact;
            }

            .page {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .content {
                flex: 1;
            }

            .footer {
                position: relative;
                bottom: 0;
                margin-top: auto;
                page-break-inside: avoid;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

</head>
<body>
    <div class="page">
      <div class="content">

        <div class="a4-container">
            <!-- Header -->
            <div class="header">
                <table style="border: 0; padding: 0; margin: 0;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <img src="<?= base_url(); ?>assets/images/c_logo.png?5" alt="Company Logo" class="logo">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <font style="font-size: 16px; font-weight: bold;"><?= company_name ?></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <font style="font-size: 11px;"><?= company_address ?> - PO Box: <?= company_po_box ?></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <font style="font-size: 10px;"><?= company_contact ?> &nbsp; | &nbsp; <?= company_email ?></font>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <font style="font-size: 10px;"><b>Tax Reg. No:</b> <?= company_tax_reg_no ?></font>
                        </td>
                    </tr>
                </table>


                <div class="document-title">
                    <h1>QUOTATION</h1>
                    <div class="quotation-no">#QO<?= sprintf("%06d", $quotation->id); ?>
                        <br/>
                        <font style="font-size: 12px; font-weight: normal;"><b>Date:</b> <?=date('d M Y H:i',strtotime($quotation->date_created))?><br/>
                        <?php if($quotation->valid_until){?>
                         <b>Valid Until:</b> <?= date('d M Y', strtotime($quotation->valid_until)) ?> 
                        <?php }?> 
                        </font>

                    </div>

                </div>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; border: none;">
                <tr>
                    <td colspan="2" style="font-size: 12px; font-weight: bold; padding-bottom: 5px;">
                        Customer Details
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="border: 1px solid #000; padding: 4px; font-size: 11px; width: 30%;">
                                    Customer Name
                                </td>
                                <td style="border: 1px solid #000; padding: 4px; font-size: 11px;">
                                    <!-- Empty for spacing or data -->
                                </td>
                                <td style="border: 1px solid #000; padding: 4px; font-size: 11px; text-align: right; width: 30%;">
                                    <?= @$arr_eta[strtolower('Customer Name')] ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="border: 1px solid #000; padding: 4px; font-size: 11px; width: 30%;">
                                    Sales Person
                                </td>
                                <td style="border: 1px solid #000; padding: 4px; font-size: 11px;">
                                    <!-- Empty for spacing or data -->
                                </td>
                                <td style="border: 1px solid #000; padding: 4px; font-size: 11px; text-align: right; width: 30%;">
                                    <?= @$arr_eta[strtolower('Sales Person')] ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            <!-- Customer Details -->
            <table class="details-table">
                <?php if($quotation->attention_to){?>
                <tr>
                    <td>Attention To:</td>
                    <td><?= $quotation->attention_to ?></td>
                </tr>
                <?php }?>
                 
                <?php if($quotation->name){?>
                <tr>
                    <td>Customer:</td>
                    <td><?= $clients->name ?></td>
                </tr>
                <?php }?>
                
                <?php if($quotation->customer_qid_bus && $quotation->customer_type==0){?>
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
                    <td align="right"><?=date('d M Y H:i',strtotime($quotation->date_created))?></td>
                </tr>
                <?php }else{?>
                <tr> 
                    <td colspan="2" align="right"><?=date('d M Y H:i',strtotime($quotation->date_created))?></td>
                </tr>
                <?php }?>
            </table>

            <!-- Items Table -->
            <table class="qtable">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php if(@$_GET['with_partnumber']==1){?>
                        <th>Part No.</th>
                        <?php }?>
                        <th>Description<?=@$arr_etab[strtolower('Description')]?></th>
                        <th>Qty</th>
                        <th class="td_currency">Unit Price</th>
                        <th class="td_currency">Line Total</th> 
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

                    $discount_total = 0;

                    if (@$items) {
                        foreach ($items as $rs) {
                            $lineTotal = $rs->retail_price * $rs->qty;
                            $discount = $rs->discount_amount > 0 ? $rs->discount_amount : 0;
                            $discount_total+=$discount;
                            $netTotal = $lineTotal - $discount;
                            $ttl += $netTotal;
                            ?>
                            <tr>
                                <td><?=@$cc+=1;?></td>
                                <?php if(@$_GET['with_partnumber']==1){?>
                                <td><?= @$rs->item_code ?></td>
                                <?php }?>
                                <td><?= @$rs->item_name.(@$rs->item_name_arabic ? '<br/>'.@$rs->item_name_arabic : '') ?></td>
                                <td align="center"><?= $rs->qty ?></td>
                                <td class="td_currency"><?= number_format($rs->retail_price, 2) ?></td>
                                <td class="td_currency"><?= number_format($lineTotal, 2) ?></td> 
                                <td class="td_currency"><?= $discount ? number_format($discount, 2) : '-' ?></td>
                                <td class="td_currency"><?= number_format($netTotal, 2) ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td align="right" colspan="<?php if(@$_GET['with_partnumber']==1){ echo '4'; }else{echo '3';}?>">DISCOUNT AMOUNT:</td>
                        <td align="right"><?= number_format($discount_total, 2) ?></td>
                        <td style="text-align: right;">TOTAL (QAR)</td>
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

             
                <table border="0">
                    <tr>
                        <td style="font-size: 9px;"><?=@$quotation->terms_and_conditions?> </td>
                        <td align="right" style="font-size: 9px;"><?=@$quotation->terms_and_conditions_arabic?> </td>
                    </tr>
                </table> 
           
            
            <!-- Footer -->
            <div style="margin-top: 40px; text-align: center; font-size: 12px; color: #666;">
                <p>Thank you for your business!</p> 
            </div>
        </div>


    </div>
      <div class="footer">
        <table style="border: 0; width:100%;">
            <tr>
                <td  >
                    <img src="<?=base_url('assets/logos/audi-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/bentley-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/bmw-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/lamborghini-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/land-rover-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/maserati-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/mercedes-benz-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/porsche-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/rolls-royce-logo.png')?>" style="height: 40px; margin: 5px;" >
                    <img src="<?=base_url('assets/logos/volkswagen-logo.png')?>" style="height: 40px; margin: 5px;" > 
                </td>
            </tr>
        </table>
      </div>
    </div>

    <script>
        //Auto print when loaded (uncomment if needed)
        // window.addEventListener('load', function() {
        //     setTimeout(function() {
        //         window.print();
        //         window.close();
        //     }, 500);
        // });
    </script>
</body>
</html>