<?php

if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $usuario = $_POST["txtusuario"];
        $sql=$conexion->query( " update usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario' where id_usuario=$id ");
        if ($sql == true) { ?>
            <script> 
          $(function notificacion(){
             new PNotify({
                title:"CORRECTO",
                type:"success",
                text:"Datos se ha modificado correctamente",
                styling:"bootstrap3"
            })
        })
        </script>
        <?php } else { ?>
            <script>
                $(function notificacion(){
                   new PNotify({
                      title:"INCORRECTO",
                      type:"error",
                      text:"Error al modificar los datos",
                      styling:"bootstrap3"
                  })
              })
            </script>
            <?php }
        


    } else { ?>
        <script>
        $(function notificacion(){
            new PNotify({
                title:"INCORRECTO",
                type:"error",
                text:"Los campos estan vacios",
                styling:"bootstrap3"
            })
        })
        </script>
    <?php } ?>

<script>
   setTimeout(() => {
    window.history.replaceState(null, null, window.location.pathname);
   }, 0);
</script> 
<?php }

?>