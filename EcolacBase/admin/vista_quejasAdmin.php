<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <title>Ecolac</title>
    <link rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            padding-top: 20px;
            flex-shrink: 0;
            margin-right: 50px;
        }

        #content {
            flex: 1;
            padding: 20px;
        }

        .menu-item {
            padding: 30px;
            text-decoration: none;
            color: #fff;
            display: block;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #555;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px;
            margin-bottom: 50px;
        }

        .card-body label {
            display: block;
            margin-bottom: 15px;
        }

        .card-body input {
            width: 25%;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 18px;
        }

        .btn-group .btn {
            margin: 5px;
        }

        .table-primary {
            border-collapse: collapse;
            width: 100%;
            text-align: left;
        }

        .table-primary th {
            background-color: #007bff;
            color: white;
            padding: 20px;
        }

        .table-primary td {
            border: 1px solid #ddd;
            padding: 25px;
        }

        .table-primary tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-primary tr:hover {
            background-color: #ddd;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            #sidebar {
                display: none;
            }

            #content {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <nav id="sidebar" class="sidebar">
        <a href="indexAdmin.php" class="menu-item">Inicio</a>
        <a href="vista_distribuidorAdmin.php" class="menu-item">Distribuidores</a>
        <a href="vista_quejasAdmin.php" class="menu-item">Devoluciones</a>
        <a href="vista_perfilAdmin.php" class="menu-item">Perfil</a>
        <a href="sesionOut.php" class="menu-item">Cerrar sesión</a>
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <br />
                <div class="row">
                    <div class="col-5">
                        <form action="" method="post">
                            <div class="card">
                                <div class="card-header">
                                    Quejas Recibidas
                                </div>
                                <div class="card-body">
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "ecolac";

                                    // Conexión a la base de datos
                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Verifica la conexión
                                    if ($conn->connect_error) {
                                        die("Conexión fallida: " . $conn->connect_error);
                                    }

                                    // Verifica si se ha recibido una solicitud POST (para actualizar el estado)
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        // Recibe la actualización del estado de una queja
                                        $queja_id = $_POST['id'];
                                        $nuevo_estado = $_POST['estado'];

                                        // Actualiza el estado de la queja en la base de datos
                                        $stmt = $conn->prepare("UPDATE quejas SET estado = ? WHERE id = ?");
                                        $stmt->bind_param("si", $nuevo_estado, $queja_id);
                                        $stmt->execute();
                                        $stmt->close();
                                        echo "Estado actualizado correctamente";
                                    }

                                    // Obtiene las quejas almacenadas
                                    $result = $conn->query("SELECT * FROM quejas");

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "ID: " . $row["id"] . "<br>";
                                            echo "Fecha: " . $row["fecha"] . "<br>";
                                            echo "Producto: " . $row["producto"] . "<br>";
                                            echo "Unidad de Medida: " . $row["uMedida"] . "<br>";
                                            echo "Caducado: " . $row["caducado"] . "<br>";
                                            echo "Mal Sellado: " . $row["mal_sellado"] . "<br>";
                                            echo "Presentación: " . $row["presentacion"] . "<br>";
                                            echo "Contaminación: " . $row["contaminado"] . "<br>";
                                            echo "Estado: " . $row["estado"] . "<br>";

                                            // Agregar formulario para actualizar el estado
                                            echo "<form method='post' action='vista_quejasAdmin.php'>";
                                            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                            echo "<label for='nuevoEstado'>Nuevo Estado:</label>";
                                            echo "<select name='estado'>";
                                            echo "<option value='pendiente'>Pendiente</option>";
                                            echo "<option value='resuelto'>Resuelto</option>";
                                            echo "<option value='En_proceso'>En Proceso</option>";
                                            echo "</select>";
                                            echo "<button type='submit'>Actualizar Estado</button>";
                                            echo "</form>";

                                            echo "<hr>";
                                        }
                                    } else {
                                        echo "No hay quejas almacenadas";
                                    }

                                    // Cierra la conexión a la base de datos
                                    $conn->close();
                                    ?>



                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>



    </div>
    </div>

    <?php include('../template/pie.php'); ?>