<?php
include 'quejas.php';
?>
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
        <a href="index.php" class="menu-item">Inicio</a>
        <!-- <a href="vista_distribuidor.php" class="menu-item">Distribuidores</a> -->
        <a href="vista_quejas.php" class="menu-item">Devoluciones</a>
        <a href="vista_perfil.php" class="menu-item">Perfil</a>
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
                                    Quejas
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="" class="form-label">ID</label>
                                        <input type="hidden" class="form-control" name="id" id="id"value="<?php echo $id; ?>"
                                            aria-describedby="helpId" placeholder="ID">

                                        <label for="fecha_emision" class="form-label mt-3">Fecha de Emisión</label>
                                        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>"
                                            placeholder="Fecha de Emisión" aria-describedby="helpId">
                                    </div>

                                    <div class="mb-4">
                                        <label for="nombre_producto" class="form-label">Producto</label>
                                        <input type="text" class="form-control" name="producto" id="producto" value="<?php echo $producto; ?>"
                                            placeholder="Producto" aria-describedby="helpId">

                                        <label for="unidad_medida" class="form-label mt-3">Unidad de Medida</label>
                                        <input type="text" class="form-control" name="uMedida" id="uMedida" value="<?php echo $uMedida; ?>"
                                            placeholder="Unidad de Medida" aria-describedby="helpId">
                                    </div>
                                    <!--checkbox para elegir -->
                                    <div class="mb-4">
                                        <label class="form-check-label"> Caducado
                                            <input type="checkbox" class="form-check-input" name="tipo_devolucion[]"
                                                value="CADUCADO" value="<?php echo $caducado; ?>">
                                        </label>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-check-label"> Mal Sellado
                                            <input type="checkbox" class="form-check-input" name="tipo_devolucion[]"
                                                value="MAL SELLADO" value="<?php echo $malSellado; ?>">
                                        </label>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-check-label"> Presentación
                                            <input type="checkbox" class="form-check-input" name="tipo_devolucion[]"
                                                value="PRESENTACIÓN" value="<?php echo $presentacion; ?>">
                                        </label>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-check-label"> Contaminado
                                            <input type="checkbox" class="form-check-input" name="tipo_devolucion[]"
                                                value="CONTAMINADO" value="<?php echo $contaminado; ?>">
                                        </label>
                                    </div>

                                    <div class="btn-group" role="group" aria-label="Button group name">
                                        <button type="submit" name="accion" value="agregar"
                                            class="btn btn-success">Agregar</button>
                                        <button type="submit" name="accion" value="editar"
                                            class="btn btn-primary" >Editar</button>
                                        <button type="submit" name="accion" value="eliminar"
                                            class="btn btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">UNID.MED</th>
                            <th scope="col">TIPO DE DEVOLUCIÓN</th>
                            <th scope="col">CADUCADO</th>
                            <th scope="col">MAL SELLADO</th>
                            <th scope="col">PRESENTACIÓN</th>
                            <th scope="col">CONTAMINADO</th>
                            <th scope="col">Opc</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listaQuejas as $quejas) { ?>
                            <tr>
                                <td>
                                    <?php echo $quejas['id']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['fecha']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['producto']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['uMedida']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['caducado']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['mal_sellado']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['presentacion']; ?>
                                </td>
                                <td>
                                    <?php echo $quejas['contaminado']; ?>
                                </td>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" id="id" value=" <?php echo $quejas['id']; ?>" />
                                    <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                                </form>
                                </td>
                                <td>
                                    <?php echo $quejas['estado']; ?>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

    <?php include('../template/pie.php'); ?>