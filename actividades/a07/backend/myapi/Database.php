<?php
namespace backend\myapi;
abstract class Database{
    protected $conexion;

    protected function Database ($db, $user , $pass ){
        $this-> conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );
        if (!$this->conexion){
            die('¡Base de datos NO conextada!');
        }
    }

}


?>