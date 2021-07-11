<?php
ob_start();
//inicio de sesion 
session_start();
$usuario = $_SESSION['username'];
//Sin acceso a sesion, lo devuelve a login.php
if (!isset($usuario)) {
  header("location: ../controlador/login.php");
} else {

  //boton de deslogear
  "<a href='../controlador/salir.php'>SALIR</a>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Sensores</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- Letras -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Iconos -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/css/cards.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <!-- Barra lateral -->
  <link rel="stylesheet" href="./assets/css/bar.css">
  <!-- ocultar -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

  <!-- barra lateral-->
  <nav class=" navbar-vertical  fixed-left  navbar-expand-xs navbar-light " id="sidenav-main">
    <div class="nav-item">
      <div>
        <br>
        <ul>
          <!--Consulta a base de datos por usuario-->
          <?php
          echo "<h1>BIENVENIDO $usuario</h1> ";
          ?>
          <br><br>
          <span class="nav-item">
            <a class="nav-link active" href="index.php">
              <i class="fas fa-tv text-primary"></i>
              <span class="nav-link-text">Sensores</span>
            </a>
          </span>
          <br>
          <span class="nav nav">
            <a class="nav-link active" href="histograma.php">
              <i class="fas fa-chart-pie text-green"></i>
              <span class="nav-link-text">Histograma</span>
            </a>
          </span>
          <br>
          <span class="nav nav">
            <a class="nav-link active" href="conf.php">
              <i class="fas fa-cogs text-default"></i>
              <span class="nav-link-text">Configuracion</span>
            </a>
          </span>
          <br>
          <!-- salir de sesion -->
          <span class="nav-item">
            <a class="active active-pro" href='../controlador/salir.php'>
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-link-text">Salir</span>
            </a>
          </span>
        </ul>
      </div>
    </div>


  </nav>
  <!--tarjetas -->
  <div class="main-content" id="panel">
    <!--Configuracion-->
    <br>
    <div class="container" style="max-width: 700px; min-width: 400px;">
      <div class="card">
        <h2 class="card-header text-center">Modificar estado de sensores</h2>
        <div class="card-body">
          <form id="myForm" onsubmit="return validar()">
            <div class="form-group">
              <div class="row justify-content-center">
                <!--Primera configuracion -->
                <div class=" col-sm-5"><br>
                  <script>
                    //iniciamos la funcion, obtenemos la id con la que trabajaremos para luego poder ocultar o mostrarla 
                    $(document).ready(function() {
                      //hacemos uso de localstorage para almacenar las funciones visuales del usuario
                      if (window.localStorage.getItem("div1") != null) {
                        var pb = window.localStorage.getItem("div1");
                        if (pb == "true") {
                          //ocultamos o mostramos segun el estado del boton 
                          $(".div1").hide();

                        }
                      }
                      //con button1 
                      $("button1").click(function() {
                        var v = $(".div1").is(":visible")
                        $(".div1").fadeToggle(500, "swing");
                        window.localStorage.setItem("div1", v)
                      });
                    });

                    //funcion para colorear los botones segun el estado
                    function changeClass() {
                      //Obtenemos el estado de localstorage y le asignamos color1 como variable
                      var color1 = localStorage.getItem("div1");
                      //comparamos el estado de la variable para luego otorgrarle un color segun corresponda
                      if (color1 == "true") {
                        document.getElementById("humedad").className = "btn btn-danger";
                      } else if (color1 == "false") {
                        document.getElementById('humedad').className = "btn btn-success";
                      }
                    };
                    //actualizamos la funcion cada 800ms en caso de que hayan cambios estos se reflejen en la interfaz web
                    setInterval(changeClass, 800);
                  </script>
                  <div class="card ">
                    <button1 class="btn btn-outline-warning" type="button" id="humedad">Humedad</button1>
                  </div>
                </div>
                <p class="div1"></p>
                <!--segunda configuracion -->
                <div class=" col-sm-5"><br>
                  <script>
                    $(document).ready(function() {
                      if (window.localStorage.getItem("div2") != null) {
                        var pb = window.localStorage.getItem("div2");
                        if (pb == "true") {
                          $(".div2").hide();
                        }
                      }

                      $("button2").click(function() {
                        var v = $(".div2").is(":visible")
                        $(".div2").fadeToggle(500, "swing");
                        window.localStorage.setItem("div2", v)
                      });
                    });

                    function changeClass2() {
                      var color2 = localStorage.getItem("div2");

                      if (color2 == "true") {
                        document.getElementById("temperatura").className = "btn btn-danger";

                      } else if (color2 == "false") {

                        document.getElementById('temperatura').className = "btn btn-success";
                      }

                    };

                    setInterval(changeClass2, 800);
                  </script>
                  <div class="card ">
                    <button2 class="btn btn-outline-warning"  type="button" id="temperatura">Temperatura</button2>
                  </div>
                </div>
                <p class="div2"></p>
                <!--tercera configuracion -->
                <div class=" col-sm-5"><br>
                  <script>
                    $(document).ready(function() {
                      if (window.localStorage.getItem("div3") != null) {
                        var pb = window.localStorage.getItem("div3");
                        if (pb == "true") {
                          $(".div3").hide();
                        }
                      }

                      $("button3").click(function() {
                        var v = $(".div3").is(":visible")
                        $(".div3").fadeToggle(500, "swing");
                        window.localStorage.setItem("div3", v)
                      });
                    });

                    function changeClass3() {
                      var color3 = localStorage.getItem("div3");

                      if (color3 == "true") {
                        document.getElementById("pH").className = "btn btn-danger";

                      } else if (color3 == "false") {

                        document.getElementById('pH').className = "btn btn-success";
                      }

                    };


                    setInterval(changeClass3, 800);
                  </script>
                  <div class="card ">
                    <button3 class="btn btn-outline-warning"  type="button" id="pH">pH</button3>
                  </div>
                </div>
                <p class="div3"></p>
                <!--cuarta configuracion -->
                <div class=" col-sm-5"><br>
                  <script>
                    $(document).ready(function() {
                      if (window.localStorage.getItem("div4") != null) {
                        var pb = window.localStorage.getItem("div4");
                        if (pb == "true") {
                          $(".div4").hide();
                        }
                      }

                      $("button4").click(function() {
                        var v = $(".div4").is(":visible")
                        $(".div4").fadeToggle(500, "swing");
                        window.localStorage.setItem("div4", v)
                      });
                    });

                    function changeClass4() {
                      var color4 = localStorage.getItem("div4");

                      if (color4 == "true") {
                        document.getElementById("presion").className = "btn btn-danger";

                      } else if (color4 == "false") {

                        document.getElementById('presion').className = "btn btn-success";
                      }

                    };


                    setInterval(changeClass4, 800);
                  </script>
                  <div class="card ">
                    <button4 class="btn btn-outline-warning"  type="button" id="presion">Presion Atmosferica</button4>
                  </div>
                </div>
                <p class="div4"></p>

                <!--Quinta configuracion -->
                <div class=" col-sm-5"><br>
                  <script>
                    $(document).ready(function() {
                      if (window.localStorage.getItem("div5") != null) {
                        var pb = window.localStorage.getItem("div5");
                        if (pb == "true") {
                          $(".div5").hide();
                        }
                      }

                      $("button5").click(function() {
                        var v = $(".div5").is(":visible")
                        $(".div5").fadeToggle(500, "swing");
                        window.localStorage.setItem("div5", v)
                      });
                    });

                    function changeClass5() {
                      var color5 = localStorage.getItem("div5");

                      if (color5 == "true") {
                        document.getElementById("uv").className = "btn btn-danger";

                      } else if (color5 == "false") {

                        document.getElementById('uv').className = "btn btn-success";
                      }

                    };

                    setInterval(changeClass5, 800);
                  </script>
                  <div class="card ">
                    <button5 class="btn btn-outline-warning"  type="button" id="uv">Radiación ultravioleta</button5>
                  </div>
                </div>
                <p class="div5"></p>
                <!--Fin configuracion -->

                
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!-- TESTTTT -->
<div class="container" style="max-width: 700px; min-width: 400px;">
      <div class="card">
        <h2 class="card-header text-center">Modificacion de datos</h2>
        <div class="card-body">

  <form class="login-container card" action="../controlador/actualizar.php" method="post">
            <!-- a travez del chekRut comprobamos que se esta ingresando un rut valido-->
            <p><input class="form-control text-center"  type="text" placeholder="Nombre Organizacion" name="nombreOrg"></p>
            <p>La contraseña de debe contener mayusculas y numeros. </p>          
            <p><input class="form-control text-center" type="password" pattern="^(?=.[0-9])(?=.[a-z])(?=.*[A-Z])(?=\S+$).{6,}$" maxlength="12" placeholder="Contraseña nueva" name="contraseña"></p>
            <!-- mensaje de error al quivocarse-->
           
            <input class="btn btn-primary" type="submit" name="update" value="Modificar">
        </form>

        </div>
      </div>
</div>
  </div>
  

  </div>
</body>

</html>