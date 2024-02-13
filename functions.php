<?php
function e($m) {
    echo trim($m);
    flush();
    ob_flush();
    ob_end_flush();
}

function getId($product) {
    return $product->id;
}

function getTitleEn($product) {
    return $product->title_en;
}

function getTitleFa($product) {
    return $product->title_fa;
}

function getPrice($product, $curr = 'T') {
    if(! isset($product->price->selling_price) || ! $product->price->selling_price) return 0;
    return ($curr == 'R') ? $product->price->selling_price :  $product->price->selling_price/10;
}

function getBrand($product) {
    return $product->brand->title_fa;
}

function getProductById($pid) {
    $url = BaseUrl . 'product/' . $pid . '/';
    $json = _get($url);
    $product = isset($json->data->product) ? $json->data->product : false;
    return $product;
}

function getCategory($product) {
    return $product->category_id;
}

function getProductsByBrandId($brandId) {
    $baseUrl = BaseUrl . 'brand/' . $brandId . '/';
    $json = _get($baseUrl);
    $totalPage = $json->data->pager->total_pages;
    
    $pageNumber = 1;
    $productsOut = [];
    while($pageNumber <= $totalPage) {
        $url = $baseUrl . "?page=$pageNumber";
        $pageNumber++;
        $json = _get($url);
        foreach ($json->data->products as $product){
            $productsOut[] = $product;
        }
    }
    return $productsOut;
}

function _get($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.81 Safari/537.36");
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output);
}

function getBrandById($id) {
    $url = "https://sirius.digikala.com/v1/brand/$id/";
    $json = _get($url);
    return $json->data->brand;
}

function getBrandNameById($id) {
    $brand = getBrandById($id);
    return $brand->title_en;
}

function getLink($id) {
    return "https://www.digikala.com/product/dkp-$id/";
}

function dbSaveProduct($product) {
    global $link;
    
    $id    = getId($product);
    $title = getTitleFa($product);
    $price = getPrice($product);
    $brand = getBrand($product);

    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) == 1) {
        // Exist; Update product.
        $query = "UPDATE products SET title = '$title', price = $price, brand = '$brand' WHERE id = $id";
    } else {
        // New product
        $query = "INSERT INTO products(id, title, price, brand) VALUES ($id, '$title', $price, '$brand')";
    }

    if($result = mysqli_query($link, $query)) return true;
    return false;
}



?>