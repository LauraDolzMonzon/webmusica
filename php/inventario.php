<?php
        session_start();
        $servidor = "127.0.0.1";
        $usuario = "root";
        $contrasenna = "";
        $basededatos = "webmusica";
        $conn = new mysqli($servidor, $usuario, $contrasenna, $basededatos);
        if ($conn->connect_error){
            die("error de conexion" . $conn->connect_error);
        }
        $sqlinvetariolistado = "SELECT dispositivo_acustico, familia, ubicacion, anyo_de_adquisicion, unidades FROM instrumento  ORDER by dispositivo_acustico DESC";
    
        $resultadoinvetario = $conn->query($sqlinvetariolistado);
        $roles_permitidos_ivnetario = ["admin", "profesor"];
        if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $roles_permitidos_ivnetario) ){
            session_unset();
            session_destroy();
            header("Location: login_bandeja_contacto.php");
            exit(); 
        }
   
?>
<!DOCTYPE html>
  <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="stylesheet" href="../estilos.css">
        <title> Inventario</title>



    </head>
    <body>
        <nav>       
            <ul>            
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a></li>
                <li><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>
                <li><a href="login_bandeja_contacto.php">Bandeja Contacto</a></li>

            </ul>
        </nav>
        <header><h2>inventario</h2></header>        
        <main>
          <div id="idflito"> 
             <div class="flitoclass">

                <form action="controlador.php" method="post">
                        <label for="flitofamilia">Filtro familia</label>
                    
                        <select name="flitofamilia" id="flitofamilia">
                            <option value="sinespecificarfamilia">Sin especificar</option>
                            <option value="vientometal">Viento metal</option>
                            <option value="vientomadera">Viento madera</option>
                            <option value="percusion">Percusi&oacute;n</option>
                            <option value="cuerda">Cuerda</option>
                        </select>
                        <button class="botonparaenviarflito" type="submit">Enviar</button>

                    </form>
                </div>
                <div class="flitoclass">
                    <form action="controlador.php"  method="post">  
                        <label for="flitoubicacion">Filtro aula</label>

                        <select name="flitoubicacion" id="flitoubicacion">
                            <option value="sinespecificarubicacion">Sin especificar</option>
                            <option value="RMU1">RMU1</option>
                            <option value="RMU2">RMU2</option>
                        </select>
                        <button class="botonparaenviarflito" type="submit">Enviar</button>

                    </form>
                    <form action="controlador.php" method="post">
                        <label for="flitoano">Filtro cantidad</label>

                        <select name="flitoucantidad" id="flitocantidad">
                            <option value="sinespecificarcantidad">Sin especificar</option>
                            <option value="accentecandidad">Accente</option>
                            <option value="seccentecantidad">Deccente</option>
                        </select>
                        <button class="botonparaenviarflito" type="submit">Enviar</button>

                    </form>
                </div>
                    <div class="flitoclass">
                    <form action="controlador.php" method="post">
                        <label for="flitoano">Flito a&ntilde;o</label>

                            <select name="flitoano" id="flitoano">
                                <option value="sinespecificarano">Sin especificar</option>
                                <option value="accente">Accente</option>
                                <option value="descente">Descente</option>
                            </select>
                            <button class="botonparaenviarflito" type="submit">Enviar</button>

                            
                            

                    </form>  
                </div>    
            </div>  
            <div > 
              <?php   
                if ($resultadoinvetario->num_rows > 0){
                    while($row = $resultadoinvetario->fetch_assoc()){
                        echo "<table class=\"tablaphp\">";
                        echo    "<tr>";
                                
                        echo       "<th>Instrumento</th>";
                        echo       "<th>Familia</th>";
                        echo       "<th>Ubicaci&oacute;n</th>";
                        echo       "<th>Unidades</th>";
                        echo       "<th>A&ntilde;o de adquisici&oacute;n</th>";
                        echo   "</tr>";
                        echo    "<tr>"; 
                        echo       "<td>" . htmlspecialchars($row['dispositivo_acustico']) . "</td>";
                        echo       "<td>" . htmlspecialchars($row['familia']) . "</td>";
                        echo       "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
                        echo       "<td>" . htmlspecialchars($row['unidades']) . "</td>";
                        echo       "<td>" . htmlspecialchars($row['anyo_de_adquisicion']) . "</td>";
                        echo    "</tr>";
                                
                        echo "</table>";
                }
                } else {
                      echo "<table class=\"tablaphp\">";
                        echo    "<tr>";
                                
                        echo       "<th>Instrumento</th>";
                        echo       "<th>Familia</th>";
                        echo       "<th>Ubicaci&oacute;n</th>";
                        echo       "<th>Unidades</th>";
                        echo       "<th>A&ntilde;o de adquisici&oacute;n</th>";
                        echo   "</tr>";
                        echo    "<tr>"; 
                        echo       "<td colspan='5'>No hay datos </td>";
                        
                        echo    "</tr>";
                                
                        echo "</table>";
                }
              ?>       
           </div>     
        </main>
        <footer>    
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>
        
    </body>
    
  </html>