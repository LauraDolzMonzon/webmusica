<?php
    $servidor = "127.0.0.1";
    $basededatos = "webmusica";
    $useario = "root";
    $contrasenna = "";
    $conn = new mysqli($servidor, $useario, $contrasenna, $basededatos);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($conn->connect_error){
        die("error de conexion" . $conn->connect_error);
    }    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['accionnyf']) && $_POST['accionnyf'] == 'noticiaeliminar'){
            $id_noticia =  $_POST['id_noticia'];
        }
            if (isset($id_noticia) && is_numeric($id_noticia)){
            

            
            $sqleliminarnoticia = "DELETE FROM noticia WHERE id_noticia = $id_noticia";
            if (mysqli_query($conn, $sqleliminarnoticia)){
                echo "<script>alert('Noticia eliminada correctamente'); window.location.href = 'formulario_programacion_y_noticias.php';</script>";
                    exit();
                } else {
                        echo "<script>alert('Error al eliminar la noticia: " . $conn->error . "'); window.location.href = 'formulario_programacion_y_noticias.php';</script>";
                        exit();
                }
           }
        if (isset($_POST['accionnyf']) && $_POST['accionnyf'] =='programacionaeliminar' ){
            $id_programacion = $_POST['id_programacion'];
            if (isset($id_programacion) && is_numeric($id_programacion)){
                $sqlelimarprogramacion = "DELETE FROM programacion WHERE id_programacion = $id_programacion";
                
                if (mysqli_query($conn, $sqlelimarprogramacion)){
                echo "<script>alert('Programación eliminada correctamente'); window.location.href = 'formulario_programacion_y_noticias.php';</script>";
                    exit();
                } else {
                        echo "<script>alert('Error al eliminar la programación: " . $conn->error . "'); window.location.href = 'formulario_programacion_y_noticias.php';</script>";
                        exit();
                }
            }
        }  
    
        $conn->close();
    }
?>