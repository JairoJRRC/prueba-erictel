<?php
session_start();
if(isset($_REQUEST['export'])) {
    export();
}
function cleanData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

function export() {
    $filename = "data_" . date('Ymd') . ".xls";

    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");

    $connectionInfo = array("Database" => "DB_ERICTEL", "UID" => $_SESSION['user'], "PWD" => $_SESSION['password']);
    $conn = sqlsrv_connect($_SESSION['serverName'], $connectionInfo);

    $result = sqlsrv_query($conn,"SELECT * FROM TB_USUARIO ORDER BY id");
    $flag = false;
    while($row =  sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        if(!$flag) {
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        array_walk($row, 'cleanData');
        echo implode("\t", array_values($row)) . "\n";
    }
}
exit;
?>