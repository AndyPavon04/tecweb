<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 4</title>
</head>
<body>

    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
 ?>
<hr/>
    <h2>Ejercicio 2</h2>
    <p>Proporcionamos los primeros valores a $a, $b, $c:</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        //Mostramos
// Abrimos la lista desordenada
        echo "<ul>";
        echo "<li>\$a = $a</li>";
        echo "<li>\$b = $b</li>";
        echo "<li>\$c = $c</li>";
        echo "</ul>";



        echo "<p>Agregamos las siguientes asignaciones:</p>";

        $a = "HP server";
        $b = &$a;

        // Abrimos la lista desordenada
        echo "<ul>";
        echo "<li>\$a = HP server</li>";
        echo "<li>\$b =&amp;\$a;</li>"; 
        echo "</ul>";

        
        echo "<p>Volvemos a mostrar:</p>";

        echo "<ul>";
        echo "<li>\$a = $a</li>";
        echo "<li>\$b = $b</li>";
        echo "<li>\$c = $c</li>";
        echo "</ul>";
        

        // Explicación de lo que ocurrió
        echo "<h4>¿Qué ocurrió?</h4>";
        echo "<p>Después de reasignar \$a con el valor 'PHP server', las ocurrieron siguientes cosas:</p>";
        echo "<ul>";
        echo "<li>\$a ahora tiene el valor 'PHP server'.</li>";
        echo "<li>\$b fue asignado como una referencia a \$a, por lo que \$b también toma el valor 'PHP server'.</li>";
        echo "<li>\$c, que sigue siendo una referencia a \$a, también refleja el nuevo valor de \$a ('PHP server').</li>";
        echo "</ul>";
        echo "<p>Esto ocurre porque tanto \$b como \$c son referencias a \$a, lo que significa que cualquier cambio en \$a
                también se refleja en las variables referenciadas.</p>";
 
 ?>

<hr/>
    <h2>Ejercicio 3</h2>
        <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
            verificar la evolución del <em>tipo</em> de estas variables (imprime todos los componentes de los
            arreglo):</p>
            <p>$a = "PHP5"; </p>
            <p>$z[] = &amp;$a; </p>
            <p>$b = "5a version de PHP";</p>
            <p>$c = $b * 10;</p>
            <p>$a .= $b;</p>
            <p>$b *= $c;</p>
            <p>$z[0] = "MySQL";</p> 



        <p>Mostrando contenido:</p>
        <?php
        echo "<ul>";
        $a = "PHP5 ";
        echo '<li>$a: ' . $a . '</li>';

        $z[] = &$a;
        echo '<li>$z: ' . print_r($z, true) . '</li>';

        $b = "5a version de PHP";
        echo '<li>$b: ' . $b . '</li>';

        $c = intval($b) * 10;
        echo '<li>$c: ' . $c . '</li>';

        $a .= $b;
        echo '<li>$a: ' . $a . '</li>';

        settype($b, 'int');
        $b *= $c;
        echo '<li>$b: ' . $b . '</li>';

        $z[0] = "MySQL";
        echo '<li>$z: ' . print_r($z, true) . '</li>';
        echo "</ul>"; 

        ?>

    

    <hr/>
    
    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz <em>$GLOBALS</em> o del modificador <em>global</em> de PHP.</p>
    <?php
        $GLOBALS['a'] = "PHP5 ";
        echo '<li>$a: ' . $GLOBALS['a'] . '</li>';
        
        $GLOBALS['z'][] = &$GLOBALS['a'];
        echo '<li>$z: ' . print_r($GLOBALS['z'], true) . '</li>';
        
        $GLOBALS['b'] = "5a version de PHP";
        echo '<li>$b: ' . $GLOBALS['b'] . '</li>';
        
        $GLOBALS['c'] = intval($GLOBALS['b']) * 10;
        echo '<li>$c: ' . $GLOBALS['c'] . '</li>';
        
        $GLOBALS['a'] .= $GLOBALS['b'];
        echo '<li>$a: ' . $GLOBALS['a'] . '</li>';
        
        settype($GLOBALS['b'], 'int');
        $GLOBALS['b'] *= $GLOBALS['c'];
        echo '<li>$b: ' . $GLOBALS['b'] . '</li>';
        
        $GLOBALS['z'][0] = "MySQL";
        echo '<li>$z: ' . print_r($GLOBALS['z'], true) . '</li>';
        unset($a, $z, $b, $c);
    ?>


    <hr/>
        <h2>Ejercicio 5</h2>
        <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
        <p>$a = “7 personas”</p>
        <p>$b = (integer) $a;</p>
        <p>$a = “9E3”;</p>
        <p>$c = (double) $a;</p>

        <?php
            $a = "7 personas";
            $b = (integer) $a;
            $a = "9E3";
            $c = (double) $a;

            $a = "7 personas";
            echo "<br><br><li>$a </li><br>";
            $b = (integer) $a;
            echo "<li>$b </li><br>";
            $a = "9E";
            echo "<li>$a </li><br>";
            $c = (double) $a;
            echo "<li>$c </li><br>";
            unset($a, $b, $c);
        ?>
    
    <hr/>
        <h2>Ejercicio 6</h2>
        <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función <em>var_dump(datos)</em>.</p>
        <p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un <em>echo</em>:</p>
        <p>$a = "0";</p> 
        <p>$b = "TRUE";</p>
        <p>$c = FALSE;</p>
        <p>$d = ($a OR $b);</p>
        <p>$e = ($a AND $c);</p>
        <p>$f = ($a XOR $b);</p>


        <?php
            $a = "0";
            $b = "TRUE";
            $c = FALSE;
            $d = ($a OR $b); 
            $e = ($a AND $c); 
            $f = ($a XOR $b); 

            echo "<br><br><li>";
            var_dump($a);
            echo "</li><br><li>";
            var_dump($b);
            echo "</li><br><li>";
            var_dump($c);
            echo "</li><br><li>";
            var_dump($d);
            echo "</li><br><li>";
            var_dump($e);
            echo "</li><br><li>";
            var_dump($f);
            echo "</li><br>";
                
            echo '<br>Valor de $c y $e transformados:<br><br>';
            echo '<li>$c: ' . var_export($c, true) . '</li><br>';
            echo '<li>$e: ' . var_export($e, true) . '</li><br>';
        ?>

    
    <hr/>
        <h2>Ejercicio 7</h2>
        <p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
        <p>a. La versión de Apache y PHP,</p>
        <p>b. El nombre del sistema operativo (servidor),</p>
        <p>c. El idioma del navegador (cliente).</p>
        <p></p>

        <?php
            echo '<li><b>Versión de Apache y PHP:</b> ' . $_SERVER['SERVER_SOFTWARE'] . '</li><br>';
            echo '<li><b>Nombre del sistema operativo:</b> ' . PHP_OS . '</li><br>';
            echo '<li><b>Idioma del navegador:</b> ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '</li><br>';
        ?>



</body>
</html>