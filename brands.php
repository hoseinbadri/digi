<?php

require_once('config.php');

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
    for($i = 1; $i <= 100; $i++) {
        $brand = getBrandById($i);
        $name = $brand->title_en;
        e('<tr>');
        e('<td>' . $i . '</td>');
        e('<td>' . $name . '</td>');
        e("<td><img width=50 src='{$brand->image}'></td>");
        e('</tr>');
    }
    ?>
    </table>
</body>
</html>
