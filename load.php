<?php
$host = 'localhost';  
$user = 'root';  
$pass = '';  
$backupDir = 'E:\\xampp\\htdocs\\ventum\\';  
 
$databasesToBackup = ['ventum'];  
 
$mysqldumpPath = 'E:\\xampp\\mysql\\bin\\mysqldump.exe'; 
 
 
$mysqli = new mysqli($host, $user, $pass);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
  

foreach ($databasesToBackup as $database) {
    
    $result = $mysqli->query("SHOW DATABASES LIKE '$database'");
    if ($result->num_rows == 0) {
        echo "does not exist.\n";
        continue;
    }

    $cur_date = date('Y-m-d_His');

    $backupFile = $backupDir . 'load_.php';

    $command = "\"{$mysqldumpPath}\" --user={$user} --password={$pass} --host={$host} {$database} > \"{$backupFile}\"";

    $output = null;
    $return_var = null;
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        echo 'Running on latest PHP version';
    } else {
        echo 'Error';
    }
}
 

$mysqli->close();

?>