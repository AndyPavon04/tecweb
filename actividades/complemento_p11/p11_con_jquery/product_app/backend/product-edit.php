<?php
    use TECWEB\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';
    $prod = new Products ('marketzone');
    $prod->edit(file_get_contents('php://input'));
    echo $prod->getData();
?>