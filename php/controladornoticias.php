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
        if (empty($Fechainventario)){
            $erroresvalicionesformularionoticiayp[] = "no se puede dajar la fecha vacido";
        }
        if (empty($lugar)){
            $erroresvalicionesformularionoticiayp[] = "no se puede dejar el profesor vacido";
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


        if (!empty($erroresvalicionesformularionoticiayp)){
            echo "<script>window.location.href = 'formulario_programacion_y_noticias.php'</script>";
            exit();
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
       $dni_prfosesor_programacion = $_POST['dni_profesor_todos'];
         $nombrearchivo = time() . "_" . basename($_FILES['archivo']['name']);
       $ruta = "uploads/" . $nombrearchivo;
       move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
       $erroresvalicionesformularionoticia = [];

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
                  alert('Programación no guardada o error: $error'); window.location.href='formulario_programacion_y_noticias.php';;
                 
                </script>";
                  
              
        }       
      }
    }  
      
    }

   $conn->close();
    
?>