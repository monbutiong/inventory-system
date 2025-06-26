<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Print P.O.</title>
    <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/gai.ico">
    <link href="<?= base_url(); ?>assets/themes/build/css/custom_print.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }

        .a4-container {
            width: 800px;
            margin: auto;
            background: #fff;
            padding: 10px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .header-table td {
            vertical-align: top;
        }

        .title {
            color: #65aadb;
            margin-bottom: 5px;
        }

        .details {
            margin-bottom: 10px;
        }

        .qbody table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            font-size: 12px;
        }

        .qbody th,
        .qbody td {
            border: 1px solid #000;
            padding: 4px 6px;
        }

        .qbody th {
            background-color: #f0f8ff;
            color: #065a9e;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .totals {
            margin-top: 10px;
        }

        .amount-in-words {
            margin-top: 15px;
            font-weight: bold;
            color: #65aadb;
        }

        .footer-note {
            margin-top: 30px;
            font-style: italic;
            font-size: 11px;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
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
<body onload="window.print()">

<div class="a4-container">

    <table class="header-table">
        <tr>
            <td>
                <img src="<?= base_url(); ?>assets/images/c_logo.png?2" alt="Company Logo" />
            </td>
            <td class="text-right">
                <h2 class="title">
                    PO#: <?= $po->po_number ?>
                    <?php if ($po->confirmed == 0): ?>
                        <span class="badge badge-danger">Unconfimed</span>
                    <?php endif; ?>
                </h2>
                <?php if (@$project->name): ?>
                    <strong>Project:</strong> <?= @$project->name ?><br/>
                <?php endif; ?>
                <strong>Date:</strong> <?= date('M d, Y', strtotime($po->date_created)) ?><br/>
                <strong>Your Ref:</strong> <?= $po->reference_no ?><br/>
            </td>
        </tr>
    </table>

    <div class="details">
        <strong><?= @$supplier->name ?></strong><br/>
        <strong>Att:</strong> <?= $po->att_to ?><br/>
        <?= @$supplier->address ?><br/><br/>
        <strong style="color: #65aadb;">Description:</strong><br/>
        <p><?= nl2br($po->description) ?></p>
    </div>

    <div class="qbody">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ttl = 0;
                if (@$po_items):
                    foreach ($po_items as $rs):
                        $symbol = @$arr_lcr[$rs->landed_cost_rate_id] ?? @$arr_rate[$rs->rate_id];
                        $line_total = $rs->price * $rs->qty;
                        $ttl += $line_total;
                ?>
                <tr>
                    <td><?= $rs->item_code ?></td>
                    <td><?= $rs->item_name ?></td>
                    <td class="text-center"><?= $rs->qty ?></td>
                    <td class="text-right"><?= $symbol ?> <?= number_format($rs->price, 2) ?></td>
                    <td class="text-right"><?= $symbol ?> <?= number_format($line_total, 2) ?></td>
                </tr>
                <?php endforeach; endif; ?>

                <tr><td colspan="5">&nbsp;</td></tr>

                <tr>
                    <td colspan="3"></td>
                    <td class="text-right"><b>Total</b></td>
                    <td class="text-right"><b><?= $symbol ?> <?= number_format($ttl, 2) ?></b></td>
                </tr>

                <?php if ($po->less_desc || $po->less_amount>0): ?>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-right"><b><?= $po->less_desc ?></b></td>
                    <td class="text-right"><b>-<?= $symbol ?> <?= number_format($po->less_amount, 2) ?></b></td>
                </tr>
                <?php $ttl -= $po->less_amount; endif; ?>

                <tr>
                    <td colspan="3"></td>
                    <td class="text-right"><b>Grand Total</b></td>
                    <td class="text-right"><b><?= $symbol ?> <?= number_format($ttl, 2) ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
<center>

    <div class="amount-in-words">
        <?php
            list($total_amount, $decimal) = explode('.', number_format($ttl, 2));
            $total_amount = str_replace(',', '', $total_amount);
            echo str_replace('qar only', '', $converter->convert(round($total_amount, 2)));
            if ($decimal !== '00') {
                echo " {$decimal}/100";
            }
        ?> qar only
    </div>
    
    <br/>
    <div class="totals">
        <?= nl2br(@$po->terms_conditions) ?>
    </div>

    <div class="footer-note">
        ** This is a system-generated document which does not require any signature.
    </div>
</center>
</div>

</body>
</html>
<script>
    // Auto print when loaded (uncomment if needed)
    window.addEventListener('load', function() {
        setTimeout(function() {
            window.print();
            window.close();
        }, 500);
    });
</script>