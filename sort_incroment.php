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

global $db;

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
