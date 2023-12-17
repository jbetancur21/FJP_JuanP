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
    <link rel="stylesheet" type="text/css" href="css\inicio.css">
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
                        <a class="active" href="inicio.php">Registrar Movimiento</a>
                        <a href="gastos.php">Ver Gastos</a>
                        <a href="gastos_fijos.php">Gastos Fijos</a>
                        <a href="dinero_prestado.php">Dinero Prestado</a>
                        <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
                    </div>
                    <hr>
                </nav>
            </header>
        </div>

        <div class="cantidad-dinero">
            <h3>Tu Dinero</h4>
                <div class="mi-dinero" id="mi-dinero">
                    <?php
                        $cuenta_usuario=$_SESSION['uname'];
                        $sql = "SELECT nombre_banco,dinero from cuentas where cuentas.usuarios_usuario='$cuenta_usuario' order by dinero DESC";
                        $result=mysqli_query($conexion,$sql);
                        $total=0;
                        while($mostrar=mysqli_fetch_array($result)){
                            echo $mostrar['nombre_banco'].' --------> '.$mostrar['dinero']."<br />";
                            $total=$total+$mostrar['dinero'];
                        }
                        echo 'Total-------->'.$total;
                    ?>
                    <br><br>
                </div>
        </div>

        <div class="row">
            <div class="column">
                <div class="card">
                    <img src="imagenes\gastos.png" alt="Gastos">
                    <div class="container">
                        <h2>Registrar un Gasto</h2>
                        <p>Registra tus gastos comunes.</p>
                        <p><button class="button"
                                onclick="document.getElementById('tarjeta1').style.display='block'">Registrar
                                un Gasto</button></p>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">
                    <img src="imagenes\gastos_fijos.jpg" alt="gasto_fijo">
                    <div class="container">
                        <h2>Registrar Gasto Fijo</h2>
                        <p>Registra tus gastos fijos.</p>
                        <p><button onclick="myFunction()" class="dropbtn button">Registrar un Gasto Fijo</button></p>
                        <div id="myDropdown" class="dropdown-content ">
                            <a onclick="document.getElementById('tarjeta2-1').style.display='block'">Hacer Pago</a>
                            <a onclick="document.getElementById('tarjeta2-2').style.display='block'">Crear Pago</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SCRIPT PARA GASTOS FIJOS -->
            <script>
                /* When the user clicks on the button, 
                toggle between hiding and showing the dropdown content */
                function myFunction() {
                    document.getElementById("myDropdown").classList.toggle("show");
                }

                // Close the dropdown if the user clicks outside of it
                window.onclick = function (event) {
                    if (!event.target.matches('.dropbtn')) {
                        var dropdowns = document.getElementsByClassName("dropdown-content");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }
            </script>

            <div class="column">
                <div class="card">
                    <img src="imagenes\prestamos.png" alt="prestamos">
                    <div class="container">
                        <h2>Registrar Prestamo</h2>
                        <p>Registra a quién le prestas.</p>
                        <p><button onclick="tipo_prestamos()" class="dropbtn button">Registrar Prestamo</button></p>
                        <div id="tip_prestamo" class="dropdown-content ">
                            <a onclick="document.getElementById('tarjeta3-1').style.display='block'">Crear Prestamo</a>
                            <a onclick="document.getElementById('tarjeta3-2').style.display='block'">Registrar Pago</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                /* When the user clicks on the button, 
                toggle between hiding and showing the dropdown content */
                function tipo_prestamos() {
                    document.getElementById("tip_prestamo").classList.toggle("show");
                }
                // Close the dropdown if the user clicks outside of it
                window.onclick = function (event) {
                    if (!event.target.matches('.dropbtn')) {
                        var dropdowns = document.getElementsByClassName("dropdown-content");
                        var i;
                        for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }
            </script>



            <div class="column">
                <div class="card">
                    <img src="imagenes\transferencia_bancos.png" alt="Transferencias_bancos">
                    <div class="container">
                        <h2>Registrar Transferencia entre Cuentas</h2>
                        <p>Mueve tu dinero de una cuenta a otra.</p>
                        <p><button class="button"
                                onclick="document.getElementById('tarjeta4').style.display='block'">Registra
                                Movimiento</button></p>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <!-- TARJETA 1 -->
        <div class="tarjeta1 modal" id="tarjeta1">
            <span onclick="document.getElementById('tarjeta1').style.display='none'" class="close"
                title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="php/registrar_gasto.php" method="POST">
                <div class="container">
                    <div class="movimiento form-group">
                        <label for="tmovimiento"><b>Seleccione el tipo de movimiento:</b></label>
                        <select class="form-control" id="tmovimiento" name="info">
                            <?php
                            $sql2 = "SELECT * from tipos_movimientos";
                            $result2=mysqli_query($conexion,$sql2);
                            while($mostrar1=mysqli_fetch_array($result2)){
                        ?>

                            <option>
                                <?php echo $mostrar1['nombre']?>
                            </option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="origen form-group">
                        <label for="omovimiento"><b>Seleccione el origen o destino del dinero:</b></label>
                        <select class="form-control" id="omovimiento" name="nombre">
                            <?php
                            $sql1 = "SELECT nombre_banco from cuentas where cuentas.usuarios_usuario='$cuenta_usuario'";
                            $result1=mysqli_query($conexion,$sql1);
                            while($mostrar=mysqli_fetch_array($result1)){
                        ?>

                            <option>
                                <?php echo $mostrar['nombre_banco']?>
                            </option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <label for="cantidad"><b>Digite la cantidad de Dinero:</b></label>
                    <input class="cantidad form-control" id="cantidad" type="number" placeholder="Cantidad de Dinero"
                        name="valor" required autocomplete="off">

                    <label for="fecha"><b>Fecha del Movimiento:</b></label><br>
                    <input type="date" class="fecha form-control" id="fecha" name="fecha" value="dd-mm-aaaa"
                        min="2002-01-21" max="2040-12-31">

                    <div class="descripcion form-group">
                        <label for="descr"><b>Descripción</b></label>
                        <textarea name="descripcion" class="descr form-control" id="descr" rows="2"
                            placeholder="Descripción"></textarea>
                    </div>

                    <button class="button_interno" type="submit">Registrar Gasto</button>
                </div>

                <div class="container">
                    <button type="button" onclick="document.getElementById('tarjeta1').style.display='none'"
                        class="cancelbtn">Cancelar</button>
                </div>
            </form>

        </div>

        <!-- TARJETA 2 -->
        <!-- TARJETA 2.1 -->
        <div class="tarjeta2-1 modal" id="tarjeta2-1">
            <span onclick="document.getElementById('tarjeta2-1').style.display='none'" class="close"
                title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="php/pago_gfijo.php" method="POST">

                <div class="container">
                    <p><a href="gastos_fijos.php" style="color:dodgerblue" target="_blank">Ver Tabla</a></p>
                    <label for="id_editar"><b>Digite el ID que desea Editar:</b></label>
                    <input class="id_editar form-control" id="id_editar" type="number" placeholder="ID que desea editar"
                        name="id_editar" required autocomplete="off">
                    <label for="omovimiento"><b>Seleccione el origen o destino del dinero:</b></label>
                    <select class="form-control" id="omovimiento" name="nombre">
                        <?php
                            $sql1 = "SELECT nombre_banco from cuentas where cuentas.usuarios_usuario='$cuenta_usuario'";
                            $result1=mysqli_query($conexion,$sql1);
                            while($mostrar=mysqli_fetch_array($result1)){
                        ?>
                        <option>
                            <?php echo $mostrar['nombre_banco']?>
                        </option>

                        <?php
                            }
                            ?>
                    </select>


                    <label for="editar_fecha"><b>Fecha del próximo Pago:</b></label>
                    <input type="date" class="editar_fecha form-control" id="editar_fecha" name="editar_fecha"
                        value="dd-mm-aaaa" min="2002-01-21" max="2099-12-31"><br>

                    <button class="button_interno" type="submit">Hacer Pago</button>
                </div>

                <div class="container">
                    <button type="button" onclick="document.getElementById('tarjeta2-1').style.display='none'"
                        class="cancelbtn">Cancelar</button>
                </div>
            </form>

        </div>

        <!-- TARJETA 2.2 -->
        <div class="tarjeta2-2 modal" id="tarjeta2-2">
            <span onclick="document.getElementById('tarjeta2-2').style.display='none'" class="close"
                title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="php/crear_gfijo.php" method="POST">

                <div class="container">
                    <label for="gasto"><b>Digite el Nombre del Gasto:</b></label>
                    <input class="gasto form-control" id="gasto" type="text" placeholder="Gastos" name="gasto" required
                        autocomplete="off">

                    <label for="fecha"><b>Fecha de Pago:</b></label><br>
                    <input type="date" class="fecha form-control" id="fecha" name="fecha" value="dd-mm-aaaa"
                        min="2002-01-21" max="2099-12-31">
                    <label for="valor"><b>Valor:</b></label>
                    <input class="valor form-control" id="valor" type="number" placeholder="Valor " name="valor"
                        required autocomplete="off">
                    <br>

                    <button class="button_interno" type="submit">Crear Gasto</button>
                </div>

                <div class="container">
                    <button type="button" onclick="document.getElementById('tarjeta2-2').style.display='none'"
                        class="cancelbtn">Cancelar</button>
                </div>
            </form>

        </div>

        <!-- TARJETA 3 -->
        <!-- TARJETA 3.1 -->
        <div class="tarjeta3-1 modal" id="tarjeta3-1">
            <span onclick="document.getElementById('tarjeta3-1').style.display='none'" class="close"
                title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="php/nuevo_prestamo.php" method="POST">

                <div class="container">
                    <label for="nombre_nuevo"><b>Digite el Nombre de la Persona:</b></label>
                    <input class="nombre_nuevo form-control" id="nombre_nuevo" type="text"
                        placeholder="Nombre de la Persona" name="nombre_nuevo" required autocomplete="off">

                    <div class="origen form-group">
                        <label for="origen_nuevo"><b>Seleccione el origen del dinero:</b></label>
                        <select class="form-control" id="omovimiento" name="nombre">
                            <?php
                            $sql1 = "SELECT nombre_banco from cuentas where cuentas.usuarios_usuario='$cuenta_usuario'";
                            $result1=mysqli_query($conexion,$sql1);
                            while($mostrar=mysqli_fetch_array($result1)){
                        ?>

                            <option>
                                <?php echo $mostrar['nombre_banco']?>
                            </option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <label for="cantidad_nuevo"><b>Digite la cantidad prestada de dinero:</b></label>
                    <input class="cantidad_nuevo form-control" id="cantidad_nuevo" type="number"
                        placeholder="Cantidad Prestada de Dinero " name="cantidad_nuevo" required autocomplete="off">

                    <label for="fecha_nuevo"><b>Fecha del Prestamo:</b></label><br>
                    <input type="date" class="fecha_nuevo form-control" id="fecha_nuevo" name="fecha_nuevo"
                        value="dd-mm-aaaa" min="2002-01-21" max="2099-12-31">

                    <div class="descripcion form-group">
                        <label for="descr"><b>Finalidad del Préstamo</b></label>
                        <textarea name="descripcion" class="descr form-control" id="descr" rows="2"
                            placeholder="Descripción"></textarea>
                    </div><br>

                    <button class="button_interno" type="submit">Crear Préstamo</button>
                </div>

                <div class="container">
                    <button type="button" onclick="document.getElementById('tarjeta3-1').style.display='none'"
                        class="cancelbtn">Cancelar</button>
                </div>
            </form>

        </div>

        <!-- TARJETA 3.2 -->
        <div class="tarjeta3-2 modal" id="tarjeta3-2">
            <span onclick="document.getElementById('tarjeta3-2').style.display='none'" class="close"
                title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="php/abonar_prestamo.php" method="POST">

                <div class="container">
                    <p><a href="dinero_prestado.php" style="color:dodgerblue" target="_blank">Ver Tabla</a></p>
                    <label for="id_editar"><b>Digite el ID que desea Editar:</b></label>
                    <input class="id_editar form-control" id="id_editar" type="number" placeholder="ID que desea editar"
                        name="id_editar" required autocomplete="off">

                    <label for="omovimiento"><b>Seleccione el origen del dinero:</b></label>
                    <select class="form-control" id="omovimiento" name="cuenta">
                        <?php
                            $sql1 = "SELECT nombre_banco from cuentas where cuentas.usuarios_usuario='$cuenta_usuario'";
                            $result1=mysqli_query($conexion,$sql1);
                            while($mostrar=mysqli_fetch_array($result1)){
                        ?>

                        <option>
                            <?php echo $mostrar['nombre_banco']?>
                        </option>

                        <?php
                            }
                            ?>
                    </select>
                    <label for="fecha"><b>Fecha del Pago:</b></label><br>
                    <input type="date" class="fecha form-control" id="fecha" name="fecha" value="dd-mm-aaaa"
                        min="2002-01-21" max="2040-12-31">

                    <label for="cantidad_abonada_editar"><b>Digite la Cantidad a abonar:</b></label>
                    <input class="cantidad_abonada_editar form-control" id="cantidad_abonada_editar" type="number"
                        placeholder="Cantidad a Abonar" name="cantidad_abonada_editar" required autocomplete="off"><br>

                    <button class="button_interno" type="submit">Abonar a la Deuda</button>
                </div>

                <div class="container">
                    <button type="button" onclick="document.getElementById('tarjeta3-2').style.display='none'"
                        class="cancelbtn">Cancelar</button>
                </div>
            </form>

        </div>

        <!-- TARJETA 4 -->
        <div class="tarjeta4 modal" id="tarjeta4">
            <span onclick="document.getElementById('tarjeta4').style.display='none'" class="close"
                title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="modal-content animate" action="php/transferencia.php" method="POST">

                <div class="container">
                    <label for="destino"><b>Transferir de:</b></label>
                    <select class="form-control" id="omovimiento" name="origen">
                        <?php
                            $sql1 = "SELECT nombre_banco from cuentas where cuentas.usuarios_usuario='$cuenta_usuario'";
                            $result1=mysqli_query($conexion,$sql1);
                            while($mostrar=mysqli_fetch_array($result1)){
                        ?>

                        <option>
                            <?php echo $mostrar['nombre_banco']?>
                        </option>

                        <?php
                            }
                            ?>
                    </select>

                    <label for="destino"><b>Transferir a:</b></label>
                    <select class="form-control" id="omovimiento" name="destino">
                        <?php
                            $sql1 = "SELECT nombre_banco from cuentas where cuentas.usuarios_usuario='$cuenta_usuario'";
                            $result1=mysqli_query($conexion,$sql1);
                            while($mostrar=mysqli_fetch_array($result1)){
                        ?>

                        <option>
                            <?php echo $mostrar['nombre_banco']?>
                        </option>

                        <?php
                            }
                            ?>
                    </select>

                    <label for="cantidad"><b>Digite la cantidad de Dinero:</b></label>
                    <input class="cantidad form-control" id="cantidad" type="number" placeholder="Cantidad de Dinero"
                        name="valor" required autocomplete="off">

                    <label for="fecha"><b>Fecha:</b></label><br>
                    <input type="date" class="fecha form-control" id="fecha" name="fecha" value="dd-mm-aaaa"
                        min="2002-01-21" max="2040-12-31"><br>

                    <button class="button_interno" type="submit">Transferir Fondos</button>
                </div>

                <div class="container">
                    <button type="button" onclick="document.getElementById('tarjeta4').style.display='none'"
                        class="cancelbtn">Cancelar</button>
                </div>
            </form>

        </div>
        <br><br><br><br><br><br>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>
    </div>
</body>

</html>