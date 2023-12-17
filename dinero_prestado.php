<?php
session_start();
error_reporting(0);
$varsesion=$_SESSION['uname'];
if($varsesion == null || $varsesion =''){
    echo "<script type=text/javascript> alert('Inicie sesión para poder ingresar');
        window.location.href='index.html';</script>";
        die();
}

$host ="localhost";
 $user ="root";
 $pass ="";
 $db="fjp";
 $conexion = mysqli_connect($host,$user,$pass,$db);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="imagenes\logo.ico">
    <link rel="stylesheet" type="text/css" href="css\general.css">
    <link rel="stylesheet" type="text/css" href="css\dinero_prestado.css">
    <title>FJP | Inicio</title>
</head>

<body>
    <div class="contenedor" id="contenedor">

        <div class="barra" id="barra">
            <header>
                <nav>
                    <div class="navbar">
                        <a class="logo-png" title="MisGastos" href="inicio.php"><img class="responsive" src="imagenes\logo.png"  alt="FJP" /></a>
                        <a href="inicio.php">Registrar Movimiento</a>
                        <a href="gastos.php">Ver Gastos</a>
                        <a href="gastos_fijos.php">Gastos Fijos</a>
                        <a class="active" href="dinero_prestado.php">Dinero Prestado</a>
                        <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                    </div><hr>
                </nav>
            </header>
        </div>

        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtrar por Nombre">
        <div class="tabla" id="tabla" style="overflow-x:auto;">

<table class="table" id="myTable">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del Prestatario</th>
            <th scope="col">Origen</th>
            <th scope="col">Valor Prestado</th>
            <th scope="col">Cuotas Abonadas</th>
            <th scope="col">Valor Pendiente</th>
            <th scope="col">Valor Abonado</th>
            <th scope="col">Fecha del Préstamo</th>
        </tr>
    </thead>
    <?php
$sesion=$_SESSION['uname'];
$sql = "SELECT * from prestamos where nombre_usuario='$sesion'";
$result=mysqli_query($conexion,$sql);

while($mostrar=mysqli_fetch_array($result)){
    ?>
    <tr>
        <td>
            <?php echo $mostrar['id']?>
        </td>
        <td>
            <?php echo $mostrar['nombre']?>
        </td>
        <td>
            <?php echo $mostrar['origen']?>
        </td>
        <td>
            <?php echo $mostrar['prestada']?>
        </td>
        <td>
            <?php echo $mostrar['abonada']?>
        </td>
        <td>
            <?php echo $mostrar['pendiente']?>
        </td>
        <td>
            <?php echo $mostrar['abonado']?>
        </td>
        <td>
            <?php echo $mostrar['fecha']?>
        </td>
    </tr>
    <?php
}
?>
</table>
<script>

    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
    </div>
</body>

</html>