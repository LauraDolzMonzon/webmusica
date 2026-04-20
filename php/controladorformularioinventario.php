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
     $rolespermitidofi = ['admin'];
      if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
          session_unset();
          session_destroy();
          header("Location: login_formulario_inventario.php");
          exit();
    }
  function validarInventario() {

    $erroresFormularioInventario = [];

    if (empty($_POST['Intrumetroivenatario'])) {
        $erroresFormularioInventario[] = "El campo Instrumento no puede estar vacío.";
    } elseif (!preg_match("/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]+$/u", $_POST['Intrumetroivenatario'])) {
        $erroresFormularioInventario[] = "El instrumento solo puede contener letras, espacios y acentos.";
    }

    $familias_validas = ["sinespecificarfamilia", "vientometral", "vientomadera", "pesucion", "cuerda"];
    if (empty($_POST['invetariofamilia'])) {
        $erroresFormularioInventario[] = "Debes seleccionar una familia.";
    } elseif (!in_array($_POST['invetariofamilia'], $familias_validas)) {
        $erroresFormularioInventario[] = "La familia seleccionada no es válida.";
    }

    $ubicaciones_validas = ["sinespecificarubicacion", "RMU1", "RMU2", "En varias aulas"];
    if (empty($_POST['ivetarioubicacion'])) {
        $erroresFormularioInventario[] = "Debes seleccionar una ubicación.";
    } elseif (!in_array($_POST['ivetarioubicacion'], $ubicaciones_validas)) {
        $erroresFormularioInventario[] = "La ubicación seleccionada no es válida.";
    }

    if (empty($_POST['invetariounidades'])) {
        $erroresFormularioInventario[] = "El campo Unidades no puede estar vacío.";
    } elseif (!preg_match("/^[0-9]+$/", $_POST['invetariounidades'])) {
        $erroresFormularioInventario[] = "Las unidades deben ser solo números.";
    }

    if (empty($_POST['invetarioanodeadquision'])) {
        $erroresFormularioInventario[] = "El campo Año de adquisición no puede estar vacío.";
    } elseif (!preg_match("/^[0-9]{4}$/", $_POST['invetarioanodeadquision'])) {
        $erroresFormularioInventario[] = "El año debe tener exactamente 4 números.";
    }
    
    

    return $erroresFormularioInventario;
}

   

    $instrumentoEditar = null;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      


         if (!empty($_POST['id_editar'])){
          $id = intval($_POST['id_editar']);
          $instrumentoEditarupdate = ($_POST['Intrumetroivenatario']);
          $familiaEditarupdate = ($_POST['invetariofamilia']);
          $ubicacionEditarupdate = ($_POST['ivetarioubicacion']);
          $unidadesupdate = ($_POST['invetariounidades']);
          $invetarioanodeadquision = ($_POST['invetarioanodeadquision']);
          $erroresFormularioInventario = validarInventario();

          if (!empty($erroresFormularioInventario)) {
              $_SESSION['erroresFormularioInventario'] = $erroresFormularioInventario;
              header("Location: formulario_inventario.php");
              exit();
          }

          $sqlupdate = "UPDATE instrumento SET dispositivo_acustico='$instrumentoEditarupdate', familia='$familiaEditarupdate',  ubicacion='$ubicacionEditarupdate',   unidades='$unidadesupdate',  anyo_de_adquisicion='$invetarioanodeadquision'  WHERE id_instrumento=$id ";
          if ($conn->query($sqlupdate)){
            echo "<script>alert('Instrumento actualizado correctamente'); window.location.href='formulario_inventario.php';</script>"; 


          } else{
             echo "<script>alert('Instrumento no actualizado correctamente'); window.location.href='formulario_inventario.php';</script>";
          }
          exit();
          }
      if (isset($_POST['formularioinvetariopricipal'])&& empty($_POST['id_editar'])){
          $Intrumetroivenatario = trim($_POST['Intrumetroivenatario']);
          $invetariofamilia = trim($_POST['invetariofamilia']);
          $ivetarioubicacion = trim($_POST['ivetarioubicacion']);
          $invetariounidades = trim($_POST['invetariounidades']);
          $invetarioanodeadquision = trim($_POST['invetarioanodeadquision']);
          $dni_formularioinvetario = $_SESSION['dni'];
          $erroresvaliconesformularioinvetario = [];
          $erroresFormularioInventario = validarInventario();

          if (!empty($erroresFormularioInventario)) {
              $_SESSION['erroresFormularioInventario'] = $erroresFormularioInventario;
              header("Location: formulario_inventario.php");
              exit();
          }

          
          $sqlcontroladorformularioinvetario ="INSERT INTO instrumento (dispositivo_acustico, familia, ubicacion, unidades, anyo_de_adquisicion, dni_profesor_instrumento)
          VALUES ('$Intrumetroivenatario', '$invetariofamilia', '$ivetarioubicacion', '$invetariounidades', '$invetarioanodeadquision', '$dni_formularioinvetario')";
          if(mysqli_query($conn, $sqlcontroladorformularioinvetario)){
            echo "<script>alert('Instumeto guardado'); window.location.href = 'formulario_inventario.php'; </script>";
          } else{
            echo "<script>alert('instrumeto no guardado o error ". $conn->error ."'); window.location.href = 'formulario_inventario.php'; </script>";
          }
    }
    if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {

        $id_instrumento = $_POST['id_instrumento'];
        if (isset($id_instrumento) && is_numeric($id_instrumento)){
        
          $sqleliminar = "DELETE FROM instrumento WHERE id_instrumento = $id_instrumento";
          if (mysqli_query($conn, $sqleliminar)){
             echo "<script>alert('Instrumento eliminado correctamente'); window.location.href = 'formulario_inventario.php';</script>";
                } else {
                    echo "<script>alert('Error al eliminar el instrumento: " . $conn->error . "'); window.location.href = 'formulario_inventario.php';</script>";
          }
        }

      }
        if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
        $id = $_POST['id_instrumento'];
        $sqleditar = "SELECT * FROM instrumento WHERE id_instrumento = $id";
        $resultadoeditar = $conn->query($sqleditar);
        if ($resultadoeditar->num_rows == 1) {
          $instrumentoEditar = $resultadoeditar->fetch_assoc();
                  echo "<script>alert('Editando instrumento: " . $instrumentoEditar['dispositivo_acustico'] . "'); window.location.href = 'formulario_inventario.php?id_editar=$id';</script>";
        } else{
          echo "<script>alert('No se puede editar eñ instrumento');   window.location.href = 'formulario_inventario.php';</script>";
        }
        }


  
   }
$conn->close();

?>