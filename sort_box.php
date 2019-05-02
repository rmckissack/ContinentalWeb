<?php
require_once("f_initialize.php");

$tallyId = e($_POST['tallyId']);
$dateTime = date('Y-m-d H:i:s');

global $db;

  $sql = "INSERT INTO BOX_COUNT ";
  $sql .= "(tallyID, boxTime) ";
  $sql .= "VALUES (" . $tallyId . ", now());";
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    
  $newBoxTotal = find_box_qty($tallyId);
  
  echo json_encode($newBoxTotal);
  
  } else {
    // UPDATE failed
    echo mysqli_error($db);
   db_disconnect($db);
  exit;
  }





?>
