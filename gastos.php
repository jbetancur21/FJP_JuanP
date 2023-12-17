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
    <link rel="stylesheet" type="text/css" href="css\gastos.css">
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
                        <a class="active" href="gastos.php">Ver Gastos</a>
                        <a href="gastos_fijos.php">Gastos Fijos</a>
                        <a href="dinero_prestado.php">Dinero Prestado</a>
                        <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                    </div>
                    <hr>
                </nav>
            </header>
        </div>

        <div class="borrar_dato" id="borrar_dato">
            <div class="botones_gastos">
                <button type="button" id="eliminar" class="eliminar button_interno" onclick="mostrar_borrar()">Eliminar
                    Registro</button>
                <button type="button" id="ocultar_eliminar" class="ocultar_eliminar button_interno"
                    onclick="ocultar_borrar()" style="display:none">Ocultar</button>
            </div>



            <div class="formulario_misgastos">
                <div id="formulario_borrar" style="display:none">

                    <form id="eliminar_form" class="eliminar_form" action="php/borrar_gasto.php" method="POST">
                        <label for="id_borrar"><b>Digite el ID que desea Eliminar:</b></label>
                        <input class="id_borrar form-control" id="id_borrar" type="number"
                            placeholder="ID que desea borrar" name="id_borrar" required><br>
                        <button type="submit" id="delete" class="delete button_interno">Confirmar</button>
                    </form>
                
                </div>
            </div>
            <br>
        </div>



        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtrar por Fecha">

        <div class="tabla" id="tabla" style="overflow-x:auto;">

            <table class="table" id="myTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cuenta Origen</th>
                        <th scope="col">Descripción del Gasto</th>
                        <th scope="col">Fecha Transacción</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Tipo de Movimiento</th>
                        <th scope="col">Tipo de Gasto</th>
                    </tr>
                </thead>
                <?php
            $sesion=$_SESSION['uname'];
            $sql = "SELECT * from movimientos where nombre_usuario='$sesion'";
            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td>
                        <?php echo $mostrar['id']?>
                    </td>
                    <td>
                        <?php echo $mostrar['cuentas_nombre']?>
                    </td>
                    <td>
                        <?php echo $mostrar['descripcion']?>
                    </td>
                    <td>
                        <?php echo $mostrar['fecha']?>
                    </td>
                    <td>
                        <?php echo $mostrar['valor']?>
                    </td>
                    <td>
                        <?php echo $mostrar['tipos_movimientos_nombre']?>
                    </td>
                    <td>
                        <?php echo $mostrar['tipos_gastos_nombre']?>
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
                        td = tr[i].getElementsByTagName("td")[3];
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


        <script src="js\mostrarmisgastos.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
    </div>
</body>

</html>