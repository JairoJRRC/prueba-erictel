<?php
    include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Controller/UserController.php");
    $controller = new UserController();
 ?>
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
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Ciudad</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Fecha de nacimiento</th>
                        </tr>
                        </thead>
                        <?php

                        $listUser = $controller->getAll();
                        $count = 1;
                        /** @var  UserEntity $user */
                        foreach ($listUser as $user){

                            ?>
                            <tbody>
                            <tr>

                                <td>
                                    <?php echo $count++; ?>
                                </td>
                                <td>
                                    <?php echo $user->getName(); ?>
                                </td>
                                <td>
                                    <?php echo $user->getLastName(); ?>
                                </td>
                                <td>
                                    <?php echo $user->getCity(); ?>
                                </td>
                                <td>
                                    <?php echo $user->getEmail(); ?>
                                </td>
                                <td>
                                    <?php echo $user->getCellphone(); ?>
                                </td>
                                <td>
                                    <?php echo $user->getBirthDateFormat(); ?>
                                </td>
                            </tr>
                            </tbody>
                            <?php
                        }

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="Export.php" class="inline">
    <button type="submit" class="btn btn-primary">Exportar Excel</button>
</form>


</body>
</html>
