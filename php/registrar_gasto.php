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
$Name=$_POST['nombre'];//Origen del Dinero
$Desc=$_POST['descripcion'];
$date=$_POST['fecha'];
$informacion=$_POST['info'];//Tipo de Movimiento
$cantidad=$_POST['valor'];

//Sentencia SQL
$sql= "INSERT INTO movimientos SET nombre_usuario='$varsesion',cuentas_nombre = '$Name', descripcion = '$Desc', fecha = '$date', tipos_movimientos_nombre = '$informacion', valor = '$cantidad',tipos_gastos_nombre='Común'";

//Ejecutamos la sentencia con sql
$ejecutar=mysqli_query($con,$sql);


$consulta_valor="SELECT dinero FROM cuentas WHERE nombre_banco='$Name' and usuarios_usuario='$varsesion'";
$ejecutar=mysqli_query($con,$consulta_valor);

while($mostrar=mysqli_fetch_array($ejecutar)){
    $total_cuenta=$mostrar[0];
}

if($informacion=='Debitar'){
    $total_cuenta=$total_cuenta-$cantidad;
    if($total_cuenta<0){
        $total_cuenta=$total_cuenta+$cantidad;
    }
}else if($informacion=='Acreditar'){
    $total_cuenta=$total_cuenta+$cantidad;
}


echo "<script type=text/javascript> alert('$varsesion');</script>";

$actualizacion="UPDATE cuentas set dinero='$total_cuenta' where nombre_banco='$Name' and usuarios_usuario='$varsesion'";
$result=mysqli_query($con,$actualizacion);


//Verificamos la ejecucion
if(!$ejecutar){
    echo"Hubo Algun Error";

}else{
    header("Location:../inicio.php");
}


?>