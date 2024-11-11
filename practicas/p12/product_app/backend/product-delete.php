<?php
    use TECWEB\MYAPI\Delete;
    include_once __DIR__.'/vendor/autoload.php';
    
    $prod = new Delete ('marketzone');
    $prod -> delete($_GET['id']);
    echo $prod -> getData();
?>