<?php
  function connectDB() {
    $username = "gcheng_mmda225_ecommerce";
    $password = "E04T1mR-^jBw";
    $database = "gcheng_mmda225_ecommerce";
    $host = "127.0.0.1";
    $mysqli = @mysqli_connect($host, $username, $password, $database);
    return mysqli_connect_errno() ? "Error: Failed to connect to MySQL:" . mysqli_connect_error() : $mysqli;
  }
  function insertRecord($mysqli, $sql) {
    return @mysqli_query($mysqli, $sql) ? "New record(s) are created successfully." : "Error:" . $sql . "[" . mysqli_error($mysqli) . "]"; 
  }
  function queryRecord($mysqli, $sql) {
    return ( $r = @mysqli_query($mysqli, $sql)) ? $r : "Error: " . $sql . "Could not retrieve the database [" . mysqli_error($mysqli) . "]";  
  }
  function closeDB($mysqli) {
    @mysqli_close($mysqli);
  }
  function isError($message) {
    if (gettype($message) == "string")
      return strpos($message, "Error:") ? true : false;
    else return false;
  }
  function remove_abnormal_string($input, $dbc) {
    return mysqli_real_escape_string($dbc, trim(strip_tags($input)));
  }
?>