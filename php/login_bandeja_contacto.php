<?php
    require __DIR__. "/conexion.php";
?>
<?php
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="../validaciones_login_contacto.js" defer></script>
            <link  rel="stylesheet" href="../estilos.css">
            <title>Login Formulario Inventario</title>
        </head>
        <body>
           <nav>
             <ul>   
                <li><a href="index.php">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a></li>
                <li><a href="#">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>
                <li><a href="#">Bandeja Contacto</a></li>

             </ul>
           </nav>
           <header>
              <h2>Login bandeja contacto</h2>

           </header>
           <main>
                <form action="controladorlogincontacto.php" method="post">
                    <div class="grindclass">  
                        <label for="usuarioicontacto">Usuario:</label>

                        <input type="text" id="usuarioicontacto" name="usuarioicontacto"  pattern="^[A-Z0-9]{9}$" minlength="9" maxlength="9"  required>
                       
                        <label  for="contrasenacontacto">Contrase&ntilde;a:</label> 
            
                        <input type="password" id="contrasenacontacto" name="contrasenacontacto" minlength="8" required>
                       
                    </div><br>
                    <button class="botonparaenviarlogin" type="submit">Enviar</button>
        
                </form>
            </main>
            <footer>
                 <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

            </footer>
        </body>

    </html>               