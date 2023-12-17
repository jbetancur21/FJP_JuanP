<?php
 session_start();
 error_reporting(0);
 $varsesion=$_SESSION['uname'];
  //conectamos Con el servidor
  $host ="localhost";
  $user ="root";
  $pass ="";
  $db="fjp";
  $con = mysqli_connect($host,$user,$pass,$db)or die("Problemas al Conectar");
  mysqli_select_db($con,$db)or die("problemas al conectar con la base de datos");




//recuperar las variables
$id=$_POST['id_editar'];
$abono=$_POST['cantidad_abonada_editar'];
$cuenta=$_POST['cuenta'];
$fecha=$_POST['fecha'];
//FILA SELECCIONADA
$id_select= mysqli_query($con,"SELECT * from prestamos where id ='$id' and nombre_usuario='$varsesion'");
$vector=mysqli_fetch_array($id_select);
$cuotas=$vector['abonada']+1;
$pendiente=$vector['pendiente']-$abono;
$abonado=$vector['abonado']+$abono;

$consulta = "UPDATE prestamos SET abonada='$cuotas', pendiente='$pendiente', abonado='$abonado'  WHERE id='$id'";
$ejecutar=mysqli_query($con,$consulta);

$sql_insercion= "INSERT INTO movimientos SET nombre_usuario='$varsesion',cuentas_nombre = '$cuenta',fecha = '$fecha', tipos_movimientos_nombre = 'Acreditar',prestamos_id='$id' ,valor = '$abono',tipos_gastos_nombre='Préstamo'";
$ejecutar_insercion=mysqli_query($con,$sql_insercion);

$consulta_valor="SELECT dinero FROM cuentas WHERE nombre_banco='$cuenta' and usuarios_usuario='$varsesion'";
$ejecutar_valor=mysqli_query($con,$consulta_valor);
$sesion=$_SESSION['uname'];
while($mostrar=mysqli_fetch_array($ejecutar_valor)){
    $total_cuenta=$mostrar[0];
}
    $total_cuenta=$total_cuenta+$abono;

    $actualizacion="UPDATE cuentas set dinero='$total_cuenta' where nombre_banco='$cuenta' and usuarios_usuario='$sesion'";
    $result=mysqli_query($con,$actualizacion);


header("Location:../dinero_prestado.php");



?>