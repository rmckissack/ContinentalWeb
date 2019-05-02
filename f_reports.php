<?php


function tally_detail($lotNum) {
  global $db;

  $sql = "SELECT * FROM TALLY_VIEW ";
  $sql .= "WHERE Lot ='" . db_escape($db, $lotNum) . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
// $itemSet = mysqli_fetch_assoc($item_result);
// mysqli_free_result($item_result);
return $item_result;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}



// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



?>
