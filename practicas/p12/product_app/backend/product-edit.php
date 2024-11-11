<?php
    use TECWEB\MYAPI\Update;
    include_once __DIR__.'/vendor/autoload.php';
    
    $prod = new Update ('marketzone');
    $prod->edit(file_get_contents('php://input'));
    echo $prod->getData();
?>