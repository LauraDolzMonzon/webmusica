<?php
    session_start();
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $useario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $useario, $contrasenna, $basededatos);
    if ($conn->connect_error){
        die ("error de conexion" . $conn->connect_error);
    }
    
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dniusuarioinventario = trim($_POST['usuarioinventario']);
    $contrasenainventario = trim($_POST['contrasenainventario']);
    $erroresvalicionescontrolador = [];

      if (empty($dniusuarioinventario)){
        $erroresvalicionescontrolador[] = "El usuario no puede esta vacido controlador";
      }
      if (!preg_match('/^[A-Z0-9]{9}$/', $dniusuarioinventario)){
        $erroresvalicionescontrolador[] = "Se requiere 8 números y una letra mayúscula controlador";
      }
      if (strlen($contrasenainventario) < 8){
        $erroresvalicionescontrolador[] = "Se requiere como mínimo 8 caracteres controlador";
      }   
      if (!empty($erroresvalicionescontrolador)){
          echo "<script>window.location.href = 'login_inventario.php';</script>";
          exit();
      }      
    $rolespermitido = ['admin', 'profesor'];
   
    $sql = "SELECT  dni, contrasenya, rol FROM profesor WHERE dni = '$dniusuarioinventario' AND contrasenya = '$contrasenainventario'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $resultado = $stmt->get_result();
    if (!$resultado) {
      die("Error en la consulta: " . $conn->error);
    }
    if ($resultado && mysqli_num_rows($resultado) === 1){
       $fila = mysqli_fetch_assoc($resultado);
      if ($fila['contrasenya'] === $contrasenainventario && in_array($fila['rol'], $rolespermitido)) {
            session_regenerate_id(true);
            $_SESSION['dni'] = $fila['dni'];
            $_SESSION['rol'] = $fila['rol'];
            header("Location: inventario.php");
            exit();
        }
    } 
    header("Location: login_inventario.php");
    exit();
    
    }
  $conn->colse();  
?>