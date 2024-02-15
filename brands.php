<?php

require_once('config.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Brand Name</th>
            <th>Image</th>
        </tr>
    
    <?php
    $activeWorksheet->setCellValue('A1', "Brand ID");
    $activeWorksheet->setCellValue('B1', "Brand Name");

    for($i = 1; $i <= 10; $i++) {
        $brand = getBrandById($i);
        $name = $brand->title_en;

        $activeWorksheet->setCellValue([1,$i+1], $i);
        $activeWorksheet->setCellValue([2,$i+1], $name);

        e('<tr>');
        e('<td>' . $i . '</td>');
        e('<td>' . $name . '</td>');
        e("<td><img width=50 src='{$brand->image}'></td>");
        e('</tr>');
    }

    $activeWorksheet->setCellValue('D2', '=SUM(A2:A11)');



$writer = new Xlsx($spreadsheet);
$writer->save('brands.xlsx');

    ?>
    </table>
</body>
</html>
