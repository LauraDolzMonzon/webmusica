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
    if ($dniusuarioinventario == $_POST['usuarioinventario'] ) {
         $sql = "SELECT * FROM profesor WHERE dni = '$dniusuarioinventario' AND contrasenya = '$contrasenainventario'";


    }
    }
    $resultado = mysqli_query($conn, $sql);
    if (mysqli_num_rows($resultado) === 1){
        $_SESSION['dni'] = $dniusuarioinventario;

        header("Location: inventario.php");
    } else {
        header("Location: login_inventario.php");

    }



?>