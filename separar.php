<?php
    var_dump($_REQUEST);exit;
    function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

        
      $filename = "website_data_" . date('Ymd') . ".xls";

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Type: application/vnd.ms-excel");
      $data = $_POST['exportData'];
      $flag = false;
      foreach($data as $row) {
        if(!$flag) {
          echo implode("\t", array_keys($row)) . "\r\n";
          $flag = true;
        }
        array_walk($row, __NAMESPACE__ . '\cleanData');
        echo implode("\t", array_values($row)) . "\r\n";
      }
      exit;
?>