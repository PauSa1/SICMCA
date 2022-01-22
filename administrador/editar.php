<?php
require('../conexion/conexionSYS.php');
session_start();
$conexion = new conexionSYS;
if (empty($_POST["id"])) {
    $id_usuario = $_GET["id_usuario"];
    $id_persona = $_GET["id_persona"];
    $datosUsuario = $conexion->obtnerUsuario($id_usuario);
    //print_r($datosUsuario);
    foreach ($datosUsuario as $key => $dato) {
        $id = $dato['id_usuario'];
        $nombre = $dato['nombre'];
        $apellidos = $dato['apellidos'];
        $correo = $dato['correo'];
        $id_rol = $dato['id_rol'];
        $nombre_rol = $dato['nombre_rol'];
        //echo "usuario= " . $id_usuario;
        //echo "persona= " . $id_persona;
    }
 
} else {   

    $id_persona = $_POST["id_persona"];
    $id_usuario = $_POST["id"];;
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $id_rol = $_POST["roles"];
    $errorN="";
    if ( empty($nombre)) {
      
        echo "nombre vacio";
    }else{

        $conexion->actualizarUsuario($id_usuario, $correo);
        $conexion->actualizarPersona($nombre, $apellidos, $id_persona);
        $conexion->actualizarRol($id_rol, $id_usuario);
        // echo "usuario= " . $id_usuario;
        // echo "persona= " . $id_persona;
        // header("location: ../adm.php");
        header("location: ../adm.php");
    }    
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="../Styles/estilos.css">
     <link rel="stylesheet" href="../Styles/bootstrap/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                        <a class="nav-link text-white menu-item p-2 text-center" href="../ip.php">Datos Conexión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white cerrar menu-item p-2 text-center" href="../clases/destroy.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-----------------Seccion formulario ------------------->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="shadow-lg mt-4 bg-body rounded ancho">
                    <h3 class="text-center fondo text-white  fs-2 pt-3 pb-3 mb-5 titulologin">Editar Usuario</h3>
                    <div class="p-3">
                        <div class="col-md-12">
                            <input type="hidden"  class="form-control" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>" >
                            <label for="fname" class="form-label ">Id Moodle</label>
                            <input type="text" class="form-control mb-3" id="id_moodle" value="<?php echo $id ?>"disabled>
                        </div>

                        <!--Ejemplo validacion
                        <div class="col-md-4">
    <label for="validationServer02" class="form-label">Last name</label>
    <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  -->
                      
                        <!--Continuacion-->
                        <div class="col-md-12">
                            <label for="fname" class="form-label "> Nombre(s)</label>
                            <span  id="datos" class="error">* <?php /* echo $e_Nombre*/?></span>
                            <input type="text" class="form-control mb-3" id="nombre" name="nombre"   minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)"     value="<?php echo $nombre ?>" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label ">Apellidos</label>
                            <span  id="datos" class="error">* <?php ?></span>
                            <input type="text" class="form-control mb-3" id="apellidos" name="apellidos"  minlength="6" maxlength="40" onkeypress="return (event.charCode < 33 || event.charCode > 64)" value="<?php echo $apellidos ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="fname" class="form-label ">Correo Institucional</label>
                            <span  id="datos" class="error">* <?php ?></span>
                            <input type="text" class="form-control mb-3" id="correo" name="correo" value="<?php echo $correo ?>" Required>
                        </div>
                        <div class="input-group col-md-3 mt-3 mb-12">
                            <label for="fname" class="input-group-text ">Tipo de Usuario</label>
                            <input type="hidden" name="rol" id="rol" size="30" ><br>
                            <select name="rol" id="roles" class="form-select" required>
                                <option selected disabled>Seleccione...</option>
                                <option value="1">Administrador</option>
                                <option value="2">Coordinador</option>
                                <option value="3">Profesor</option>
                            </select>
                            <br>                            
                        </div>
                        <div class="mb-3 text-center">
                            <p id="error"></p>
                            <button href="../adm.php" class="btn btn-warning mt-3 me-3 fw-bold text-white" type="" id="editar" name="editar">Actualizar</button>
                            <button class="btn btn-primary mt-3 me-3 fw-bold">Enviar Contraseña</button>
                            <?php
                            echo "<a href='../adm.php'   class='btn btn-success mt-3  fw-bold' type='button'>Regresar</a>";
                            ?>
                        </div> 
                    </div>                    
             
                </div>
            </div>
        </div>
    </div>

    <div id="respuesta">
        
    </div>   
    

<script src="../js/validacionEditar.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap/popper.min.js"></script>
<script src="../js/bootstrap/bootstrap.min.js"></script>

</body>

<footer class="text-center text-lg-start text-white mt-3">
    <!-- Section: Avisos de privacidad  -->
    <section class="piePagina">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 mt-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4 text-center">Contacto
                    </h6>
                    <a href="https://www.tic.unam.mx/ubicacion/" class=" text-white enlaces">Circuito exterior s/n, frente a la Facultad de Contaduría y Administración, Ciudad Universitaria, C.P. 04510, Ciudad de México</a>
                    
                    <p class="mt-3"> <i class="bi bi-telephone"></i> Teléfonos: (55) 5622 8502 y (55) 5622 8354</p>
                    <a href="mailto:contacto.tic@unam.mx" class="text-white enlaces"><i class="bi bi-envelope"></i> contacto.tic@unam.mx</a>
                </div>
                <!-- Grid column -->
                <div class="col-md-4 mt-4">
                    <h6 class="text-uppercase mb-4 fw-bold text-center">Avisos de Privacidad</h6>
                    <a href="https://www.tic.unam.mx/avisosprivacidad/" class=" text-white fs-6 enlaces">Dirección General de Cómputo y de Tecnologías de Información y Comunicación <span class="fw-bold">(DGTIC).</span></a>
                    <br><br>
                    <a href="https://www.dgae.unam.mx/aviso_privacidad.html" class=" text-white fs-6 enlaces">Dirección General de Administración Escolar <span class="fw-bold">(DGAE).</span></a>
                    <h6 class="text-uppercase mt-3 fw-bold text-center">Créditos</h6>
                </div>
                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 mt-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4 text-center">Portal</h6>
                    <a href="https://www.tic.unam.mx/" title="logo DGTIC"><img src="https://www.tic.unam.mx/wp-content/uploads/2019/03/logo-dgtic-300x71.png" width="auto" height="auto" alt="logo DGTIC"></a>
                    <a href="https://www.dgae.unam.mx/" title="logo DGAE"><img src="https://www.dgae.unam.mx/assets/images/escudo_dgae_completow.svg" class="logo" width="auto" height="auto" alt="logo DGAE"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Copyright -->
    <div class="text-center p-4 copyright">
        © 2021 Copyright:
        <p class=" derechos">Hecho en México, Universidad Nacional Autónoma de México (UNAM), todos los derechos reservados 2021. Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. De otra forma, requiere permiso previo por escrito de la institución.</p>
        <a class="text-reset fw-bold" href="https://www.unam.mx/">Portal UNAM.mx</a>
    </div>
</footer>

</html>
