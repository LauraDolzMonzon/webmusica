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
    $sql = "SELECT * FROM profesor WHERE dni = '$dniusuarioinventario' AND contrasenya = '$contrasenainventario'";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado && mysqli_num_rows($resultado) === 1){
       $fila = mysqli_fetch_assoc($resultado);
       if ($fila['contrasenya'] === $contrasenainventario) {
            session_regenerate_id(true);
            $_SESSION['dni'] = $fila['dni'];
            header("Location: inventario.php");
            exit();
        }
    } 
    header("Location: login_inventario.php");
    exit(); 
    }
?>