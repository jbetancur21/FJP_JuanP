<?php
 //conectamos Con el servidor
 $host ="localhost";
 $user ="root";
 $pass ="";
 $db="fjp";
 $con = mysqli_connect($host,$user,$pass,$db)or die("Problemas al Conectar");
 mysqli_select_db($con,$db)or die("problemas al conectar con la base de datos");
//recuperar las variables
$user=$_POST['uname'];
$password=$_POST['psw'];


if(buscaRepetido($user,$con)==1){
    $sql="SELECT * from usuarios where usuario='$user'";
    $result=mysqli_query($con,$sql);
    $fila =mysqli_fetch_array($result);
    $contraseña= $fila['contraseña'];   

    if (password_verify($password, $contraseña)) {
        session_start();
        $_SESSION['uname']=$user;
        echo "<script type=text/javascript>window.location.href='../inicio.php';</script>";
    } else {
        echo "<script type=text/javascript> alert('La Contraseña no es correcta');
        window.location.href='../index.html';</script>";
    }
    
    
}else{
    echo "<script type=text/javascript> alert('El Nombre de Usuario no es valido o no existe');
    window.location.href='../index.html';</script>";

   
}



function buscaRepetido($user,$con){
    $sql="SELECT * from usuarios 
            where usuario='$user'";
    $result=mysqli_query($con,$sql);

    if(mysqli_num_rows($result) > 0){
            return 1;
    }else{
            return 0;
    }
}

?>