<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Facultades</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top fondo">
    <div class="container">
      <img src="https://www.unam.mx/sites/all/themes/unam/logo.png" alt="logo" width="auto" height="auto" class="mb-3 imagen">
      <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarmenu">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
           <li class="nav-item"><?php echo "<a class='nav-link active text-white menu-item p-2 text-center' aria-current='page' href='../adm.php'>Lista de Usuario</a>" ?>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2  text-center" href="altas.php">Altas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2 text-center" href="docu.php">Documentación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2 text-center" href="#">Facultad</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white menu-item p-2 text-center" href="../ip.php">Datos Conexión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white cerrar menu-item p-2 text-center" href="../clases/destroy.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>