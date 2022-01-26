<?php
//require("./clases/registro.php");
require('./conexion/conexionSYS.php');

session_start();
if (isset($_SESSION['login'])) {
} else {
    header("location: index.php");
}
/*******************************************/

if (empty($_POST['id_moodle']))
{  
    $conexion = new conexionSYS;
    $listaUsuarios = $conexion->listaUsuarios();
    //print_r($listaUsuarios);
   // echo "vacio ";
  
    if ( isset($_POST['id_usuario']) && isset($_POST['id_persona'])) {
        $id_persona = $_POST['id_persona'];
        $id_usuario = $_POST['id_usuario'];

        //echo "idU=".$id_usuario." "."idP= ".$id_persona;
        $conexion->eliminarRol($id_usuario);
        $conexion->eliminarUsuario($id_usuario);
        $conexion->eliminarPersona($id_persona);
        header("location: ./adm.php");
        
    }

} else 
{
      //registro de usuarios
      $id = $_POST['id_moodle'];
      $nombre = $_POST['nombre'];
      $apellidos = $_POST['apellidos'];
      $correo = $_POST['correo'];
      $contraseña = $_POST['contra'];
      $rol=$_POST['rol'];
    $long= strlen($contraseña);

        if ($long >12) {
            //echo "no encripta";
            $contraseña = $_POST['contra'];
        } else{
            //echo "si encripta";
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);    
        }
      
      //conectamos a la base  dedatos
      $registro = new conexionSYS;
      $id_persona = $registro->insertPersona($nombre, $apellidos);
      $registro->insertUsuario($id, $correo, $contraseña, $id_persona);
     // echo "id personas= " . $id . "<br>";
     // echo "ROL= " . $rol . "<br>";
      $filas = $registro->insertROL($rol, $id);
     // echo "FILAS MOVIDAS " . $filas . "<br>";
     unset($_POST['id_moodle']);
     unset( $_POST['nombre']);
     unset($_POST['apellidos']);
     unset($_POST['correo']);
     unset($_POST['contra']);
     unset($_POST['rol']);

   // echo "insertar";
   header("location: ./adm.php");

}


//$conexion = new conexionSYS;
$listaUsuarios = $conexion->listaUsuarios();
//print_r($listaUsuarios);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="./Styles/estilos.css">
     <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <!--Botones -->
     <link rel="stylesheet" href="datatables/Buttons-2.2.2/css/buttons.dataTables.min.css">
     <!-- CSS personalizado -->
     <link rel="stylesheet" href="Styles/estilosTabla.css">
     <!--datables estilo bootstrap 5 CSS-->  
     <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.11.4/css/dataTables.bootstrap5.min.css">
     <!--font awesome con CDN-->  
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
   
</head>
<?php include('./templates/header.php'); ?>
<body>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                
                <div class="shadow-lg pt-3 mt-4 bg-body rounded ancho  text-secondary">
                    <h1 class="text-center">Lista de Usuarios</h1>
                    <div class="col-md-12 p-1">
                    <table id="tablaAdministrador" class="table table-striped table-bordered table-hover pt-3 tabla" cellspacing="0" width="100%">
                        <div class="col-md-12">
                            <thead class="cabeceraTabla text-center">
                                <div class="col-md-12">
                                    <tr class="mt-2 pt-2 cabeceras" id="tabla">
                                        <th class="columna">Nombre(s)</th>
                                        <th class="columna">Apellidos</th>
                                        <th class="columna">Tipo de Usuario</th>
                                        <th class="columna">Correo Institucional</th>
                                        <th class="columna">Acción</th>
                                    </tr>
                                </div>
                            </thead>
                            <tbody class="cuerpoTabla">
                                <?php
                                try {
                                    foreach ($listaUsuarios  as $key => $usuario) {
                                        echo '
                                        <tr class="cabeceras">
                                        <td class="fila text-center">' . $usuario["nombre"] . '</td>
                                        <td class="fila text-center">' . $usuario["apellidos"] . '</td>
                                        <td class="fila text-center">' . $usuario["nombre_rol"] . '</td>
                                        <td class="fila text-center">' . $usuario["correo"] . '</td>
                                        <td class="fila text-center">
                                        <a href="./administrador/editar.php?id_usuario=' . $usuario['id_usuario'] . '&id_persona=' . $usuario['id_persona'] . '" class="btn btn-primary mt-1 mb-2" type="button">Editar</a>
                                        <a  class="btn btn-danger mt-1 mb-2"  onclick="eliminar('.$usuario['id_usuario'].',' . $usuario['id_persona'] . ')" type="button">Eliminar</a>
                                        </td>
                                        </tr>';
                                    }
                                } catch (\Throwable $th) {
                                    
                                }
                                ?>
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="respuesta"></div>
    <script>
        function eliminar(id_usuario, id_persona)
        {
            var resultado = window.confirm('Estas seguro de eliminar el Usuario');
            var temporal;
            if (resultado === true) {
                var ruta = "id_usuario=" + id_usuario + "&id_persona=" + id_persona;
                console.log(ruta);
                $.ajax({
                    url: 'adm.php',
                    type: 'POST',
                    data: ruta,
                    })
                    .done(function(res)
                    {
                    $('#respuesta').html(res);
                    })
                    .fail(function()
                    {
                    console.log('error');
                    })
                    .always(function()
                    {
                    console.log('complete');
                    });
                    location.reload();
                    } else {
                    window.alert('El registro no se ha eliminado');
                    }
                    }
    </script>
       <!--JQuery, Popper y bootstrap -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

       <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>   
    
    <!-- para usar botones en datatables JS -->
    <script src="datatables/Buttons-2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="datatables/Buttons-2.2.2/js/buttons.html5.min.js"></script> 
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script> 
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>  
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-2.2.2/js/buttons.html5.min.js"></script>
     
    <!-- código JS propìo-->    
    <script type="text/javascript" src="js/tabla.js"></script>  


    <!-- Para los estilos en Excel     -->
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js"></script>



</body>
<!-- Footer -->
<?php include('./templates/footer.php'); ?>

</html>