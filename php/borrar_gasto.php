<?php
session_start();
error_reporting(0);
$varsesion=$_SESSION['uname'];
$host ="localhost";
$user ="root";
$pass ="";
$db="fjp";
$conexion = mysqli_connect($host,$user,$pass,$db);


 $delete=$_POST['id_borrar'];
 $consulta = "DELETE FROM movimientos WHERE id='$delete' and nombre_usuario='$varsesion'";
 $ejecutar1=mysqli_query($conexion,$consulta);
 header("Location:../gastos.php");
?>