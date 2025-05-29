<?php
session_start();
session_destroy();
header("location:/sistema_asistencias/vista/login/login.php");
?>