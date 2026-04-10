<?php
    session_start();
    $servidor = "127.0.0.1";
    $usuario = "root";
    $contrasenna = "";
    $basededadotas = "webmusica";

    $conn = new mysqli($servidor, $usuario, $contrasenna, $basededadotas);
    if ($conn->connect_error){
        die("Error de conexion" . $conn->connect_error );
    }
    $sqlindex = "SELECT titulo_noticia, fecha, lugar,  texto_noticia, dni_profesor_noticia FROM noticia ORDER BY fecha DESC ";
    $resultadoindex = $conn->query($sqlindex);
?>
<!DOCTYPE html>
  <html>
    <head>
        <title> Inicio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="stylesheet" href="../estilos.css">
    </head>
    <body>
        <nav>       
            <ul>   
                <li><a href="#">Inicio</a></li>
                <li><a href="noticias_y_programacion.php">Noticias y programaci&oacute;n</a></li>
                <li><a href="login_inventario.php">Inventario</a></li>
                <li><a href="login_formulario_inventario.php">Formulario de inventario</a></li>
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>
            </ul>
        </nav>        
        <header><h1>Departamento de M&uacute;sica</h1></header>
        <main>
            <div id="div1inicio">
              <p >Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n</p>
            </div>
            <div > 
              <?php    
            if ($resultadoindex && $resultadoindex->num_rows > 0) {   
                    $row = $resultadoindex->fetch_assoc();
                    echo "<table>";
                    echo   "<tr>";
                    echo      "<th>Fecha</th>";
                    echo      "<th>Noticias</th>";
                    echo      "<th>Lugar</th>";
                    echo      "<th>Texto</th>";
                    echo   "</tr>";
                    echo   "<tr>";
                    echo      "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                    echo      "<td>" . htmlspecialchars($row['titulo_noticia']) . "</td>";
                    echo      "<td>" . htmlspecialchars($row['lugar']) . "</td>";
                    echo      "<td>" . htmlspecialchars($row['texto_noticia']) . "</td>";
                    echo  "</tr>";
                    echo "</table>";
                
              } else {
                    echo "<table>";
                    echo   "<tr>";
                    echo      "<th>Fecha</th>";
                    echo      "<th>Noticias</th>";
                    echo      "<th>Lugar</th>";
                    echo      "<th>Texto</th>";
                    echo   "</tr>";
                    echo   "<tr>";
                    echo      "<td colspan='4'>No hay datos</td>";
                
                    echo  "</tr>";
                    echo "</table>";

              }

              ?>  
           </div>     
        </main>
        <footer>    
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>
        
    </body>
  </html>