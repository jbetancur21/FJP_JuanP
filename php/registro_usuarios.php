<?php

 //conectamos Con el servidor
 $host ="localhost";
 $user ="root";
 $pass ="";
 $db="fjp";
 $con = mysqli_connect($host,$user,$pass,$db)or die("Problemas al Conectar");
 mysqli_select_db($con,$db)or die("problemas al conectar con la base de datos");
//recuperar las variables
$user=$_POST['usuario'];
$mail=$_POST['email'];
$pas=$_POST['psw'];
$pass_cifrado=password_hash($pas, PASSWORD_DEFAULT);
//Llamado a la Funcion: Funcion que sirve para buscar si existe un valor en la tabla
if((buscaRepetido($user,$con)==1)/*||(buscacedula($cc,$con)==0)*/){
        echo "<script type=text/javascript> alert('Error al crear el registro, el nombre de usuario ya existe');
        window.location.href='../index.html';</script>";
        
}else{
        $sql="INSERT INTO usuarios (usuario,correo,contraseña) VALUES ('$user','$mail','$pass_cifrado')";
        $ejecutar=mysqli_query($con,$sql);
        header("Location:../index.html");
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
// function buscacedula($cc,$con){
//         $sql="SELECT * from personas 
//                 where cedula='$cc'";
//         $result=mysqli_query($con,$sql);

//         if(mysqli_num_rows($result) > 0){
//                 return 1;
//         }else{
//                 return 0;
//         }
// }
?>