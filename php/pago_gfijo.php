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
$editar_fecha=$_POST['editar_fecha'];
$name=$_POST['nombre'];

$fechaActual = date('d-m-Y');//Fecha Sistema

$valor_pagar="SELECT valor FROM gfijos WHERE id='$id' and nombre_usuario='$varsesion'";//Obtencion Valor a Pagar
$ejecutar_valor=mysqli_query($con,$valor_pagar);
while($mostrar_valor=mysqli_fetch_array($ejecutar_valor)){
    $valor=$mostrar_valor[0];//Valor a Pagar
}

$gasto_pagar="SELECT gasto FROM gfijos WHERE id='$id' and nombre_usuario='$varsesion'";//Obtencion Nombre del Gasto
$ejecutar_gasto=mysqli_query($con,$gasto_pagar);
while($mostrar_gasto=mysqli_fetch_array($ejecutar_gasto)){
    $nombre_gasto=$mostrar_gasto[0];//Gasto a Pagar
}



if($valor != 0 ){
    $sql="INSERT INTO movimientos SET nombre_usuario='$varsesion',cuentas_nombre = '$name', descripcion = 'Pago de $nombre_gasto', fecha = '$fechaActual', tipos_movimientos_nombre = 'Debitar', gfijos_id ='$id', valor = '$valor', tipos_gastos_nombre='Gasto Fijo'";
    $consulta_movimiento=mysqli_query($con,$sql);

    $consulta = "UPDATE gfijos SET pago='$editar_fecha'  WHERE id='$id'";//Actualización en tabla gfijos
    $consulta_ejecutar=mysqli_query($con,$consulta);

}


$consulta_valor="SELECT dinero FROM cuentas WHERE nombre_banco='$name' and usuarios_usuario='$varsesion'";
$ejecutar=mysqli_query($con,$consulta_valor);

while($mostrar=mysqli_fetch_array($ejecutar)){
    $total_cuenta=$mostrar[0];
}
    $total_cuenta=$total_cuenta-$valor;

    $actualizacion="UPDATE cuentas set dinero='$total_cuenta' where nombre_banco='$name' and usuarios_usuario='$varsesion'";
    $result=mysqli_query($con,$actualizacion);

header("Location:../gastos_fijos.php");

?>