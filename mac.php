<?php 
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('getmac');
} else {
    system('ifconfig -a');
}

$output = ob_get_clean();

// Match MAC address pattern (supports hyphen or colon)
if (preg_match('/([0-9A-Fa-f]{2}[:-]){5}[0-9A-Fa-f]{2}/', $output, $matches)) {
    $mac = strtoupper(str_replace(':', '-', $matches[0]));
}

echo $mac;
?>