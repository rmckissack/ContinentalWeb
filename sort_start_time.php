<?php
require_once("f_initialize.php");

$tallyId = e($_POST['tallyId']);
$charCode = e($_POST['charCode']);
$incroment = e($_POST['incroment']);

switch ($charCode) {
  case 109:
    $category = "mutilation";
    break;
  case 112:
    $category = "plating";
    break;
  case 120:
    $category = "mixed";
    break;

  default:
    break;
}


function start_tally_time($tallyId, $sorterID, $startTime) {
    global $db;
  
  
  $sql = "INSERT INTO TALLY_TIME ";
    $sql .= "(employeeId, startTime, tallyId) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $sorterID) . "',";
    $sql .= "'" . db_escape($db, $startTime) . "',";
    $sql .= "'" . db_escape($db, $tallyId) . "'";
    echo $sql;
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return mysqli_insert_id($con);
    } else {
      // INSERT failed
      // echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  $sql = "UPDATE TALLY SET ";
  $sql .= $category . "= " . $category . " +" . $incroment;
  $sql .= " WHERE tallyId= " . $tallyId;
  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    
  $newTotal = find_tally_qty($tallyId, $category);
  
  echo json_encode($newTotal);
  
  } else {
    // UPDATE failed
    echo mysqli_error($db);
   db_disconnect($db);
  exit;
  }





?>
