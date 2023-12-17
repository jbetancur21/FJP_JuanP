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
$name=$_POST['nombre_nuevo'];
$or=$_POST['origen_nuevo'];
$pres=$_POST['cantidad_nuevo'];
$fecha=$_POST['fecha_nuevo'];
$descripcion=$_POST['descripcion'];

//Sentencia SQL para insertar en la tabla
$sql= "INSERT INTO prestamos (nombre_usuario, nombre, origen,prestada,abonada,pendiente,abonado ,fecha) VALUES ('$varsesion','$name', '$or', '$pres', '0', '$pres', '0', '$fecha')";
$ejecutar=mysqli_query($con,$sql);

//Sentencia SQL para buscar el ID
$searh_id="SELECT max(id) from prestamos where nombre_usuario='$varsesion'";
$ejecutar_search=mysqli_query($con,$searh_id);
while($mostrar_valor=mysqli_fetch_array($ejecutar_search)){
  $valor_id=$mostrar_valor[0];//id
}

$sql_insercion= "INSERT INTO movimientos SET nombre_usuario='$varsesion',cuentas_nombre = '$or', descripcion = '$descripcion', fecha = '$fecha', tipos_movimientos_nombre = 'Debitar',prestamos_id='$valor_id' ,valor = '$pres',tipos_gastos_nombre='Préstamo'";
$ejecutar_insercion=mysqli_query($con,$sql_insercion);


$consulta_valor="SELECT dinero FROM cuentas WHERE nombre_banco='$or' and usuarios_usuario='$varsesion'";
$ejecutar_valor=mysqli_query($con,$consulta_valor);
$sesion=$_SESSION['uname'];
while($mostrar=mysqli_fetch_array($ejecutar_valor)){
    $total_cuenta=$mostrar[0];
}
    $total_cuenta=$total_cuenta-$pres;

    $actualizacion="UPDATE cuentas set dinero='$total_cuenta' where nombre_banco='$or' and usuarios_usuario='$sesion'";
    $result=mysqli_query($con,$actualizacion);

header("Location:../dinero_prestado.php");



?>