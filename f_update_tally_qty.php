<?php
require_once('initialize.php');

$tallyId = $_GET['tallyId'];
$category = $_GET['category'];
$change = $_GET['change'];

if (!$_GET['tallyId']) {
    // create error message here
    echo ("Huston we have a problem");
    exit;
} else {
  echo ("Go with throtle up!");
    update_tally_qty($tallyId, $category, $change);
}




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


  function find_tally_qty($tallyId, $category) {
    global $db;
  
    $sql = "SELECT " . db_escape($db, $category) . " FROM Tally ";
    $sql .= "WHERE tallyId='" . db_escape($db, $tallyId) . "';";
  
  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  // $itemSet = mysqli_fetch_assoc($item_result);
  // mysqli_free_result($item_result);
  return $item_result;

  }

  ?>