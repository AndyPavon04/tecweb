// JSON BASE A MOSTRAR EN FORMULARIO
/* var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
}; */

/* function init() {
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}*/

$(document).ready(function() {

    let edit = false;

    console.log('JQuery está trabajando!')
    listadoProductos();

    function listadoProductos(){
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response){
                let productos = JSON.parse(response);
                if(Object.keys(productos).length > 0) {
                    let template = '';

                    productos.forEach(producto => {
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
                    document.getElementById("products").innerHTML = template;
                }
            }
        });
    }

    $('#search').keyup(function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        // Obtener el valor de búsqueda usando jQuery
        var search = $('#search').val(); // Cambia 'searchInput' por el ID correcto del campo de entrada

        // Realizar la solicitud AJAX
        $.ajax({
            url: './backend/product-search.php',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                let productos = JSON.parse(response);

                if (Object.keys(productos).length > 0) {
                    let template = '';
                    let template_bar = '';

                    productos.forEach(producto => {
                        let descripcion = `
                            <li>precio: ${producto.precio}</li>
                            <li>unidades: ${producto.unidades}</li>
                            <li>modelo: ${producto.modelo}</li>
                            <li>marca: ${producto.marca}</li>
                            <li>detalles: ${producto.detalles}</li>
                        `;

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                    <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" data-id="${producto.id}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;

                        template_bar += `<li>${producto.nombre}</li>`;
                    });

                    // Actualizar el DOM con los resultados
                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;
                    document.getElementById("products").innerHTML = template;
                } else {
                    // Manejar el caso en que no se encuentran productos
                    document.getElementById("product-result").className = "card my-4 d-none"; // Ocultar el contenedor
                    document.getElementById("container").innerHTML = ""; // Limpiar la barra de estado
                    document.getElementById("products").innerHTML = ""; // Limpiar la tabla de productos
                }
            },
            error: function() {
                alert("Hubo un error al realizar la búsqueda.");
            }
        });
    });

    $('#product-form').submit(function(e) {
        e.preventDefault();

        // Crear un objeto con las propiedades deseadas
        var yeison = {
            id: $('#productId').val(),
            nombre: $('#form-name').val(),
            marca: $('#form-brand').val(),
            modelo: $('#form-model').val(),
            precio: $('#form-price').val(),
            detalles: $('#form-story').val(),
            unidades: $('#form-units').val(),
            imagen: $('#form-img').val()
        };

        // Convertir el objeto a JSON
        var productoJsonString = JSON.stringify(yeison, null, 3);

        // Si necesitas manipular alguna propiedad en `yeison` después
        yeison['nombre'] = document.getElementById('form-name').value;
        yeison['id'] = document.getElementById('productId').value;

        // Volver a convertir el objeto actualizado a JSON si es necesario
        productoJsonString = JSON.stringify(yeison, null, 3);

        var finalJSON = JSON.parse(productoJsonString);
        productoJsonString = JSON.stringify(finalJSON, null, 3);

        let template_bar = '';
        let errores = [];

        // Validar nombre
        if (!finalJSON.nombre || finalJSON.nombre.length == 0) {
            errores.push('Ingresa un nombre.');
        }
        if (finalJSON.nombre.length > 100) {
            errores.push('El nombre debe tener menos de 100 caracteres.');
        }

        // Validar marca
        const marcasValidas = ['Epiphone', 'Fender', 'Gibson', 'Oscar Schmidt','Taylor' , 'Yamaha'];
        if (!finalJSON.marca || finalJSON.marca.length == 0) {
            errores.push('Selecciona una marca.');
        }
        if (!marcasValidas.includes(finalJSON.marca)) {
            errores.push('Marca no válida.');
        }

        // Validar modelo
        if (!finalJSON.modelo || finalJSON.modelo.length == 0) {
            errores.push('Ingresa un modelo.');
        }
        if (!/^[a-zA-Z0-9 ]+$/.test(finalJSON.modelo) || finalJSON.modelo.length > 25) {
            errores.push('El modelo debe ser alfanumérico y menor a 25 caracteres.');
        }

        // Validar precio
        if (!finalJSON.precio || finalJSON.precio.length == 0) {
            errores.push('Ingresa el precio.');
        }
        if (finalJSON.precio < 99.99) {
            errores.push('El precio debe ser mayor a $99.99.');
        }

        // Validar detalles
        if (finalJSON.detalles && finalJSON.detalles.length > 250) {
            errores.push('Los detalles deben tener máximo 250 caracteres.');
        }
        
        // Validar unidades
        if (finalJSON.unidades == null || finalJSON.unidades < 0) {
            errores.push('La cantidad mínima de unidades es 0.');
        }

        // Validar imagen
        if (!finalJSON.imagen || finalJSON.imagen.length == 0) {
            finalJSON.imagen = 'img/pre.png';  // Asignar una imagen por defecto
        }

        // Si hay errores, mostrarlos todos
        if (errores.length > 0) {
            template_bar = '<ul>';
            template_bar+= '<li style="list-style: none;">status: Error</li>';
            errores.forEach(error => {
                template_bar += `<li style="list-style: none;">message: ${error}</li>`;
            });
            template_bar += '</ul>';

            document.getElementById("product-result").className = "card my-4 d-block";
            document.getElementById("container").innerHTML = template_bar;
        }

        else{
            let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
            console.log(finalJSON);

            $.ajax({
                url: url,
                type: 'POST',
                contentType: 'application/json', // Especificar que estamos enviando JSON
                data: JSON.stringify(finalJSON),

                success: function(response) {
                    console.log(response);
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;

                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;

                    listadoProductos();
                    edit = false;
                    $('#submit-button').text('Agregar Producto');
                    $('#form-name').val('');
                    $('#form-brand').val('');
                    $('#form-model').val('');
                    $('#form-price').val('');
                    $('#form-story').val('');
                    $('#form-units').val('');
                    $('#form-img').val('');
                    $('#productId').val('');
                }
            });
        }
    });

    $(document).on('click', '.product-delete', function() {
        if( confirm("De verdad deseas eliminar el Producto") ) {
            var id = event.target.parentElement.parentElement.getAttribute("productId");
            $.ajax({
                url: './backend/product-delete.php?id='+id,
                type: 'GET',
                data: {id},

                success: function(response){
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;
                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;

                    listadoProductos();
                }
            });
        }
    });

$(document).on('click', '.product-item', function() {
    let id = $(this)[0].parentElement.parentElement.getAttribute('productId');
    console.log(id);
    $.post('./backend/product-single.php', {id}, function(response){
        try {
            const product = JSON.parse(response);
            console.log(response);

            if (product && product[0]) { // Check if product and product[0] exist
                $('#productId').val(id);
                $('#form-name').val(product[0].nombre);
                $('#form-brand').val(product[0].marca);
                $('#form-model').val(product[0].modelo);
                $('#form-price').val(product[0].precio);
                $('#form-story').val(product[0].detalles);
                $('#form-units').val(product[0].unidades);
                $('#form-img').val(product[0].imagen);

                edit = true;
                $('#submit-button').text('Editar Producto');
            } else {
                console.error("Product not found or invalid response.");
                // Handle the case where the product is not found or the response is invalid.
                // You could display an error message to the user.
            }
        } catch (error) {
            console.error("Error parsing JSON response:", error);
            // Handle the case where the response is not valid JSON.
        }
    })
});

    $('#form-name').keyup(function(e) {
        e.preventDefault();

        var name = $('#form-name').val();

        $.ajax({
            url: './backend/product-singleByName.php',
            type: 'GET',
            data: { name: name },
            success: function(response) {
                let productos = response;
                if(productos.length > 2) {
                    let template_bar = '';
                    template_bar += `<li>Ya existe un producto con ese nombre</li>`;
                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;
                }
                else{
                    let template_bar = '';
                    template_bar += `<li>El nombre es valido</li>`;
                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;
                }
            }

        });
    });
});

function validarNombre(){
    var nombre = document.getElementById("form-name");
    if(nombre.value == ''){
        let template_bar = '';
        template_bar += `<li>El campo nombre es obligatorio</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
    else if (nombre.value.length > 100){
        let template_bar = '';
        template_bar += `<li>El nombre debe tener como maximo 100 caracteres</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;

    }
}

function validarMarca(){
    var marca = document.getElementById("form-brand");
    if (marca.value == ""){
        let template_bar = '';
        template_bar += `<li>El campo marca es obligatorio</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
}

function validarModelo(){
    var modelo = document.getElementById("form-model");
    if (modelo.value == ''){
        let template_bar = '';
        template_bar += `<li>Ingresa un modelo</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
}

function validarPrecio(){
    var precio = document.getElementById("form-price");
    if (precio.value == ''){
        let template_bar = '';
        template_bar += `<li>Ingresa el precio</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
    else if (precio.value <= 99.99){
        let template_bar = '';
        template_bar += `<li>El precio debe ser mayor a $99.99</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
}

function validarDetalles(){
    var detalles = document.getElementById("form-details");
    if(detalles.value > 250)
    {
        let template_bar = '';
        template_bar += `<li>Los detalles deben tener máximo 250 caracteres</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
}

function validarUnidades(){
    var unidades = document.getElementById("form-units");
    if (unidades.value == ''){
        let template_bar = '';
        template_bar += `<li>El campo unidades es obligatorio</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
    else if (unidades.value < 0){
        let template_bar = '';
        template_bar += `<li>Cantidad mínima de unidades es 0</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;
    }
}

function validarImagen(){
    var imagen = document.getElementById("form-img");
    if (imagen.value == ''){
        let template_bar = '';
        template_bar += `<li>Se asignó una imagen por defecto</li>`;
        document.getElementById("product-result").className = "card my-4 d-block";
        document.getElementById("container").innerHTML = template_bar;

        imagen.value = "img/default.png";
    }
}