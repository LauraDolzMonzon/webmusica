<?php
    session_start();
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $useario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $useario, $contrasenna, $basededatos);
    if ($conn->connect_error){
        die("error de conexion" . $conn->connect_error);
    }
 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $emailcontacto = trim($_POST['emailcontacto']);
        $asuntocontacto = trim($_POST['asuntocontacto']);
        $enviartextos = trim($_POST['enviartextos']);
        $dni_conacto = '00000000A';
        $erroresvalicionesformulariocontratos = [];
        if (empty($emailcontacto)){
            $erroresvalicionesformulariocontratos[] = "No se puede dejar el email vacío";
        }
        if (empty($asuntocontacto)){
            $erroresvalicionesformulariocontratos[] = "No se puede dajar el asunto vacío";
        }
        if (empty($enviartextos)){
            $erroresvalicionesformulariocontratos[] = "No se puede dejar el texto vacío";
        }
        if (!empty($erroresvalicionesformulariocontratos)){
            echo "<script>window.location.href = 'formulario_contacto.php';</script>";
            exit();
        }

        $sqlcontatoformulario = "INSERT INTO contacto (email, asunto, texto_contenido, dni_profesor_contacto) 
        VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlcontatoformulario);
        if ($stmt === false){
            die("Error en la consulta prerada(); " . $conn->connect_error);
        }
        $stmt->bind_param("ssss", $emailcontacto, $asuntocontacto, $enviartextos, $dni_conacto);

        if ($stmt->execute()){
            echo "<script>alert('Email enviado'); window.location.href = 'formulario_contacto.php';</script>";
            exit(); 
        } else {
           echo "<script>alert('Email no enviado'); window.location.href = 'formulario_contacto.php';</script>";  
           exit();
        }

    }
    $stmt->close();    