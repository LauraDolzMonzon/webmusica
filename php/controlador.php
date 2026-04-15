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
  $usuariologin_invetariovalicionphp = trim($_POST['usuario']);
    $contrasenyaologin_invetariovalicionphp = trim($_POST['contrasenya']);
  if (empty($usuariologin_invetariovalicionphp)){
    $erroresvaliciones[] = "El usuario no puede esta vacido controlador";
  }
  if (!preg_match('/^[A-Z0-9]{9}$/', $usuariologin_invetariovalicionphp)){
     $erroresvaliciones[] = "Se requiere 8 números y una letra mayúscula controlador";
  }
  if (strlen($contrasenyaologin_invetariovalicionphp) < 8){
    $erroresvaliciones[] = "Se requiere como mínimo 8 caracteres controlador";
  }   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dniusuarioinventario = trim($_POST['usuarioinventario']);
    $contrasenainventario = trim($_POST['contrasenainventario']);
    $rolespermitido = ['admin', 'profesor'];
   
    $sql = "SELECT  dni, contrasenya, rol FROM profesor WHERE dni = '$dniusuarioinventario' AND contrasenya = '$contrasenainventario'";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado && mysqli_num_rows($resultado) === 1){
       $fila = mysqli_fetch_assoc($resultado);
       if ($fila['contrasenya'] === $contrasenainventario && $fila['rol'] == in_array($fila['rol'], $rolespermitido)) {
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
?>