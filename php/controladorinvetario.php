<?php
    session_start();
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $usuario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $usuario, $contrasenna, $basededatos);
    if ($conn->connect_error){
    die("error de conexion" . $conn->connect_error);
    $usuariologin_iventarioformulariovalicionphp = trim($_POST['usuario']);
    $contrasenyaologin_iventarioformulariovalicionphp = trim($_POST['contrasenya']);
  if (empty($usuariologin_iventarioformulariovalicionphp)){
    $erroresvaliciones[] = "El usuario no puede esta vacido controladorinvetario";
  }
  if (!preg_match('/^[A-Z0-9]{9}$/', $usuariologin_iventarioformulariovalicionphp)){
     $erroresvaliciones[] = "Se requiere 8 números y una letra mayúscula controladorinvetario";
  }
  if (strlen($contrasenyaologin_iventarioformulariovalicionphp) < 8){
    $erroresvaliciones[] = "Se requiere como mínimo 8 caracteres controladorinvetario";
  }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
      $usuariologinformularioinventario = trim($_POST['usuariologinformularioinventario']);
      $contrasenaloginformularioinventario = trim($_POST['contrasenaloginformularioinventario']);
      
     
      $sql3 = "SELECT dni, contrasenya, rol FROM profesor WHERE dni = '$usuariologinformularioinventario'";
      $resultado3 = mysqli_query($conn, $sql3);
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
?>