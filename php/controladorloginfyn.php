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
    $usuariofyp = trim($_POST['usuariofyp']);
    $contrasenafyp = trim($_POST['contrasenafyp']);
    $erroresvalicionesloginfyn = [];

    if (empty($usuariofyp)){
          $erroresvalicionesloginfyn[] = "El usuario no puede esta vacido ";


    }
    if (!preg_match('/^[A-Z0-9]{9}$/', $usuariofyp)){
      $erroresvalicionesloginfyn[] = "Se requiere 8 números y una letra mayúscula  ";
    }
    if (strlen($contrasenafyp) < 8){
      $erroresvalicionesloginfyn[] = "Se requiere como mínimo 8 caracteres ";
    }
    if (!empty($erroresvalicionesloginfyn)){
       echo "<script>window.history.back();</script>";
       exit();
    }
              
    $sql2 = "SELECT dni, contrasenya, rol FROM profesor WHERE dni = '$usuariofyp'";
    $resultado2 = mysqli_query($conn, $sql2);
    if ($resultado2 && mysqli_num_rows($resultado2) === 1) {
        $fila2 = mysqli_fetch_assoc($resultado2);
       if ($fila2['contrasenya'] === $contrasenafyp && $fila2['rol'] === 'admin') {
            session_regenerate_id(true);
            $_SESSION['dni'] = $fila2['dni'];
            $_SESSION['rol'] = $fila2['rol'];
            header("Location: formulario_programacion_y_noticias.php");
            exit();
        }
    } 
    header("Location: login_formulario_noticias_y_programacion.php");

    exit();  
  }
?>