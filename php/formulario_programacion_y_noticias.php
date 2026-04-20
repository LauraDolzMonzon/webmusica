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
$sqlprofesorestodos = "SELECT dni, nombre, apellido1, apellido2 FROM profesor WHERE rol != 'invitado';";
$resultadotodosprofesores = $conn->query($sqlprofesorestodos);

?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link  rel="stylesheet" href="../estilos.css">
            <script src="../validaciones_programacion_y_noticias.js" defer></script>

            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Envi&oacute;n Programaci&oacute;n y Noticias</title>
        </head>
        <body>
           <nav>
             <ul>   
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a></li>
                <li><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="#">Formulario de noticias y formulario de programaci&oacute;n</a></li>
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
                        <label for="noticainventario">Noticia:</label>

                        <input type="text" id="noticiainventario" name="noticiainventario" minlength="5" required>
                       
                        <label  for="Fechainventario">Fecha:</label> 
            
                        <input type="date" id="Fechainventario" name="Fechainventario" required>
                        <label  for="lugar">Lugar:</label> 
            
                        <input type="text" id="lugar" minlength="5" name="lugar" required>
                       
                        <label for="textoprogamacion">Texto:</label>
                        <textarea id="textoprogamacion" name="textoprogamacion" minlength="8" required></textarea>

                        
                    </div><br>
                    <button class="botonparaenviarformularioprogamacionynoticias" type="submit" name="botonparaenviarnoticias">Enviar</button>
                </form>
                <h3> Programaci&oacute;n</h3>
                <form action="controladornoticias.php" method="post" enctype="multipart/form-data">
                    <div class="grindclass4">  
                        <label for="dni_profesor_todos">Elige el profesor</label>
                        <select name="dni_profesor_todos" id="dni_profesor_todos_id" required >
                            <option value="">elige un profesor</option>
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
               
            </main>
            <footer>
                <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>
            </footer>
        </body>
    </html>    