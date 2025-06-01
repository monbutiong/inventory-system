<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

function read_excel_file($file_path)
{
    $spreadsheet = IOFactory::load($file_path);
    $worksheet = $spreadsheet->getActiveSheet();
    $data = $worksheet->toArray();

    return $data;
}