<?php
    namespace backend\myapi;
    abstract class DataBase{
        protected $conexion;

        protected function __construct($db, $user,$pass){
            $this-> conexion = @mysqli_connect(
                'localhost',
                $user,
                $pass,
                $db
            );

            if(!$this->conexion){
                die('¡Base de datos NO conectada!');
            }
        }
    }
?>