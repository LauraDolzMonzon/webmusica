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
    if (!empty($filtroFamilia != "")){
        $sql .= " AND familia = '$filtroFamilia'";
    }
    if (!empty($filtroUbicacion != "")){
        $sql .= " AND ubicacion = '$filtroUbicacion'";
    }
    $order = " ORDER BY dispositivo_acustico ASC";
    if (!empty($filtroano == "asc")) {
        $order = " ORDER BY anyo_de_adquisicion ASC";
    } elseif (!empty($filtroano == "desc")) {
        $order = " ORDER BY anyo_de_adquisicion DESC";
    } else {
        $order = " ORDER BY dispositivo_acustico ASC";
    }

    if (!empty($flitounidades == "asc")) {
        $order = " ORDER BY unidades ASC";
    } elseif (!empty($flitounidades == "desc")) {
        $order = " ORDER BY unidades DESC";
    }
    $sql .= $order;
   
    $resutadofiltro = $conn->query($sql);
    $_SESSION['resultado_filtro'] = $resutadofiltro->fetch_all(MYSQLI_ASSOC);
    header("Location: inventario.php?familia=$filtroFamilia&ubicacion=$filtroUbicacion&ano=$filtroano");
    exit();

    ?> 