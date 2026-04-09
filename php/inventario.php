<?php
        session_start();
        



    

    if (!isset($_SESSION['dni'])){
    header("Location: login_inventario.php");
    exit;
    
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
                <a href="index.php">Inicio</a>
                <a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a>
                <a href="login_inventario.php">Inventario</a>
                <a href="login_formulario_inventario.php">Formulario de inventario</a>
                <a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a>
                <a href="formulario_contacto.php">Contacto</a>
            </ul>
        </nav>
        <header><h2>inventario</h2></header>        
        <main>
          <div id="idflito"> 
             <div class="flitoclass">

                <form action="controlador.php" method="post">
                        <label for="flitofamilia">Filtro familia</label>
                    
                        <select name="flitofamilia" id="flitofamilia">
                            <option value="sinespecificarfamilia">Sin especificar</soption>
                            <option value="vientometal">Viento metal</option>
                            <option value="vientomadera">Viento madera</option>
                            <option value="percusion ">Percusi&oacute;n</option>
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
                            <option value="RMU1">Accente</option>
                            <option value="RMU2">Deccente</option>
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
              <table>
                <tr>
                    <th>ID</th>
                    <th>Instrumento</th>
                    <th>Familia</th>
                    <th>Ubicaci&oacute;n</th>
                    <th>Unidades</th>
                    <th>A&ntilde;o de adquisici&oacute;n</th>
                </tr>
                <tr>
                    <td></td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
                </table>
           </div>     
        </main>
        <footer>    
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>
        
    </body>
  </html>