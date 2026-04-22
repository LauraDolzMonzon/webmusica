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
    

    
    $filtroFamilia = $_GET['flitofamilia'] ?? "";
    $filtroUbicacion = $_GET['flitoubicacion'] ?? "";
    $filtroano = $_GET['flitoano'] ?? "";
    $flitounidades = $_GET['flitounidades'] ?? "";

    $sql = "SELECT  dispositivo_acustico, familia, ubicacion, anyo_de_adquisicion, unidades FROM instrumento WHERE 1=1";
    if ($filtroFamilia != ""){
        $sql .= " AND familia = '$filtroFamilia'";
    }
    if ($filtroUbicacion != ""){
        $sql .= " AND ubicacion = '$filtroUbicacion'";
    }
    $order = [];
    if ($filtroano == "asc") {
      $order[] = "anyo_de_adquisicion ASC";
    } elseif ($filtroano == "desc") {
      $order[] = "anyo_de_adquisicion DESC";
}

   if ($flitounidades == "asc") {
    $order[] = "unidades ASC";
    } elseif ($flitounidades == "desc") {
        $order[] = "unidades DESC";
    }
    if (empty($order)) {
    $order[] = "dispositivo_acustico ASC";
}
    $sql .= " ORDER BY " . implode(", ", $order);   
    $resutadofiltro = $conn->query($sql);
    if (!$resutadofiltro){
        die("Error en la consulta: " . $conn->error);
    }
    $_SESSION['resultado_filtro'] = $resutadofiltro->fetch_all(MYSQLI_ASSOC);
    header("Location: inventario.php?familia=$filtroFamilia&ubicacion=$filtroUbicacion&ano=$filtroano");
    exit();

    ?> 