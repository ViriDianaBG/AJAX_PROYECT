$(document).ready(function () {
  sesionIniciada();
});

function formularioInicioSesionCajero() {
  $("#inicioSesionForm").submit(function (e) {
    e.preventDefault();
    var email = $("#email").val();
    var contrasenia = $("#contrasenia").val();
    console.log(email + " " + contrasenia);

    $.ajax({
      url: "php/Controller/inicioSesionCajero.php",
      type: "POST",
      data: { email: email, contrasenia: contrasenia },
      success: function (response) {
        if (parseInt(response) == 200) {
          console.log(" Hola, soy Cajero");
          $("#contenedor").load("php/View/puntoVenta.php", function () {
            $("#cerrarSesion").click(function () {
              $.ajax({
                url: "php/Controller/cerrarSesion.php",
                type: "POST",
                success: function (response) {
                  sesionIniciada();
                },
              });
            });
          });
        } else {
          console.log(response);
          console.log("hola por aca");
          alert("cajero o contraseña incorrectos");
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
}

function formularioInicioSesionAdmin() {
  $("#inicioSesionForm").submit(function (e) {
    e.preventDefault();
    var email = $("#email").val();
    var contrasenia = $("#contrasenia").val();
    console.log(email + " " + contrasenia);

    $.ajax({
      url: "php/Controller/inicioSesionAdmin.php",
      type: "POST",
      data: { email: email, contrasenia: contrasenia },
      success: function (response) {
        if (parseInt(response) == 200) {
          console.log("Hola, soy Administrador");
          $("#contenedor").load("php/View/paginaAdmin.php", function () {
            cerrarSesion();
            cajeroBtn();
            productoBtn();
            proveedorBtn();
          });
        } else {
          console.log(response);
          console.log("hola por aca");
          alert("cajero o contraseña incorrectos");
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
}

//Inicio de sesion
function sesionIniciada() {
  console.log("Inicio funcion sesionIniciada");
  $.ajax({
    url: "php/Controller/verificarEstado.php",
    type: "POST",
    success: function (response) {
      console.log(response);
      if (parseInt(response) == 200) {
        console.log("HOLA");
        console.log("Sesión iniciada CAJERO");
        $("#contenedor").load("php/View/puntoVenta.php", function () {
          cerrarSesion();
          busquedaProducto();
        });

      } else if (parseInt(response) == 201) {
        console.log("Sesión iniciada ADMIN");
        $("#contenedor").load("php/View/paginaAdmin.php", function () {
          cerrarSesion();
          cajeroBtn();
          mostrarCajeros();
          productoBtn();
          proveedorBtn();
        });
      } 
      else {
        console.log("Sesión no iniciada");
        $("#contenedor").load("php/View/inicio.php", function () {
          $("#cajeroBoton").click(function () {
            $.ajax({
              url: "php/View/inicioSesionCajero.php",
              type: "POST",
              success: function (response) {
                $("#contenedor").html(response);
                formularioInicioSesionCajero();
              },
            });
          });

          $("#administradorBoton").click(function () {
            $.ajax({
              url: "php/View/inicioSesionAdmin.php",
              type: "POST",
              success: function (response) {
                console.log("Condicional");
                $("#contenedor").html(response);
                formularioInicioSesionAdmin();
              },
            });
          });
        });
      }
      cerrarSesion();
    },
    error: function () {
      console.log("Error al verificar el estado de la sesión.");
    },
  });
}

function cerrarSesion() {
  console.log("Funcion cerrarSesion");
  $("#cerrarSesion").click(function () {
    console.log("Funcion cerrarSesion");
    $.ajax({
      url: "php/Controller/cerrarSesion.php",
      type: "POST",
      success: function (response) {
        sesionIniciada();
      },
    });
  });
}

function menuAdmin() {
  console.log("Funcion menuAdmin");
  $("#menuBoton").click(function () {
    console.log("Funcion menuAdmin");
    $.ajax({
      url: "php/View/paginaAdmin.php",
      type: "POST",
      success: function (response) {
        $("#contenedor").html(response);
        cerrarSesion();
        cajeroBtn();
        productoBtn();
        proveedorBtn();
      },
    });
  });
}

function cajeroBtn() {
  console.log("Funcion cajeroBtn");
  $("#CajeroButton").click(function () {
    console.log("Funcion CajeroButton");
    $.ajax({
      url: "php/View/cajero.php",
      type: "POST",
      success: function (response) {
        console.log("cajeroBoton");
        $("#contenedor").html(response);
        menuAdmin();
        mostrarCajeros();
      },
    });
  });
}

function productoBtn() {
  console.log("Funcion productosBtn");
  $("#StockButton").click(function () {
    console.log("Funcion ProductosButton");
    $.ajax({
      url: "php/View/stock.php",
      type: "POST",
      success: function (response) {
        console.log("ProductosButton");
        $("#contenedor").html(response);
        menuAdmin();
      },
    });
  });
}

function proveedorBtn() {
  console.log("Funcion proveedoresBtn");
  $("#ProveedoresButton").click(function () {
    console.log("Funcion ProveedoresButton");
    $.ajax({
      url: "php/View/proveedores.php",
      type: "POST",
      success: function (response) {
        console.log("ProveedoresButton");
        $("#contenedor").html(response);
        menuAdmin();
        mostrarProveedores();
      },
    });
  });
}

function mostrarProveedores() {
  console.log("Funcion mostrarProveedores");
  $.ajax({
    url: "php/Controller/mostrarProveedores.php",
    type: "POST",
    success: function (response) {
      console.log("proveedoresLista");
      $("#proveedores").html(response);
      btnEditarProveedor();
      btnEliminarProveedor();
      btnAgregarProveedor();
    },
  });
}

function btnEditarProveedor() {
  console.log("Funcion btnEditarProveedor");
  $(".editarBtn").click(function () {
    console.log("Funcion btnEditarProveedor");
    var id = $(this).data("id");
    console.log("proveedor:" + id);
    $.ajax({
      url: "php/Controller/editarProveedorForm.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        console.log("BotonEditarProveedor");
        $("#contenedor").html(response);
        editarFormProveedor();
      },
    });
  });
}

function btnEliminarProveedor() {
  console.log("Funcion btnEliminarProveedor");
  $(".eliminarBtn").click(function () {
    console.log("Funcion btnEliminarProveedor");
    var id = $(this).data("id");
    $.ajax({
      url: "php/Controller/eliminarBotonProveedor.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        console.log("ProveedorEliminado");
        console.log(response);
        mostrarProveedores();
      },
    });
    console.log(id);
  });
}

function btnAgregarProveedor() {
  console.log("Funcion btnAgregarProveedor");
  $("#agregarProveedor").click(function () {
    console.log("clickAgregarProveedor");
    $.ajax({
      url: "php/Controller/agregarProveedorForm.php",
      type: "POST",
      success: function (response) {
        console.log("agregarProveedor");
        $("#contenedor").html(response);
        agregarFormProveedor();
      },
    });
  });
}

function agregarFormProveedor() {
  $("#agregarProveedorForm").on("submit", function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var direccion = $("#direccion").val();
    var telefono = $("#telefono").val();
    var email = $("#email").val();

    console.log(nombre + " " + telefono + " " + email + " " + direccion);
    $.ajax({
      url: "php/Controller/setAgregarInfoProveedor.php",
      type: "POST",
      data: {
        nombre: nombre,
        telefono: telefono,
        email: email,
        direccion: direccion,
      },
      success: function (response) {
        console.log("agregarProveedorActualizado");
        console.log(response);
        sesionIniciada();
      },
    });
  });
}

function editarFormProveedor() {
  $("#editarProveedorForm").on("submit", function (e) {
    e.preventDefault();
    var id = $("#id").data("id");
    var nombre = $("#nombre").val();
    var telefono = $("#telefono").val();
    var email = $("#email").val();
    var direccion = $("#direccion").val();

    console.log(
      id + " " + nombre + " " + telefono + " " + email + " " + direccion
    );
    $.ajax({
      url: "php/Controller/setEditarInfoProveedor.php",
      type: "POST",
      data: {
        id: id,
        nombre: nombre,
        telefono: telefono,
        email: email,
        direccion: direccion,
      },
      success: function (response) {
        console.log("editarProveedorActualizado");
        console.log(response);
        sesionIniciada();
      },
    });
  });
}

function mostrarCajeros() {
  console.log("Funcion mostrarCajeros");
  $.ajax({
    url: "php/Controller/mostrarCajeros.php",
    type: "POST",
    success: function (response) {
      console.log("cajerosLista");
      $("#cajeros").html(response);
      btnEditarCajero();
      btnEliminarCajero();
      btnAgregarCajero();
    },
  });
}

function btnEditarCajero() {
  console.log("Funcion btnEditarCajero");
  $(".editarBtn").click(function () {
    console.log("Funcion btnEditarCajero");
    var id = $(this).data("id");
    console.log("cajero:" + id);
    $.ajax({
      url: "php/Controller/editarCajero.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        console.log("BotonEditarCajero");
        $("#contenedor").html(response);
        editarFormCajero();
        RegresarCajero();
      },
    });
  });
}

function btnEliminarCajero() {
  console.log("Funcion btnEliminarCajero");
  $(".eliminarBtn").click(function () {
    console.log("Funcion btnEliminarCajero");
    var id = $(this).data("id");
    $.ajax({
      url: "php/Controller/eliminarBotonCajero.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        console.log("CajeroEliminado");
        console.log(response);
        mostrarCajeros();
      },
    });
    console.log(id);
  });
}

function btnAgregarCajero() {
  console.log("Funcion btnAgregarCajero");
  $("#agregarCajero").click(function () {
    console.log("clickAgregarCajero");
    $.ajax({
      url: "php/Controller/agregarCajero.php",
      type: "POST",
      success: function (response) {
        console.log("agregarCajero");
        $("#contenedor").html(response);
        agregarFormCajero();
        Regresar();
      },
    });
  });
}

function Regresar(){
  $("#cancelar").click(function () {
    console.log("Funcion Regresar");
    $.ajax({
      url: "php/View/paginaAdmin.php",
      type: "POST",
      success: function (response) {
        console.log("Regresar");
        $("#contenedor").html(response);
      },
    });
  });
}

function RegresarCajero(){
  $("#regresar").click(function () {
    console.log("Funcion Regresar");
    $.ajax({
      url: "php/Controller/mostrarCajeros.php",
      type: "POST",
      success: function (response) {
        console.log("Regresar");
        $("#contenedor").html(response);
      },
    });
  });

}


function editarFormCajero() {
  $("#editarCajeroForm").on("submit", function (e) {
    e.preventDefault();
    var id = $("#id").data("id");
    var nombre = $("#nombre").val();
    var apellidoPaterno = $("#apellidoPaterno").val();
    var apellidoMaterno = $("#apellidoMaterno").val();
    var telefono = $("#telefono").val();
    var email = $("#email").val();
    var direccion = $("#direccion").val();

    console.log(
      id +
        " " +
        nombre +
        " " +
        apellidoPaterno +
        " " +
        apellidoMaterno +
        " " +
        email +
        " " +
        direccion +
        " " +
        telefono
    );
    $.ajax({
      url: "php/Controller/guardarInfoCajero.php",
      type: "POST",
      data: {
        id: id,
        nombre: nombre,
        apellidoPaterno: apellidoPaterno,
        apellidoMaterno: apellidoMaterno,
        telefono: telefono,
        email: email,
        direccion: direccion,
      },
      success: function (response) {
        console.log("editarCajeroActualizado");
        console.log(response);
        sesionIniciada();
      },
    });
  });
}

function agregarFormCajero() {
  $("#agregarCajeroForm").on("submit", function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var apellidoPaterno = $("#apellidoPaterno").val();
    var apellidoMaterno = $("#apellidoMaterno").val();
    var email = $("#email").val();
    var direccion = $("#direccion").val();
    var telefono = $("#telefono").val();
    var contrasenia = $("#contrasenia").val();

    console.log(
      nombre +
        " " +
        apellidoPaterno +
        " " +
        apellidoMaterno +
        " " +
        email +
        " " +
        contrasenia +
        " " +
        direccion +
        " " +
        telefono
    );
    $.ajax({
      url: "php/Controller/guardarCajeroC.php",
      type: "POST",
      data: {
        nombre: nombre,
        apellidoPaterno: apellidoPaterno,
        apellidoMaterno: apellidoMaterno,
        telefono: telefono,
        email: email,
        contrasenia: contrasenia,
        direccion: direccion,
      },
      success: function (response) {
        console.log("agregarCajeroActualizado");
        console.log(response);
        sesionIniciada();
      },
    });
  });
}

function productoBtn() {
  console.log("Funcion productosBtn");
  $("#ProductosButton").click(function () {
    console.log("Funcion ProductosButton");
    $.ajax({
      url: "php/View/producto.php",
      type: "POST",
      success: function (response) {
        console.log("ProductosButton");
        $("#contenedor").html(response);
        menuAdmin();
        mostrarProductos();
      },
    });
  });
}

function mostrarProductos() {
  console.log("Funcion mostrarProductos");
  $.ajax({
    url: "php/Controller/mostrarProductos.php",
    type: "POST",
    success: function (response) {
      console.log("productosLista");
      $("#productos").html(response);
      btnEditarProducto();
      btnEliminarProducto();
      btnAgregarProducto();
    },
  });
}

function btnEditarProducto() {
  console.log("Funcion btnEditarProducto");
  $(".editarBtn").click(function () {
    console.log("Funcion btnEditarProducto");
    var id = $(this).data("id");
    console.log("producto:" + id);
    $.ajax({
      url: "php/Controller/editarProductoForm.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        console.log("BotonEditarProducto");
        $("#contenedor").html(response);
        editarFormProducto();
      },
    });
  });
}

function editarFormProducto() {
  $("#editarProductoForm").on("submit", function (e) {
    e.preventDefault();
    var id = $("#id").data("id");
    var nombre = $("#nombre").val();
    var precio = $("#precio").val();
    var stock = $("#stock").val();
    var descripcion = $("#descripcion").val();
    var categoria = $("#categoria").val();
    var marca = $("#marca").val();
    var proveedor = $("#proveedor").val();

    console.log(
      id +
        " " +
        nombre +
        " " +
        precio +
        " " +
        stock +
        " " +
        descripcion +
        " " +
        categoria +
        " " +
        marca +
        " " +
        proveedor
    );

    $.ajax({
      url: "php/Controller/setEditarInfoProducto.php",
      type: "POST",
      data: {
        id: id,
        nombre: nombre,
        precio: precio,
        stock: stock,
        descripcion: descripcion,
        categoria: categoria,
        marca: marca,
        proveedor: proveedor,
      },
      success: function (response) {
        console.log("editarProductoActualizado");
        console.log(response);
        sesionIniciada();
      },
    });
  });
}

function btnEliminarProducto() {
  console.log("Funcion btnEliminarProducto");
  $(".eliminarBtn").click(function () {
    console.log("Funcion btnEliminarProducto");
    var id = $(this).data("id");
    $.ajax({
      url: "php/Controller/eliminarBotonProducto.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        console.log("ProductoEliminado");
        console.log(response);
        mostrarProductos();
      },
    });
    console.log(id);
  });
}

function btnAgregarProducto() {
  console.log("Funcion btnAgregarProducto");
  $("#agregarProducto").click(function () {
    console.log("clickAgregarProducto");
    $.ajax({
      url: "php/Controller/agregarProductoForm.php",
      type: "POST",
      success: function (response) {
        console.log("agregarProducto");
        $("#contenedor").html(response);
        agregarFormProducto();
      },
    });
  });
}

function agregarFormProducto() {
  $("#agregarProductoForm").on("submit", function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var precio = $("#precio").val();
    var stock = $("#stock").val();
    var descripcion = $("#descripcion").val();
    var categoria = $("#categoria").val();
    var marca = $("#marca").val();
    var proveedor = $("#proveedor").val();

    console.log(
      nombre +
        " " +
        precio +
        " " +
        stock +
        " " +
        descripcion +
        " " +
        categoria +
        " " +
        marca +
        " " +
        proveedor
    );
    $.ajax({
      url: "php/Controller/setAgregarInfoProducto.php",
      type: "POST",
      data: {
        nombre: nombre,
        precio: precio,
        stock: stock,
        descripcion: descripcion,
        categoria: categoria,
        marca: marca,
        proveedor: proveedor,
      },
      success: function (response) {
        sesionIniciada();
      },
    });
  });
}

function busquedaProducto() {
  $("#buscador").on("keyup", function () {
    var nombre = $(this).val().toLowerCase();
    console.log(nombre);
    // Verificar si el campo de búsqueda está vacío
    if (nombre.trim() !== "") {
      $.ajax({
        url: "php/Controller/busquedaProductos.php",
        type: "POST",
        data: { nombre: nombre },
        success: function (response) {
          $("#listaProductos").html(response);
          agregarCarrito();
          eliminarCarrito();
          pagarCarritoEfectivo();
          pagarCarritoTarjeta();
          valorEfectivo();
        },
      });
    } else {
      // Si el campo de búsqueda está vacío, limpiar la tabla
      $("#listaProductos").empty();
    }
  });
}

function agregarVenta() {
  $(".agregarVenta").click(function () {
    console.log("AgregarVenta");
    var id = $(this).data("id");
    console.log(id);
    $.ajax({
      url: "php/Controller/agregarVenta.php",
      type: "POST",
      data: { id: id },
      success: function (response) {
        $("#contenedor").html(response);
        pagarCarritoEfectivo();
        pagarCarritoTarjeta();
      },
    });
  });
}


function eliminarCarrito() {
  $(".eliminarProducto").click(function () {
    var id = $(this).data("id");
    console.log(id);
    $.ajax({
      url: "php/Controller/gestorCarrito.php",
      type: "POST",
      data: { id: id, operacion: "eliminar" },
      success: function (response) {
        $("#carrito").html(response);
        eliminarCarrito();
        pagarCarritoEfectivo();
        pagarCarritoTarjeta();
      },
    });
  });
}

function agregarCarrito() {
  $(".agregarProducto").click(function () {
    var id = $(this).data("id");
    $.ajax({
      url: "php/Controller/gestorCarrito.php",
      type: "POST",
      data: { id: id, operacion: "agregar" },
      success: function (response) {
        $("#carrito").html(response);
        eliminarCarrito();
        pagarCarritoEfectivo();
        pagarCarritoTarjeta();
      },
    });
  });
}

function pagarCarritoEfectivo(){
  $(".efectivoBoton").click(function () {
    console.log("pagarCarritoEfectivoEfectivo");
   /*  var id = $(this).data("id"); */
    $.ajax({
      url: "php/Controller/gestorCarrito.php",
      type: "POST",
      data: { pago: "efectivo" },
      success: function (response) {
        $("#contenedor").html(response);
        valorEfectivo();
        nuevaCompra();
      },
    });
  });

  
}

function pagarCarritoTarjeta(){
  $("#tarjetaBoton").click(function () {
    console.log("pagarCarritoEfectivoEfectivo");
    $.ajax({
      url: "php/Controller/gestorCarrito.php",
      type: "POST",
      data: { pago: "tarjeta" },
      success: function (response) {
        $("#contenedor").html(response);
        nuevaCompra();
      },
    });
  });
}

function valorEfectivo(){
  $("#pagoEfectivo").on('click', function () {
    console.log("hola bola");
    var total = $("#total").data('value');
    console.log('Total:' + total);
    var efectivo = $("#efectivo").val();
    console.log('Efectivo :' + efectivo);
    var resultado = efectivo - total;
    console.log('Resultado: ' + resultado);

    $("#resultado").text(resultado.toFixed(2));
    if(resultado >= 0){
    $("#resultado").text("Tu cuenta ha sido pagada, Cambio: " + (resultado.toFixed(2)));
    }
  });
}


function nuevaCompra(){
  $("#nuevaCompra").click(function () {
    console.log("nuevaCompra");
    $.ajax({
      url: "php/Controller/gestorCarrito.php",
      type: "POST",
      success: function (response) {
        $("#contenedor").html(response);
        sesionIniciada();
      },
    });
  });
}
