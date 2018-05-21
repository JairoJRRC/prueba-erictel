<?php session_start(); ?>
<html>
<head>
    <title>Erictel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="col-lg-10 offset-lg-2" content-wrapper”>
    <h3 class=”text-primary”>Información de base de datos: </h3>
    <div class=”row”>
        <div class="col-lg-12">
            <div class=”card”>
                <div class=”card-block”>
                    <table class="table">
                        <thead>
                        <tr class=”text-primary”>
                            <th>#</th>
                            <th>Id</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Ciudad</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Fecha de nacimiento</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php
                        $exportData = [];
                        $sql = "SELECT * from usuario_datos";
                        $connectionInfo = array(
                            "Database" => "DB_ERICTEL",
                            "UID" => $_SESSION['user'],
                            "PWD" => $_SESSION['password']
                        );
                        $conn = sqlsrv_connect($_SESSION['serverName'], $connectionInfo);
                        $stmt = sqlsrv_query($conn, $sql);

                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

                            ?>
                            <tbody>
                            <tr>
                                <th scope="row">
                                </th>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td>
                                    <?php echo utf8_decode($row['name']); ?>
                                </td>
                                <td>
                                    <?php echo utf8_decode($row['last_name']); ?>
                                </td>
                                <td>
                                    <?php echo $row['city']; ?>
                                </td>
                                <td>
                                    <?php echo $row['email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['cellphone']; ?>
                                </td>
                                <td>
                                    <?php echo $row['birth_date']; ?>
                                </td>
                                <td>

                                    <a href=<?php echo "formulario.php?id=" . $row['id'] . ""; ?> class="btn btn-info
                                       btn-md" role="button">Editar</a>
                                    <a href=<?php echo "../UserManagement.php?delete=true&id=" . $row['id'] . ""; ?> class="btn
                                       btn-danger btn-md" role="button">Eliminar</a>

                                </td>
                            </tr>
                            </tbody>
                            <?php
                            $exportData[] = $row;
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>