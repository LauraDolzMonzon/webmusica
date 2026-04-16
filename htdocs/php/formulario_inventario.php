<?php
    session_start();
    $rolespermitidofi = ['admin'];
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        session_unset();
        session_destroy();
        header("Location: login_formulario_inventario.php");
        exit();
    }
   $servidor = "127.0.0.1";
   $usuario = "root";
   $contrasenna = "";
   $basededatos = "webmusica";
   $conn = new mysqli($servidor, $usuario, $contrasenna, $basededatos);
   if ($conn->connect_error){
            die("error de conexion" . $conn->connect_error);
    } 
    $sqlformularoinvetario = "SELECT ubicacion, anyo_de_adquisicion, unidades, familia, dispositivo_acustico, id_instrumento  FROM instrumento ORDER BY dispositivo_acustico ";
    $resultadoinvetarioformulario = $conn->query($sqlformularoinvetario);
?>
<!DOCTYPE html>
  <html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../validaciones_inventario.js"> </script>
        <link  rel="stylesheet" href="../estilos.css">
        <title>Formulario inventario</title>



    </head>
    <body>
        <nav>       
            <ul>   
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a></li>
                <il><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>
                <li><a href="login_bandeja_contacto.php">Bandeja Contacto</a></li>

            </ul>
        </nav>
        <header><h2>Formulario inventario</h2></header>        
        <main>
            <h3>A&ntilde;adir instrumento</h3>
            <form action="controladorformularioinventario.php" method="post">
              <table>
                <tr>
                    <th><label for="Intrumetroivenatario">Instrumento</label></th>
                    <th><label for="invetariofamilia">Familia</label></th>
                    <th><label for="ivetarioubicacion">Aula</label> </th>
                    
                    <th><label for="invetariounidades">Unidades</label></th>
                    <th><label for="invetarioanodeadquision">A&ntilde;o de adquisici&oacute;n</label></th>
                    <th><label for="botonadminstrainventario">Enviar</label></th>
                </tr>
                <tr>
                    <td><input type="text" id="Intrumetroivenatario" name="Intrumetroivenatario" pattern="[A-Za-zñÑ]+" required> </td>
               
                    <td>
                    
                        <select name="invetariofamilia" id="invetariofamilia" required>
                            <option value="sinespecificarfamilia">Sinespecificarfamilia</option>
                            <option value="vientometral">Viento metal</option>
                            <option value="vientomadera">Viento madera</option>
                            <option value="pesucion">Percusi&oacute;n</option>
                            <option value="cuerda">Cuerda</option>
                        </select> 
                    </td>
                    <td>  <select name="ivetarioubicacion" id="ivetarioubicacion" required>
                            <option value="sinespecificarubicacion">Sinespecificarubicacion</option>
                            <option value="RMU1">RMU1</option>
                            <option value="RMU2">RMU2</option>
                        </select>
                    </td>
                    <td><input type="text" id="invetariounidades" name="invetariounidades" pattern="^[0-9]+$" required> </td> 
                    

                    
                       

                    <td><input type="date" id="invetarioanodeadquision" name="invetarioanodeadquision" min="1900" max="2100" required> </td>
                   
                    <td><button type="submit" class="botonadminstrainventario" name="formularioinvetariopricipal">Enviar</button></td>
                 </tr>  
               </table>
               <h3>Administrar instrumentos</h3>
            </form>        
            <div > 
              
            
              <?php   
                if ($resultadoinvetarioformulario->num_rows > 0){
                    while($row = $resultadoinvetarioformulario->fetch_assoc()){
                        echo "<table class='tablaphp'>";
                        echo "<tr>";
                        echo "<th>Instrumento</th>";
                        echo "<th>Familia</th>";
                        echo "<th>Ubicación</th>";
                        echo "<th>Unidades</th>";
                        echo "<th>Año de adquisición</th>";
                        echo "<th colspan='2'>Administrar</th>";
                        echo "</tr>";
                        echo "<tr>";

                        echo "<td>" . htmlspecialchars($row['dispositivo_acustico']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['familia']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['unidades']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['anyo_de_adquisicion']) . "</td>";

                        echo "<td>";
                        echo "<form action='controladorformularioinventario.php' method='post'>";
                        echo "<input type='hidden' name='id_instrumento' value='" . htmlspecialchars($row['id_instrumento']) . "'>";
                        echo "<button class='botonadminstrainventarioeditaryeliminar' name='accion' value='eliminar' type='submit'>Eliminar</button>";
                        echo "</form>";
                        echo "</td>";

                        echo "<td>";
                        echo "<form action='formulario_inventario.php' method='post'>";
                        echo "<input type='hidden' name='id_instrumento' value='" . htmlspecialchars($row['id_instrumento']) . "'>";
                        echo "<button class='botonadminstrainventarioeditaryeliminar' name='accion' value='editar' type='submit'>Editar</button>";
                        echo "</form>";
                        echo "</td>";

                        echo "</tr>";
                        

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
                        echo       "<th colspan='2'>Administrar</th>";
                        echo   "</tr>";
                        echo    "<tr>"; 
                        echo       "<td colspan='7'>No hay datos </td>";
                        
                        echo    "</tr>";
                                
                        echo "</table>";
                }
              ?>   
                        </tr>
                      
                    </table>
           </div>     
        </main>
        <footer>    
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>
        
    </body>
  </html>