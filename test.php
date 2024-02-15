<?php

require_once('config.php');


$baseurl = "https://sirius.digikala.com/v1/brand/";

for($i=1; $i<=10; $i++) {
    $output =_get($baseurl . $i . "/");
    e( $output->data->brand->title_en . "<br>" );

}



