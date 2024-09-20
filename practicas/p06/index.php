<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

    <?php include 'src/funciones.php'; ?>
     <!-- Formulario para ingresar el número -->
     <form action="" method="GET">
        <label for="numero">Ingrese un número:</label>
        <input type="number" id="numero" name="numero" required>
        <input type="submit" value="Comprobar">
    </form>
    <?php
        // Comprobamos si se ha enviado un número
        if (isset($_GET['numero'])) {
            $num = $_GET['numero'];
            // Llamar a la función del ejercicio 1
            echo '<h3>R= ' . ejercicio1($num) . '</h3>';
        }
    ?>

<hr>
<h2>Ejercicio 2</h2>
    <p>Generar secuencias de números aleatorios hasta obtener la secuencia impar, par, impar</p>

    <?php
        // Llamar a la función del ejercicio 2
        $resultado = ejercicio2();
        $matriz = $resultado['matriz'];
        $iteraciones = $resultado['iteraciones'];

        // Mostrar la matriz generada
        echo "<h3>Matriz generada:</h3>";
        echo "<table border='1'>";
        foreach ($matriz as $fila) {
            echo "<tr>";
            foreach ($fila as $numero) {
                echo "<td>$numero</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        // Calcular el total de números generados
        $total_numeros = $iteraciones * 3;

        // Mostrar el resultado final
        echo "<h3>Se obtuvieron $total_numeros números en $iteraciones iteraciones.</h3>";
    ?>

<hr>
<h2>Ejercicio 3</h2>
    <p>Encontrar el primer número obtenido aleatoriamente, pero que además sea múltiplo de un número dado</p>

    <!-- Formulario para el ciclo while -->
    <form action="" method="GET">
        <label for="numero">Ingrese un número para comprobar con while:</label>
        <input type="number" id="numero" name="numero" required>
        <input type="submit" name="metodo" value="Comprobar con while">
    </form>
    <br>
    <!-- Formulario para el ciclo do-while -->
    <form action="" method="GET">
        <label for="numero">Ingrese un número para comprobar con do-while:</label>
        <input type="number" id="numero" name="numero" required>
        <input type="submit" name="metodo" value="Comprobar con do-while">
    </form>

    <?php
    if (isset($_GET['numero'])) {
        $numero_dado = $_GET['numero'];  // Obtener el número dado vía GET

        if ($_GET['metodo'] === 'Comprobar con while') {
            // Llamar a la función con ciclo while
            echo "<h3>Resultado con ciclo while:</h3>";
            $intentos_while = ejercicio3($numero_dado);
            echo "$intentos_while, ";

        

        } elseif ($_GET['metodo'] === 'Comprobar con do-while') {
            // Llamar a la función con ciclo do-while
        
            echo "<h3>Resultado con ciclo do-while:</h3>";
            $intentos_dowhile = ejercicio3Do_While($numero_dado);
            echo "$intentos_dowhile, ";
        }
    }
    ?>
    <hr>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
        a la ‘z’. Usa la función chr(n) que <br> devuelve el caracter cuyo código ASCII es n para poner
        el valor en cada índice.</p>
    <?php
        // Llamar a la función para crear el arreglo
        $arregloASCII = ejercicio4();

        // Llamar a la función para generar la tabla desde el arreglo
        generarTablaDesdeindices($arregloASCII);
    ?>

    <br>
    <fieldset>
        <h2>Ejercicio 5</h2>
        <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de sexo “femenino”, <br>cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de bienvenida apropiado.</p>
        
        <form action="" method="POST">
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" required><br><br>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="femenino">Femenino</option>
                <option value="masculino">Masculino</option>
            </select><br><br>

            <input type="submit" value="Enviar">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edad']) && isset($_POST['sexo'])) {
            // Obtener los valores de edad y sexo del formulario
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];

            // Llamar a la función para validar la edad y el sexo
            $resultado = validarEdadSexo($edad, $sexo);

            // Mostrar el resultado
            echo "<h3>$resultado</h3>";
        } else {
            // No se ha enviado el formulario de edad y sexo
            echo "<h3>Por favor, ingresa la edad y selecciona el sexo.</h3>";
        }
        ?>
    </fieldset>
    <br>

    <fieldset>
        <h2>Ejercicio 6</h2>

        <h2>Consulta de Autos</h2>

        <!-- Formulario para buscar un vehículo por matrícula -->
        <form method="POST" action="">
            <label for="matricula">Buscar por Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>
            <input type="submit" name="buscar_matricula" value="Buscar">
        </form>
        <br>
        <!-- Botón para mostrar todos los autos registrados -->
        <form method="POST" action="">
            <input type="submit" name="ver_todos" value="Ver Todos los Autos">
        </form>

        <?php
        if (isset($_POST['ver_todos'])) {
            // Mostrar todos los autos registrados
            mostrarTodosLosAutos($vehiculos);
        }

        if (isset($_POST['buscar_matricula'])) {
            // Buscar vehículo por matrícula
            $matricula = $_POST['matricula'];
            buscarAuto($vehiculos, $matricula);
        }
        ?>
    </fieldset>




</body>
</html>