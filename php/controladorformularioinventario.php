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
        $Intrumetroivenatario = trim($_POST['Intrumetroivenatario']);
        $invetariofamilia = trim($_POST['invetariofamilia']);
        $ivetarioubicacion = trim($_POST['ivetarioubicacion']);
        $invetariounidades = trim($_POST['invetariounidades']);
        $invetarioanodeadquision = trim($_POST['invetarioanodeadquision']);
        $dni_formularioinvetario = $_SESSION['dni'];
        var_dump($_SESSION['dni']);
        $sqlcontroladorformularioinvetario ="INSERT INTO instrumento (dispositivo_acustico, familia, ubicacion, unidades, anyo_de_adquisicion, dni_profesor_instrumento)
        VALUES ('$Intrumetroivenatario', '$invetariofamilia', '$ivetarioubicacion', '$invetariounidades', '$invetarioanodeadquision', '$dni_formularioinvetario')";
        if(mysqli_query($conn, $sqlcontroladorformularioinvetario)){
          echo "<script>alert('Instumeto guardado'); window.location.href = 'formulario_inventario.php'; </script>";
        } else{
          echo "<script>alert('instrumeto no guardado o error'); window.location.href = 'formulario_inventario.php'; </script>";
    }
 }

?>