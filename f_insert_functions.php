<?php

function insert_tally_sheet($selected_lot_id, $selected_table, $date) {
  global $db;


  $sql = "INSERT INTO TALLY ";
  $sql .= "(LotId, table_num, TallyDate) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $selected_lot_id) . "', ";
  $sql .= "'" . db_escape($db, $selected_table) . "',";
  $sql .= "'" . db_escape($db, $date) . "');";


//  echo "insert_tally_sheet" . $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    $tally_id = $db->insert_id;
    $tally_address = 'sort_tallysheet.php?tally=' . h(u($tally_id)) . '&lot=' . h(u($selected_lot_id)) . '&table=' . h(u($selected_table)); 

    header("Location:" . $tally_address);
  exit();

    return true;
  } else {
    // INSERT failed
    echo $sql;
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}




?>
