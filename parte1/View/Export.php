<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 5:09 AM
 */
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Controller/UserController.php");
$controller = new UserController();

$filename = "data_erictel_" . date('Ymd') . ".xls";
header("Content-Type: application/vnd.ms-excel");
header(sprintf("Content-Disposition: attachment; filename=%s",$filename));
$show_coloumn = false;

if (!empty($controller->getAll())) {
    /** @var UserEntity $row */
    foreach ($controller->getAll() as $row) {
            if (!$show_coloumn) {
                echo implode("\t", array_keys($row->getArrayParams())) . "\n";
                $show_coloumn = true;
            }
            echo implode("\t", array_values($row->getArrayParams())) . "\n";
    }
}
exit;