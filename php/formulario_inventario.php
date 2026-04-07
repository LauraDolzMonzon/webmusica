<?php
    require  __DIR__. "/conexion.php";
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
                <a href="index.php">Inicio</a>
                <a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a>
                <a href="login_inventario.php">Inventario</a>
                <a href="login_formulario_inventario.php">Formulario de inventario</a>
                <a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a>
                <a href="formulario_contacto.php">Contacto</a>
            </ul>
        </nav>
        <header><h2>Inventario</h2></header>        
        <main>
            <h3>A&ntilde;adir instrumento</h3>
            <form action="controlador.php" method="post">
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
                    <td><input type="text" id="Intrumetroivenatario" name="Intrumetroivenatario" pattern="[A-Z0a-zñÑ]+" required> </td>
               
                    <td>
                    
                        <select name="invetariofamilia" id="invetariofamilia" required>
                            <option value="sinespecificarfamilia2"></soption>
                            <option value="vientometral">Viento metal</option>
                            <option value="vientomadera">Viento madera</option>
                            <option value="pesucion">Percusi&oacute;n</option>
                            <option value="cuerda">Cuerda</option>
                        </select> 
                    </td>
                    <td>  <select name="ivetarioubicacion" id="ivetarioubicacion" required>
                            <option value="sinespecificarubicacion2"></option>
                            <option value="RMU1">RMU1</option>
                            <option value="RMU2">RMU2</option>
                        </select>
                    </td>
                    <td><input type="text" id="invetariounidades" name="invetariounidades" pattern="^[0-9]+$" required> </td> 
                    

                    
                       

                    <td><input type="text" id="invetarioanodeadquision" name="invetarioanodeadquision" pattern="^[0-9]{4}$" maxlength="4" minlength="4" required> </td>
                   
                    <td><button class="botonadminstrainventario">Enviar</button></td>
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
                        <th Colspan="2">Administrar</th>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="botonadminstrainventarioeditaryeliminar" >Editar</button></td>
                        <td><button class="botonadminstrainventarioeditaryeliminar">Eliminar</button></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="botonadminstrainventarioeditaryeliminar">Editar</button></td>
                        <td><button class="botonadminstrainventarioeditaryeliminar">Eliminar</button></td>
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