<?php

session_start();

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario=$_POST["usuario"];
        $password=md5($_POST["password"]);
        $sql=$conexion->query(" select * from usuario where usuario='$usuario' and  password='$password'");
        if ($datos=$sql->fetch_object()){
            $_SESSION["nombre"]=$datos->nombre;
            $_SESSION["apellido"]=$datos->apellido;
            $_SESSION["id"]=$datos->id_usuario;
            header("location:../inicio.php");
        } else{
            echo "<div class='alert alert-danger'>usuario o  contraseña incorrectos </div>";
        }

    } else {
        echo "<div class='alert alert-danger'>Los campos estan vacios</div>";
    } ?>

    <script>
       setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
       }, 0);
    </script>    
    
    <?php }

?>