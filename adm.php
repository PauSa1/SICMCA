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
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
   
</head>
<?php include('./templates/header.php'); ?>
<body> 
        <div class="container">
            <div class="row">
                <div class="col"></div>
                
                <div class="shadow-lg pt-3 mt-4 bg-body rounded ancho text-center text-secondary">
                    <h1>Lista de Usuarios</h1>
                    <div class="col-md-12 table-responive text-center p-2">
                    <table class="table table-sm table.bordered tabla">
                        <div class="col-md-12">
                            <thead class="cabeceraTabla">
                                <div class="col-md-12">
                                    <tr class="text-center mt-2 pt-2 cabeceras" id="tabla">
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
                                        <td class="fila">' . $usuario["nombre"] . '</td>
                                        <td class="fila">' . $usuario["apellidos"] . '</td>
                                        <td class="fila">' . $usuario["nombre_rol"] . '</td>
                                        <td class="fila">' . $usuario["correo"] . '</td>
                                        <td class="fila">
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
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
<!-- Footer -->
<?php include('./templates/footer.php'); ?>

</html>