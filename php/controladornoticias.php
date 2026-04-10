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
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $noticainventario = trim($_POST['noticiainventario']);
      $Fechainventario = trim($_POST['Fechainventario']);
      $lugar = trim($_POST['lugar']);
      $textoprogamacion = trim($_POST['textoprogamacion']);
      $dni_prfosesor = $_SESSION['dni'];
      $sqlnoticias = "INSERT INTO noticia (titulo_noticia, fecha, lugar,  texto_noticia, dni_profesor_noticia)
      VALUES ('$noticainventario', '$Fechainventario', '$lugar', '$textoprogamacion', '$dni_prfosesor')";
      if(mysqli_query($conn, $sqlnoticias)){
        echo "<script>alert('Noticia guardada'); window.location.href = 'formulario_programacion_y_noticias.php'; </script>";
      } else{
            echo "<script>alert('Noticia no guardada o error " . $conn->error . "' ); window.location.href = 'formulario_programacion_y_noticias.php'; </script>";

        }
   }
   $conn->close();
    
?>