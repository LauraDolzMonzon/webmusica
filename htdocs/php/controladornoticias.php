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
      if (isset($_POST['botonparaenviarnoticias'])){
        $noticainventario = trim($_POST['noticiainventario']);
        $Fechainventario = trim($_POST['Fechainventario']);
        $lugar = trim($_POST['lugar']);
        $textoprogamacion = trim($_POST['textoprogamacion']);
        $dni_prfosesor = $_SESSION['dni'];
        $erroresvalicionesnoticias = [];

        if (strlen($lugar) < 8){
          $erroresvalicionesnoticias[] = "Se requiere como mínimo 5 caracteres ";
          }
        if (strlen($noticainventario) < 8){
           $erroresvalicionesnoticias[] = "Se requiere como mínimo 8 caracteres ";
          }
         if (strlen($textoprogamacion) < 8){
             $erroresvalicionesnoticias[] = "Se requiere como mínimo 8 caracteres ";
        }
             
                      


        $sqlnoticias = "INSERT INTO noticia (titulo_noticia, fecha, lugar,  texto_noticia, dni_profesor_noticia)
        VALUES ('$noticainventario', '$Fechainventario', '$lugar', '$textoprogamacion', '$dni_prfosesor')";
        if(mysqli_query($conn, $sqlnoticias)){
          echo "<script>alert('Noticia guardada'); window.location.href = 'formulario_programacion_y_noticias.php'; </script>";
        } else{
            echo "<script>alert('Noticia no guardada o error: " . addslashes($conn->error) . "'); window.location.href='formulario_programacion_y_noticias.php';</script>";
          }
    }
    if (isset($_POST['botonparaenviarprogramacion'])){
       $nivel = trim($_POST['nivel']);
       $ano = trim($_POST['ano']);
       $nivel = trim($_POST['nivel']);

       $erroresvaliciones = [];
        if(empty($_POST['dni_profesor_todos'])){
            echo "<script>alert('Selecciona un profesor'); window.history.back();</script>";
            exit();
        }
        $dni_prfosesor_programacion = $_POST['dni_profesor_todos'];

        if (empty($nivel)){
            $erroresvaliciones[] = "Debe rellenar el campo nivel";
        }

        if (empty($ano)){
            $erroresvaliciones[] = "Debe rellenar el campo año";
        }
         if (strlen($nivel) < 8){
          $erroresvaliciones[] = "Se requiere como mínimo 8 caracteres ";
          }
          
         if (!preg_match('/^[0-9]{4}$/', $ano)){
            $erroresvaliciones[] = "Se requiere 4 números ";
         }

        if (empty($_FILES['archivo']['name'])){
            $erroresvaliciones[] = "Debe seleccionar un archivo PDF";
        } else {
          $extension = strtolower(pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION));

          if ($extension !== 'pdf'){
                  $erroresvaliciones[] = "Solo se admite formato PDF";
              }
              $tipoMine = mime_content_type($_FILES['archivo']['tmp_name']);
                  if ($tipoMine !== 'application/pdf'){
                  $erroresvaliciones[] = "El archivo debe ser un PDF válido";
              }
              if (!empty($erroresvaliciones)){
                echo "<script>window.history.back();</script>";
                exit();
              }
              
        
       
       }
       $dni_prfosesor_programacion = $_POST['dni_profesor_todos'];       


       $nombrearchivo = time() . "_" . basename($_FILES['archivo']['name']);
       $ruta = "uploads/" . $nombrearchivo;
       move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
       
       $sqlprogramacion = "INSERT INTO programacion (anyo, contenido, titulo_programacion)
       VALUES ('$ano', '$ruta', '$nivel')";
       if ($conn->query($sqlprogramacion)) {
        $id_programacion_intermedio = $conn->insert_id;
        $sql_tabla_intermedeia = "INSERT INTO tabla_profesor_programacion (dni_profesor_intermedio, id_programacion_intermedio)
        VALUES ('$dni_prfosesor_programacion', '$id_programacion_intermedio')";
        if(mysqli_query($conn, $sql_tabla_intermedeia)) {
          echo "<script>alert('Programacion guardara');  window.location.href='formulario_programacion_y_noticias.php';</script>";
        } else{  

          $error = addslashes($conn->error);
          echo "<script>
                  alert('Programación no guardada o error: $error');
                 
                </script>";
                  
              
        }       
      }
    }  
  }

   $conn->close();
    
?>