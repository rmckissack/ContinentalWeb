<?php 
require_once("f_initialize.php");


function update_tally_qty($tallyId, $category, $change) {
  global $db;

  // echo ("SRB seaperation complete" . $tallyId . $category . $change . " XXX");
  $sql = "UPDATE Tally SET ";
  // echo ("sql statement" . $sql);
  $sql .= $category . " = " . $category . " + " . $change;
  // echo ("sql statement" . $sql);
  $sql .= " WHERE tallyId=" . $tallyId;

  echo ("db statement" . $db . "\n");
  echo ("sql statement" . $db . "\n" . $sql . "\n");

  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
    // find_tally_qty($tallyId, $category);
  } else {
    // UPDATE failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


 ?>
