$(document).ready(function () {
  sesionIniciada();
});

var $pagina = 0;

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
          console.log("hola por aqui");
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
          console.log("hola por aqui");
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
        $("#contenedor").load("php/View/paginaCajero.php", function () {
          cerrarSesion();
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
      } else {
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

    console.log(
      nombre +
        " " +
        telefono +
        " " +
        email +
        " " +
        direccion
    );
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
      id +
        " " +
        nombre +
        " " +
        telefono +
        " " +
        email +
        " " +
        direccion
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
  $(".editarBtnProveedor").click(function () {
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
