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
  
   
 
  if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $usuarioicontacto = trim($_POST['usuarioicontacto']);
    $contrasenacontacto = trim($_POST['contrasenacontacto']);
    $erroresvalicioneslongicontacto = [];

     if (empty($usuarioicontacto)){
    $erroresvalicioneslongicontacto[] = "El usuario no puede esta vacido ";

    }
    if (!preg_match('/^[A-Z0-9]{9}$/', $usuarioicontacto)){
      $erroresvalicioneslongicontacto[] = "Se requiere 8 números y una letra mayúscula ";
    }
    if (strlen($contrasenacontacto) < 8){
      $erroresvalicioneslongicontacto[] = "Se requiere como mínimo 8 caracteres ";
    }
   if (!empty($erroresvalicioneslongicontacto)){
       echo "<script>window.history.back();</script>";
       exit();
      }
                  
    $sqlbanderaconctato = "SELECT dni, contrasenya, rol FROM profesor WHERE dni = ?";

    $stmt = $conn->prepare($sqlbanderaconctato);
    $stmt->bind_param("s", $usuarioicontacto);

    $stmt->execute();


    $resultadobanderaconctato = $stmt->get_result();
    if (!$resultadobanderaconctato) {
      die("Error en la consulta: " . $conn->error);
    }
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
  $conn->close();
?>