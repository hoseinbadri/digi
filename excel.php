<?php
require_once 'config.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

// $spreadsheet = new Spreadsheet();
// $activeWorksheet = $spreadsheet->getActiveSheet();
// $activeWorksheet->setCellValue('A1', 'Hello World !');

// $writer = new Xlsx($spreadsheet);
// $writer->save('hello world.xlsx');

// --------------------------------------------------

// $inputFileName = './sampleData/example1.xls';

// /** Load $inputFileName to a Spreadsheet Object  **/
// $spreadsheet = IOFactory::load($inputFileName);
// $worksheet = $spreadsheet->getActiveSheet();
// $rows = $worksheet->toArray();

// foreach ($rows as $row) {
//     echo implode(', ', $row) . PHP_EOL;
// }


$query = "SELECT * FROM products";
$result = mysqli_query($link, $query);

$data = [];
$data[] = ['ID', 'Title', 'Price', 'Brand']; // Excel column headers

$p=1;
while($product = mysqli_fetch_assoc($result)) {
    $data[$p][0] = $product['id'];
    $data[$p][1] = $product['title'];
    $data[$p][2] = $product['price'];
    $data[$p][3] = $product['brand'];
    $p++;
}



$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();



for($i = 0; $i < $p; $i++) { // number of rows
    for($j = 0; $j <= 3; $j++) { // number of columns
        $activeWorksheet->setCellValue([$j+1, $i+1], $data[$i][$j]);
    }
}


$writer = new Xlsx($spreadsheet);
$writer->save('test.xlsx');

