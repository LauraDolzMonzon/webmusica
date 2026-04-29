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
       $rolespermitidofi = ['admin'];
      if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
          session_unset();
          session_destroy();
          header("Location: login_formulario_inventario.php");
          exit();
    }
    
    

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if (isset($_POST['botonparaenviarnoticias'])){
        $noticainventario = trim($_POST['noticiainventario']);
        $Fechainventario = trim($_POST['Fechainventario']);
        $lugar = trim($_POST['lugar']);
        $textoprogamacion = trim($_POST['textoprogamacion']);
        $dni_prfosesor = $_SESSION['dni'];
        $erroresvalicionesformularionoticiayp = [];
      

        if (empty($noticainventario)){
            $erroresvalicionesformularionoticiayp[] = "no se puede dejar el titulo vacido";
        }
        
        if (empty($lugar)){
            $erroresvalicionesformularionoticiayp[] = "no se puede dejar el lugar vacido";
        }
         if (empty($textoprogamacion)){
            $erroresvalicionesformularionoticiayp[] = "no se puede dejar la ruta vacido";

        }
         if (strlen($noticainventario) < 5){
           $erroresvalicionesformularionoticiayp[] = "Se requiere como mínimo 5 caracteres ";
      }
        if(strlen($lugar) < 5){
           $erroresvalicionesformularionoticiayp[] = "Se requiere como mínimo 5 caracteres ";
        }
        if (strlen($textoprogamacion) < 8){
          $erroresvalicionesformularionoticiayp[] = "Se requiere como minimo 8 caracteres";
        }


       
        if (empty($Fechainventario)){
            $erroresvalicionesformularionoticiayp[] = "La fecha no puede estar vacía.";
        } else {
         if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $Fechainventario)) {
        $erroresvalicionesformularionoticiayp[] = "Formato de fecha inválido.";
        } else {
          list($anodate, $mes, $dia) = explode('-', $Fechainventario);
          if ($anodate < 1900 || $anodate > 2100){
            $erroresvalicionesformularionoticiayp[] = "El año debe estar entre 1900 y 2100.";
          }
          if (!checkdate($mes, $dia, $anodate)){
            $erroresvalicionesformularionoticiayp[] = "la fecha no es validadd";
          }
       }
      }
        if (!empty($erroresvalicionesformularionoticiayp)){
            echo "<script>window.location.href = 'formulario_programacion_y_noticias.php'</script>";
            exit();
        } 
  
      
             
                      


        $stmt = $conn->prepare("INSERT INTO noticia (titulo_noticia, fecha, lugar,  texto_noticia, dni_profesor_noticia)
        VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $noticainventario, $Fechainventario, $lugar, $textoprogamacion, $dni_prfosesor);
       
        if($stmt->execute()){
          echo "<script>alert('Noticia guardada'); window.location.href = 'formulario_programacion_y_noticias.php'; </script>";
        } else{
            echo "<script>alert('Noticia no guardada o error: " . addslashes($conn->error) . "'); window.location.href='formulario_programacion_y_noticias.php';</script>";
          }
          $stmt->close();
    }
    
    // 
    if (isset($_POST['botonparaenviarprogramacion'])){
       $nivel = trim($_POST['nivel']);
       $ano = trim($_POST['ano']);
       $dni_prfosesor_programacion = $_POST['dni_profesor_todos'];
       $erroresvalicionesformularionoticia = [];

     if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
    $erroresvalicionesformularionoticia[] = "Debe subir un archivo PDF.";
} else {

    $nombre = $_FILES['archivo']['name'];
    $tipo = mime_content_type($_FILES['archivo']['tmp_name']);
    $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

    // Validar extension
    if ($extension !== 'pdf') {
        $erroresvalicionesformularionoticia[] = "El archivo debe tener extensión PDF.";
    }

    // Validar si es tipo MIME y es MINE autentico
    if ($tipo !== 'application/pdf') {
        $erroresvalicionesformularionoticia[] = "El archivo no es un PDF válido.";
    }

    // Validar tamaño (hadta un 1 GB)
    if ($_FILES['archivo']['size'] > 1024 * 1024 * 1024) {
        $erroresvalicionesformularionoticia[] = "El archivo no puede superar 1 GB.";
    }
}


    

         $nombrearchivo = time() . "_" . basename($_FILES['archivo']['name']);
       $ruta = "uploads/" . $nombrearchivo;
       move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
       

             if (empty($nivel)){
            $erroresvalicionesformularionoticia[] = "no se puede dejar el nivel vacido";
        }
        if (empty($ano)){
            $erroresvalicionesformularionoticia[] = "no se puede dajar el año vacido";
        }
        if (empty($dni_prfosesor_programacion)){
            $erroresvalicionesformularionoticia[] = "no se puede dejar el profesor vacido";
        }
        
         
      
      
      if (!preg_match('/^[0-9]{4}$/', $ano)){
          $erroresvalicionesformularionoticia[] = "Se requiere 4 caracteres y solo numeros";        

      }
     
  

     if (!empty($erroresvalicionesformularionoticia)){
            echo "<script>window.location.href = 'formulario_programacion_y_noticias.php'</script>";
            exit();
        }    
      

      

       
       $stmt = $conn->prepare("INSERT INTO programacion (anyo, contenido, titulo_programacion)
       VALUES (?, ?, ?)");
       $stmt->bind_param("iss",$ano, $ruta, $nivel);
       //
       if ($stmt->execute()) {
        $id_programacion_intermedio = $conn->insert_id;
        $stmt2 = $conn->prepare("INSERT INTO tabla_profesor_programacion (dni_profesor_intermedio, id_programacion_intermedio)
        VALUES (?, ?)");
        $stmt2->bind_param("si", $dni_prfosesor_programacion, $id_programacion_intermedio);
        if($stmt2->execute()) {
          echo "<script>alert('Programacion guardara');  window.location.href='formulario_programacion_y_noticias.php';</script>";
        } else{  

          $error = addslashes($stmt2->error);
          echo "<script>
                  alert('Programación no guardada o error: $error'); window.location.href='formulario_programacion_y_noticias.php';
                 
                </script>";
                  
              
        }     
        $stmt2->close();  
      } else{
        $error = addslashes($stmt->error);
        echo  "<script>alert('Programación no guardada o error: $error'); window.location.href='formulario_programacion_y_noticias.php';</script>";
      }
              $stmt->close();

    }  
            $stmt->close();

      
    }
  
  

   $conn->close();
    
?>