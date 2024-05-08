
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
          alert("Usuario o contraseña incorrectos");
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
          $("#contenedor").load("php/View/paginaAdmin.php", 
          function () {
            $("#cerrarSesion").click(function () {
              $.ajax({
                url: "php/Controller/cerrarSesion.php",
                type: "POST",
                success: function (response) {
                  sesionIniciada();
                },
              });
            });
            usuarioBtn();
          });
        } else {
          console.log(response);
          console.log("hola por aca");
          alert("Usuario o contraseña incorrectos");
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
  e.preventDefault();
  console.log("Inicio funcion sesionIniciada");
  $.ajax({
    url: "php/Controller/verificarEstado.php",
    type: "POST",
    success: function (response) {
      console.log(response);
      if (response == 200) {
        console.log("Sesión iniciada");
        
        $("#contenedor").load("php/View/paginaCajero.php");
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
    },
  });
}

function usuarioBtn(){
  console.log("Funcion usuarioBtn");
  $("#CajeroButton").click(function(){
    console.log("Funcion CajeroButton");
   $.ajax({
     url: "php/View/usuarios.php",
     type: "POST",
     success: function(response){
      console.log("Mensaje de la función");
       $("#contenedor").html(response);
     }
   });
  });
}
