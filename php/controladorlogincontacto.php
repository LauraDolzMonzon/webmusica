<?php
  session_start();
  $servidor = "127.0.0.1";
  $basededatos = "webmusica";
  $usuario = "root";
  $contrasenna = "";
  $conn = new mysqli($servidor, $usuario, $contrasenna, $basededatos);
  If ($conn->connect_error) {
    die("error de conexion" . $conn->connect_error);
  }
  
    $usuariologin_contactovalicionphp = trim($_POST['usuario']);
    $contrasenyaologin_contactovalicionphp = trim($_POST['contrasenya']);
  if (empty($usuariologin_contactovalicionphp)){
    $erroresvaliciones[] = "El usuario no puede esta vacido controladorlogincontacto";
  }
  if (!preg_match('/^[A-Z0-9]{9}$/', $usuariologin_contactovalicionphp)){
     $erroresvaliciones[] = "Se requiere 8 números y una letra mayúscula controladorlogincontacto";
  }
  if (strlen($contrasenyaologin_contactovalicionphp) < 8){
    $erroresvaliciones[] = "Se requiere como mínimo 8 caracteres controladorlogincontacto";
  }
  if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $usuarioicontacto = trim($_POST['usuarioicontacto']);
    $contrasenacontacto = trim($_POST['contrasenacontacto']);
    $sqlbanderaconctato = "SELECT dni, contrasenya, rol FROM profesor WHERE dni = '$usuarioicontacto'";
    $resultadobanderaconctato = mysqli_query($conn, $sqlbanderaconctato);
    if ($resultadobanderaconctato &&  mysqli_num_rows($resultadobanderaconctato) === 1){
        $filasbandejacontacto = mysqli_fetch_assoc($resultadobanderaconctato);
        if ($filasbandejacontacto['contrasenya'] === $contrasenacontacto && $filasbandejacontacto['rol'] === 'admin'){
            session_regenerate_id(true);
            $_SESSION['dni'] = $filasbandejacontacto['dni'];
            $_SESSION['rol'] = $filasbandejacontacto['rol'];
            header("Location: bandeja_de_contacto.php");
            exit();
       }
    }  
    header("Location: login_bandeja_contacto.php");
    exit();
    
  }
?>