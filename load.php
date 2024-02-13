<?php
require_once('config.php');


$brandId =29; // Intel
$brandName = getBrandNameById($brandId);
$products = getProductsByBrandId($brandId);

 if( fwrite(fopen("load.txt", "w"),serialize($products))) {
    echo "Done!";
 }


?> 