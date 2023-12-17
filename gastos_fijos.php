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
    <link rel="stylesheet" type="text/css" href="css\gastos_fijos.css">
    <title>FJP | Inicio</title>
</head>

<body>
    <div class="contenedor" id="contenedor">

        <div class="barra" id="barra">
            <header>
                <nav>
                    <div class="navbar">
                        <a class="logo-png" title="MisGastos" href="inicio.php"><img class="responsive"
                                src="imagenes\logo.png" alt="FJP" /></a>
                        <a href="inicio.php">Registrar Movimiento</a>
                        <a href="gastos.php">Ver Gastos</a>
                        <a class="active" href="#">Gastos Fijos</a>
                        <a href="dinero_prestado.php">Dinero Prestado</a>
                        <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                    </div>
                    <hr>
                </nav>
            </header>
        </div>

        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtrar por Gasto">
        <div class="tabla" id="tabla" style="overflow-x:auto;">
            <table id="myTable" class="table" >
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Gasto</th>
                        <th scope="col">Fecha de Pago</th>
                        <th scope="col">Dias para el pago</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <?php
            $sql = "SELECT * from gfijos";
            $result=mysqli_query($conexion,$sql);

           // $ensayo="<script type=text/javascript> alert('Hello world')</script>";
            $cont_proxpago=0;
            while($mostrar=mysqli_fetch_array($result)){
                $cadena=$mostrar['pago'];
                $array = explode("-", $cadena);
                $año_dias = ($array[0]-date("Y"))*365.25;
                $mes_date=date("m");
                switch ($mes_date) {
                    case 1:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;
                    case 2:
                        $meses_dias=($array[1]-date("m"))*28;       
                        break;
                    case 3:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;
                    case 4:
                        $meses_dias=($array[1]-date("m"))*30;
                        break;
                    case 5:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;
                    case 6:
                        $meses_dias=($array[1]-date("m"))*30;
                        break;
                    case 7:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;
                    case 8:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;
                    case 9:
                        $meses_dias=($array[1]-date("m"))*30;
                        break;
                    case 10:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;
                    case 11:
                        $meses_dias=($array[1]-date("m"))*30;
                        break;
                    case 12:
                        $meses_dias=($array[1]-date("m"))*31;
                        break;                                    
                }

                $resta_dias = ($array[2]-date("d"))+1;

                $total_dias=$año_dias+$meses_dias+$resta_dias-1;
                if($total_dias<0){
                    $total_dias=$total_dias*(-1);
                }
                if($total_dias<=5){
                    $cont_proxpago=$cont_proxpago+1;
                }

                ?>
                <tr>
                    <td>
                        <?php echo $mostrar['id']?>
                    </td>
                    <td>
                        <?php echo $mostrar['gasto']?>
                    </td>
                    <td>
                        <?php echo $mostrar['pago']?>
                    </td>
                    <td>
                        <?php echo $total_dias ?>
                    </td>
                    <td>
                        <?php echo $mostrar['valor']?>
                    </td>
                </tr>
                <?php
        }
        if($cont_proxpago!=0){
            echo "<script type=text/javascript> alert('Hay $cont_proxpago registro(s) próximo(s) al pago')</script>";
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