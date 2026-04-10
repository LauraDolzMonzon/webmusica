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
    $resultadostablanoticias = $conn->query($sql4)
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
            </ul>
        </nav>  
        <header>
            <h2>Noticias y Programaci&oacute;n</h2>

        </header>
            
        <main>
            <h3 class="h3nyp">Noticias</h3>
            <div> 
              <?php
                if ($resultadostablanoticias->num_rows > 0){
                    while($row = $resultadostablanoticias->fetch_assoc()) {   
                        echo  "<table class=\"tablaphp\">";
                        echo     "<tr>";
                        echo        "<th>Fecha</th>";
                        echo        "<th>Noticias</th>";
                        echo        "<th>Lugar</th>";
                        echo         "<th>Texto</th>";
                        echo     "</tr>";
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
            <h3 class="h3nyp">Programaci&oacute;n</h3>  
            <div>
                <table>
                  <tr>
                    <th>Curso</th>
                    <th>A&ntilde;o</th>
                    <th>Profesor</th>
                    <th>Programaci&oacute;n</th>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    
                    <td><button>Descarga</button> </td>

                </tr>  
                 <tr>
                   <th>Curso</th>
                   <th>A&ntilde;o</th>
                   <th>Profesor</th>
                   <th>Programaci&oacute;n</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button>Descarga</button> </td>
                </tr>   
                </table>
           
           </div>     
        
   
        </main>
        <footer>
            <h4>Bienvenido a la web del Departamento de M&uacute;sica del IES Bajo Arag&oacute;n.</h4>

        </footer>

        </body>
       

    </html>    