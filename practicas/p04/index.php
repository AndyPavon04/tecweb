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
<hr>
    <h2>Ejercicio 2</h2>

    <?php

    
        
        echo "Proporcionamos los primeros valores a \$a, \$b, \$c:<br>";

        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        //Mostramos

        echo "\$a = $a<br>";
        echo "\$b = $b<br>";
        echo "\$c = $c</p>";


        echo "Agregamos las siguientes asignaciones:<br>";

        $a = "HP server";
        $b = &$a;

        echo "\$a = HP server<br>";
        echo "\$b = &\$a;";
        
        echo '</p>';
        echo "Volvemos a mostrar:";

        echo '<br>';
        echo "\$a = $a<br>";
        echo "\$b = $b<br>";
        echo "\$c = $c</p>";

        // Explicación de lo que ocurrió
        echo "<h4>¿Qué ocurrió?</h4>";
        echo "Después de reasignar \$a con el valor 'PHP server', las ocurrieron siguientes cosas:<br>";
        echo "<br>";
        echo "<li>\$a ahora tiene el valor 'PHP server'.</li>";
        echo "<li>\$b fue asignado como una referencia a \$a, por lo que \$b también toma el valor 'PHP server'.</li>";
        echo "<li>\$c, que sigue siendo una referencia a \$a, también refleja el nuevo valor de \$a ('PHP server').</li>";
        echo "<br>";
        echo "<p>Esto ocurre porque tanto \$b como \$c son referencias a \$a, lo que significa que cualquier cambio en \$a
                también se refleja en las variables referenciadas.</p>";
 
 ?>

<hr>
    <h2>Ejercicio 3</h2>
        <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
            verificar la evolución del tipo de estas variables (imprime todos los componentes de los
            arreglo):</p>
            $a = "PHP5"; <br>
            $z[] = &$a; <br>
            $b = "5a version de PHP"; <br>
            $c = $b * 10; <br>
            $a .= $b; <br>
            $b *= $c; <br>
            $z[0] = "MySQL"; <br>

        <br>

        <p><b>Mostrando contenido:</b></p>
        <?php
            $a = "PHP5 ";
            echo '<li>$a: '.$a.'</li>';
            $z[] = &$a;
            echo '<li>$z: ' . print_r($z, true) . '</li>';
            $b = "5a version de PHP";
            echo '<li>$b: '.$b.'</li>';
            $c = intval($b)*10;
            echo '<li>$c: '.$c.'</li>';
            $a .= $b;
            echo '<li>$a: '.$a.'</li>';
            settype($b, 'int');
            $b *= $c;
            echo '<li>$b: '.$b.'</li>';
            $z[0] = "MySQL";
            echo '<li>$z: ' . print_r($z, true) . '</li>';
        ?>

    <br>

    <hr>
    
    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
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




</body>
</html>