<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Print Stock Adjustment - SA<?= sprintf("%06d", $ia->id); ?></title>
  <link rel="shortcut icon" href="<?=base_url('assets/template/assets')?>/images/gai.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @page {
      size: A4;
      margin: 15mm;
    }
    body {
      font-family: 'Arial', sans-serif;
      color: #333;
      background: #fff;
      margin: 0;
      padding: 0;
    }
    .a4-container {
      width: 210mm;
      margin: auto;
      padding: 5mm;
      box-sizing: border-box;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #65aadb;
      padding-bottom: 15px;
      margin-bottom: 20px;
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
    .document-title .adjustment-no {
      font-weight: bold;
      font-size: 18px;
    }
    .badge {
      display: inline-block;
      padding: 0.35em 0.65em;
      font-size: 0.75rem;
      font-weight: 600;
      line-height: 1;
      color: #fff;
      border-radius: 0.375rem;
    }
    .badge-danger {
      background-color: #dc3545;
    }
    .details-table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }
    .details-table td {
      padding: 5px 0;
      vertical-align: top;
    }
    .details-table td:first-child {
      width: 30%;
      font-weight: bold;
    }
    .qtable {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 13px;
    }
    .qtable th {
      background-color: #65aadb;
      color: white;
      padding: 10px 8px;
      text-align: left;
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
    .remarks {
      margin-top: 30px;
      padding: 15px;
      background-color: #f5f5f5;
      border-left: 4px solid #65aadb;
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
    }
  </style>
</head>
<body>
  <div class="a4-container">
    <!-- Header -->
    <div class="header">
      <img src="<?= base_url(); ?>assets/images/c_logo.png" alt="Company Logo" class="logo">
      <div class="document-title">
        <h1>Stock Adjustment 
          <?php if ($ia->confirmed == 0): ?>
            <span class="badge badge-danger">Unconfirmed</span>
          <?php endif; ?>
        </h1>
        <div class="adjustment-no">#AJ<?= sprintf("%06d", $ia->id); ?></div>
      </div>
    </div>

    <!-- Details -->
    <table class="details-table">
      <tr>
        <td>Covered Date:</td>
        <td><?= date('d M Y', strtotime($ia->covered_date)) ?></td>
        <td>Filed By:</td>
        <td><?= $user->name ?></td>
      </tr>
      <tr>
        <td>Reference Number:</td>
        <td><?= $ia->ref_no ?></td>
        <td>Date Filed:</td>
        <td><?= date('M d, Y H:i', strtotime($ia->date_created)) ?></td>
      </tr>
      <tr>
        <td>Adjustment Type:</td>
        <td>
          <?php
          foreach ($adj_types as $t) {
            if ($t->id == $ia->adjustment_type_id) echo $t->title;
          }
          ?>
        </td>
        <?php if ($ia->confirmed): ?>
        <td>Confirmed By:</td>
        <td><?= $confirm_user->name ?? 'N/A' ?></td>
        <?php endif; ?>
      </tr>
      <?php if ($ia->confirmed): ?>
      <tr>
        <td>Date Confirmed:</td>
        <td><?= date('M d, Y H:i', strtotime($ia->confirmed_date)) ?></td>
      </tr>
      <?php endif; ?>
    </table>

    <!-- Items Table -->
    <table class="qtable">
      <thead>
        <tr>
          <th>Part No.</th>
          <th>Description</th>
          <th>Brand</th>
          <th>Unit Cost</th>
          <th>Stock Qty</th>
          <th>Adjustment</th>
          <th>New Qty</th>
          <th>Remarks</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ia_items as $item): ?>
        <tr>
          <td><?= $item->item_code ?></td>
          <td><?= $item->item_name ?></td>
          <td><?= $item->brand ?></td>
          <td class="td_currency"><?= number_format($item->unit_cost_price, 2) ?></td>
          <td class="td_currency"><?= number_format($item->qty, 2) ?></td>
          <td class="td_currency">
            <?= ($item->adjustment_type == 'deduction' ? '-' : '+') . number_format($item->adj_qty, 2) ?>
          </td>
          <td class="td_currency">
            <?= number_format($item->adjustment_type == 'addition' ? ($item->qty + $item->adj_qty) : ($item->qty - $item->adj_qty), 2) ?>
          </td>
          <td><?= $item->remarks ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Remarks -->
    <?php if (!empty($ia->remarks)): ?>
    <div class="remarks">
      <strong>Remarks:</strong><br/>
      <?= nl2br($ia->remarks) ?>
    </div>
    <?php endif; ?>
  </div>

  <!-- Footer -->
  <!-- <div class="footer">
    <img src="<?= base_url('assets/images/footer.png') ?>" style="width: 100%;" alt="Footer">
  </div> -->

  <script>
    window.addEventListener('load', function () {
      setTimeout(() => {
        window.print();
        window.close();
      }, 500);
    });
  </script>
</body>
</html>
