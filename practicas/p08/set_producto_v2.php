<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Registro Completado</title>
    <style type="text/css">
        body {
            margin: 20px;
            background-color: #C4DF9B;
            font-family: Verdana, Helvetica, sans-serif;
            font-size: 90%;
        }
        h1 {
            color: #005825;
            border-bottom: 1px solid #005825;
        }
        h2 {
            font-size: 1.2em;
            color: #4A0048;
        }
    </style>
</head>
<body>
    <h1>REGISTRO PRODUCTO</h1>
    <?php
    $nombre = isset($_POST['name']) ? $_POST['name'] : 'nombre_producto'; // Si existe el valor, se asigna a la variable, si no, se asigna un valor por defecto
    $marca = isset($_POST['brand']) ? $_POST['brand'] : 'marca_producto';
    $modelo = isset($_POST['model']) ? $_POST['model'] : 'modelo_producto';
    $precio = isset($_POST['price']) ? $_POST['price'] : 0;
    $detalles = isset($_POST['details']) ? $_POST['details'] : 'detalles_producto';
    $unidades = isset($_POST['units']) ? $_POST['units'] : 0;
    $imagen = isset($_POST['img']) ? $_POST['img'] : 'imagen_producto';
 // Validar que todos los campos estén llenos
 if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($detalles) || empty($unidades) || empty($imagen)) {
    echo '<p>Error, faltan campos del formulario por llenar.</p>';
} else {
    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', '12345', 'marketzone', 3306);
    /** comprobar la conexión */
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }
    $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
    $result = $link->query($sql); // Ejecuta la consulta y guarda el resultado
    if ($result->num_rows > 0) { // Si hay al menos un registro
        echo '<p>El producto ya se encuentra registrado</p>';
    } else {
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
        if ($link->query($sql)) { // Ejecuta la consulta y guarda el resultado
            echo '<p>Producto insertado con ID: ' . $link->insert_id . '</p>';
            echo '<h2>Resumen del Producto:</h2>';
            echo '<ul>';
            echo '<li><strong>Nombre:</strong> <em>' . $nombre . '</em></li>';
            echo '<li><strong>Marca:</strong> <em>' . $marca . '</em></li>';
            echo '<li><strong>Modelo:</strong> <em>' . $modelo . '</em></li>';
            echo '<li><strong>Precio:</strong> <em>' . $precio . '</em></li>';
            echo '<li><strong>Detalles:</strong> <em>' . $detalles . '</em></li>';
            echo '<li><strong>Unidades:</strong> <em>' . $unidades . '</em></li>';
            echo '<li><strong>Imagen:</strong> <em>' . $imagen . '</em></li>';
            echo '</ul>';
        } else {
            echo '<p>El Producto no pudo ser insertado</p>';
        }
    }
    $link->close(); // Cierra la conexión
}
?>
</body>
</html>