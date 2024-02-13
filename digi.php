<?php
require_once('config.php');



$brandId = 29; // Intel
$brandName = 'Intel';
$categoryId = 6899; // پردازنده


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table>
        <tr>
            <th>ردیف</th>
            <th>شناسه</th>
            <th>نام محصول</th>
            <th>قیمت</th>
            <th>لینک</th>
            <th>ذخیره در پایگاه داده</th>
        </tr>    
        <?php
        $products = unserialize(file_get_contents('load.txt'));

        $i=1;
        foreach($products as $product) { 

            if(getCategory($product) != $categoryId) continue; // فقط سی پی یو ها   

        ?>
        <tr>
            <td><?php echo($i++); ?></td>
            <td><?php echo($product->id); ?></td>
            <td><?php echo(getTitleFa($product)); ?></td>
            <td><?php echo(number_format(getPrice($product))); ?></td>
            <td><a href="<?php echo(getLink($product->id)) ?>">لینک دیجیکالا</td>
            <td><?php if(dbSaveProduct($product)) echo "ذخیره شد"; else echo "<span style='color:red'>خطا در ذخیره سازی</span>";?></td>
        </tr>
    <?php } ?>
    </table>
</body>
</html>
