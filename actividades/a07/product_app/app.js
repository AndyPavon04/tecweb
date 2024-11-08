// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

function resetForm(){
    document.getElementById('name').value = '';

    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

function listarProductos(){
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function(response){
            //console.log(response);
            let productos = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
            let template = '';

            productos.forEach(producto => {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                descripcion += '<li>precio: '+producto.precio+'</li>';
                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                descripcion += '<li>marca: '+producto.marca+'</li>';
                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class="product-item">${producto.nombre}</a>
                        </td>
                        <td><ul>${descripcion}</ul></td>
                        <td>
                            <button class="product-delete btn btn-danger">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
            $('#products').html(template);
        }
    });
}

$(document).ready(function() {
    init();
    let edit = false;
    listarProductos();
    $('#product-form button[type="submit"]').text('Agregar Producto');
    
    // SE ASIGNA EL EVENTO CLICK AL BOTON DE BUSCAR
    $("#search").keyup(function() {
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: {search},
                success: function(response) {
                    let productos = JSON.parse(response);
                    console.log(response);
                        // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                        let template = '';
                        let template_bar = '';

                        productos.forEach(producto => {
                            // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                            console.log(producto);

                            // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                            let descripcion = '';
                            descripcion += '<li>precio: '+producto.precio+'</li>';
                            descripcion += '<li>unidades: '+producto.unidades+'</li>';
                            descripcion += '<li>modelo: '+producto.modelo+'</li>';
                            descripcion += '<li>marca: '+producto.marca+'</li>';
                            descripcion += '<li>detalles: '+producto.detalles+'</li>';
                        
                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td>${producto.nombre}</td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-delete btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            `;

                            template_bar += `
                                <li>${producto.nombre}</il>
                            `;
                        });
                        // SE HACE VISIBLE LA BARRA DE ESTADO
                        $('#product-result').removeClass('d-none');
                        // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                        $('#container').html(template_bar);  
                        // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                        $('#products').html(template);
                }
            });
        }
    });

    // SE ASIGNA EL EVENTO CLICK AL BOTON DE AGREGAR
    $('#product-form').submit(function(e){
        e.preventDefault();
        
        // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
        let productoJsonString = $('#description').val();
    
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let finalJSON = JSON.parse(productoJsonString);
        
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        finalJSON['nombre'] = document.getElementById('name').value;

        if(!verifJSON(finalJSON)){
            return;
        }
        console.log()
        finalJSON['id'] = document.getElementById('productId').value;
        console.log(finalJSON)

        productoJsonString = JSON.stringify(finalJSON, null, 2);
        
        console.log(productoJsonString);
        
        let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify(finalJSON), // Convertir el objeto JSON a string 
            contentType: 'application/json; charset=utf-8', // Enviar como JSON
            success: function(response) {
                console.log(response);  // Mostrar la respuesta del servidor

                let template_bar = '';
                let respuesta = JSON.parse(response);
                
                template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                
                $('#product-result').removeClass('d-none');;
                $('#container').html(template_bar);
                
                edit = false;  // Reiniciar el modo de edición
                $('#product-form button[type="submit"]').text('Agregar Producto');
                resetForm();
                listarProductos();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud:', textStatus, errorThrown);  // Manejo de errores
            }
        });
    });

    // SE ASIGNA EL EVENTO CLICK AL BOTON DE ELIMINAR
    $(document).on('click', '.product-delete', function() {
        if (confirm('De verdad deseas eliminar el Producto?')) {
            let id = $(this).closest('tr').attr('productId');

            $.ajax({
                url: './backend/product-delete.php',
                type: 'GET',
                data: {id},
                success: function(response){
                    // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                    let respuesta = JSON.parse(response);
                    // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                    let template_bar = `
                        <li>status: ${respuesta.status}</li>
                        <li>message: ${respuesta.message}</li>
                    `;

                    // SE HACE VISIBLE LA BARRA DE ESTADO
                    $('#product-result').removeClass('d-none');
                    // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                    $('#container').html(template_bar);
                    
                    // SE LISTAN TODOS LOS PRODUCTOS
                    listarProductos();
                }
            });
        }
    });
    
    $(document).on('click', '.product-item', function(){
        let id = $(this)[0].parentElement.parentElement.getAttribute('productId');

        $.post('./backend/product-single.php', {id}, function(response){
            const product = JSON.parse(response);
            $('#productId').val(product[0].id);

            $('#name').val(product[0].nombre);
            
            let productWithoutNameAndId = {...product[0]};
            delete productWithoutNameAndId.nombre;
            delete productWithoutNameAndId.id;
            delete productWithoutNameAndId.eliminado;

            $('#description').val(JSON.stringify(productWithoutNameAndId, null, 4));
            edit = true;
            $('#product-form button[type="submit"]').text('Actualizar Producto');
        })
    });

});

function verifJSON(json){
    var final = true;
    let status = 'success';
    let message = "Validación exitosa";

    for(var i = 1; i < 8; i++){
        switch(i){
            case 1: 
                var nombre = json['nombre'];
                if(nombre.length == 0){
                    status = 'error';
                    message = 'Ingresa un nombre.';
                    final = false;
                } else if(nombre.length > 100){
                    status = 'error';
                    message = 'El nombre debe de tener 100 caracteres o menos.';
                    final = false;
                }
                break;
                
            case 2: 
                var marca = json.marca;
                let marcas = ['Epiphone', 'Gibson', 'Taylor', 'Fender', 'Yamaha', 'Oscar Schmidt'];
                
                if(marca.length == 0){
                    status = 'error';
                    message = 'Selecciona una marca.';
                    final = false;
                } else if(!marcas.includes(marca)){
                    status = 'error';
                    message = 'Marca no válida.';
                    final = false;
                }
                break;
                
            case 3: 
                var modelo = json.modelo;
                if(modelo.length == 0){
                    status = 'error';
                    message = 'Ingresa un modelo.';
                    final = false;
                } else if (!/^[a-zA-Z0-9 ]+$/.test(json.modelo) || json.modelo.length > 25) {
                    status = 'error';
                    message = 'El modelo debe ser alfanumérico y menor a 25 caracteres.';
                    final = false;
                }
                break;
                
            case 4: 
                var precio = json.precio;
                if(precio === undefined || precio === ''){
                    status = 'error';
                    message = 'Ingresa el precio.';
                    final = false;
                } else {
                    var aux = parseFloat(precio);
                    if(aux < 99.99){
                        status = 'error';
                        message = 'El precio debe de ser mayor a $99.99.';
                        final = false;
                    }
                }
                break;
                
            case 5: 
                var detalles = json.detalles;
                if (detalles.length > 250){
                    status = 'error';
                    message = 'Los detalles deben de tener 250 caracteres o menos.';
                    final = false;
                }
                break;
                
            case 6: 
                var unidades = json.unidades;
                if(unidades === undefined || unidades === ''){
                    status = 'error';
                    message = 'Ingresa la cantidad de unidades.';
                    final = false;
                } else {
                    var aux = parseInt(unidades);
                    if(aux < 0){
                        status = 'error';
                        message = 'La cantidad mínima de unidades es 0.';
                        final = false;
                    }
                }
                break;
                
            case 7: 
                var imagen = json.imagen;
                if(imagen.length == 0){
                    json.imagen = 'img/imagen.png';
                }
                break;

            default: 
                final = false;
        }
        
        // Si se detecta un error, salir del ciclo
        if(final == false){
            break;
        }
    }

    // Mostrar mensajes de error
    if(final == false){
        let template_bar = `
            <li style="list-style: none;">status: ${status}</li>
            <li style="list-style: none;">message: ${message}</li>
        `;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }

    return final;
}