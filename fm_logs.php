<?php
$mysqli = new mysqli("localhost", "root", "", "inventory_project"); // Adjust credentials

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get all table names that start with "fm_" and have columns we can extract
$tables = [];
$res = $mysqli->query("SHOW TABLES LIKE 'fm_%'");
while ($row = $res->fetch_array()) {
    $table = $row[0];

    if($table!='fm_logs'){

        // Check if the table has required columns
        $colsRes = $mysqli->query("SHOW COLUMNS FROM `$table`");
        $columns = [];
        while ($col = $colsRes->fetch_assoc()) {
            $columns[] = $col['Field'];
        }

        // We require these columns

        $required = ['id', 'title', 'ds', 'dc', 'user_id'];
        if (count(array_intersect($required, $columns)) === count($required)) {
            $tables[] = $table;
        }
    }
}

foreach ($tables as $table) {

    if($table=='fm_models'){
        $query = "
            INSERT INTO fm_logs (title, ds, dc, user_id, table_name, row_id, deleted, manufacturer_id, model_year)
            SELECT title, ds, dc, user_id, '$table', id, NULL, manufacturer_id, model_year
            FROM `$table`
        ";
    }else{
        $query = "
            INSERT INTO fm_logs (title, ds, dc, user_id, table_name, row_id, deleted)
            SELECT title, ds, dc, user_id, '$table', id, NULL
            FROM `$table`
        ";
    }

    if ($mysqli->query($query)) {
        echo "Inserted from $table<br>";
    } else {
        echo "Error inserting from $table: " . $mysqli->error . "<br>";
    }
}

$mysqli->close();
?>
