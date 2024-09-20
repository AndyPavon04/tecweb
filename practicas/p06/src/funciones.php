<?php
// Función para el ejercicio 1
function ejercicio1($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        return "El número $num SÍ es múltiplo de 5 y 7.";
    } else {
        return "El número $num NO es múltiplo de 5 y 7.";
    }
}

// Función para el ejercicio 2
function ejercicio2() {
    $secuencia_compuesta = false;
    $iteraciones = 0;
    $matriz = [];

    while (!$secuencia_compuesta) {
        $fila = [];

        // Generar 3 números aleatorios
        for ($i = 0; $i < 3; $i++) {
            $fila[] = rand(0, 999);
        }

        // Añadir la fila generada a la matriz
        $matriz[] = $fila;
        $iteraciones++;

        // Verificar si la secuencia cumple con la condición impar, par, impar
        if ($fila[0] % 2 != 0 && $fila[1] % 2 == 0 && $fila[2] % 2 != 0) {
            $secuencia_compuesta = true;
        }
    }

    return ['matriz' => $matriz, 'iteraciones' => $iteraciones];
}

    //funcion para el ejercicio 3 (While)
    function ejercicio3($numero_dado){
        $encontrado = false;
        $intentos = 0;
    
        while (!$encontrado) {
            $numero_aleatorio = rand(1, 1000);  // Genera un número aleatorio entre 1 y 1000
            $intentos++;
            echo "$numero_aleatorio, ";
    
            // Verifica si el número aleatorio es múltiplo del número dado
            if ($numero_aleatorio % $numero_dado == 0) {
                echo "<h3>El número $numero_aleatorio es múltiplo de $numero_dado</h3>";
                $encontrado = true;  // Finaliza el ciclo al encontrar el múltiplo
            }
        }
    
        // Devuelve el número de intentos realizados
        return $intentos;

    }

    // Función con ciclo do-while
function ejercicio3Do_While($numero_dado) {
    $encontrado = false;
    $intentos = 0;

    do {
        $numero_aleatorio = rand(1, 1000);  // Genera un número aleatorio entre 1 y 1000
        $intentos++;
        echo "$numero_aleatorio, ";

        // Verifica si el número aleatorio es múltiplo del número dado
        if ($numero_aleatorio % $numero_dado == 0) {
            echo "<h3>El número $numero_aleatorio es múltiplo de $numero_dado</h3>";
            $encontrado = true;  // Finaliza el ciclo al encontrar el múltiplo
        }
    } while (!$encontrado);

    // Devuelve el número de intentos realizados
    return $intentos;
}

// EJERCICIO 4
function ejercicio4() {
    $indices = [];

    // Usamos un ciclo for para llenar el indices con los índices 97-122 (ASCII para 'a' a 'z')
    for ($i = 97; $i <= 122; $i++) {
        $indices[$i] = chr($i);  // Asigna la letra correspondiente al código ASCII
    }

    return $indices;
}

// Función para generar la tabla XHTML a partir del indices
function generarTablaDesdeindices($indices) {
    echo '<table border="1">';
    echo '<tr><th>Letra</th><th>Código ASCII</th></tr>';

    // Usamos foreach para recorrer el indices y generar las filas de la tabla
    foreach ($indices as $key => $value) {
        echo "<tr><td>$value</td><td>$key</td></tr>";
    }

    echo '</table>';
}


// EJERCICIO 5
function validarEdadSexo($edad, $sexo) {
    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        return "Bienvenida, usted está en el rango de edad permitido.";
    } else {
        return "Lo siento, no cumple con los criterios de edad y sexo.";
    }
}



//Vehiculos registrados de ejerecicio 6
$vehiculos = [
    'ABC1234' => [
        'Auto' => [
            'marca' => 'HONDA',
            'modelo' => 2020,
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Alfonzo Esparza',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'C.U., Jardines de San Manuel'
        ]
    ],
    'PQR1234' => [
    'Auto' => [
        'marca' => 'CHEVROLET',
        'modelo' => 2021,
        'tipo' => 'sedan'
    ],
    'Propietario' => [
        'nombre' => 'Luis Fernández',
        'ciudad' => 'Toluca, Estado de México',
        'direccion' => 'Colonia Centro'
    ]
],
'STU5678' => [
    'Auto' => [
        'marca' => 'VOLKSWAGEN',
        'modelo' => 2020,
        'tipo' => 'camioneta'
    ],
    'Propietario' => [
        'nombre' => 'Gabriela López',
        'ciudad' => 'Querétaro, Qro.',
        'direccion' => 'Colonia Jurica'
    ]
],
'VWX9012' => [
    'Auto' => [
        'marca' => 'KIA',
        'modelo' => 2021,
        'tipo' => 'hachback'
    ],
    'Propietario' => [
        'nombre' => 'Jorge Ramírez',
        'ciudad' => 'San Luis Potosí, SLP',
        'direccion' => 'Colonia Universitaria'
    ]
],
'YZA3456' => [
    'Auto' => [
        'marca' => 'HYUNDAI',
        'modelo' => 2019,
        'tipo' => 'sedan'
    ],
    'Propietario' => [
        'nombre' => 'Daniela Ortega',
        'ciudad' => 'Aguascalientes, Ags.',
        'direccion' => 'Barrio de la Salud'
    ]
],
'BCD7890' => [
    'Auto' => [
        'marca' => 'BMW',
        'modelo' => 2022,
        'tipo' => 'camioneta'
    ],
    'Propietario' => [
        'nombre' => 'Federico Chávez',
        'ciudad' => 'León, Guanajuato',
        'direccion' => 'Colonia Los Castillos'
    ]
],
'EFG1234' => [
    'Auto' => [
        'marca' => 'MERCEDES-BENZ',
        'modelo' => 2020,
        'tipo' => 'sedan'
    ],
    'Propietario' => [
        'nombre' => 'Andrea Salinas',
        'ciudad' => 'Mérida, Yucatán',
        'direccion' => 'Colonia García Ginerés'
    ]
],
'HIJ5678' => [
    'Auto' => [
        'marca' => 'TESLA',
        'modelo' => 2021,
        'tipo' => 'eléctrico'
    ],
    'Propietario' => [
        'nombre' => 'Ricardo Velázquez',
        'ciudad' => 'Cancún, Quintana Roo',
        'direccion' => 'Zona Hotelera'
    ]
],
'KLM9012' => [
    'Auto' => [
        'marca' => 'PEUGEOT',
        'modelo' => 2019,
        'tipo' => 'camioneta'
    ],
    'Propietario' => [
        'nombre' => 'Mariana Flores',
        'ciudad' => 'Veracruz, Veracruz',
        'direccion' => 'Colonia Reforma'
    ]
],
'NOP3456' => [
    'Auto' => [
        'marca' => 'AUDI',
        'modelo' => 2021,
        'tipo' => 'sedan'
    ],
    'Propietario' => [
        'nombre' => 'Ignacio Vázquez',
        'ciudad' => 'Hermosillo, Sonora',
        'direccion' => 'Colonia Pitic'
    ]
],
'QRS7890' => [
    'Auto' => [
        'marca' => 'JEEP',
        'modelo' => 2022,
        'tipo' => 'camioneta'
    ],
    'Propietario' => [
        'nombre' => 'Rosa María Cruz',
        'ciudad' => 'Tijuana, Baja California',
        'direccion' => 'Colonia Libertad'
    ]
    ],

    'DEF5678' => [
        'Auto' => [
            'marca' => 'MAZDA',
            'modelo' => 2019,
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Ma. del Consuelo Molina',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => '97 oriente'
        ]
    ],
    'GHI9012' => [
        'Auto' => [
            'marca' => 'TOYOTA',
            'modelo' => 2021,
            'tipo' => 'hachback'
        ],
        'Propietario' => [
            'nombre' => 'Carlos Pérez',
            'ciudad' => 'Ciudad de México, CDMX',
            'direccion' => 'Colonia Roma'
        ]
    ],

    'JKL3456' => [
        'Auto' => [
            'marca' => 'NISSAN',
            'modelo' => 2018,
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Fernanda García',
            'ciudad' => 'Guadalajara, Jalisco',
            'direccion' => 'Av. Chapultepec'
        ]
    ],
    'MNO7890' => [
        'Auto' => [
            'marca' => 'FORD',
            'modelo' => 2022,
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Roberto Hernández',
            'ciudad' => 'Monterrey, NL',
            'direccion' => 'Centro'
        ]
    ],

];

// Función para mostrar todos los autos registrados
function mostrarTodosLosAutos($vehiculos) {
    echo "<h3>Todos los autos registrados:</h3>";
    foreach ($vehiculos as $matricula => $info) {
        echo "<h4>Matrícula: $matricula</h4>";
        echo "<p>Marca: " . $info['Auto']['marca'] . "</p>";
        echo "<p>Modelo: " . $info['Auto']['modelo'] . "</p>";
        echo "<p>Tipo: " . $info['Auto']['tipo'] . "</p>";
        echo "<p>Propietario: " . $info['Propietario']['nombre'] . "</p>";
        echo "<p>Ciudad: " . $info['Propietario']['ciudad'] . "</p>";
        echo "<p>Dirección: " . $info['Propietario']['direccion'] . "</p>";
        echo "<hr>";
    }
}


function buscarAuto($vehiculos, $matricula) {
    if (isset($vehiculos[$matricula])) {
        $info = $vehiculos[$matricula];
        echo "<h3>Detalles del vehículo con matrícula $matricula:</h3>";
        echo "<p>Marca: " . $info['Auto']['marca'] . "</p>";
        echo "<p>Modelo: " . $info['Auto']['modelo'] . "</p>";
        echo "<p>Tipo: " . $info['Auto']['tipo'] . "</p>";
        echo "<p>Propietario: " . $info['Propietario']['nombre'] . "</p>";
        echo "<p>Ciudad: " . $info['Propietario']['ciudad'] . "</p>";
        echo "<p>Dirección: " . $info['Propietario']['direccion'] . "</p>";
    } else {
        echo "<p>No se encontró ningún vehículo con la matrícula $matricula.</p>";
    }
}




?>


