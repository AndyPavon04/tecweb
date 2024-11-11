<?php
    use TECWEB\MYAPI\Read;
    include_once __DIR__.'/vendor/autoload.php';
    
    $prod = new Read('marketzone');
    $prod->list();
    echo $prod->getData();
?>