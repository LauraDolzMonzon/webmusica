<?php
        session_start();
        $servidor = "127.0.0.1";
        $basededatos = "webmusica";
        $usuario = "root";
        $contrasenna = "";

        $conn = new mysqli($servidor, $usuario, $contrasenna, $basededatos);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
       
        $roles_permitidos_ivnetario = ["admin", "profesor"];
        if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $roles_permitidos_ivnetario) ){
            session_unset();
            session_destroy();
            header("Location: login_inventario.php");
            exit(); 
        }
        if (!isset($_SESSION['resultado_filtro'])) {
             $sql = "SELECT dispositivo_acustico, familia, ubicacion, anyo_de_adquisicion, unidades FROM instrumento ORDER BY dispositivo_acustico ASC";
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             $resultadoinvetariolistado = $stmt->get_result();
             if (!$resultadoinvetariolistado) {
               die("Error en la consulta: " . $conn->error);
            }
             $instrumentos = $resultadoinvetariolistado->fetch_all(MYSQLI_ASSOC);

        } else {
            $instrumentos  = $_SESSION['resultado_filtro'] ?? [];
            unset($_SESSION['resultado_filtro']);
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
            <form action="filtro.php" method="get">
    
                <div id="idflito"> 
                    <div class="flitoclass">

                                <label for="flitofamilia">Filtro familia</label>
                            
                                <select name="flitofamilia" id="flitofamilia">
                                    <option value="">Sin especificar</option>
                                    <option value="vientometral">Viento metal</option>
                                    <option value="vientomadera">Viento madera</option>
                                    <option value="pesucion">Percusi&oacute;n</option>
                                    <option value="cuerda">Cuerda</option>
                                </select>

                            
                    </div>
                    <div class="flitoclass">
                                <label for="flitoubicacion">Filtro aula</label>

                                <select name="flitoubicacion" id="flitoubicacion">
                                    <option value="">Sin especificar</option>
                                    <option value="RMU1">RMU1</option>
                                    <option value="RMU2">RMU2</option>
                                    <option value="En varias aulas">En varias aulas</option>

                                </select>
                    </div>     
                    <div class="flitoclass">
                                <label for="flitounidades">Filtro  unidades</label>

                                <select name="flitounidades" id="flitounidades">
                                    <option value="">Sin especificar</option>
                                    <option value="asc">Ascendente</option>
                                    <option value="desc">Descendente</option>

                                </select>
                    </div>                        

                    <div class="flitoclass">
                                <label for="flitoano">Filtro  a&ntilde;o</label>

                                    <select name="flitoano" id="flitoano">
                                        <option value="">Sin especificar</option>
                                        <option value="asc">Ascendente</option>
                                        <option value="desc">Descendente</option>
                                    </select>
                    </div>                
                    <div class="flitoclass">                
                                    <button id="botonparaenviarflito" type="submit">Enviar</button>

                                    
                                    

                    </div>  
                </div > 
            </form>  
            <div>
              <?php   
                if (!empty($instrumentos)) {
                    echo "<table class=\"tablaphp\">";
                    echo "<tr>
                            <th>Instrumento</th>
                            <th>Familia</th>
                            <th>Ubicación</th>
                            <th>Unidades</th>
                            <th>Año de adquisición</th>
                        </tr>";

                    foreach ($instrumentos  as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['dispositivo_acustico']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['familia']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['unidades']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['anyo_de_adquisicion']) . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<table class=\"tablaphp\">";
                    echo "<tr>
                            <th>Instrumento</th>
                            <th>Familia</th>
                            <th>Ubicación</th>
                            <th>Unidades</th>
                            <th>Año de adquisición</th>
                        </tr>";
                    echo "<tr><td colspan='5'>No hay datos</td></tr>";
                    echo "</table>";
                }
              $conn->close();


              ?>       
           </div>     
        </main>
        <footer>    
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>
        
    </body>
    
  </html>