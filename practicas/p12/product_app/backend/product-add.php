<?php
    use TECWEB\MYAPI\Create;
    include_once __DIR__.'/vendor/autoload.php';
    
    $prod = new Create ('marketzone');
    $prod->add(file_get_contents('php://input'));
    echo $prod->getData();
?>