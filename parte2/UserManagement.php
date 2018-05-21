<?php
session_start();
include('InputForm.php');
include('config.php');

if (isset($_POST['formulario'])) {
    switch ($_POST['formulario']) {
        case 'insert':

            $validate = new InputForm(
                $_POST['name'],
                $_POST['last_name'],
                $_POST['city'],
                $_POST['email'],
                $_POST['cell_phone'],
                $_POST['birth_date']);
            insertUser($validate);
            break;
        case 'edit':

            $validate = new InputForm(
                $_POST['name'],
                $_POST['last_name'],
                $_POST['city'],
                $_POST['email'],
                $_POST['cell_phone'],
                $_POST['birth_date']);

            editUser($validate, $_GET['id']);
            break;

        default:
            var_dump("la funcion" . $_POST['formulario'] . " no es correcta");
            break;
    }
}

if (isset($_GET['delete']) && $_GET['delete']) {
    deleteUser($_GET['id']);
}


function insertUser(InputForm $input)
{

    $connectionInfo = array("Database" => "DB_ERICTEL", "UID" => $_SESSION['user'], "PWD" => $_SESSION['password']);
    $conn = sqlsrv_connect($_SESSION['serverName'], $connectionInfo);
    $_SESSION['conexionBD'] = $conn;
    $sql = sprintf("insert into usuario_datos(name, last_name, city, email, cellphone, birth_date) values ('%s', '%s', '%s', '%s', %s, %s)",
        $input->name, $input->lastName, $input->city, $input->email, $input->cellphone, $input->birthDate);

    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt) {
        header('Location: listado.php');
        exit();
    } else {
        echo "Conexión no se pudo establecer.";
        die(print_r(sqlsrv_errors(), true));
        exit;
    }
}

function editUser(InputForm $input, $id)
{

    $connectionInfo = array("Database" => "DB_ERICTEL", "UID" => $_SESSION['user'], "PWD" => $_SESSION['password']);
    $conn = sqlsrv_connect($_SESSION['serverName'], $connectionInfo);

    $sql = sprintf("UPDATE usuario_datos SET name = '%s', last_name = '%s', city = '%s', email = '%s', cellphone = %s, birth_date = %s WHERE id = %s",
        $input->name, $input->lastName, $input->city, $input->email, $input->cellphone, $input->birthDate, $id);

    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt) {
        header('Location: views/listado.php');
        exit();
    } else {
        echo "Conexión no se pudo establecer.";
        die(print_r(sqlsrv_errors(), true));
        exit;
    }
}

function getUser($id)
{

    $connectionInfo = array("Database" => "DB_ERICTEL", "UID" => $_SESSION['user'], "PWD" => $_SESSION['password']);
    $conn = sqlsrv_connect($_SESSION['serverName'], $connectionInfo);

    $sql = sprintf("SELECT * FROM usuario_datos where id = %s", $id);

    $stmt = sqlsrv_query($conn, $sql);

    return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
}

function deleteUser($id)
{

    $connectionInfo = array("Database" => "DB_ERICTEL", "UID" => $_SESSION['user'], "PWD" => $_SESSION['password']);
    $conn = sqlsrv_connect($_SESSION['serverName'], $connectionInfo);

    $sql = sprintf("DELETE FROM usuario_datos WHERE id = %s", $id);

    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt) {
        header('Location: views/listado.php');
        exit();
    } else {
        echo "Conexión no se pudo establecer.";
        die(print_r(sqlsrv_errors(), true));
        exit;
    }
}

?>