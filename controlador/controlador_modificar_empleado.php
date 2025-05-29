<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtdni"]) and !empty($_POST["txtcargo"])) {
        $id=$_POST["txtid"];
        $nombre=$_POST["txtnombre"];
        $apellido=$_POST["txtapellido"];
        $dni = $_POST["txtdni"];
        $cargo=$_POST["txtcargo"];
        $sql=$conexion->query(" select count(*) as 'totaldni'  from empleado where dni='$dni' and id_empleado!=$id ");
        if ($sql->fetch_object()->totaldni > 0) { ?>
            <script>
                $(function notificacion(){
                    new PNotify({
                        title:"ERROR",
                        type:"error",
                        text:"El DNI <?= $dni ?> ya existe",
                        styling:"bootstrap3"
                    })
                })
            </script>
        
        <?php } else {
            $sql=$conexion->query(" update empleado set nombre='$nombre', apellido='$apellido', dni=$dni, cargo=$cargo where id_empleado=$id ");

            if ($sql==true) {?>
                <script>
                    $(function notificacion(){
                        new PNotify({
                            title:"CORRECTO",
                            type:"success",
                            text:"Empleado modificado correctamente",
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
                    text:"Error al modificar empleado",
                    styling:"bootstrap3"
                })
            })
        </script>
    
    <?php }
            
        }
        

    } else { ?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title:"ERROR",
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