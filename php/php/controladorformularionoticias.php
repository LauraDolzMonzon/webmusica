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
        $sqlcontatoformulario = "INSERT INTO contacto (email, asunto, texto_contenido) 
        VALUES ('$emailcontacto', '$asuntocontacto', '$enviartextos')";
        if (mysqli_query($conn, $sqlcontatoformulario)){
            echo "<script>alert('Email enviado'); window.location.href = 'formulario_contacto.php'</script>"; 
        } else {
           echo "<script>alert('Email no enviado'); window.location.href = 'formulario_contacto.php'</script>";  
        }

    }