<?php
namespace backend\myapi;
use backend\myapi\Database;


require_once __DIR__ . '/Database.php'; 

class Products extends Database {
 private $this->data;

 public function __construct ($db, $user='root', $pass='12345'){
    $this->data = array();
    parent :: __construct($user, $pass, $db);
 }
  
 public function add($jsonOBJ) {
    $this->data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );
    if(isset($_POST['nombre'])) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
	    $this->result = $this->conexion->query($sql);
        
        if ($this->result->num_rows == 0) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
            if($this->conexion->query($sql)){
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto agregado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
        }

        $this->result->free();
        // Cierra la conexion
        $this->conexion->close();
    }
}
 
 public function delete ($id){
 
 
 }
 


}




?>
