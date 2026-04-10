<?php
session_start();

$rolespermitido = ['admin'];

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    session_unset();
    session_destroy();
    header("Location: login_formulario_noticias_y_programacion.php");
    exit();
}

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
             </ul>
           </nav>
           <header>
              <h2>Formulario Programaci&oacute;n y Noticias</h2>
           </header>
           <main>
                <h3>Noticias</h3>
                <form action="controladornoticias.php" method="post">
                    <div class="grindclass2">  
                        <label for="noticainventario">Noticia:</label>

                        <input type="text" id="noticiainventario" name="noticiainventario" minlength="5" required>
                       
                        <label  for="Fechainventario">Fecha:</label> 
            
                        <input type="date" id="Fechainventario" name="Fechainventario" required>
                        <label  for="lugar">Lugar:</label> 
            
                        <input type="text" id="lugar" minlength="8" name="lugar" required>
                       
                        <label for="textoprogamacion">Texto:</label>
                        <textarea id="textoprogamacion" name="textoprogamacion" minlength="10" required></textarea>

                        
                    </div><br>
                    <button class="botonparaenviarformularioprogamacionynoticias" type="submit">Enviar</button>
                </form>
                <h3> Programaci&oacute;n</h3>
                <form action="controlador.php" methos="post">
                    <div class="grindclass4">  
                        <label for="nivel">Curso:</label>

                        <input type="text" id="nivel" name="nivel" required>

                        <label  for="Ano">A&ntilde;o</label> 
            
                        <input type="text" id="ano" name="ano"   min="1900" max="2100" required>
                       
                        <label  for="profesor">Profesor:</label> 
            
                        <input type="text" id="profesor" name="profesor" pattern="^[A-Za-zñÑ]+$" minlength="3" required>
                        <label for="achivo">Sube el archivo:</label>
                        <input type="file" id="achivo" accept=".pdf" required>    
                                      
                </div><br>
                    <button class="botonparaenviarformularioprogamacionynoticias" type="submit">Enviar</button>
               </form>
               
            </main>
            <footer>
                <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>
            </footer>
        </body>
    </html>    