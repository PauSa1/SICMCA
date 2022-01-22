<?php
require("./conexion/conexionSYS.php");
require_once 'validar.php';
$conexion = new conexionSYS;
$error = "";

define('SITE_KEY', '6Le5n6gdAAAAAH0xCX98iX0rSXWBbLxijF7uvm5d');
define('SECRET_KEY', '6Le5n6gdAAAAAH3zpsb6FQ_0n5KqHqSvsFWL9iYb');

if($_POST){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
       echo "Bienvenido!";
    }else{
        echo "Usted es un Robot!!";
    }
}


?>
<?php

try {
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST["email"]) || empty($_POST["pwd"])) 
        {
            $error="vacio";
            echo $error;
        } else 
        {
            $error="";
           $login = $_POST["email"]; 
           $pwd = $_POST["pwd"];
           
            $formato = validarCorreo($login);
            if ($formato ==true) {
                $buscar_Dominio = strpos($login,'unam.mx');
                if ($buscar_Dominio === false) {
                    $error2 ="Tienes que tener una cuenta unam.mx";
                }
            }else {
                $error2 ="Formato del correo Invalido";
            }

            $query= "select * from usuario where correo ='$login'";
            $valdiar = $conexion->validar($query);
            $datos = $conexion->obtenerDatos($query);
            $contraseña = $datos['contraseña'];
            password_verify($pwd,$contraseña);
            if ($valdiar >=1 &&  password_verify($pwd,$contraseña) ) {
                session_start();
                $result= $conexion->obtenerDatos($query);

                $id = $result['id_usuario'];
                $rol1= $conexion->obtenerRol($id);
                

                 $rol = $rol1[0];
                 $_SESSION['login']= $result['correo'];
                 $_SESSION['id_usuario']= $result['id_usuario'];
                if ($rol ==1) {

                    header("location: adm.php");
                } else if($rol==2){

                    header("location: ./coordinador/cursos.php");
                }elseif($rol==3){
                 
                   header("location: ./profesor/cursos.php");
                }else{
                  //  echo "rol no identificado = ". $rol;
                  
                }
                
                
            } else {

               //echo $login.$pwd ;
               //El correo electrónico que ingresaste no está conectado a una cuenta , No se ha encontrado un usuario con esa dirección de correo <br> 
               $error = "Debe ingresar una contraseña y/o un correo institucional validos";
               //header("location: index.php");
            }
            
        }
    } else {
       // header("location: index.php");
        //echo "vacio";
    }
} catch (Exception $e) {
    die("error:" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="https://www.unam.mx/sites/default/files/favicon_0.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <link rel="stylesheet" href="./Styles/estilos.css">
     <link rel="stylesheet" href="./Styles/bootstrap/bootstrap.min.css">
     <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top fondo">
    <div class="container">
      <img src="https://www.unam.mx/sites/all/themes/unam/logo.png" alt="logo" width="auto" height="auto" class="mb-3 imagen">
    </div>
</nav>
<!-- formulario de Inicio de sesion -->
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="shadow-lg mt-4 bg-body rounded ancho">
                <h3 class="text-center fondo text-white pt-4 pb-4 mb-1 titulologin">SICMCA</h3>
               <div class="p-3">
               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
               
                <span class="error"> <?php echo $error ?></span><br>
                <div class="col-md-12">
                    <label for="" class="form-label">Correo  Institucional</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id=""><i class="bi bi-person-circle"></i></span>
                        </div>
                        <input type="text" class="form-control" id="email" placeholder="Escriba su dirección de correo institucional" name="email" required>
                        <div class="valid-feedback"></div>
                    <span class="error"><?php/* echo $error2 */?></span>
                    </div>
                </div>


                <div class="col-md-12">
                    <label for="" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id=""><i class="bi bi-lock-fill"></i></span>
                        </div>
                        <input type="password" class="form-control" minlength="5" maxlength="25" name="pwd" value="" placeholder="Escriba la contraseña de su correo institucional" required>
                        <div class="valid-feedback"></div>
                        <span class="error"><?php  ?></span>
                    </div>
                </div>
                
                
                <div class="mb-3">
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br >
                </div>
                <div class="mt-3 mb-3 text-center">
                    <input type="submit" class="btn btn-primary" name="submit" class="button"  value="Ingresar">
                </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</div>
<?php include('./templates/footer.php'); ?>

<script>
    grecaptcha.ready(function() {
    grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'homepage'})
    .then(function(token) {
        //console.log(token);
        document.getElementById('g-recaptcha-response').value=token;
        });
    });
</script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap/popper.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>