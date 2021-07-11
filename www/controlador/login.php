<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../app/assets/css/bar.css">
    <link rel="stylesheet" href="../app/assets/css/log.css">
</head>

<body>
    <div class="login">
        <div class="login-triangle"></div>
        <h2 class="login-header">Inicio de sesión</h2>
        <form class="login-container" action="loguear.php" method="post">
            <!-- a travez del chekRut comprobamos que se esta ingresando un rut valido-->
            <p>Usuario <input required oninput="checkRut(this)" type="text" placeholder="ingrese su rut" name="usuario"></p>
            <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="clave"></p>
            <!-- mensaje de error al quivocarse-->
            <div align="mensaje">
                <?php if (isset($_GET['error']) && $_GET['error'] == 'true') : ?>
                    <center>
                        <h2>¡Sus datos no son correctos!</h2>
                    </center>
                <?php endif; ?>
            </div>
            <input type="submit" value="Ingresar">
            <script src="../app/assets/js/validarRUT.js"></script>
        </form>
</body> 
</html>