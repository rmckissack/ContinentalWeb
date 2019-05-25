<?php
// this group of functions relate to the parts list
  function find_all_parts() {
    global $db;

    $sql = "SELECT * FROM Part ";
    $sql .= "ORDER BY partNumber ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  // function autocomplete_parts() {
  //   global $db;
  //
  //   $sql = "SELECT * FROM PART ";
  //   $sql .= "ORDER BY PartNum ASC";
  //   $result = mysqli_query($db, $sql);
  //   confirm_result_set($result);
  //   $auto_list = mysqli_fetch_assoc($result);
  //   echo json_encode($auto_list);
  // }

  function find_part_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Part ";
    $sql .= "WHERE partNumber='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $partResult = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $partResult; // returns an assoc. array
  }

  function insert_part($part) {
    global $db;

    $sql = "INSERT INTO Part ";
    $sql .= "(partNumber, description, packaging, perBox, perSkid, weightClass, piecePrice, mutilation, plating, mixed, noGo, boxOnly, comments) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $part['partNumber']) . "',";
    $sql .= "'" . db_escape($db, $part['description']) . "',";
    $sql .= "'" . db_escape($db, $part['packaging']) . "',";
    $sql .= "'" . db_escape($db, $part['perBox']) . "',";
    $sql .= "'" . db_escape($db, $part['perSkid']) . "',";
    $sql .= "'" . db_escape($db, $part['weightClass']) . "',";
    $sql .= "'" . db_escape($db, $part['piecePrice']) . "',";
    $sql .= "'" . db_escape($db, $part['mutilation']) . "',";
    $sql .= "'" . db_escape($db, $part['plating']) . "',";
    $sql .= "'" . db_escape($db, $part['mixed']) . "',";
    $sql .= "'" . db_escape($db, $part['noGo']) . "',";
    $sql .= "'" . db_escape($db, $part['boxOnly']) . "',";
    $sql .= "'" . db_escape($db, $part['comments']) . "')";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_part($part) {
    global $db;

    $sql = "UPDATE Part SET ";
    $sql .= "partNumber='" . db_escape($db, $part['partNumber']) . "', ";
    $sql .= "description='" . db_escape($db, $part['description']) . "', ";
    $sql .= "packaging='" . db_escape($db, $part['packaging']) . "', ";
    $sql .= "perBox='" . db_escape($db, $part['perBox']) . "', ";
    $sql .= "perSkid='" . db_escape($db, $part['perSkid']) . "', ";
    $sql .= "weightClass='" . db_escape($db, $part['weightClass']) . "', ";
    $sql .= "piecePrice='" . db_escape($db, $part['piecePrice']) . "', ";
    $sql .= "mutilation='" . db_escape($db, $part['mutilation']) . "', ";
    $sql .= "plating='" . db_escape($db, $part['plating']) . "',";
    $sql .= "mixed='" . db_escape($db, $part['mixed']) . "', ";
    $sql .= "noGo='" . db_escape($db, $part['noGo']) . "', ";
    $sql .= "boxOnly='" . db_escape($db, $part['boxOnly']) . "', ";
    $sql .= "comments='" . db_escape($db, $part['comments']) . "'";
    $sql .= "WHERE partNumber='" . db_escape($db, $part['partNumber']) . "' ";
    $sql .= "LIMIT 1";


    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function find_part_photos($partNumber) {
    global $db;

    $sql = "SELECT * FROM Photo ";
    $sql .= "WHERE partNumber='" . db_escape($db, $partNumber) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $partResult = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $partResult; // returns an assoc. array
  }



// start section for inbound functions

function find_all_inbound() {
  global $db;

  $sql = "SELECT * FROM Inbound ";
  $sql .= "ORDER BY inDate ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_all_inbound_month() {
  global $db;

  $sql = "SELECT * FROM Inbound ";
  $sql .= "WHERE inDate between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()";
  $sql .= "ORDER BY inDate ASC ";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_inbound_by_date($inDate) {
  global $db;

  $sql = "SELECT * FROM Inbound ";
  $sql .= "WHERE inDate='" . db_escape($db, $inDate) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $InBound = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $inBound; // returns an assoc. array
}

function find_inbound_by_BOL($inboundBOL) {
  global $db;

  $sql = "SELECT * FROM Inbound ";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inboundBOL) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $inBoundResult = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $inBoundResult; // returns an assoc. array
}

function insert_inbound($Inbound) {
  global $db;

  $sql = "INSERT INTO Inbound ";
  $sql .= "(inDate, inboundBOL, tripNumber, note) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $Inbound['inDate']) . "',";
  $sql .= "'" . db_escape($db, $Inbound['inboundBOL']) . "',";
  $sql .= "'" . db_escape($db, $Inbound['tripNum']) . "',";
  $sql .= "'" . db_escape($db, $Inbound['note']) . "')";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function insert_inbound_item($new_item) {
  global $db;

  $sql = "INSERT INTO InItems ";
  $sql .= "(inboundBOL, lotId, poNumber, quantityOfTubs, quantityOfSkids, quantityOfBoxes) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $new_item['inboundBOL']) . "',";
  // $sql .= "'" . db_escape($db, $new_item['PartNum']) . "',";
  $sql .= "'" . db_escape($db, $new_item['lotId']) . "',";
  $sql .= "'" . db_escape($db, $new_item['poNumber']) . "',";
  $sql .= "'" . db_escape($db, $new_item['quantityOfTubs']) . "',";
  $sql .= "'" . db_escape($db, $new_item['quantityOfSkids']) . "',";
  $sql .= "'" . db_escape($db, $new_item['quantityOfBoxes']) . "');";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function insert_LOT($new_LOT) {
  global $db;

  $sql = "INSERT INTO Lot ";
  $sql .= "(lotNumber, partNumber, dueDate, hotList, completed) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $new_LOT['lotNumber']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['partNumber']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['dueDate']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['hotList']) . "',";
  $sql .= "'" . db_escape($db, $new_LOT['completed']) . "');";

  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    $last_id = $db->insert_id;
    return $last_id;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function find_inbound_items_by_date($inDate) {
  global $db;

  $sql = "SELECT * FROM InItems ";
  $sql .= "WHERE inDate='" . db_escape($db, $inDate) . "'";
  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  return $item_result;
}


function find_inbound_items_by_BOL($inboundBOL) {
  global $db;

  $sql = "SELECT * FROM InWithLot ";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inboundBOL) . "'";

  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  return $item_result;
}

function find_inbound_items_by_BOL_and_lot($inboundBOL, $lotNumber) {
  global $db;

  $sql = "SELECT * FROM InWithLot ";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inboundBOL) . "' ";
  $sql .= "AND lotNumber='" . db_escape($db, $lotNumber) . "';";

  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  $itemSet = mysqli_fetch_assoc($item_result);
  mysqli_free_result($item_result);
  return $itemSet;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}
function find_by_lot($LotNum) {
  global $db;

  $sql = "SELECT * FROM InWithLot ";
  $sql .= "WHERE lotNumber='" . db_escape($db, $lotNumber) . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}

function update_inbound($inbound) {
  global $db;

  $sql = "UPDATE Inbound SET ";
  // $sql .= "inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "inDate='" . db_escape($db, $inbound['inDate']) . "',";
  $sql .= "tripNumber='" . db_escape($db, $inbound['tripNumber']) . "',";
  $sql .= "note='" . db_escape($db, $inbound['note']) . "'";
  $sql .= "WHERE inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function update_inbound_item($in_item_update) {
  global $db;

  $sql = "UPDATE InItems SET ";
  // $sql .= "inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "poNumber='" . db_escape($db, $in_item_update['poNumber']) . "', ";
  $sql .= "quantityOfTubs='" . db_escape($db, $in_item_update['quantityOfTubs']) . "', ";
  $sql .= "quantityOfSkids='" . db_escape($db, $in_item_update['quantityOfSkids']) . "', ";
  $sql .= "quantityOfBoxes='" . db_escape($db, $in_item_update['quantityOfBoxes']) . "' ";
  $sql .= "WHERE inItemId='" . db_escape($db, $in_item_update['inItemId']) . "' ";
  $sql .= "LIMIT 1;";


  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function update_inbound_lot($lot_update) {
  global $db;

  $sql = "UPDATE Lot SET ";
  // $sql .= "inboundBOL='" . db_escape($db, $inbound['inboundBOL']) . "',";
  $sql .= "lotNumber='" . db_escape($db, $lot_update['lotNumber']) . "', ";
  $sql .= "partNumber='" . db_escape($db, $lot_update['partNumber']) . "', ";
  $sql .= "dueDate='" . db_escape($db, $lot_update['dueDate']) . "', ";
  $sql .= "hotList='" . db_escape($db, $lot_update['hotList']) . "', ";
  $sql .= "completed='" . db_escape($db, $lot_update['completed']) . "' ";
  $sql .= "WHERE LOT.lotId='" . db_escape($db, $lot_update['lotId']) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


function fifo_list() {
  global $db;

  $sql = "SELECT * FROM InWithLot ";
  $sql .= "WHERE completed = '0' or completed is null ";
  $sql .= "ORDER BY hotList DESC, CASE WHEN dueDate = '0000-00-00' THEN 2 ELSE 1 END,  dueDate, inDate, lotNumber";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
return $item_result;

}

function find_all_box_type() {
  global $db;

  $sql = "SELECT * FROM Box ";
  $sql .= "ORDER BY box ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_all_outbound_month() {
  global $db;

  $sql = "SELECT * FROM Outbound ";
  $sql .= "WHERE dateOut between (CURDATE() - INTERVAL 1 MONTH ) and (CURDATE() + INTERVAL 1 MONTH )";
  $sql .= "ORDER BY dateOut ASC ";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}


function insert_outbound($outBound) {
  global $db;

  $sql = "INSERT INTO Outbound ";
  $sql .= "(dateOut, tripNumber, emptyTubs, note) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $outBound['dateOut']) . "',";
  // $sql .= "'" . db_escape($db, $inbound['BOL']) . "',";
  $sql .= "'" . db_escape($db, $outBound['tripNumber']) . "',";
  $sql .= "'" . db_escape($db, $outBound['emptyTubs']) . "',";
  $sql .= "'" . db_escape($db, $outBound['note']) . "')";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}


// functions for sorting

function available_lots() {
  global $db;

  $sql = "SELECT * FROM InWithLot ";
  $sql .= "WHERE completed = '0' or completed is null ";
  $sql .= "ORDER BY  hotList DESC, lotNumber";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
return $item_result;

}



function find_all_employees() {
  global $db;

  $sql = "SELECT * FROM Employee ";
  $sql .= "ORDER BY lastName ASC, firstName ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_employee_by_id($id) {
  global $db;

  $sql = "SELECT * FROM Employee ";
  $sql .= "WHERE employeeId='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $employeeResult = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $employeeResult; // returns an assoc. array
}

function insert_employee($employee) {
  global $db;

  $sql = "INSERT INTO Employee ";
  $sql .= "(lastName, firstName, homePhone, cellPhone, address, city, state, zip, startDate, endDate, workStatusId, dateOfBirth) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $employee['lastName']) . "',";
  $sql .= "'" . db_escape($db, $employee['firstName']) . "',";
  $sql .= "'" . db_escape($db, $employee['homePhone']) . "',";
  $sql .= "'" . db_escape($db, $employee['cellPhone']) . "',";
  $sql .= "'" . db_escape($db, $employee['address']) . "',";
  $sql .= "'" . db_escape($db, $employee['city']) . "',";
  $sql .= "'" . db_escape($db, $employee['state']) . "',";
  $sql .= "'" . db_escape($db, $employee['zip']) . "',";
  $sql .= "'" . db_escape($db, $employee['startDate']) . "',";
  $sql .= "'" . db_escape($db, $employee['endDate']) . "',";
  $sql .= "'" . db_escape($db, $employee['workStatusID']) . "',";
  $sql .= "'" . db_escape($db, $employee['dateOfBirth']) . "')";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_employee($details) {
  global $db;

  $sql = "UPDATE Employee SET ";
  $sql .= "employeeId='" . db_escape($db, $details['employeeId']) . "', ";
  $sql .= "lastName='" . db_escape($db, $details['lastName']) . "', ";
  $sql .= "firstName='" . db_escape($db, $details['firstName']) . "', ";
  $sql .= "homePhone='" . db_escape($db, $details['homePhone']) . "', ";
  $sql .= "cellPhone='" . db_escape($db, $details['cellPhone']) . "', ";
  $sql .= "address='" . db_escape($db, $details['address']) . "', ";
  $sql .= "city='" . db_escape($db, $details['city']) . "', ";
  $sql .= "state='" . db_escape($db, $details['state']) . "', ";
  $sql .= "zip='" . db_escape($db, $details['zip']) . "',";
  $sql .= "startDate='" . db_escape($db, $details['startDate']) . "', ";
  $sql .= "endDate='" . db_escape($db, $details['endDate']) . "', ";
  $sql .= "workStatusId='" . db_escape($db, $details['workStatusId']) . "', ";
  $sql .= "dateOfBirth='" . db_escape($db, $details['dateOfBirth']) . "'";
  $sql .= "WHERE employeeId='" . db_escape($db, $details['employeeId']) . "' ";
  $sql .= "LIMIT 1";


  $result = mysqli_query($db, $sql);
  // For UPDATE statements, $result is true/false
  if($result) {
    return true;
  } else {
    // UPDATE failed

    db_disconnect($db);
    return mysqli_error($db);
    exit;
  }

}

function find_all_work_status() {
  global $db;

  $sql = "SELECT * FROM WorkStatus ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function all_sort_tables() {
  global $db;

  $sql = "SELECT * FROM SortTables ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_by_lot_id($LotId) {
  global $db;

  $sql = "SELECT * FROM InWithLot ";
  $sql .= "WHERE lotId='" . db_escape($db, $LotId) . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

  // $item_result = mysqli_query($db, $sql);
  // confirm_result_set($item_result);
  // return $item_result;
}

function find_tally_by_id($tallyId) {
  global $db;

  $sql = "SELECT * FROM Tally ";
  $sql .= "WHERE tallyId='" . db_escape($db, $tallyId) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $tally = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $tally; // returns an assoc. array
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


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

  $sql = "SELECT " . $category . " FROM Tally ";
  $sql .= "WHERE tallyId='" . $tallyId . "';";

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

}

function find_box_qty($tallyId) {
  global $db;



  $sql = "SELECT count(*) FROM BoxCount ";
  $sql .= "WHERE tallyId = " . $tallyId ;

$item_result = mysqli_query($db, $sql);
confirm_result_set($item_result);
$itemSet = mysqli_fetch_assoc($item_result);
mysqli_free_result($item_result);
return $itemSet;

}

function employee_names() {
  find_all_employees();
$employee_list = find_all_employees(); // get list of employees for drop down list


while($name1 = mysqli_fetch_assoc($employee_list)) {
    echo '<option value="' . h($name1['employeeId']) .'">' . h($name1['lastName']) . ', ' . h($name1['firstName']) . '</option>';
    }
  }




function total_tubs_on_bol($thisBOL)   {
      global $db;

    $sql = "SELECT SUM(quantityOfTubs) ";
    $sql .= "AS totalTubs ";
    $sql .= "FROM InItems ";
    $sql .= "WHERE inboundBOL ='" . db_escape($db, $thisBOL) . "';";


  $item_result = mysqli_query($db, $sql);
  confirm_result_set($item_result);
  $itemSet = mysqli_fetch_assoc($item_result);
  return $itemSet;


}

function insert_user($user) {
  global $db;

  $sql = "INSERT INTO Users ";
  $sql .= "(userName, password, firstName, lastName, time, email, dateAdded, active, level) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $user['userName']) . "',";
  $sql .= "'" . db_escape($db, $user['password']) . "',";
  $sql .= "'" . db_escape($db, $user['firstName']) . "',";
  $sql .= "'" . db_escape($db, $user['lastName']) . "',";
  $sql .= "'" . db_escape($db, $user['time']) . "',";
  $sql .= "'" . db_escape($db, $user['email']) . "',";
  $sql .= "'" . db_escape($db, $user['dateAdded']) . "',";
  $sql .= "'" . db_escape($db, $user['active']) . "',";
  $sql .= "'" . db_escape($db, $user['level']) . "')";
  echo $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    // echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function dbUserData($username) {
  global $db;

  $sql = "SELECT * FROM Users ";
  $sql .= "WHERE userName ='" . db_escape($db, $username) . "'";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $userResult = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $userResult;
}

function find_employee_time_by_tally_id($tally_id) {
  global $db;

  $sql = "SELECT * FROM TallyTime ";
  $sql .= "WHERE tallyId='" . db_escape($db, $tally_id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result; // returns an assoc. array
}


function lot_completed($lotId) {
  global $db;
echo "lot completed";
  $sql = "UPDATE Lot SET ";
  $sql .= "completed = '1' ";
  $sql .= "WHERE lotId = '" . $lotId . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  // mysql_free_result($result);
    return;
}

function overrun($overrun, $tallyId) {
  global $db;
echo "overrun" . $overrun;
  $sql = "UPDATE Tally SET ";
  $sql .= "overflow = '" . $overrun . "' ";
  $sql .= "WHERE tallyId = '" . $tallyId . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  // mysql_free_result($result);
  return;

}

function employee_tally_list($tally_id) {
global $db;

$sql = "SELECT TallyTime.timeId, TallyTime.employeeId, TallyTime.startTime, TallyTime.stopTime, TallyTime.tallyId, Employee.employeeId, ";
$sql .= "CONCAT_WS (',', `lastName`, `firstName`) AS `wholeName` "; 
$sql .= "FROM Employee ";
$sql .= "INNER JOIN TallyTime ON TallyTime.employeeId=Employee.employeeId ";
$sql .= "WHERE TallyTime.tallyId = '" . $tally_id . "' ";

$result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;

}

function stop_time($timeId) {
global $db;

$sql = "UPDATE TallyTime SET ";
$sql .= "stopTime = '" . NOW()  . "' ";
$sql .= "WHERE timeId = '" . $timeId . "' ";

}

?>
