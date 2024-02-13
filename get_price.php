<?php
require_once('config.php');

$id = $_GET['id'];


$product = getProductById($id);
echo getPrice($product);