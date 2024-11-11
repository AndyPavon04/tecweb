<?php
    use TECWEB\MYAPI\Read;
    include_once __DIR__.'/vendor/autoload.php';
    $prod = new Read('marketzone');
    $prod->singleByName($_GET['name']);
    echo $prod->getData();
?>