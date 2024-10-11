<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
    <style type="text/css">
    ol, ul { 
    list-style-type: none;
    }
    </style>
    <script src="./src/main.js"></script> <!-- Conexion al js -->
</head>
<body>

    <h1>Añade o edita producto</h1>

    <form id=formularioProductos" action="http://localhost/tecweb/practicas/p09/update_producto.php" method="post">

    <h2>Información de Producto</h2>

    <fieldset>
        <legend>Información</legend>

        <ul>
            <input type="hidden" name="id" value="<?= !empty($_POST['id']) ? $_POST['id'] : $_GET['id'] ?>">
            <li><label for="form-name">Nombre:</label> <input type="text" name="nombre" id="form-name" value="<?= !empty($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($_GET['nombre']) ?>"></li><br />
            <li> 
                <label for="form-brand">Marca:</label>
                <select name="marca" id="form-brand" onblur="validarMarca();" required>
                    <option value="" disabled <?= !empty($_POST['marca']) || !empty($_GET['marca']) ? '' : 'selected' ?>>Selecciona una marca</option>
                    <option value="Epiphone" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Epiphone') || (!empty($_GET['marca']) && $_GET['marca'] == 'Epiphone') ? 'selected' : '' ?>>Epiphone</option>
                    <option value="Fender" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Fender') || (!empty($_GET['marca']) && $_GET['marca'] == 'Fender') ? 'selected' : '' ?>>Fender</option>
                    <option value="Gibson" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Gibson') || (!empty($_GET['marca']) && $_GET['marca'] == 'Gibson') ? 'selected' : '' ?>>Gibson</option>
                    <option value="Oscar Smichdt" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Oscar Smichdt') || (!empty($_GET['marca']) && $_GET['marca'] == 'Oscar Smichdt') ? 'selected' : '' ?>>Oscar Smichdt</option>
                    <option value="Taylor" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Taylor') || (!empty($_GET['marca']) && $_GET['marca'] == 'Taylor') ? 'selected' : '' ?>>Taylor</option>
                    <option value="Yamaha" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Yamaha') || (!empty($_GET['marca']) && $_GET['marca'] == 'Yamaha') ? 'selected' : '' ?>>Yamaha</option>
                    <option value="Paracho" <?= (!empty($_POST['marca']) && $_POST['marca'] == 'Paracho') || (!empty($_GET['marca']) && $_GET['marca'] == 'Paracho') ? 'selected' : '' ?>>Paracho</option>
                </select>
            </li><br />
            <li><label for="form-model">Modelo:</label> <input type="text" name="modelo" id="form-model" onblur="validarModelo();" value="<?= !empty($_POST['modelo']) ? htmlspecialchars($_POST['modelo']) : htmlspecialchars($_GET['modelo']) ?>" ></li><br />
            <li><label for="form-price">Precio:</label> <input type="number" name="precio" id="form-price" onblur="validarPrecio();" value="<?= !empty($_POST['precio']) ? htmlspecialchars($_POST['precio']) : htmlspecialchars($_GET['precio']) ?>" ></li><br />
            <li><label for="form-details">Detalles...</label><br/><textarea name="detalles" rows="4" cols="60" id="form-story" placeholder="No mas de 250 caracteres de longitud"><?= isset($_POST['detalles']) ? htmlspecialchars($_POST['detalles']) : (isset($_GET['detalles']) ? htmlspecialchars($_GET['detalles']) : '') ?></textarea></li><br/>
            <li><label for="form-units">Unidades:</label> <input type="number" name="unidades" id="form-units" onblur="validarUnidades();" value="<?= !empty($_POST['unidades']) ? htmlspecialchars($_POST['unidades']) : htmlspecialchars($_GET['unidades']) ?>" ></li><br />
            <li><label for="form-img">Imagen:</label> <input type="text" name="imagen" id="form-img" onblur="validarImagen();" value="<?= !empty($_POST['imagen']) ? htmlspecialchars($_POST['imagen']) : htmlspecialchars($_GET['imagen']) ?>"></li><br />
        </ul>
    </fieldset>

        <p>
            <input type="submit" value="Enviar Producto">
            <input type="reset" value="Restablecer">
        </p>

    </form>

</body>
</html>