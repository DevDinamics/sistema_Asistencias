<?php
   session_start();
   if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
       header('location:login/login.php');
   }

?>
<style>
ul li:nth-child(2) .activo {
    background: #F2421B !important;
}
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secundary">LISTA DE USUARIOS</h4>


    <?php
    include "../modelo/conexion.php";  
    include "../controlador/controlador_modificar_usuario.php";
    include "../controlador/controlador_eliminar_usuario.php";

    
    $sql=$conexion->query(" SELECT * from usuario ");
    
    ?>
    <a href="registro_usuario.php" class="btn btn-primary btn-rounder mb-3"><i class="fa-solid fa-plus"></i>
        &nbsp;Registrar</a>
    <div class="text-right mb-3">
        <a href="fpdf/reporteUsuario.php" target="_blank" clas="btn btn-success"><i
                class="fa-regular fa-file-pdf"></i>Generar reportes</a>
    </div>


    <table class="table table-bordered table-hover col-12" id="example">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDO</th>
                <th scope="col">USUARIO</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            <?php
    
    while ($datos=$sql->fetch_object()) { ?>
            <tr>
                <td><?= $datos->id_usuario ?></td>
                <td><?= $datos->nombre ?></td>
                <td><?= $datos->apellido ?></td>
                <td><?= $datos->usuario ?></td>
                <td>

                    <a href="" data-toggle="modal" data-target="#staticBackdrop<?= $datos->id_usuario ?>"
                        class="btn btn-warning btn-sm "><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="usuario.php?id=<?= $datos->id_usuario?>" onclick="advertencia(event)"
                        class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                </td>

            </tr>


            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop<?= $datos->id_usuario ?>" data-backdrop="static"
                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-between">
                            <h5 class="modal-title w-100" id="staticBackdropLabel">Modificar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div hidden class="fl-flex-label mb-4 px-2 col-12 ">
                                    <input type="text" placeholder="ID" class="input input__text" name="txtid"
                                        value="<?= $datos->id_usuario ?>">
                                </div>
                                <div class="fl-flex-label mb-4 px-2 col-12 ">
                                    <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre"
                                        value="<?= $datos->nombre ?>">
                                </div>

                                <div class="fl-flex-label mb-4 px-2 col-12 ">
                                    <input type="text" placeholder="Apellido" class="input input__text"
                                        name="txtapellido" value="<?= $datos->apellido ?>">
                                </div>
                                <div class="fl-flex-label mb-4 px-2 col-12 ">
                                    <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario"
                                        value="<?= $datos->usuario ?>">
                                </div>
                                <div class="text-right p-3">
                                    <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>
                                    <button type="submit" value="ok" name="btnmodificar"
                                        class="btn btn-primary btn-rounded">Modificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <?php }
    ?>

        </tbody>
    </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>