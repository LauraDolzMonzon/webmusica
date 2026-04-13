<?php
    session_start();
    require __DIR__. "/conexion.php";
    if (!isset($_SESSION['rol'])){
        header("Location: login_formulario_inventario.php");
        exit;
    }
?>
<!DOCTYPE html>
  <html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../validaciones_inventario.js"> </script>
        <link  rel="stylesheet" href="../estilos.css">
        <title> Inventario</title>



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
            </ul>
        </nav>
        <header><h2>Inventario</h2></header>        
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
                            <option value="sinespecificarfamilia2">Sinespecificarfamilia</option>
                            <option value="vientometral">Viento metal</option>
                            <option value="vientomadera">Viento madera</option>
                            <option value="pesucion">Percusi&oacute;n</option>
                            <option value="cuerda">Cuerda</option>
                        </select> 
                    </td>
                    <td>  <select name="ivetarioubicacion" id="ivetarioubicacion" required>
                            <option value="sinespecificarubicacion2">Sinespecificarubicacion</option>
                            <option value="RMU1">RMU1</option>
                            <option value="RMU2">RMU2</option>
                        </select>
                    </td>
                    <td><input type="text" id="invetariounidades" name="invetariounidades" pattern="^[0-9]+$" required> </td> 
                    

                    
                       

                    <td><input type="date" id="invetarioanodeadquision" name="invetarioanodeadquision" min="1900" max="2100" required> </td>
                   
                    <td><button type="submit" class="botonadminstrainventario">Enviar</button></td>
                 </tr>  
               </table>
               <h3>Administrar instrumentos</h3>
            </form>        
            <div > 
               <form action="controlador.php"     method="post">
            
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Instrumento</th>
                            <th>Familia</th>
                            <th>Ubicaci&oacute;n</th>
                            <th>Unidades</th>
                            <th>A&ntilde;o de adquisici&oacute;n</th>
                            <th colspan="2">Administrar</th>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button class="botonadminstrainventarioeditaryeliminar" type="submit">Editar</button></td>
                            <td><button class="botonadminstrainventarioeditaryeliminar" type="submit">Eliminar</button></td>
                        </tr>
                      
                    </table>
              </form>  
           </div>     
        </main>
        <footer>    
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>
        
    </body>
  </html>