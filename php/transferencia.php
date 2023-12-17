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
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$dinero=$_POST['valor'];
$fecha=$_POST['fecha'];

$sql_insercion= "INSERT INTO movimientos SET nombre_usuario='$varsesion',cuentas_nombre = '$origen', descripcion = 'Paso de $origen a $destino', fecha = '$fecha', tipos_movimientos_nombre = 'Debitar',valor = '$dinero',tipos_gastos_nombre='Transferencia'";
$ejecutar_insercion=mysqli_query($con,$sql_insercion);

$sql_insercion2= "INSERT INTO movimientos SET nombre_usuario='$varsesion',cuentas_nombre = '$destino', descripcion = 'Paso de $origen a $destino', fecha = '$fecha', tipos_movimientos_nombre = 'Acreditar',valor = '$dinero',tipos_gastos_nombre='Transferencia'";
$ejecutar_insercion2=mysqli_query($con,$sql_insercion2);


$consulta_valor1="SELECT dinero FROM cuentas WHERE nombre_banco='$origen' and usuarios_usuario='$varsesion'";
$ejecutar_valor1=mysqli_query($con,$consulta_valor1);
$consulta_valor2="SELECT dinero FROM cuentas WHERE nombre_banco='$destino' and usuarios_usuario='$varsesion'";
$ejecutar_valor2=mysqli_query($con,$consulta_valor2);
$sesion=$_SESSION['uname'];
while($mostrar1=mysqli_fetch_array($ejecutar_valor1)){
    $total_cuenta1=$mostrar1[0];
}
while($mostrar2=mysqli_fetch_array($ejecutar_valor2)){
    $total_cuenta2=$mostrar2[0];
}

$total_cuenta1=$total_cuenta1-$dinero;
$total_cuenta2=$total_cuenta2+$dinero;

    $actualizacion1="UPDATE cuentas set dinero='$total_cuenta1' where nombre_banco='$origen' and usuarios_usuario='$sesion'";
    $result1=mysqli_query($con,$actualizacion1);

    $actualizacion2="UPDATE cuentas set dinero='$total_cuenta2' where nombre_banco='$destino' and usuarios_usuario='$sesion'";
    $result2=mysqli_query($con,$actualizacion2);

    header("Location:../inicio.php");
?>