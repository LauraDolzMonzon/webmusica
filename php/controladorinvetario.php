<?php
    session_start();
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $usuario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $usuario, $contrasenna, $basededatos);
    if ($conn->connect_error){
    die("error de conexion" . $conn->connect_error);
    } 
   
    
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
      $usuariologinformularioinventario = trim($_POST['usuariologinformularioinventario']);
      $contrasenaloginformularioinventario = trim($_POST['contrasenaloginformularioinventario']);
      $erroresvalicioneslogininvetario = [];

       if (empty($usuariologinformularioinventario)){
        $erroresvalicioneslogininvetario[] = "El usuario no puede esta vacido ";
      }
      if (!preg_match('/^[A-Z0-9]{9}$/', $usuariologinformularioinventario)){
        $erroresvalicioneslogininvetario[] = "Se requiere 8 números y una letra mayúscula ";
      }
      if (strlen($contrasenaloginformularioinventario) < 8){
        $erroresvalicioneslogininvetario[] = "Se requiere como mínimo 8 caracteres ";
      }
      if (empty($contrasenaloginformularioinventario)){
       $erroresvalicioneslogininvetario = "contraseña vacida"; 
      }

    
      if (!empty($erroresvalicioneslogininvetario)){
       echo "<script>window.history.back();</script>";
       exit();
      }
        
              
     
      $sql3 = "SELECT dni, contrasenya, rol FROM profesor WHERE dni = '$usuariologinformularioinventario'";
      $stmt = $conn->prepare($sql3);
      $stmt->execute();
      $resultado3 = $stmt->get_result();
      if (!$resultado3) {
        die("Error en la consulta: " . $conn->error);
    }
      if ($resultado3 && mysqli_num_rows($resultado3) === 1){
        $fila3 = mysqli_fetch_assoc($resultado3);
        if ($fila3['contrasenya'] === $contrasenaloginformularioinventario && $fila3['rol'] === 'admin'){
            session_regenerate_id(true);
            $_SESSION['dni'] = $fila3['dni'];
            $_SESSION['rol'] = $fila3['rol'];
            header("Location: formulario_inventario.php");
            exit();
        }
      } 
    header("Location: login_formulario_inventario.php");
    exit();
    }
    $conn->close();
?>