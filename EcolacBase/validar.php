<?php
session_start();
if (isset($_SESSION["id"])) {
    header("Location: /EcolacBase/index.php"); 
    exit();
}


// Obtener el tipo de usuario
$tipoUsuario = $_SESSION["tipo_usuario"];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecolac";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para verificar la información de inicio de sesión y obtener el tipo de usuario
    $sql = "SELECT u.id, u.nombres, u.usuario, u.contrasenia, c.descripcion AS tipo
        FROM usuarios u
        JOIN cargo c ON u.id_cargo = c.id
        WHERE u.usuario = '$usuario' AND u.contrasenia = '$contrasenia'";
    
    // Imprimir la consulta para depurar
    echo "Consulta SQL: $sql";

    $result = $conn->query($sql);

    // Verificar si se encontraron coincidencias
    if ($result && $result->num_rows > 0) {
        // Inicio de sesión exitoso
        $row = $result->fetch_assoc();
        $tipoUsuario = $row["tipo"];
        //guardar los datos 
        $_SESSION["id_usuario"] = $row["id"];
        $_SESSION["nombre_usuario"] = $row["nombres"];
        $_SESSION["tipo_usuario"] = $tipoUsuario;

        if ($tipoUsuario == "cliente") {
            header("Location: /EcolacBase/secciones/vista_quejas.php");
            exit();
        } elseif ($tipoUsuario == "Administrador") {
            header("Location: /EcolacBase/admin/indexAdmin.php");
            exit();
        }else{
            header("Location: /EcolacBase/acceso_denegado.php");
        exit();
        }
        
    } else {
        // No se encontraron coincidencias, mostrar mensaje de error
        ob_start();
        echo "Inicio de sesión fallido. Verifique sus credenciales.";
        ob_end_flush();
        $conn -> close();
        header("Location: /EcolacBase/index.php");
        exit();
    }
}else{
    if(!isset($_SESSION[id])){
        header("Location: /EcolacBase/index.php");
        exit();
    }
}
    // Cerrar la conexión
    $conn->close();

?>
