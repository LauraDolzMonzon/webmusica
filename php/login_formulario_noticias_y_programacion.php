<!DOCTYPE html>
    <html>
        <head>
          
          
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="../validaciones_login_programacion_y_noticias.js" defer></script>

            <link  rel="stylesheet" href="../estilos.css">
            <title>Login Formulario de Noticias y Programaci&oacute;n</title>
    

        </head>


        <body>
          <nav>       
            <ul>   
              
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a><li>
                <li><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="#">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>   
                <li><a href="login_bandeja_contacto.php">Bandeja Contacto</a></li>

            </ul>
          </nav>
          <header>
            <h2>Login Formulario de Noticias y Programaci&oacute;</h2>
          </header>  
          <main>
            <form action="controladorloginfyn.php" method="post">
              <div class="grindclass">  
                <label for="usuariofyp">Usuario:</label>

                <input type="text" id="usuariofyp" name="usuariofyp" pattern="^[A-Z0-9]{9}$"  minlength="9" maxlength="9" required>

                  
                <label  for="contrasenafyp">Contrase&ntilde;a:</label> 
    
                <input type="password" id="contrasenafyp" name="contrasenafyp" minlength="8" required>
                 
              </div><br>
              <button class="botonparaenviarlogin" type="submit">Enviar</button>

          </form>
          </main>
          <footer>
                 <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

          </footer>
        </body>

    </html>    