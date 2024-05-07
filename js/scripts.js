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
      url: "php/Controller/inicioSesion.php",
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

function sesionIniciada() {
  console.log("Inicio función");
  $.ajax({
    url: "php/Controller/verificarEstado.php",
    type: "POST",
    success: function (response) {
      console.log(response);
      if (response == 200) {
        console.log("Sesión iniciada");
        $("#contenedor").load("php/View/puntoVenta.php");
      } else {
        console.log("Sesión no iniciada");
        $("#contenedor").load("php/View/inicioSesion.php", function () {
          formularioInicioSesionCajero();
        });
      }
    },
  });
}

