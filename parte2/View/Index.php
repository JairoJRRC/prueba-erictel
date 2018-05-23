<?php
include_once(realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..\..\parte1') . DIRECTORY_SEPARATOR . "Controller/UserController.php");
$controller = new UserController();


if (isset($_POST['formulario'])) {
    switch ($_POST['formulario']) {
        case 'insert':
            $controller->insert(
                UserEntity::create(
                    new NameInput($_POST['name']),
                    new LastNameInput($_POST['last_name']),
                    new CityInput($_POST['city']),
                    new EmailInput($_POST['email']),
                    new CellPhoneInput($_POST['cell_phone']),
                    new BirthDateInput($_POST['birth_date']))
            );
            header('Location: Index.php');
            break;
        case 'edit':
            $result = $controller->update(
                UserEntity::create(
                    new NameInput($_POST['name']),
                    new LastNameInput($_POST['last_name']),
                    new CityInput($_POST['city']),
                    new EmailInput($_POST['email']),
                    new CellPhoneInput($_POST['cell_phone']),
                    new BirthDateInput($_POST['birth_date']),
                    $_GET['id']
                )
            );

            header('Location: Index.php');
            break;

        default:
            var_dump("la funcion" . $_POST['formulario'] . " no es correcta");
            break;
    }
}

if (isset($_GET['delete']) && $_GET['delete']) {
    $controller->delete($_GET['id_user']);
}

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
                            <th>
                                <a href=<?php echo "Index.php?create=true"; ?> class="btn btn-danger btn-md"
                                role="button">Add</a>

                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php

                        $listUser = $controller->getAll();
                        $count = 1;
                        /** @var  UserEntity $user */
                        foreach ($listUser as $user) {
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
                                <td>
                                    <a href=<?php echo "Index.php?edit=true&id=" . $user->getId() . ""; ?> class="btn btn-info
                                       btn-md" role="button">Editar</a>
                                </td>
                                <td>
                                    <a href=<?php echo "Index.php?delete=true&id_user=" . $user->getId() . ""; ?> class="btn
                                       btn-danger btn-md" role="button">Eliminar</a>
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
<?php
if (isset($_GET['create']) || isset($_GET['edit'])) {
    echo "<script type='text/javascript'>
					$(document).ready(function(){
					$('#exampleModalCenter').modal('show');
					});
					</script>";
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ingrese sus datos de conexion:</h5>
            </div>
            <div class="modal-body">
                <div class="col-md-6 col-md-offset-3">
                    <?php

                    if (isset($_GET['id'])) {
                        /** @var UserEntity $user */
                        $user = $controller->find($_GET['id']);
                        ?>
                        <form method="POST" scope="user">
                            <div class="form-group">
                                <label for="name">Nombres :</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value=<?php echo $user->getName(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Apellidos :</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value=<?php echo $user->getLastName(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad :</label>
                                <input type="text" class="form-control" id="city" name="city"
                                       value=<?php echo $user->getCity(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       value=<?php echo $user->getEmail(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="cell_phone">Telefono:</label>
                                <input type="text" class="form-control" id="cell_phone" name="cell_phone"
                                       value=<?php echo $user->getCellphone(); ?>>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Fecha de nacimiento:</label>
                                <input type="text" class="form-control" id="birth_date" name="birth_date"
                                       value=<?php echo $user->changeFormat($user->getBirthDate()); ?>>
                            </div>
                            <button type="submit" class="btn btn-primary" name="formulario" value="edit">Submit</button>
                        </form>


                        <?php


                    } else {

                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="name">Nombres :</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Apellidos :</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad :</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="cell_phone">Telefono:</label>
                                <input type="text" class="form-control" id="cell_phone" name="cell_phone">
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Fecha de nacimiento:</label>
                                <input type="text" class="form-control" id="birth_date" name="birth_date">
                            </div>
                            <button type="submit" class="btn btn-primary" name="formulario" value="insert">Submit
                            </button>
                        </form>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
