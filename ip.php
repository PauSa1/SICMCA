<?php

/*echo "Tu dirección IP es: {$_SERVER['REMOTE_ADDR']}";
echo "El nombre del servidor es: {$_SERVER['SERVER_NAME']}<hr>"; 
echo "Vienes procedente de la página: {$_SERVER['HTTP_REFERER']}<hr>"; 
echo "Te has conectado usando el puerto: {$_SERVER['REMOTE_PORT']}<hr>"; 
echo "El agente de usuario de tu navegador es: {$_SERVER['HTTP_USER_AGENT']}";*/
$direccionIP = $_SERVER['REMOTE_ADDR'];
$nombreServidor = $_SERVER['SERVER_NAME'];
$pagina = $_SERVER['HTTP_REFERER'];
$puerto = $_SERVER['REMOTE_PORT'];
$agenteNav = $_SERVER['HTTP_USER_AGENT'];
$fecha = date('Y-m-d H:i:s');
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Conexión</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="./Styles/estilos.css">
     <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
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
                     <li class="nav-item"><?php echo "<a class='nav-link active text-white menu-item p-2 text-center' aria-current='page' href='adm.php'>Lista de Usuario</a>" ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white menu-item p-2  text-center" href="./administrador/altas.php">Altas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white menu-item p-2 text-center" href="./administrador/docu.php">Documentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white menu-item p-2 text-center" href="#">Datos Conexión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white cerrar menu-item p-2 text-center" href="./clases/destroy.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row ">
            <div class="col">
                <div class="shadow-lg mt-4 bg-body rounded ancho">
                <h3 class="text-center fondo text-white fs-2 pt-3 pb-3 mb-3 titulologin">Registro de Actividad</h3>
                    <div class="col-md-12 table-responsive text-center p-2">
                        <table class="table table-striped table-sm mb-3">
                         
                            <div class="col-md-12">
                                <tbody>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>Usuario:</td>
                                            <td>
                                                <h6>Gabrielas	Peñalver Bernal	</h6>
                                                <h6>Profesor</h6>
                                                <h6>profesor1@dominio.com.mx</h6>
                                            </td>
                                        </tr>
                                    </div>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>Dirección IP:</td>
                                            <td><?php echo $direccionIP ?></td>
                                        </tr>
                                    </div>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>El nombre del servidor es:</td>
                                            <td><?php echo $nombreServidor ?></td>
                                        </tr>
                                    </div>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>Página Visitada</td>
                                            <td><?php echo $pagina ?></td>
                                        </tr>
                                    </div>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>Puerto de Conexión</td>
                                            <td><?php echo $puerto ?></td>
                                        </tr>
                                    </div>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>Agente de usuario del Navegador</td>
                                            <td><?php echo $agenteNav ?></td>
                                        </tr>
                                    </div>
                                    <div class="col-md-12">
                                        <tr>
                                            <td>Fecha y hora</td>
                                            <td><?php echo $fecha ?></td>
                                        </tr>  
                                    </div>
                                </tbody>
                            </div>

                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
<?php include('./templates/footer.php'); ?>
</html>