<?php
    require  __DIR__ .  "/conexion.php";
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link  rel="stylesheet" href="../estilos.css">

            <title>Formulario contacto</title>
            
    

        </head>


        <body>
           <nav>
             <ul>   
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a></li>
                <li><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventarioo</a></li>
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="#">Contacto</a></li>
             </ul>
           </nav>
           <header>
              <h2>Formulario contacto</h2>
           </header>
            <main>
                <form action="controlador.php" method="post">
                    <div class="grindclass2">  
                        <label for="email">Email:</label>

                        <input type="text" id="email" name="email" required>

                        <label  for="asunto">Asunto:</label> 
            
                        <input type="text" id="asunto" name="asunto" required>
                        
                    
                        <label for="enviartexto">Enviar texto:</label>
                        <textarea id="enviartextos"></textarea>
                    </div>
                    <button class="botonparaenviarcontacto" type="submit">Enviar</button>
        
                </form>
            </main>
            <footer>
                 <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

            </footer>
        </body>

    </html>  