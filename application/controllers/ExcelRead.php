<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory; 
use TNkemdilim\MoneyToWords\Converter; 
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelRead extends CI_Controller {
 

	public function inv($value = '') {
	    // Path to the Excel file and the password
	    $inputFileName = '\\\\192.168.6.15\\it$\\DOCUMENTS\\INVENTORY1.xlsx';
	    $password = 'pass*';

	    if (!file_exists($inputFileName)) {
	        show_error('The file does not exist.', 404);
	        return;
	    }

	    // Initialize the reader
	    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	    $reader->setReadDataOnly(true);
	    $reader->setPassword($password);

	    // Load the Excel file
	    $spreadsheet = $reader->load($inputFileName);

	    // Get the active sheet
	    $sheet = $spreadsheet->getActiveSheet();
	    $data = $sheet->toArray();

	    // Pass the data to the view
	    $this->load->view('excel_table', ['data' => $data]);
	}
 


}