<?php
  session_start();
    $rolpermetidoformulariocontacto = ["admin"];
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin' ){
        session_unset();
        session_destroy();
        header("Location: login_bandeja_contacto.php");
        exit(); 
    }
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $useario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $useario, $contrasenna, $basededatos);
    if ($conn->connect_error){
        die("error de conexion" . $conn->connect_error);
        exit();
    }
    $sqllistadobandejacontacto = "SELECT email, asunto, texto_contenido, id_contacto FROM contacto ORDER BY id_contacto DESC";
    $stmt = $conn->prepare($sqllistadobandejacontacto);
    $stmt->execute();
    $resultadoslistadobandejacontacto = $stmt->get_result();
    if (!$resultadoslistadobandejacontacto){
        die("Error en la consulta: " . $conn->error);
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
                <li><a href="login_formulario_noticias_y_programacion.php">Formulario de noticias y formulario de programaci&oacute;n</a></li>
                <li><a href="formulario_contacto.php">Contacto</a></li>
                <li><a href="#.php">Bandeja Contacto</a></li>

             </ul>
            </nav> 
            <header>
                <h2>Bandeja de Contacto</h2>
            </header>
            <main>
                <?php
                  if($resultadoslistadobandejacontacto->num_rows > 0){
                    while ($filla = $resultadoslistadobandejacontacto->fetch_assoc()){
                        echo "<table class='tablaphp'>";
                        echo "<tr>";
                        echo "<td>Email</td>";
                        echo "<td>Asunto</td>";
                        echo "<td>Contenido</td>";
                        echo "<tr>";
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($filla['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($filla['asunto']) . "</td>";
                        echo "<td>" . htmlspecialchars($filla['texto_contenido']) . "</td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                  } else {
                      echo "<table class='tablaphp'>";
                        echo "<tr>";
                        echo "<td>Email</td>";
                        echo "<td>Asunto</td>";
                        echo "<td>Contenido</td>";
                        echo "<tr>";
                        echo "<td colspan='3'>No hay datos </td>";
                        echo "</tr>";
                        echo "<table>";

                  }
                 $conn->close(); 
                
                ?>
            </main>    
            <footer>
                <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>
            </footer>
        </body>    
    </html>        
