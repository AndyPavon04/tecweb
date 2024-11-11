<?php
    namespace TECWEB\MYAPI;

    abstract class DataBase {
        protected $conexion;
        protected $data;

        public function __construct($db, $user, $pass) {
            $this->conexion = new \mysqli('localhost', 'root', '12345', 'marketzone');
            $this->data = array();
        }
    }
?>