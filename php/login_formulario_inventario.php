
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="../validaciones_formulatio_login_inventario.js" defer></script>
            <link  rel="stylesheet" href="../estilos.css">
            <title>Login Formulario Inventario</title>
        </head>
        <body>
           <nav>
             <ul>   
                <a href="index.php">Inicio</a>
                <a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a>
                <a href="login_inventario.php">Inventario</a>
                <a href="#">Formulario de inventario</a>
                <a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a>
                <a href="formulario_contacto.php">Contacto</a>
             </ul>
           </nav>
           <header>
              <h2>Login Formulario de Inventario</h2>
           </header>
           <main>
                <form action="controladorinvetario.php" method="post">
                    <div class="grindclass">  
                        <label for="usuariologinformularioinventario">Usuario:</label>

                        <input type="text" id="usuariologinformularioinventario" name="usuariologinformularioinventario"  pattern="^[A-Z0-9]{9}$" minlength="9" maxlength="9"  required>
                       
                        <label  for="contrasenaloginformularioinventario">Contrase&ntilde;a:</label> 
            
                        <input type="password" id="contrasenaloginformularioinventario" name="contrasenaloginformularioinventario" minlength="8" required>
                       
                    </div><br>
                    <button class="botonparaenviarlogin" type="submit">Enviar</button>
        
                </form>
                <a href="formulario_inventario.php">Enlace provisional para entrar al formulario del inventario, porque todavía no hay PHP</a>
            </main>
            <footer>
                 <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

            </footer>
        </body>

    </html>    