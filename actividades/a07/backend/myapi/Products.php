<?php
    namespace backend\myapi;
    use backend\myapi\DataBase;

    include_once __DIR__.'/DataBase.php';

    class Products extends DataBase{
        private $data;

        public function __construct($db, $user= 'root',$pass='zorobabel'){
            $this->data = array();
            parent::__construct($db,$user,$pass);
        }

        public function add($jsonOB){
            $this->data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            if(!empty($jsonOB)) {
                // SE TRANSFORMA EL STRING DEL JSON A OBJETO
                $jsonOBJ = json_decode($jsonOB);
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                    if($this->conexion->query($sql)){
                        $this->data['status'] =  "success";
                        $this->data['message'] =  "Producto agregado";
                    } else {
                        $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                    }
                }
            
                $result->free();
                // Cierra la conexion
                $this->conexion->close();
            }
        
        }
 


}




?>
