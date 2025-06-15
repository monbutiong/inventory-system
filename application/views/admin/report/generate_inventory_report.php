<meta charset="utf-8">
<title>Inventory Report | German Auto Line</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
<meta content="Themesbrand" name="author">
<link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/gai.ico">
<link href="<?=base_url('assets/template/assets')?>/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f9f9f9;
        padding: 20px;
    }

    h4 {
        margin-bottom: 20px;
        font-weight: bold;
        color: #2A3F54;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    .report-table th,
    .report-table td {
        padding: 10px 12px;
        text-align: left;
        font-size: 13px;
        border-bottom: 1px solid #ddd;
    }

    .report-table th {
        background-color: #2A3F54;
        color: #ffffff;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .report-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .report-table td.align-right {
        text-align: right;
    }

    .print-link {
        float: right;
        font-size: 12px;
    }

    .print-link a {
        color: #007bff;
        text-decoration: none;
    }

    .print-link a:hover {
        text-decoration: underline;
    }

    @media print {
        body {
            background: #fff;
        }

        .no-print, .no-print * {
            display: none !important;
        }

        .report-table {
            box-shadow: none;
            border: 1px solid #000;
        }
    }
</style>

<div class="report-container">
    <h4>Inventory Report

    <?php if ($this->input->post('export_to_excel') == 0): ?>
        <span class="no-print print-link">
            <a href="javascript:window.print();"><i class="fa fa-print"></i> Print Report</a>
        </span>
    <?php endif; ?>
    </h4>

    <table class="report-table table-bordered">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Supplier Price</th>
                <th>Unit Cost Price</th>
                <th>Retail Price</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($inventory as $item): ?>
            <tr>
                <td><?= $item->item_code; ?></td>
                <td><?= $item->item_name; ?></td>
                <td><?= $item->category; ?></td>
                <td><?= $item->type; ?></td>
                <td><?= $item->brand; ?></td>
                <td class="align-right"><?= $item->qty; ?></td>
                <td class="align-right"><?= $item->supplier_price ? number_format($item->supplier_price,2) : '0.00'; ?></td>
                <td class="align-right"><?= $item->unit_cost_price ? number_format($item->unit_cost_price,2) : '0.00'; ?></td>
                <td class="align-right"><?= $item->retail_price ? number_format($item->retail_price,2) : '0.00'; ?></td>
                <td><?= date('M d, Y', strtotime($item->date_created)); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
