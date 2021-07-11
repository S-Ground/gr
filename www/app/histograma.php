<?php
ob_start();
//inicio de sesion 
require '../controlador/db.php';

session_start();

$usuario = $_SESSION['username'];
//Sin acceso a sesion, lo devuelve a login.php
if (!isset($usuario)) {
  header('location: ../controlador/login.php');

} else {
  
  //boton de deslogear
  "<a href='../controlador/salir.php'>SALIR</a>";
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Histograma</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
  <!-- letra -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="./assets/css/bar.css">

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  
</head>

<body>
  <!-- barra lateral-->
  <nav class=" navbar-vertical  fixed-left  navbar-expand-xs navbar-light " id="sidenav-main">
    <div class="nav-item">
      <div>
        <br>
        <ul>
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
  <!--Hisogramas -->
  <div class="main-content" id="panel"> <br>
    <div class="container" style="max-width: 1300px; min-width: 400px;">
      <div class="card">
        <div class="card-body">
          <!--Se establece id al canvas para trabajarlo y mostrar lo que sea necesario -->
          <canvas id="myChart" style="position: relative; height: 25vh; width: 80vw;"></canvas>
          <!--repositorio de chartjs.org que nos entrega los graficos -->
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <!--Script de grafico -->
          <script>

            var ctx = document.getElementById('myChart').getContext('2d');
            
            //definimos la variable con la que se trabajara
            var myChart = new Chart(ctx, {
              //Se establecen los parametros para el grafico
              type: 'line',
              data: {
                datasets: [{
                  label: 'Humedad',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: 'rgb(75, 192, 192)',
                  borderWidth: 1.5,
                  radius: 1.5

                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })
            
            //Llamamos a la api para poder obtener los datos 
            let url =  'http://localhost/apirest_php/datos.php'
            fetch(url)
              .then(response => response.json())
              .then(datos => mostrar(datos))
              .catch(error => console.log(error))

            //una ves obtenido los datos, estos se seleccionan y luego se muestran
            const mostrar = (datos) => {
              datos.forEach(element => {
                //obtenemos los datos y los ingresamos 
                myChart.data['labels'].push(element.fecha)
                myChart.data['datasets'][0].data.push(element.humedad)
                myChart.update();
              });
              console.log(myChart.data)
              
            };


          </script>

        </div>
      </div>
    </div>

    <!--Histograma 2-->

    <div class="container" style="max-width: 1300px; min-width: 400px;">
      <div class="card">
        <div class="card-body">
          <canvas id="myChart1" style="position: relative; height: 25vh; width: 80vw;"></canvas>
          <script>
            var ctx1 = document.getElementById('myChart1').getContext('2d');
            var myChart1 = new Chart(ctx1, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'Temperatura',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: 'rgb(75, 192, 192)',
                  borderWidth: 1.5,
                  radius: 1.5
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })
            let url1 = 'http://localhost/apirest_php/datos.php'
            fetch(url1)
              .then(response => response.json())
              .then(datos1 => mostrar1(datos1))
              .catch(error => console.log(error))

            const mostrar1 = (datos1) => {
              datos1.forEach(element => {
                myChart1.data['labels'].push(element.fecha)
                myChart1.data['datasets'][0].data.push(element.temperatura)
                myChart1.update();
              });
              console.log(myChart1.data)


            };
           
          </script>
        </div>
      </div>
    </div>

    <!--Histograma 3-->

    <div class="container" style="max-width: 1300px; min-width: 400px;">
      <div class="card">
        <div class="card-body">
          <canvas id="myChart2" style="position: relative; height: 25vh; width: 80vw;"></canvas>
          <script>
            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var myChart2 = new Chart(ctx2, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'pH',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: 'rgb(75, 192, 192)',
                  borderWidth: 1.5,
                  radius: 1.5
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })
            let url2 =  'http://localhost/apirest_php/datos.php'
            fetch(url2)
              .then(response => response.json())
              .then(datos2 => mostrar2(datos2))
              .catch(error => console.log(error))

            const mostrar2 = (datos2) => {
              datos2.forEach(element => {
                myChart2.data['labels'].push(element.fecha)
                myChart2.data['datasets'][0].data.push(element.ph)
                myChart2.update();
              });
              console.log(myChart2.data)


            };
          


          </script>
        </div>
      </div>
    </div>



    <!--Histograma 4-->

    <div class="container" style="max-width: 1300px; min-width: 400px;">
      <div class="card">
        <div class="card-body">
          <canvas id="myChart3" style="position: relative; height: 25vh; width: 80vw;"></canvas>
          <script>
            var ctx3 = document.getElementById('myChart3').getContext('2d');
            var myChart3 = new Chart(ctx3, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'Presion atmosferica',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: 'rgb(75, 192, 192)',
                  borderWidth: 1.5,
                  radius: 1.5
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })
            let url3 =  'http://localhost/apirest_php/datos.php'
            fetch(url3)
              .then(response => response.json())
              .then(datos3 => mostrar3(datos3))
              .catch(error => console.log(error))

            const mostrar3 = (datos3) => {
              datos3.forEach(element => {
                myChart3.data['labels'].push(element.fecha)
                myChart3.data['datasets'][0].data.push(element.presion)
                myChart3.update();

              });
              console.log(myChart3.data)


            };
          </script>
        </div>
      </div>
    </div>


    <!--Histograma 5-->

    <div class="container" style="max-width: 1300px; min-width: 400px;">
      <div class="card">
        <div class="card-body">
          <canvas id="myChart4" style="position: relative; height: 25vh; width: 80vw;"></canvas>
          <script>
            var ctx4 = document.getElementById('myChart4').getContext('2d');
            var myChart4 = new Chart(ctx4, {
              type: 'line',
              data: {
                datasets: [{
                  label: 'Raduacion UV',
                  backgroundColor: ['#6bf1ab', '#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
                  borderColor: 'rgb(75, 192, 192)',
                  borderWidth: 1.5,
                  radius: 1.5
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            })
            let url4 =  'http://localhost/apirest_php/datos.php'
            fetch(url4)
              .then(response => response.json())
              .then(datos4 => mostrar4(datos4))
              .catch(error => console.log(error))

            const mostrar4 = (datos4) => {
              datos4.forEach(element => {
                myChart4.data['labels'].push(element.fecha)
                myChart4.data['datasets'][0].data.push(element.uv)
                myChart4.update();
              });
              console.log(myChart4.data)
            };
          </script>
        </div>
      </div>
    </div>

    <!--Histograma de test-->
    <!--Ultimo div panel-->
  </div>

  <!--grafico-->
  <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
</body>

</html>