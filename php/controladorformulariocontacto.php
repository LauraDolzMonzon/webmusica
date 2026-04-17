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
    $rolpermetidoformulariocontacto = ["admin"];
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin' ){
        session_unset();
        session_destroy();
        header("Location: login_bandeja_contacto.php");
        exit(); 
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $emailcontacto = trim($_POST['emailcontacto']);
        $asuntocontacto = trim($_POST['asuntocontacto']);
        $enviartextos = trim($_POST['enviartextos']);
        $dni_conacto = '00000000A';
        $erroresvalicionesformulariocontratos = [];
        if (empty($emailcontacto)){
            $erroresvalicionesformulariocontratos = "no se puede dejar el email vacido";
        }
        if (empty($asuntocontacto)){
            $erroresvalicionesformulariocontratos = "no se puede dajar el asunto vacido";
        }
        if (empty($enviartextos)){
            $erroresvalicionesformulariocontratos = "no se puede dejar el texto vacido";
        }
        if (!empty($erroresvalicionesformulariocontratos)){
            echo "<script>window.history.back();</script>";
            exit();
        }

        $sqlcontatoformulario = "INSERT INTO contacto (email, asunto, texto_contenido, dni_profesor_contacto) 
        VALUES ('$emailcontacto', '$asuntocontacto', '$enviartextos', '$dni_conacto')";
        if (mysqli_query($conn, $sqlcontatoformulario)){
            echo "<script>alert('Email enviado'); window.location.href = 'formulario_contacto.php'</script>"; 
        } else {
           echo "<script>alert('Email no enviado'); window.location.href = 'formulario_contacto.php'</script>";  
        }

    }