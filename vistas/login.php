<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <?php
    //INCLUDES
    include_once __DIR__."/../lib/autenticacion.php";
    include_once __DIR__."/../lib/GestorBD.php";
    include_once __DIR__."/../config/config.php";
    //CONEXION A LA BBDD
    $conex = new GestorBD();
    $conex->conectar();

    if (Autenticacion::estaAutenticado()){
        header ("location: /vistas/verRutinas.php");
        exit();
    }
    if (isset($_POST["nombre_usuario"]) && isset($_POST["contrasena"])){
        if (Autenticacion::autenticar($_POST["nombre_usuario"], $_POST["contrasena"])){
          header("location: /vistas/verRutinas.php");
          //exit();
        } else {
          $error_message = "Usuario y/o contraseña incorrectos";
        }
    }
    ?>

    <main class="form-signin w-100 m-auto">
        <!-- Formulario de inicio de sesión -->
        <form method="POST" action="">
        <a href="/index.php">
    <img class="mb-4" src="/assets/img/logo.png" alt="" width="300px" style="margin-top: 150px;">
</a>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>


            <div class="form-floating">
                <input type="text" class="form-control" name="nombre_usuario" id="floatingInput" placeholder="Nombre de usuario">
                <label for="floatingInput">Nombre de usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="contrasena" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>
                <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
                <?php  endif; ?>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
            </div>
            <button class="btn btn-primary w-100 py-2, margen-inferior" type="submit" style="margin-bottom: 10px;">Sign in</button>
            <a href="/vistas/registro.php" class="btn btn-primary w-100 py-2">Crear cuenta</a>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
      document.getElementById("crearCuentaBtn").addEventListener("click", function() {
        window.location.href = "registro.php";
      });
</script>
</body>
</html>
