<?php
session_start();

$rolespermitido = ['admin'];

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    session_unset();
    session_destroy();
    header("Location: login_formulario_noticias_y_programacion.php");
    exit();
}
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $useario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $useario, $contrasenna, $basededatos);
    if ($conn->connect_error){
        die("error de conexion" . $conn->connect_error);
    }    
$sqlprofesorestodos = "SELECT dni, nombre, apellido1, apellido2 FROM profesor WHERE rol != 'invitado'";
$stmt = $conn->prepare($sqlprofesorestodos);
$stmt->execute();

$resultadotodosprofesores = $stmt->get_result();
$sqllistadonoticiaeliminar = "SELECT * FROM noticia ";
$sqllistadoprogramacioaeliminar = "SELECT  programacion.anyo, programacion.contenido, programacion.id_programacion, programacion.titulo_programacion, profesor.nombre, profesor.apellido1, profesor.apellido2  FROM programacion LEFT JOIN tabla_profesor_programacion ON programacion.id_programacion = tabla_profesor_programacion.id_programacion_intermedio  LEFT JOIN profesor ON  tabla_profesor_programacion.dni_profesor_intermedio = profesor.dni ORDER BY programacion.anyo DESC";

$resultadolistadonoticiaeliminar = mysqli_query($conn, $sqllistadonoticiaeliminar);
$resultadolistadoprogramacioaeliminar = mysqli_query($conn, $sqllistadoprogramacioaeliminar);
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link  rel="stylesheet" href="../estilos.css">
            <script src="../validaciones_programacion_y_noticias.js" defer></script>

            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Formulario Programaci&oacute;n y Noticias</title>
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
           <header>
              <h2>Formulario Programaci&oacute;n y Noticias</h2>
           </header>
           <main>
                <h3>Noticias</h3>
                <form action="controladornoticias.php" method="post" >

                    <div class="grindclass2">  
                        <label for="noticiainventario">Noticia:</label>

                        <input type="text" id="noticiainventario" name="noticiainventario" minlength="5" required>
                       
                        <label  for="Fechainventario">Fecha:</label> 
            
                        <input type="date" id="Fechainventario" name="Fechainventario" min="1900-01-01" max="2100-12-31" required>
                        <label  for="lugar">Lugar:</label> 
            
                        <input type="text" id="lugar" minlength="5" name="lugar" required>
                       
                        <label for="textonoticia">Texto:</label>
                        <textarea id="textonoticia" name="textonoticia" minlength="8" required></textarea>

                        
                    </div><br>
                    <button class="botonparaenviarformularioprogamacionynoticias" type="submit" name="botonparaenviarnoticias">Enviar</button>
                </form>
                <h3> Programaci&oacute;n</h3>
                <form action="controladornoticias.php" method="post" enctype="multipart/form-data">
                    <div class="grindclass4">  
                        <label for="dni_profesor_todos">Elige el profesor</label>
                        <select name="dni_profesor_todos" id="dni_profesor_todos_id" required >
                            <option value="">Elige un profesor</option>
                            <?php
                              if ($resultadotodosprofesores && $resultadotodosprofesores->num_rows > 0){
                                while ($fila = $resultadotodosprofesores->fetch_assoc()){
                                echo "<option value='" . $fila['dni'] . "'>" . 
                                    htmlspecialchars($fila['nombre']) . " " . 
                                    htmlspecialchars($fila['apellido1']) . " " . 
                                    htmlspecialchars($fila['apellido2']) . 
                                    "</option>";
                                }
                              } 
                            
                            ?>    
                        </select>
                        <label for="nivel">Curso:</label>
                        <input type="text" id="nivel" name="nivel" required>
                        <label  for="ano">A&ntilde;o</label> 
                        <input type="text" id="ano" name="ano"  pattern="[0-9]{4}" minlength="4"  maxlength="4" required>
                        <label for="achivo">Sube el archivo:</label>
                        <input type="file" id="achivo" name="archivo" accept=".pdf" required>                    
                </div><br>
                    <button class="botonparaenviarformularioprogamacionynoticias2" name="botonparaenviarprogramacion" type="submit">Enviar</button>
               </form>
               <h3>Editar noticia </h3>

                 <div class="admistrarfyn">
                    <?php
                        if ($resultadolistadonoticiaeliminar->num_rows > 0){
                            while($row = $resultadolistadonoticiaeliminar->fetch_assoc()){
                            echo "<table class='tablaphp'>";
                            echo "<tr>";
                            echo "<th>Titulo noticia</th>";
                            echo "<th>Texto noticia</th>";
                            echo "<th>Lugar</th>";      
                            echo "<th>Fecha</th>";
                            echo "<th>Eleminar</th>";   
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['titulo_noticia']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['texto_noticia']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['lugar']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                            echo "<form action='controladoreliminarfyn.php' method='post'>";
                            echo "<td>";
                            echo "<input type='hidden' name='id_noticia' value='" . htmlspecialchars($row['id_noticia']) . "'>";
                            echo "<button name='accionnyf' value='noticiaeliminar' type='submit'>Eleminar</button>";
                            echo "</td>";
                            echo "</form>";
                            echo "</tr>";

                            echo "</table>";


                            }
                            } else {
                                echo "<table class='tablaphp'>";
                            echo "<tr>";
                            echo "<th>Titulo noticia</th>";
                            echo "<th>Texto noticia</th>";
                            echo "<th>Lugar</th>";      
                            echo "<th>Fecha</th>";
                            echo "<th>Eleminar</th>";   
                            echo "<tr>";
                            echo "<td colspan='5'> No hay datos </td>";
                        
                            echo "</tr>"; 
                            echo "</table>";
                        
                        }
                  ?>  
                 </div> 
                 <h3>Editar Programaci&oacute;n </h3>
                 <div class="admistrarfyn">
                    <?php
                        if ($resultadolistadoprogramacioaeliminar->num_rows > 0){
                            while($filla = $resultadolistadoprogramacioaeliminar->fetch_assoc()){
                                echo "<table class='tablaphp'>";
                                echo "<tr>";
                                echo "<th>a&#241;o</th>";
                                echo "<th>Curso</th>";
                                echo "<th>Nombre</th>";
                                echo "<th>Apellido1</th>";
                                echo "<th>Apellido2</th>";
                                echo "<th>Contenido</th>"; 
                                echo "<th>Eliminar</th>";   
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($filla['anyo']) . "</td>";
                                echo "<td>" . htmlspecialchars($filla['titulo_programacion']) . "</td>";
                                echo "<td>" . htmlspecialchars($filla['nombre']) . "</td>";
                                echo "<td>" . htmlspecialchars($filla['apellido1']) . "</td>";
                                echo "<td>" . htmlspecialchars($filla['apellido2']) . "</td>";
                                echo "<td>" . '<a href="' .  htmlspecialchars($filla['contenido']) . '"  download> <button type="button">Descargar</button> </a>' .  "</td>";
                                echo "<form action='controladoreliminarfyn.php' method='post'>";

                                echo "<td>";

                                echo "<input type='hidden' name='id_programacion' value='" . htmlspecialchars($filla['id_programacion']) . "'>";
                                echo "<button name='accionnyf' value='programacionaeliminar' type='submit'>Eleminar</button>";
  
                                echo "</td>";
                                echo "</form>";
                                echo "</tr>"; 

                                echo "</table>";
                            } 
                            } else {
                                echo "<table class='tablaphp'>";
                                echo "<tr>";
                                echo "<th>A&#241;o</th>";
                                echo "<th>Titulo programacion</th>";
                                echo "<th>Nombre</th>";
                                echo "<th>Apellido1</th>";
                                echo "<th>Apellido2</th>";
                                echo "<th>Contenido</th>"; 
                                echo "<th>Eliminar</th>";
                                echo "<tr>";
                                echo "<td colspan='7'> No hay datos </td>";

                                echo "</tr>"; 
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
    <?php
        $conn->close();
    ?>