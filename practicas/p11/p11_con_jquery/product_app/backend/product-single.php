<?php
    include_once __DIR__.'/database.php';

    $data = array();

    if( isset($_POST['id']) ) {
        $id = $_POST['id'];

        $sql = "SELECT * FROM productos WHERE id = '{$id}'";

        if ( $result = $conexion->query($sql) ) {
            $rows = $result->fetch_all(MYSQLI_ASSOC); // OBTIENE TODOS LOS REGISTROS Y LOS GUARDA EN UN ARRAY

            if(!is_null($rows)) {
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $data[$num][$key] = $value;  
                    }
                }
            } 
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
?>