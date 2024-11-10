<?php
    use TECWEB\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';
    $prod = new Products ('marketzone');
    $prod -> delete($_GET['id']);
    echo $prod -> getData();
?>