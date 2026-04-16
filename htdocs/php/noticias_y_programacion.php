<?php
     session_start();
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $useario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $useario, $contrasenna, $basededatos);
    if ($conn->connect_error){
        die("error de conexion" . $conn->connect_error);
    }
    $sql4 = "SELECT  titulo_noticia, fecha, lugar,  texto_noticia, dni_profesor_noticia FROM noticia ORDER BY fecha DESC";
    $resultadostablanoticias = $conn->query($sql4);
    $sqlformularioprogramacion = "SELECT programacion.anyo, programacion.contenido, programacion.titulo_programacion, profesor.nombre, profesor.apellido1, profesor.apellido2 FROM programacion LEFT JOIN tabla_profesor_programacion 
    ON programacion.id_programacion = tabla_profesor_programacion.id_programacion_intermedio LEFT JOIN profesor ON tabla_profesor_programacion.dni_profesor_intermedio = profesor.dni ORDER BY programacion.anyo DESC ";

    $resultadostablaprogramacion = $conn->query($sqlformularioprogramacion);
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link  rel="stylesheet" href="../estilos.css">
            <title> Noticias y programaci&oacute;n</title>
    

        </head>


        <body>
            <nav>       
            <ul>   
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#">Noticias y programaci&oacute;n</a></li>  
                <li><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>
                <li><a href="login_bandeja_contacto.php">Bandeja Contacto</a></li>

            </ul>
        </nav>  
        <header>
            <h2>Noticias y Programaci&oacute;n</h2>

        </header>
            
        <main>
            <h3 class="h3nyp">Noticias</h3>
            <div> 
              <?php
                
                        echo  "<table class=\"tablaphp\">";
                        echo     "<tr>";
                        echo        "<th>Fecha</th>";
                        echo        "<th>Noticias</th>";
                        echo        "<th>Lugar</th>";
                        echo         "<th>Texto</th>";
                        echo     "</tr>";
                    if ($resultadostablanoticias->num_rows > 0){
                    while($row = $resultadostablanoticias->fetch_assoc()) {   
                        echo     "<tr>";
                        echo        "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                        echo        "<td>" . htmlspecialchars($row['titulo_noticia']) . "</td>";
                        echo        "<td>" . htmlspecialchars($row['lugar']) . "</td>";
                        echo        "<td>" . htmlspecialchars($row['texto_noticia']) . "</td>";
                        echo     "</tr>";   
                        echo  "</table>";
                    }
                 } else {
                      echo  "<table>";
                        echo     "<tr>";
                        echo        "<th>Fecha</th>";
                        echo        "<th>Noticias</th>";
                        echo        "<th>Lugar</th>";
                        echo         "<th>Texto</th>";
                        echo     "</tr>";
                         
                        echo     "<tr >";
                        echo        "<td colspan='4'>No hay datos</td>";
                        
                        echo     "</tr>";
                 }
             ?>


            </div>  
            <div>
                 <h3 class="h3nyp">Programaci&oacute;n</h3>  

                <?php
                    if ($resultadostablaprogramacion->num_rows > 0){
                      while ($row = $resultadostablaprogramacion->fetch_assoc()) {
                        
                        echo  "<table>";
                        echo      "<tr>";
                        echo         "<th>Curso</th>";
                        echo         "<th>A&ntilde;o</th>";
                        echo         "<th>Nombre</th>";
                        echo         "<th>Primer apellido</th>";
                        echo         "<th>Segundo apellido</th>";
                        echo         "<th>Programaci&oacute;n</th>";

                        echo      "</tr>";
                        echo      "<tr>";
                        echo         "<td>" . htmlspecialchars($row['titulo_programacion']) . "</td>";
                        echo         "<td>" . htmlspecialchars($row['anyo']) . "</td>";
                        echo         "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo         "<td>" . htmlspecialchars($row['apellido1']) . "</td>";
                        echo         "<td>" . htmlspecialchars($row['apellido2']) . "</td>";
                        echo         "<td>" . '<a href="' . $row['contenido'] . '" download> <button type="button">Descargar</button> </a>' . "</td>";
                        echo      "</tr>"; 
                        echo  "</table>";
                      }
                        } else {
                            echo  "<table>";
                        echo      "<tr>";
                        echo         "<th>Curso</th>";
                        echo         "<th>A&ntilde;o</th>";
                        echo         "<th>Programaci&oacute;n</th>";
                        echo         "<th>Primer apellido</th>";
                        echo         "<th>Segundo apellido</th>";
                        echo         "<th>Programaci&oacute;n</th>";                        
                        echo      "</tr>";
                        echo      "<tr>";
                        echo         "<td colspan='6'>No hay datos </td>";
                                
                        echo      "</tr>"; 
                        echo  "</table>";
                        }

                     
                    ?>      
           
           </div>     
        
   
        </main>
        <footer>
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>

        </body>
       

    </html>    