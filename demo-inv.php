<?php
for ($i = 1; $i <= 30; $i++) {
  $item_code = "ITM" . str_pad($i, 4, "0", STR_PAD_LEFT);
  $item_name = "Item Name " . $i;
  $qty = rand(10, 100);
  $unit_cost = rand(100, 1000);
  $retail_price = $unit_cost + rand(50, 300);
  $old_cost = $unit_cost - rand(10, 50);
  $old_qty = rand(0, 20);
  $item_type_id = rand(1, 5);
  $item_category_id = rand(1, 5);
  $item_brand_id = rand(1, 5);
  $min_qty = rand(5, 15);
  $max_qty = $min_qty + rand(10, 50);
  $pv_model_id = rand(1, 10);
  echo "(
    NOW(), 1, 0, '', NULL,
    NOW(), 1, '$item_code', '$item_name', $qty,
    'manual', '$unit_cost', '$retail_price', '$old_cost', $old_qty,
    '', '', '$unit_cost',
    '[1,2]', '[3,4]',
    $item_type_id, $item_category_id, $item_brand_id,
    'A1', 'B2', 'C3', $min_qty, $max_qty,
    '', '', '', $pv_model_id, 'Sedan, SUV'
  )" . ($i < 30 ? ",\n" : ";\n");
}
?>